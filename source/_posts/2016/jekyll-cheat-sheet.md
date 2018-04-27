---
title: Jekyll Cheat Sheet
date: 2016-04-06
tags:
  - static-sites
image: checklist.jpg
---
Building this blog with Jekyll has been a lot of fun for me. But while I was building it, I had to research a ton of stuff to improve my workflow and make this static site as functional as possible. So now I'd like to share some information that might be useful to anyone else new to Jekyll and would like to give it a try.

## Jekyll and Browsersync

If you want to use **Browsersync** with Jekyll, you may be a bit confused at first because both of them start their own servers. But luckily, Jekyll has different options on how it generates files. To make Jekyll play nice with Browsersync, use the `jekyll build --watch` command instead of `jekyll serve`. And then tell Browsersync to serve files from the `_site` folder. I also installed `gulp-shell` to have Gulp execute `jekyll build --watch` for me.

```js
// gulpfile.js

var browserSync = require("browser-sync").create();
var gulp = require("gulp");
var shell = require("gulp-shell");

// Jekyll Build (generates files into _site)
gulp.task("build", shell.task(["jekyll build --watch"]));

// Browsersync Task (reload is triggered when files in _site are regenerated)
gulp.task("browser-sync", function(){
    browserSync.init({
        server: { baseDir: "_site/" },
        notify: false
    });
    gulp.watch("_site/**/*").on("change", browserSync.reload);
});

// Default Task
gulp.task("default", ["build", "browser-sync"]);

```

Also remember to tell Jekyll that you don't want it to build the `node_modules` folder and any other files that are only needed in development.

```yaml
## _config.yml

exclude:
- node_modules
- bower_components
- package.json
- bower.json
- gulpfile.js
```

## Adding Disqus Comments

Before doing anything in this section, make sure you already have an account on **Disqus**. The first thing you want to do is to add your Disqus shortname to your `_config.yml` file.

```yaml
## _config.yml

title: John Doe's Blog
url: http://yourgithubusername.github.io
description: Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.
disqus_shortname: johndoe ## put your shortname here
```

Then, add the code below to the area where you want the comments to appear. An even better way to do this would be to place this code in a separate include file. Note that the `disqus_shortname` you defined in your config file is already being passed in, so you don't need to edit anything.

```html
<!-- _includes/disqus_comments.html -->

<div id="disqus_thread"></div>
<script type="text/javascript">
    var disqus_shortname = '{{ site.disqus_shortname }}';

    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();

    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
```

If you placed the code in a separate file, you can then include it in your layout. This makes your layout's code much cleaner.

```html
<!-- _layouts/post.html -->

{% if site.disqus_shortname and page.comments == true %}
<!-- this section won't appear if there is no shortname or if the post's comments are disabled -->
<section class="comments">
    <h4>Comments</h4>
    {% include disqus_comments.html %} <!-- include it here -->
</section>
{% endif %}
```

Lastly, just remember to add `comments: true` to all the posts you want to allow people to comment on.

```markdown
---
layout: post
comments: true
title: "An Epic Post About Bacon"
---

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.
```

## Adding a Formspree Contact Form

To add a contact form to a static site, you can use **Formspree**. You don't need to sign up for anything, you just need to send your form to their URL and they'll forward it to your email. They also provide special `name` attributes you can use in your form that have specific functions when using their service. You can learn more by going to their site. If you looked at their examples and noticed that I did not add an `action` attribute to this form, this will be explained later on.

```html
<form id="contact-form" autocomplete="off">
    <input type="text" name="_gotcha" style="display:none">
    <input type="hidden" name="_subject" value="Message from your site's contact page">

    <label>Name</label>
    <input type="text" name="name">

    <label>Email</label>
    <input type="email" name="_replyto">

    <label>Message</label>
    <textarea name="message"></textarea>

    <input type="submit" value="Send">
</form>
```

One issue with using Formspree is that your plaintext email would be lying around exposed in your code. This could potentially lead to a lot of spam. My solution was to obfuscate my email with JavaScript. The code below takes your base-64 encoded email, converts it back to plaintext, and concatenates it to the Formspree URL. You can then set your form's `action` attribute or submit your form using AJAX. To get your base-64 encoded email, run your plaintext email through the `btoa()` function.

```js
function getFormSubmitURL(){
    /* btoa("your@email.com");
    remember, you don't want to leave your email anywhere in your code
    so don't forget to erase it later */
    var base64_email = "eW91ckBlbWFpbC5jb20";
    return "https://formspree.io/" + atob(base64_email);
}
```

