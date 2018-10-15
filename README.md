# My Personal Blog

This repo contains the source code of my Jigsaw powered static blog at [https://raniesantos.netlify.com](https://raniesantos.netlify.com).

Listed below are some details about this blog that other people building static sites may find useful.

If you'd like to use a similar setup for your own blog, you can just use [this template](https://github.com/raniesantos/artisan-static) that I made instead of forking this repo.

## General details

- Static site generator: [Jigsaw](http://jigsaw.tighten.co) (Laravel Blade templates)
- Hosting: [Netlify](https://www.netlify.com)
- CMS: [Netlify CMS](https://www.netlifycms.org)
- Favicons generated via [RealFaviconGenerator](https://realfavicongenerator.net)
- Image hosting: [Cloudinary](https://cloudinary.com)
- Has Google Analytics

## Posts

- Can have multiple tags
- A warning is shown if the post is potentially outdated (over 365 days old)
- Code highlighting: [highlight.js](https://github.com/highlightjs/highlight.js)
- Share buttons: [vue-social-sharing](https://github.com/nicolasbeauvais/vue-social-sharing)
- Has Facebook Open Graph and Twitter Card meta tags
- Comments: [Disqus](https://disqus.com) via [vue-disqus](https://github.com/ktquez/vue-disqus)

## Contact form

- Validation: [vee-validate](https://github.com/baianat/vee-validate) (uses Laravel-like validation)
- Form endpoint: [Jumprock](https://jumprock.co) (3rd-party service built with Laravel)
