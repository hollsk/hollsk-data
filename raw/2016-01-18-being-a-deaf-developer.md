---
title: On being a deaf developer and deep accessibility
description: Accessibility as a philosophy of problem-solving for everyone
excerpt: &ldquo;The power of the Web is in its universality. Access by everyone regardless of disability is an essential aspect.&rdquo;  - Tim Berners-Lee, inventor of the World Wide Web
date: 2016-01-18 13:40
lastmod: 2016-08-12 00:00
disqus_identifier: 24
---

<div class="excerpt bs-callout bs-callout-info"><p>"The power of the Web is in its universality. Access by everyone regardless of disability is an essential aspect."</p><p>- Tim Berners-Lee, inventor of the World Wide Web</p></div>

I've been deaf since infancy. It is not profound; my hearing loss is described as *moderate to severe* and is [mostly problematic at higher frequency ranges][frequencies], the range at which most human speech happens. I rely on lip-reading and identifying vowel patterns to understand spoken language. Particular struggles are:

* recognising consonants, especially [sibilants][sibilants] and unvoiced consonants (all consonants are high frequency sounds, and the unvoiced and sibilant consonants [don't activate the vocal chords][consonants])
* the beginning of sentences
* the end of sentences

Some deaf people [successfully become programmers][programmers]. It's mostly thought-based, often solitary work, where all your output is written down. Specifications and bugs come to you (in an ideal world, at least) on paper and in ticketing systems instead of through other people's noiseholes. Some areas aren't quite so fabulous (I'm looking at *you*, interminable conference call meetings involving 15 people sitting in a circle around a gigantic table), but adjustments are always possible.

The stereotype of a programmer as a solitary eccentric who's allergic to human company is unfair *and* inaccurate. As a group, we're a very social bunch. We write blogs, we speak at conferences, we produce tutorials, we mentor. This isn't new, either - it's an atmosphere that dates from before the earliest days of the internet at Bell Labs, or MIT, and scores of other R&amp;D orgs. I love this social world of code, as being able to surround yourself with competent, enthusiastic individuals is a big part of becoming a better developer yourself. But one thing that I've always felt shut out of is pair programming.

Pair programming, in principle, is great - it's like [Rubber Duck debugging][rubberduck] on steroids. You work together with another person who knows more than you and can guide you, or who perhaps knows less and will appreciate your guidance, or who perhaps knows precisely the same amount as you and can work with you to hash out a solution. Plus, y'know, it's fun. You get to know your colleagues. You get to remind yourself that *everyone* makes mistakes sometimes. You have somebody to catch you before you deploy that bit of code you are definitely not supposed to be deploying.

But when you're deaf, that dynamic changes and the fun gets sucked out of it. For me, pairing sessions are worse than useless. As a driver, trying to think about the code, type, simultaneously look at the screen in front and lipread the pairing partner beside me, *and* understand their (often contextless), higher-frequency, spoken English and technical jargon with [~30% success rate][lipreading] is a recipe for misery. Eventually I start staring glumly at an increasingly frustrated navigator before eventually relinquishing control and letting them drive instead, as it's the only way we'll be able to progress. Navigating is even worse - drivers look at their screen pretty much constantly because it's *hard* to think about how2code *and* your pairing partner's communication needs at the same time. I know! I _know_. So I become a passive navigator, and the driver does all the work, and it's just no good for anyone and eurgh. Eurgh!

So it was great to get the opportunity to pair with [Rowan Manning][rowanmanning] on the [Pa11y][github] project, the automated accessibility testing tool built for [Nature][nature]. Using [Screenhero][screenhero] to set up a remote pairing session meant that we could both look at the screen and use text to communicate, losing no information and generating no confusion. This was the first time I've done a pairing session that worked as it should. It's difficult to express what a difference this makes as I think most hearing people find it hard to appreciate how much information loss occurs in general conversation with a deaf person. Imagine that in your city that all the books you've ever read have had ~60% of the words in them randomly blanked out with a Sharpie. Then imagine going on holiday to a neighbouring city where (mercifully) nobody does that and you can suddenly read an entire book without needing to guess at anything. It's a bit like that.

There's a larger story here. At Nature, we have a set of developers who truly do care about accessibility. Providing equal access to Nature's 400-odd websites underpins everything that we do - when Tim Berners-Lee says that, "The power of the Web is in its universality. Access by everyone regardless of disability is an essential aspect", we agree. That grokking of accessibility runs deep, and at the time I've spent at Nature I've enjoyed unparalleled support from my colleagues in the form of notes, live-feeds of meetings, using [the ball method][football] to help me keep track of who's talking in group discussions, and pushing me to get support from [Access to Work][a2w]. I've had more practical support for my disability in the 3 years I've been with Nature than in my 34 years of being alive!

The opportunity to work alongside these accessibility grokkers at Nature has been great. They make no assumptions about ability and provide full access by default. So they get [accessibility experts in][abilitynet] to look at our sites and make recommendations, they [strongly apply WCAG standards][wcag] and [build tools][pa11y] to help meet those standards. When they're confronted with a real live disabled person on their honest-to-goodness actual team, they do everything that they can to help that person be a productive member of the group.

Accessibility is considered a niche discipline. It shouldn't be. Disabled people are considered by developers to be a tiny minority. [We aren't][minority]. [Equal access is a right][dda].

If you provide it, you make the web, and the world, better for everyone.

This post was originally written for [Cruft.io][cruft], the Nature tech blog.

[frequencies]: http://www.noisehelp.com/high-frequency-hearing-loss.html
[sibilants]: https://en.wikipedia.org/wiki/Sibilant
[consonants]: http://www.elearnenglishlanguage.com/blog/learn-english/pronunciation/consonants-voiced-unvoiced/
[programmers]: https://www.reddit.com/r/programming/comments/az7tu/do_you_think_a_deaf_programmer_can_still_be/
[rubberduck]: http://c2.com/cgi/wiki?RubberDucking
[lipreading]: http://allthingslinguistic.com/post/108295580685/but-you-can-lip-read-right
[rowanmanning]: http://rowanmanning.com/
[github]: https://github.com/nature/pa11y
[nature]: http://www.nature.com/
[screenhero]: https://screenhero.com/
[football]: http://www.theguardian.com/careers/careers-blog/deaf-office-workers
[a2w]: https://www.gov.uk/access-to-work/overview
[abilitynet]: https://www.abilitynet.org.uk
[wcag]: http://www.nature.com/info/accessibility_statement.html
[pa11y]: http://pa11y.org/
[minority]: http://www.newstatesman.com/media/2014/08/bbc-s-plans-show-more-disabled-people-tv-are-good-they-should-be-better
[dda]: https://www.gov.uk/rights-disabled-person/the-equality-act-2010-and-un-convention
[cruft]: http://cruft.io/posts/deep-accessibility/