Lastly, once the form is submitted the page will be redirected to Formspree's "Thank You" page. It would be preferable if the user stayed on your site after submitting the form. One solution would be to redirect the user to an alternative page within your site by using `_next` in Formspree's `name` attributes.

```html
<input type="hidden" name="_next" value="//yourwebsite.io/thanks.html">
```

The other solution is submitting the form through AJAX so that the user doesn't leave the page at all.

```js
var $contactForm = $("#contact-form");
var $submitButton = $contactForm.find('[type="submit"]');

$.ajax({
    url: getFormSubmitURL(),
    method: "POST",
    data: $contactForm.serialize(),
    dataType: "json",
    beforeSend: function(){
        /* Disable the submit button to prevent multiple submissions
        Tell the user that the form is sending */
        $submitButton.attr("disabled", true);
        console.log("Sending message...");
    },
    success: function(data){
        /* Enable the submit button
        Tell the user that their message was sent
        Clear all the form fields */
        $submitButton.attr("disabled", false);
        console.log("Message sent.");
        $contactForm.trigger("reset");
    },
    error: function(err){
        /* Enable the submit button
        Tell the user that the message failed to send */
        $submitButton.attr("disabled", false);
        console.log("Something went wrong. Try again.");
    }
});
```

## Sharing Posts to Other Sites

If you follow any major blogs or news sites on Facebook you've probably noticed that they usually display with images and neatly presented information. If you want pages of your Jekyll site to display like that, you need to add **Open Graph** tags which are recognized by both Facebook and Google+, and **Summary Card** tags for Twitter.

### Metadata in the &lt;head&gt;

The block of code below contains most of the necessary tags for both. Note that most of the information is being pulled in from `_config.yml` so you should check first whether the options used below exist in your config file.

```html
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="{{ site.owner.twitterhandle }}">

{% if page.id %}
    <!-- This block is rendered if the page is a blog post -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ page.title }}">
    <meta property="og:description" content="{{ page.excerpt | strip_html | strip | truncatewords:30 }}">

    <meta name="twitter:title" content="{{ page.title }}">
    <meta name="twitter:description" content="{{ page.excerpt | strip_html | strip | truncatewords:30 }}">

    <meta name="description" content="{{ page.excerpt | strip_html | strip | truncatewords:30 }}">
    <meta name="author" content="{{ site.owner.name }}"> <!-- change this if someone besides you writes posts -->
{% else %}
    <!-- This block is rendered for all other pages of the site -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ site.title }}">
    <meta property="og:description" content="{{ site.description }}">

    <meta name="twitter:title" content="{{ site.title }}">
    <meta name="twitter:description" content="{{ site.description }}">

    <meta name="description" content="{{ site.description }}">
{% endif %}

{% if page.image %}
    <meta property="og:image" content="{{ site.url }}/assets/img/post-img/{{ page.image }}">
    <meta name="twitter:image:src" content="{{ site.url }}/assets/img/post-img/{{ page.image }}">
{% else %}
    <meta property="og:image" content="{{ site.url }}/assets/img/image.png">
    <meta name="twitter:image:src" content="{{ site.url }}/assets/img/image.png">
{% endif %}
```

If you want to make sure the tags you added are valid, each of the sites have their own validators where you can paste your URLs to have them checked.

### Share Links

Now that your pages display nicely when they're shared, you should also make them easier to share so that the user doesn't have to copy the URL, open another browser tab, and paste the link. Below is a snippet of sharing links for Facebook, Twitter, and Google+.

```html
<a href="https://www.facebook.com/sharer/sharer.php?u={{ site.url }}{{ page.url }}"
    onclick="window.open(this.href, 'facebook-share','width=580,height=610');return false;" title="Share on Facebook">
    Facebook
</a>
<a href="https://twitter.com/intent/tweet?text={{ page.title }}&url={{ site.url }}{{ page.url }}"
    onclick="window.open(this.href, 'twitter-share', 'width=550,height=260');return false;" title="Share on Twitter">
    Twitter
</a>
<a href="https://plus.google.com/share?url={{ site.url }}{{ page.url }}"
    onclick="window.open(this.href, 'google-plus-share', 'width=490,height=600');return false;" title="Share on Google+">
    Google+
</a>
```

### Quick Note About Kramdown and Rouge

Jekyll uses Kramdown as its markdown engine, which uses Rouge as its code highlighter. If for some reason you don't want to use Rouge and use something else like Prism, that's a problem because Kramdown applies the class `highlighter-rouge` to code blocks which doesn't work with Prism. You can disable this behavior by adding the option below to your config file.

```yaml
## _config.yml

kramdown:
  syntax_highlighter_opts:
    disable : true
```
