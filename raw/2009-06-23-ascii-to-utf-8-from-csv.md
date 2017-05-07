---
title: ASCII to UTF-8 from CSV
description: Sanitise that
date: 2009-06-23 10:11:30
lastmod: 2016-08-12 00:00
disqus_identifier: 7
---

Excel automatically exports CSV files as ASCII instead of UTF-8 which is intensely annoying if you need to put the data into a UTF-8 configured database. It's easy enough to just open the file in Notepad and resave it with the right character set, but that's no use if you're using files of unguaranteed origin.

Force the data to use UTF-8 with PHP's [iconv()](http://www.php.net/iconv) function.

```
 $handle = fopen("../path/to/csv/", 'r');
 while ((($data = fgetcsv($handle, 0, ",")) !== FALSE))
 {	
    $data0 = mysql_real_escape_string(iconv('Windows-1252', 'UTF-8//TRANSLIT',$data['0']));
    $data1 = mysql_real_escape_string(iconv('Windows-1252', 'UTF-8//TRANSLIT',$data['1']));

    $q = "INSERT INTO table (column1,column2) VALUES ('$data0','$data1') ";
    mysql_query($q) or die(mysql_error());
 }
```

Et voila, ASCII to UTF-8\. I love PHP so much. :]

PS: Always sanitise your data with [mysql_real_escape_string()](http://www.php.net/mysql_real_escape_string) or similar. You wouldn't believe the amount of production applications that are vulnerable to SQL injection attacks. Whatever you choose to use will depend on your server setup but don't leave it out, you guys, or [the Jekk](http://en.wikipedia.org/wiki/Bone_(comics)#Other_characters) will come and drag you away by your tail!