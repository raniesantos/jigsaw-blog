---
title: Misused Mixins, Placeholders out of Place
date: 2016-04-02
tags:
  - css
image: confused.jpg
---
Today I realized that I've been making a huge mistake in the way I've been using certain features of Sass.

My main Sass file used to look something like this:

```scss
// Core
@import '0-core/variables';
@import '0-core/mixins';
@import '0-core/placeholders';

// Base
@import '1-base/resets';
@import '1-base/defaults';

// Layout
@import '2-layouts/header';

// Modules
@import '3-modules/menu';
```

In some cases I would encounter this weird problem where the styles of the modules where I would `@extend` a Sass **placeholder** would get overridden.

A quick look at the compiled CSS revealed that **the selectors I apply the placeholders to show up before** `resets.scss`.
So I decided to go to CodePen to test it just to be sure.

```scss
// code that would be in the placeholders file
%placeholder {
    font-weight: bold;
    font-family: sans-serif;
    font-size: 2em;
}

// code that would be in the resets file
h1, h2, h3, h4, h5, h6 {
    font: inherit;
}

// code that would be in the defaults file
h1 {
    @extend %placeholder;
}

article header {
    @extend %placeholder;
}
```

I was expecting the output to turn out like this:

```scss
h1, h2, h3, h4, h5, h6 {
    font: inherit;
}

h1 {
    font-weight: bold;
    font-family: sans-serif;
    font-size: 2em;
}

article header {
    font-weight: bold;
    font-family: sans-serif;
    font-size: 2em;
}
```

What I actually got was this:

```scss
h1, article header {
    font-weight: bold;
    font-family: sans-serif;
    font-size: 2em;
}

h1, h2, h3, h4, h5, h6 {
    font: inherit;
}
```

Apparently, when you extend the Sass placeholders, **their contents don't get pulled into the file where they were used, the placeholders are the ones that pull the selectors into wherever they're defined**. And since I have all my placeholders declared at the top they could easily be overridden by any styles I define afterwards.

After reading a few articles about Sass here and there, I found that there's actually a **functions** feature in Sass which is completely different from **mixins**. It was then that I realized that I've been using placeholders as mixins and mixins as functions.

Placeholders are not ideal for outputting repetitive blocks of CSS because they can ruin your source order. I should have simply used mixins without parameters for that. And all this time I thought that mixins were supposed to be the functions in Sass. But they're not. Yes, mixins can take parameters, but they are meant to return entire blocks of CSS, while functions are meant to only return a specific value to be used in a CSS rule.

Sass placeholders seem to have confused me. As of now I'm questioning their usefulness. But hopefully I can figure out how to use them correctly later on.
