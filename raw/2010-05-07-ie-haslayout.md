---
title: An odd IE6 layout bug
date: 2010-05-07 14:46:31
lastmod: 2016-08-12 00:00
disqus_identifier: 11
---

IE6 is not exactly short of haslayout bugs. Certain elements have or do not have layout by default. Applying certain CSS attributes to an element can lead it to gain or lose layout. This has been [covered](http://www.satzansatz.de/cssd/onhavinglayout.html) [in-depth](http://haslayout.net/) [elsewhere](http://css-class.com/articles/explorer/guillotine/) so I won't go into it here.

![fffffuuuuu](http://hollsk.co.uk/hollsk/images/uploads/4be460078e19a.jpg){.align-right .space-left .standard-margin}

While working on the new blog for Royal Sun Alliance I encountered an awesome CSS tooltip bug whereby IE6 would apply a background colour to an absolutely-positioned element on hover, and then _not remove that background_ on release. This is apparently due to to IE6 needing to redraw the element when it changes in order to affect the background colour change. Or something, I don't really know. It took quite a long time to identify this as a haslayout issue. Demonstration code lies below:

```
<html>
<head>
<style type="text/css">
a.overlay:hover {
	text-decoration:none;
	background-color:transparent;
}
a.overlay span { 
	position:absolute; 
	left:6px; 
	top:5px; 
	background:#000000; 
	color:#ffffff; 
	padding: 50px; 
	width: 423px; 
	height:176px; 
	display:none; 
}
a.overlay:hover span{
	display:block;
}
</style>
</head>

<body>
	<div>
		<a href="#" class="overlay">
			<img src="mypic.png"/>
			<span>teaser text goes here</span>
		</a>
	</div>
</body>
</html>
```

And [here is the bug in action](http://www.hollsk.co.uk/files/haslayoutbug.html). IE7 upwards all seem fine, it's only IE6 that has the problem.

In order to stop IE6 from getting stuck retaining the background after you've moused off you've got two options, viz: either use javascript (which is what I was expressly trying to avoid), or remove the attribute that is giving the .overlay span the haslayout property. In this case, it's the position:absolute that is the culprit. You can't get away with using any of the other position attributes except from position:static, which is the default. For the purposes of this issue, I went with position:static plus some negative margins to secure the overlay element in place.