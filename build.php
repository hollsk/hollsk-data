<?php
	echo "Build script started...\n";

	/** 
	** Extract the setup block from .md files and return the info in an array
	**/
	function extractSetup($filepath){
	    $post = file_get_contents($filepath);

	    // detect the setup block
	    $delimiter = "---";
	    $startsAt = strpos($post, $delimiter) + strlen($delimiter);
	    $endsAt = strpos($post, $delimiter, $startsAt);
	    $setup = substr($post, $startsAt, $endsAt - $startsAt);

	    // turn the metadata into an array
	    $metadata = preg_split("/\\r\\n|\\r|\\n/", $setup, -1, PREG_SPLIT_NO_EMPTY);
	    foreach ($metadata as $key => $value) {
	        // extract sane key/vals 
	        $index = substr($value, 0, strpos($value, ":"));
	        $metadata[$index] = substr($value, strpos($value, ": ") + strlen(": "));
	        unset($metadata[$key]);
	    }
	    // get the rest of the content
	    $content = substr($post, $endsAt + strlen($delimiter)+2);
	    return array("content"=>$content,"metadata"=>$metadata);
	}

	/** 
	** File handling 
	**/
	function removeFile($path) {
	    if (is_file($path)) {
	    	echo "Unlinking file...\n";
	        unlink($path);
	        return true;
	    } else {
	        return true;
	    }
	}

	function writeFile($path, $json) {
	    $handle = fopen($path, 'w') or die('Cannot open file:  '.$path);
	    fwrite($handle, $json);    
	}	

	// STAGE 1: 
    echo "Collating raw md files...\n";
    $allItems = [];
    $path = __DIR__."/raw";
    $d = dir($path);
    while (false !== ($entry = $d->read())) {
        $filepath = "{$path}/{$entry}";
        // only take files, and specifically md files
        if (is_file($filepath)) {
            $pathbits = pathinfo($filepath);
            if($pathbits['extension'] == "md") {
                $postContent = extractSetup($filepath);
                array_push($allItems, array(
                    "filecreated"=>substr($entry, 0, 10),
                    "metadata"=> $postContent["metadata"],
                    "slug"=>substr($entry, 11, -3),
                    "content"=>$postContent["content"]
                    )
                );
            }
        }
    }

    // STAGE 2: 
    echo "Building posts index...\n";
    $allItems = array_reverse($allItems); // sort into reverse order (assume this will always be in date order)
    $recentposts = __DIR__."/recent.json";
    $archive = __DIR__."/archive.json";

    // add the shunter template to use and the page title
    $recentArray['layout'] = array('template'=>'archive');
    $recentArray['title'] = "Archive - hollsk.co.uk";

    $n = 0;
    foreach ($allItems as $item) {
        $recentArray['blog']["recent"][$n] = array(
            "title"=>$item['metadata']['title'],
            "date"=>$item['metadata']['date'],
            "excerpt"=>$item['metadata']['excerpt'],            
            "description"=>$item['metadata']['description'],
            "slug"=>$item['slug']
        );
        $n++;
    }
    $json = json_encode($recentArray, JSON_PRETTY_PRINT);
    if(removeFile($archive)) {
    	echo "Rebuilding archive...\n";
        writeFile($archive, $json);
    }

    // STAGE 3: 
    echo "Massaging mini archive...\n";
    $mostrecent['blog']['recent'] = array_slice($recentArray['blog']['recent'], 1, 6); // get 6 most recent
    $mostrecent['blog']["feature"] = array(
        "title"=>$recentArray['blog']['recent'][0]['title'],
        "date"=>$recentArray['blog']['recent'][0]['date'],
        "excerpt"=>$recentArray['blog']['recent'][0]['excerpt'],
        "description"=>$recentArray['blog']['recent'][0]['description'],
        "slug"=>$recentArray['blog']['recent'][0]['slug']
    );
    $json = json_encode($mostrecent, JSON_PRETTY_PRINT);
    if(removeFile($recentposts)) {
    	echo "Rebuilding mini archive...\n";
        writeFile($recentposts, $json);
    }

    // STAGE 4: 
    echo "Building homepage...\n";
    $homepage = __DIR__."/statichomepage.json";
    $dynamichomepage = __DIR__."/dynamichomepage.json";
    $homepageObject = json_decode(file_get_contents($homepage));
    $homepageObject->blog = $mostrecent['blog'];

    $json = json_encode($homepageObject, JSON_PRETTY_PRINT);
    if(removeFile($dynamichomepage)){
    	echo "Rebuilding homepage...\n";
        writeFile($dynamichomepage, $json);
    }

    // STAGE 5:
    echo "Building individual posts...\n";

	require_once 'vendor/Michelf/MarkdownExtra.inc.php';
	use \Michelf\MarkdownExtra;

    $postsdir = __DIR__."/posts";
    $newPosts = false;
    foreach ($allItems as $item) {
        // check for the markdown files in the array that don't have a json equivalent
        $filepath = "{$postsdir}/{$item["slug"]}";
        if (!is_file($filepath.".json")) {

        	echo "New post found! ...\n";
        	$newPosts = true;
            
            // add shunter template and page title
            $item['title'] = $item['metadata']['title']." - hollsk.co.uk";
            $item['layout'] = array("template"=>"post");

            // parse markdown into HTML
            $item['content'] = MarkdownExtra::defaultTransform($item['content']);
            $item['blog']['recent'] = $mostrecent['blog']['recent'];
            
            // convert it all to JSON
            $json = json_encode($item, JSON_PRETTY_PRINT);

            echo "Building post...\n";
            
            // write out any files that don't already exist
            $writefile = $filepath.".json";
            writeFile($writefile, $json);
        } 
    }  
    if($newPosts == false) {
    	echo "No new posts found...\n";
    }

    // STAGE 6:  
    echo "Congratulations on your successful build!\n";

?>