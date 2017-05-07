---
title: Using actions in Pa11y
description: We recently released Actions for Pa11y and Pa11y Dashboard. This post explores the reasons behind the change, and how to put it to use in your projects right now. 
date: 2017-03-12 14:20:00
lastmod: 2017-03-12 14:20:00
---

One of the most common questions users have when they start using [Pa11y](http://pa11y.org/) is how to perform tasks on a page before they run the tests. Most often that takes the form of logging into an account page and going through a redirect, but it could also mean things like switching to a particular tab, or waiting for something to become visible. 

We [solved this problem](https://github.com/pa11y/pa11y/issues/98) by adding a `beforeScript()` hook to allow uses to run arbitrary code before handing off the results of their actions to Pa11y for testing. It worked great! The only problem was its own success - over time people began to do more and more things with it, and some of the use cases were generating very complex code that wasn't always easy to understand. To make the best use of `beforeScript()` in a complex series of actions, you really needed to have a good model in your head for how Pa11y interacts with PhantomJS, and where your own code fits into that picture. That's fine if you're already familiar with PhantomJS scripting, but if Pa11y is your introduction to Phantom (or even to Node.js itself), figuring out what's going on can be hard. 

We [solved this new problem](https://github.com/pa11y/pa11y#actions) by adding Actions! We took inspiration from automation libraries like [Nightwatch](http://nightwatchjs.org/), as we really liked the simplicity of being able to use clean syntax to create a list of commands that could be executed in series. Although our users want to do all kinds of interesting and unique things on their pages before running tests, the actions that they take are pretty easy to condense into discrete commands - click this, wait for that, fill those fields with data. 

Let's build an example. Imagine we have an online pie shop. We want users to press a button to obtain a delicious pie, be redirected to a login page to input their account details, and then redirect them again to the delivery confirmation page (if only all pie acquisition were so easy). We're interested in the accessibility of the delivery confirmation page only, since we're able to easily test the other two pages directly. 

With `beforeScript()`, things can get kind of ugly:

```
var test = pa11y({
    beforeScript: function(page, options, next) {

        // create a function that will poll Phantom for changes to the current page...
        var waitUntil = function(condition, retries, waitOver) {
            page.evaluate(condition, function(error, result) {
                if (result || retries < 1) {
                    // Once the changes have taken place continue with Pa11y testing
                    waitOver();
                } else {
                    retries -= 1;
                    setTimeout(function() {
                        waitUntil(condition, retries, waitOver);
                    }, 200);
                }
            });
        };

        // start working through the flow of pages...
        page.evaluate(function() {

            // order a pie
            var addToCartButton = document.getElementById('addToCartButton');
            addToCartButton.click();

        }, waitUntil(function() {
              
              // wait until we're redirected to the login page
              return window.location.href === 'http://the-pa11y-pie-shop/login';

            }, 20, function() {
                page.evaluate(function() {

                    // add data to the login fields and submit
                    var user = document.querySelector('#username');
                    var password = document.querySelector('#password');
                    var submit = document.querySelector('#submit');

                    user.value = 'exampleUser';
                    password.value = 'password1234';
                    submit.click();

                }, waitUntil(function() {
                        
                        // wait until we're redirected to the delivery page, then pass the next callback to test!
                        return window.location.href === 'http://the-pa11y-pie-shop/delivery-confirmation/5px372aa8j';

                    }, 20, next)
                )
            })
        );

    }
});
```

You can see from here that there are two main problems - context switching and callback hell. `page.evaluate()` is a Phantom method. It tells the headless browser to begin evaluating the page you've passed to it, and returns a callback. We use `waitUntil()` as that callback, plugging our own function into the `beforeScript()` context, that passes off to another Phantom context, and so on. Switch in, switch out, switch in, switch out. If you're not familiar with Phantom, or with JavaScript context, this can be super confusing. 

The rat's nest of callback hell could be fixed using Promises, but that takes us into the realm of teaching JavaScript best practice. We're a tiny team of maintainers at Pa11y, and we don't really have that kind of time. And we'd still have the context switching problem. 

Let's try the same thing with Actions instead:

```
var test = pa11y({
  actions: [
    'click element #addToCartButton',
    'wait for url to be http://the-pa11y-pie-shop/login',
    'set field #username to exampleUser',
    'set field #password to password1234',
    'click element #submit',
    'wait for url to be http://the-pa11y-pie-shop/delivery-confirmation/5px372aa8j'
  ]
});
```

Easier, isn't it? 

We haven't removed `beforeScript()` as it's still really useful, but it helps if you look at using `beforeScript()` as playing in Hard Mode. When you run your tests, you can choose to use either `beforeScript()` _or_ Actions, not both. We strongly recommend using Actions if you want to take some specific, simple steps before you test a page. If the Actions we've provided are missing something that you need, please [create an issue](https://github.com/pa11y/pa11y/issues) to tell us about it! We're really pleased with this feature, and we want to make it even better. 

Actions are available in [Pa11y CLI](https://github.com/pa11y/pa11y/), [Pa11y Webservice](https://github.com/pa11y/webservice/), [Pa11y Dashboard](https://github.com/pa11y/dashboard/), and in our work-in-progress replacement for Dashboard, codenamed [Sidekick](https://github.com/pa11y/sidekick/). 

We hope you enjoy working with them! 
