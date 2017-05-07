---
title: Killing off IE6
description: How to be a massive douche over browser supprt
date: 2009-04-19 08:25:04
lastmod: 2016-08-12 00:00
disqus_identifier: 6
---

A horrifying find on the internets this morning! Edskes Software Silent Setup for Mozilla Firefox detects a user's browser, and if it catches you using Internet Explorer instead of something "standards-compliant", it'll silently install Firefox for you and then open the site you were looking at in your shiny new browser instead! It's super! It's easy! It's genius! It's... wait, no, actually it's horrible, it's black-hat web design. I never thought I'd see the day.

![how about no](http://hollsk.co.uk/hollsk/images/uploads/howaboutno.jpg){.align-right .space-left .standard-margin}

The creator of the software justifies [this monstrosity](http://edskes.net/firefoxs/) thus:

> This is just how Flash gets installed anywhere: Flash just says "click here to view this", which results in Flash being installed. This works great, because Flash is not installed by default while the installed base of Flash is over 99% percent.

This sort of ignores the idea that Flash is a useful plug-in and isn't, like, y'know, a WHOLE NEW BROWSER THAT MAKES SIGNIFICANT CHANGES TO YOUR BROWSING EXPERIENCE. As well as coding up websites and making backend systems, I find myself doing a lot of ad-hoc user support for non-technical people who have borked their machines by doing a variety of interesting and boneheaded things that take me forever to get to the bottom of. Many of these borkations are performed by the user actively choosing to download something and then forgetting that they downloaded it or why they ever wanted it in the first place. The last thing we need is somebody providing even more ways for the unscrupulous to screw these people over by installing random software on their machines. Guys, I am so shocked by this thing, seriously. I haven't been this shocked since the first time somebody sent me a link to goatse.cx back in '99\.

The most telling part of the FAQ for this script is here:

> By including Edskes Software Silent Setup for Mozilla Firefox on their website web developers no longer have to waste hours and hours on problems which occur only in non-standard compliant browsers.

Translated, what this says is "I am too lazy to do my job properly so I will force unsuspecting users to modify their behaviour to suit me". That's not good enough.

If you're incapable or unwilling of making your sites functional for all users no matter what their configurations are, then you are no longer a web developer, and you're outta the web developer club. Turn in your membership card and slope home in disgrace, because this is an Epic Fail of _extraordinarily_ epic proportions.

To be honest, if you're wasting hours and hours on cross-browser compatibility problems for every site, then you're doing it wrong in the first place. [Andy Clarke](http://forabeautifulweb.com/blog/about/five_css_design_browser_differences_i_can_live_with/) points out that:

> Please allow me to clear up a common misconception. When I talk about designs not looking exactly the same in all browsers I am not talking about making bad designs for people using older or abandoned software. I would never accept that. Or that a design should look poor or broken. Or that a person could be denied access to content or services if they are using a less capable browser. What I am talking about is creating a visual design that looks best to people who are using modern software and at the same time thinking carefully about what a person using less capable software will see. This approach is simply based around thinking about alternatives. It's little different to the way that I hope we have been taught to think about web accessibility.

The minute you give up on graceful degradation and start thinking "I have to find a way to force my users to behave consistently" is the self-same minute you've crossed over to the dark side, Anakin. There ain't no going back for you now.

The fact is that you can't force your users to browse the same way you do. Like Brian says in the Monty Python film, "you're all individuals!", and that means individual machines have individual configurations. Some people use IE, some people use Chrome. Some people are stuck using weensy displays on laptops, other people have 24" LCD behemoths. Some people hate javascript and so they never see all your fluffy Web 2.0 cruft. The web is a grand and diverse place, and if I'm honest, I'd rather keep it that way. This sort of browser discrimination helps nobody but the lazy and the incompetent.