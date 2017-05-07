---
title: MySQL timestamp works weird in older versions
description: MySQL 4. Anybody remember that?
date: 2009-01-31 05:38:43
lastmod: 2016-08-12 00:00
disqus_identifier: 1
---

So say you have a column in a database and you need it to have a timestamp in it. You think "I will use the timestamp datatype, because that is what it is for". You go ahead and do so, on your MySQL 5 installation, and it works great. The timestamp is formatted as yyyy-mm-dd hh:mm:ss. So far, so good, right?

Then you port your code and your database structure to a different server. The other server uses < MySQL 4.1\. MySQL 4.1 and under format timestamps thusly: YYYYMMDDHHMMSS, which is... less useful? Man! This had me scratching my head for at least ten minutes.

Huh. Moral of the story? I now use datetime instead.

![the more you know!](http://hollsk.co.uk/hollsk/images/uploads/MoreYouKnow.png){.align-center}