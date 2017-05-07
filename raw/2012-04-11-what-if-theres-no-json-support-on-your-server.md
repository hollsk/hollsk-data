---
title: What if there's no JSON support on your server?
description: An unlikely situation
date: 2012-04-11 09:52:39
lastmod: 2016-08-12 00:00
disqus_identifier: 17
---

Everybody loves JSON. Every webservice and its dog uses JSON because it's awesome. It's easy to work with, it makes sense, and it's simple to check its validity and so on because there are so many SDKs and in-built libs that make wrangling a JSON response into objects or arrays a breeze.

![Holy shit](http://hollsk.co.uk/hollsk/images/uploads/4f858ca750eee.jpg){.align-right .space-left .standard-margin}

But what if, one day, you discover you're working on a server that doesn't support JSON?

Yeah, I know, what is this, 1996? Unbelievably, this state of affairs does actually exist. If you can't make the webhost fix it (really dudes, just enable the module. Wtf?), then you've no choice but to resort to a library. There's a [PECL json package](http://pecl.php.net/package/json) that might do what you want, but that was a bust for me because if I couldn't persuade the webhost to switch on JSON I sure as hell wasn't going to be able to persuade them to install a PECL package.

I googled about for a while and [found some code on php.net](http://us2.php.net/manual/en/function.json-decode.php#100740) that claimed to do the job - that code is linked to in random places around the net by people who seem to think it's a great solution. The problem with this is twofold; firstly the code uses eval(), which will cause the gates of Hell to open the instant it runs and spew forth gibbering demons that will swallow your wretched, tainted little soul; and secondly it outputs what looks like an array construct but is actually a string. Which, given that PHP can't really cast the resulting string into a useful array, means it doesn't actually do anything helpful at all. Genius.

Next!

What eventually worked for me was a little [PEAR library called services_json](http://pear.php.net/pepr/pepr-proposal-show.php?id=198). Include the JSON.phps file into your project, then do your decoding and encoding like so:

```
	include('JSON.phps');
	$json = new Services_JSON();
	$arrayOfDecodedJSON = $json->decode($JSONresponseFromSomewhere);
```

That's it. You can now encode and decode JSON as though your webhost isn't some kind of bizarre throwback from the 1800s.