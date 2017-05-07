---
title: Yahoo! Weather Developer API
description: Weather 100% guaranteed
date: 2009-03-25 08:45:13
lastmod: 2016-08-12 00:00
disqus_identifier: 4
---

So I've been playing with the Yahoo! Weather API, which is quite fun. By using cURL, we can grab and then scrape the contents of Yahoo!'s weather RSS feed to find out what the current atmospheric conditions are in any given location, then use that data for your own devious ends.

![Michael Fish! Yeah!](http://hollsk.co.uk/hollsk/images/uploads/bbc_rain.gif){.align-right} Being typically London-centric, I am only interested in the weather in London, which I am sure is absolutely _fascinating_ for those of you in other parts of the UK or indeed the world (big shout out to my visitors from [Grassroots.org](http://volunteer.grassroots.org/), keep fighting the good fight, you guys!)

This idea was originally stolen outright from [CSS Tricks](http://css-tricks.com/using-weather-data-to-change-your-websites-apperance-through-php-and-css/), who posted it a year ago but I couldn't really think of a use for it. I'd already been changing this site's entire style (and haiku) depending on the current season, so it was a natural progression to do something with the weather, too. To that end, I've added a little Flash animation up the top there that changes with the weather. Usually. Sort of. In a manner of speaking. I haven't quite got round to doing a rain/snow version yet because it hardly ever rains in London, right? Riiiiiight.

Anyway, check out the tutorial on CSS Tricks and the Yahoo! Developer API for more information. It's not necessarily _useful_, but it does make otherwise static pages a bit more interesting.

_Edit: 18/04/2009_  
As an aside, I added a little bit of code to CSS Tricks' stuff for extra customisation. Those guys did it by naming a style sheet after a particular weather condition and switching to it depending on the name. If no stylesheet existed, it would default to sunny. I wanted more control, so I used a hashmap to decide on an output depending on what was pulled in. PHP is good because any array can be used as a hashmap, so making these sort of associations is super-easy, like so:

```
// this is the hashmap - the fact that practically everything is "cloudy" is a testament to my excellent generalisation skills 
// it in no way suggests that I was too lazy to replicate the full spectrum of weather possibilities
$hashmap = array(
    'cloudy' => 'cloudy',
    'partly-cloudy' => 'partly-cloudy',
    'mostly-cloudy' => 'cloudy',
    'scattered-thunderstorms' => 'thunder',
    'isolated-thundershowers' => 'thunder',
    'isolated-thunderstorms' => 'thunder',    
    'severe-thunderstorms' => 'thunder',   
    'thundershowers' => 'thunder',    
    'thunderstorms' => 'thunder',
    'hail' => 'thunder',    
    'scattered-snow-showers' => 'snow',    
    'mixed-rain-and-sleet' => 'snow',
    'mixed-snow-and-sleet' => 'snow',
    'mixed-rain-and-snow' => 'snow',    
    'light-snow-showers' => 'snow',
    'snow-flurries' => 'snow', 
    'blowing-snow' => 'snow',
    'snow-showers' => 'snow',  
    'heavy-snow' => 'snow',    
    'sleet' => 'snow',
    'snow' => 'snow',    
    'mixed-rain-and-hail' => 'cloudy',  
    'scattered-showers' => 'cloudy',    
    'freezing-drizzle' => 'cloudy',
    'freezing-rain' => 'cloudy',
    'light-rain' => 'cloudy',    
    'drizzle' => 'cloudy',
    'showers' => 'cloudy',
    'fog' => 'cloudy',
    'haze' => 'fair',
    'blustery' => 'fair',
    'windy' => 'fair',
    'clear' => 'fair',
    'fair' => 'fair'
); 

$weather = $hashmap[$condition]; // $weather_class comes from the CSS Tricks code, it's pulled with cURL

$weather_class = str_replace('-', ' ',$weather_class); 
// the RSS url we are working with may contain hyphens, so we change them to spaces instead

if (date('G') == '0') { $time = 'night'; } // check the time (24 hour time) - if it's midnight, then it's night
else if ((date('G') <= '18') && (date('G') >= '5')) { $time = "day"; } // if it's between 6pm and 5am then it's day
else { $time = 'night'; } // otherwise it's night

print "Weather in London: ".$weather_class." ";
```

From there you can use your `$time` and `$weather` variables to determine which style sheet/image/whatever you want to display.