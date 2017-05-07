---
title: IE haslayout lulz
date: 2010-10-02 08:58:10
lastmod: 2016-08-12 00:00
disqus_identifier: 12
---

The [IE developer toolbar](http://www.microsoft.com/downloads/en/details.aspx?familyid=95E06CBE-4940-4218-B75D-B8856FCED535&displaylang=en&pf=true) has been available for a while. It allows you to make live updates to a page like its analogue plugins for other browsers but does it really clunkily with the drop-down buttons and the little text fields, Delphi-style. Whatever, though, it's not that great but it's better than nothing, and it's less buggy than the standalone Firebug bookmarklet.

![Oh god.](http://hollsk.co.uk/hollsk/images/uploads/4ca72c62129f9.gif){.align-right .space-left .standard-margin}

The really useful thing about the IE dev toolbar is that it shows you whether an element has layout or not. Naturally the developers just couldn't resist the temptation to somehow screw this up, so if an element DOES have layout, the tool will show you that hasLayout is set to -1\. If, on the other hand, an element DOES NOT have layout, the toolbar won't tell you anything about hasLayout at all. Genius. I can't think of a single other system where -1 means 'on'. Thank you, Microsoft, for giving us this gift with one hand while using the other hand to sneakily slide a drawing pin onto our collective chair.

I hope this post saves you at least 5 minutes of confusion.