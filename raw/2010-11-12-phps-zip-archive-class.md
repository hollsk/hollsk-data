---
title: PHP's ZipArchive class
description: Tl;dr: your path is probably wrong.
date: 2010-11-12 07:17:39
lastmod: 2016-08-12 00:00
disqus_identifier: 13
---

I spent a few days last week trying to get [ZipArchive](http://us3.php.net/manual/en/class.ziparchive.php) working to produce on-the-fly archives for a Wordpress blog I was working on.

![Philosoraptor considers the way of the JSON](http://hollsk.co.uk/hollsk/images/uploads/4cdd4e8ded30f.jpg){.align-right .space-left .standard-margin}

This led me down a few dead-ends including "[Rackspace Cloud has issues with ZipArchive](http://www.fileslinger.com/2010/03/backupbuddy-the-holy-grail-of-wordpress-backups-is-almost-within-reach/)". Luckily this last explanation regarding Rackspace Cloud (and most likely the others too) isn't actually true and is due to a simple but easily-made misunderstanding of how ZipArchive works.

ZipArchive is, to be honest, a [bit of a pain in the arse](http://codingrecipes.com/the-annoying-php-ziparchive-class). After you've added your files using addFile() you can grab a status code from the method to indicate whether your attempt was successful - if everything's ok you'll get status 0 returned for no error.

The problem is that this check only cares about whether the method was able to actually add files to the new zip object - the file itself doesn't get written until you call zip->close(). If zip->close() fails then lolz@you because you won't be getting any notification from zipArchive itself. ZipArchive only returns true or false, thus leaving you with a silent failure.

The key is, predictably, to make sure your filepath is valid.

`$filename = "../wp-content/uploads/check-out-my-download.zip";`

is fine, but

`$filename = "/wp-content/uploads/check-out-my-download.zip";`

in some cases is not. ZipArchive may interpret the leading slash as you intending to go all the way back up to the _actual_ root directory of the document on the machine it sits on, so something like /mnt/usr/htdocs/webroot/content/wp-content/uploads/check-out-my-download.zip is what is actually produced. This is unlikely to be accessible from your application, hence the path not being located. This behaviour is bound to the way the server itself is set up, which is why some people have this problem when others don't.

If you're having difficulty getting ZipArchive to make archives but not getting any actual errors, then the above is almost certainly the problem. Be extra-careful with your filepaths.