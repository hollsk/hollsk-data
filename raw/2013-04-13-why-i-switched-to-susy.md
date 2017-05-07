---
title: Why I switched to Susy
description: Tl;dr: because everything else pretty much sucks
date: 2013-04-13 15:57:41
lastmod: 2016-08-12 00:00
disqus_identifier: 21
---

![Aw yiss](http://hollsk.co.uk/hollsk/images/uploads/aw_yiss.jpg){.align-right .space-left .standard-margin}

[Susy](http://susy.oddbird.net/) is a grid framework for Sass and Compass. It's one of approximately twenty five billion CSS grid frameworks and frankly if you're researching these now then you ought to be suffering from some serious framework fatigue. So why Susy instead of one of the other twenty five billion?

First, a bit of background. At [Pancentric](http://www.pancentric.com), the mobile side of the business was burgeoning. Rather than doing native mobile applications, we threw our hat in with responsive design, largely because the majority of the work we did was websites, often pretty big ones, that were all content-heavy but with relatively low levels of deep user interaction. But to do responsive design properly, we had to try it out ourselves.

The redesign of the Pancentric website was the obvious place to start. With no external client to answer to, we were free to experiment and test things out. A lengthy analysis process turned up approximately twenty five billion frameworks we could use, but unhappily the design had already been done by the time the coding started, which immediately meant that none of the frameworks generally available were really suitable.

This was our first mistake.

All the frameworks we looked at were the wrong size or shape or made too many assumptions about what we were going to do and how we were going to do it, or were problematic by way of semantics or accessibility. "No problem", I said, "we can roll our own".

This was our second mistake.

The creatives had given me a nicely-marked up cue sheet with all the column widths and margins and total grid size in highlighted stripes. My job was to turn this from pixel widths into percentages (we were doing a fluid-width site) and build a grid system on it. This was our third mistake (there were a lot of these). It turned out to be not quite so easy to get everything working neatly. What we ended up with was something similar to (but much, much worse than) [Twitter Bootstrap](http://twitter.github.io/bootstrap/), with rows being marked up as rows and grid panels being marked up as grid panels of whatever number of columns they were supposed to cover. This sucked for the following reasons:

*   The markup was a total mess. `<div class="grid-6 grid box theme-green blah-blah this-is-an-actual-nightmare">` is horrible to read and to work with. The only person who understood the HTML was me and I was forever correcting it after my baffled colleagues had been copying stuff from one place to another and discovering it didn't work in the way they wanted it to. In most cases it took me a good five minutes to spot that some element or another was missing or that a classname was wrong.
*   The columns stopped making sense after a while. On a 12 column grid that has 2 boxes on it, each box is worth 6 columns. On a grid with 3 boxes, each box is worth 4 columns. This is something that you need to pause and think about, in the same way you need to pause and think about what you're doing during a [Stroop test](http://en.wikipedia.org/wiki/Stroop_effect). Sure, it's hardly calculating P vs NP, but on a page with 20+ rows and different numbers of columns in each, those tiny pauses add up to a lot of time thinking about something that isn't what you really want to be thinking about.
*   Each grid box began to acquire properties that weren't strictly related to its width. A grid-3 box, taking up 3 columns in a 12 column grid, began to also have particular stylistic theme, a particular header style, say, or a particular background colour. Whenever an element was needed that was also a grid-3 box but that needed something different, like a right-aligned link at the end, or a header icon or whatever, another class needed to be stuffed in and some overrides applied in the CSS. This made the HTML even bigger and increased the noise-to-signal ratio even further. On top of that it made the CSS, which was already looking like Yog-Sothoth in digital form, even more evil, shapeless, and lumpen.
*   I set up the grid in a base .scss include file, thinking "once this is set up, I won't need to touch it again". Unfortunately I'd neglected to think about what happened at different media query breakpoints. What I _actually_ had to do was override every grid width declaration at different viewport sizes in the main .scss file so the whole "let's separate this so it's tidier!" attempt ended up completely worthless. Now not only was the code a mess because of the duplications everywhere, but I also had to manage multiple files. Ugh.
*   Halfway through the project, we figured we could do with some outside help. We got a guy in who had some experience in responsive front end to talk to us about what we were trying to achieve, and I had him look over the code and tell me what he thought I should do make it less awful. He basically said "this is far too complicated, refactor it so the media queries are separated out of the main structure, and do the mobile view first otherwise things will be needlessly difficult". All sound advice. Unhappily due to limited time available in each sprint, it led to partial refactorings where some bits of the site were mobile first and others, not so much. This was eventually fixed but while the refactoring was ongoing, things were pretty grim for everybody.
*   Correcting rounding errors is basically impossible, and we knew this going into the project. It turns out that even getting the basics of column widths in a fluid layout right isn't that easy either, and so the grid widths were adjusted again and again again, continually, over the entire project lifetime. On a project that lasted more than 7 months, this was no joke.

![Dude, come on.](http://hollsk.co.uk/hollsk/images/uploads/dudecomeon.png){.align-left .space-right .standard-margin}

Damn. _Screw this_.

This was obviously no good. We had to find some way of leveraging a standard framework or we were all going to go insane. About two-thirds of the way through the project, the PM sent me another list of frameworks to look at. I don't mind admitting that I did consider tipping the coffee jug in his lap when he did this, but I went through them again anyway. We'd looked at almost all of them before, and I diligently checked them off, explaining why we'd rejected them at the start of the project; "too restrictive; doesn't do fluid grids; impossible to separate out the style from the structure; etc; etc;" and then, suddenly, "Ooh."

![me gusta](http://hollsk.co.uk/hollsk/images/uploads/megusta.jpg){.align-right .space-left .standard-margin}

The newcomer Susy, having a purely abstract approach, looked the business. The two crucial things that Susy did for us was to reduce the amount of crap in the HTML as we no longer needed to specify any width settings as part of the class names, and it also got rid of the problem of having to add dozens of overrides for width settings through its @include span-columns(n,n) mixin. Awwwwww yiss. These two things magically got rid of all the other problems, too. Just like that. Bam. Suddenly we had a system that actually worked that wasn't a home-brewed piece of crap that nobody could understand. It even supports mobile first.

So should _you_, the intrepid researcher, use Susy? I'm going to go out on a limb here and say 'yes'. I don't use Susy for everything; if I'm working on admin control panels or demo sites that need some basic styling but I don't care for making any of it myself, I'll still use [Twitter Bootstrap](http://twitter.github.io/bootstrap/) which is excellent. But for full builds, you bet your ass I'm going to recommend you use Susy.

If you're not totally convinced, then compare our non-Susy project, at 8 months and counting for a 7-template front end, to our first Susy-based project, a 10-template front end completed in 4 months. That is some serious time-saving. It's worth it for your sanity, too.