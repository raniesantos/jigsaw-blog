---
title: 'Static Site Substitution: Jekyll to Jigsaw + Netlify'
date: 2018-07-20
tags:
  - static-sites
  - php
  - laravel
image: jigsaw.jpg
comments: true
---
A couple of years ago I created this blog with Jekyll. I'm not a Ruby guy, but Jekyll had certain advantages that were attractive at the time. It had templating which would save me from repeating HTML and I could have it automatically build and get free hosting thanks to GitHub Pages.

As time passed, a few problems started popping up that made even tiny edits become tedious. I found that I only ever install Ruby to update my blog, on Windows Jekyll started requiring me to install additional dependencies, and I used Bower and Gulp to install and compile dependencies back when I started.

I did have the idea to refresh the blog for some time but I kept putting it off. It wasn't until I heard of **[Jigsaw](http://jigsaw.tighten.co)** and **[Netlify](https://www.netlify.com)** that I got really motivated to do so.

## Jigsaw

When I started using Jigsaw, there were several advantages that were immediately apparent. I already had the necessary development environment, I got to use the Blade templating engine which I was comfortable with, and it already came with a Laravel Mix script for compiling assets. I felt right at home with Jigsaw. Truly a static site generator made by Laravel people for Laravel people.

## Netlify

GitHub Pages is a good static site host, but to me Netlify has one significant advantage over it, **flexibility**. Using anything other than Jekyll on GitHub Pages is fine, but you lose the convenience of the automatic build step. And then there's Netlify, which is so flexible that you can configure it to play nice with any static site generator, even the lesser known ones. On top of that, Netlify has a wide range of features to either enhance your site or make managing it easier. You can even add the equally flexible **[Netlify CMS](https://www.netlifycms.org)** to your site, you just need to take some time to configure it properly.

## Final Thoughts

Jekyll has been a great option for building static sites, having lots of users and resources. However, Jigsaw allows me to build with a familiar toolset and Netlify has allowed me to keep the same quick and easy deployment process even though I'm using a somewhat obscure static site generator. I'm really happy that I made these changes.
