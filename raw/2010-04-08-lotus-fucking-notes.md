---
title: Lotus Fucking Notes
description: Sent by Satan
date: 2010-04-08 11:18:01
lastmod: 2016-08-12 00:00
disqus_identifier: 10
---

Lotus Notes is a tool sent by Satan himself to destroy the souls and the pleasure of all who are forced to use it. It is particularly distressing if you are a web developer creating HTML email campaigns for B2B customers. Here are some of the things I have learned about Shitty, Shitty Notes and how to 'fix' them.

![SAVE YOURSELVES](http://hollsk.co.uk/hollsk/images/uploads/4be466fb975fe.png){.align-right .space-left .standard-margin}

*   **No background images, ever**  
    Never, not ever. Also goes for Outlook 2007.
*   **Use fallback font tags for Lotus Notes 5**  
    _Notes ignores my font style settings_  
    Notes 5 chokes on inline font-face style declarations. The safest way to make sure it picks up the correct font is to use `<font face="arial">` tags instead of your fancy-pants modern CSS.
*   **Don't bother centering tables**  
    _Notes won't center my layout_  
    There is no way to fix this. All versions of Notes will ignore `align="center"` and display everything in the top left corner instead.
*   **No CSS padding, margins, or width/height attributes**  
    _Notes collapses my padding / height / width declarations, or ignores my margins_  
    All versions of Notes will strip these CSS declarations out of your code. Width and height attributes in native HTML generally aren't respected either, being collapsed to fit the wrapped content. You can, however, use HTML's native cellpadding and cellspacing attributes to get around this, and you can also use spacer images / shims. Both of these methods have their own unique pitfalls thanks to Notes' crappiness in other areas. It will collapse or expand table cells at will, depending on the phase of the moon and what colour pants you had on when you built the email. The most reliable way to fix table cell widths is to use transparent spacer images, but only if you don't mind them being at least 12px by 12px (see below).
*   **No colspans or rowspans in tables**  
    _Notes has screwed up my complicated table!_  
    Notes will generally collapse colspans and rowspans into some other configuration that you didn't expect. But if you think this means you can use additional empty `<td>` tags then you would be wrong;
    *   **No empty table cells**  
        All tables need to contain _something_ otherwise Notes will sometimes decide not to bother displaying them. If you think this means you can get away with 1px square spacer.gif images, then you would be wrong;
*   **No images with dimensions below 12px**  
    _Notes has stretched my images beyond recognition or they won't show up at all!_  
    Older versions of Notes will freak out if you give it any images that have dimensions smaller than 12px by 12px. It'll either resize your image up to 12px, or it'll just not display it at all.
*   **Don't slice images up into sections**  
    _Notes is misaligning images in horizontal table rows_  
    Horizontally-sliced images placed into neighbouring TDs will be aligned in a variety of interesting configurations in Notes 5, but seldom ones that you actually want. This includes it screwing up the positioning of images that are aligned in place using `valign="top"` or `valign="bottom"`. If you can possibly get away with using one big horizontal image then do it.
*   **Don't expect any parent attribute to cascade into its child elements**  
    If you set a table background colour then don't expect it to carry over into any table nested inside. Don't even expect it to cascade into the child `<td>`. Set all styles in the `<td>` itself for best support.
*   **No CSS borders in Notes 5**  
    Notes 6 is fine with CSS borders, but Notes 5 won't display them. This effectively means 'no borders of any kind' in Notes 5 because of general flakiness. You can just about get away with using a background table with `cellspacing="1"` around the nested content table but even that's a pain because Notes will sometimes cram the cell contents up against the left hand side and lose your faux border anyway.
*   **No XHTML-style self-closing tags**  
    Notes 6 seems to be able to cope with XHTML-style self-closing tags ( `<br/>` or `<img />` ). Notes 5 doesn't understand self-closing line breaks at all and will ignore them if it encounters them. It sort of understands self-closing image tags, at least well enough to display a broken image placeholder instead of the image itself. Stick to HTML style tags for images and line breaks instead: `<img src="">`, `<br>`
*   **Special characters are handled in special ways**  
    By 'special' I mean, 'in some cases not at all'. There is no way to set the character encoding of a page in Notes emails so you are at the mercy of IBM and whoever is charge of the Domino server on this one. Some characters can be represented using their HTML entity (for example &raquo;). Some can be represented using their Unicode entity (for example &#27;). There don't appear to be any guides on the net regarding which ones Notes will and won't accept and I sure as shit don't have the inclination to make one, but as a general rule of thumb stick to the absolute basics and be prepared for Notes to mangle the input you give it.

Finally, the good news: If an email works in Notes, then it's pretty much guaranteed to work in anything else you throw it at. Other rendering engines have other quirks and issues but none to the same murderous-rage level that Notes has.