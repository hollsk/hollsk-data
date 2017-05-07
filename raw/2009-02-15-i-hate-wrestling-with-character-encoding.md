---
title: Wrestling with character encoding
date: 2009-02-15 12:49:49
lastmod: 2016-08-12 00:00
disqus_identifier: 3
---

Every week, literally every week, I find myself having a brand new, shiny headache with character encoding. In databases, in files, in insert statements, EVERYWHERE. It drives me insane.

This week's issue involved a massive CSV file filled with delegate information for a large European defence industry conference. Lots of people from all over Europe, with all sorts of non-Latin characters in their names! Swedish, German, French! Very exciting! Setting the database character set to UTF8 wasn't enough - the data was still ending up garbled.

Eventually it transpires that as soon as your database connection is opened, you may need to run 'SET NAMES UTF8' before you do the insert, because mysql is so hilariously flaky about character encoding. Yes, even if your [entire database has been set to use the UTF-8 character encoding and general-utf8-ci collation](http://forums.mysql.com/read.php?103,46870,247882#msg-247882).

The second, unrelated issue I had on this little project was with [strtr()](http://uk3.php.net/strtr). We needed url slugs for our delegates to access their own special content by using their own names in the url string, which of course means transliterating the non-Latin characters to Latin ones. Strtr() would cheerfully translate the entire string, but when it came to actually inserting the resultant data into the corresponding field, everything in the string after the first transliterated character would, er, be discarded. This was not particularly helpful to me, and I never did figure out a reason or find a solution. I ended up just doing each vowel transliteration individually using str_replace(). I'll probably never know what was causing the truncation, but eh. The app works, so all is well, I guess?