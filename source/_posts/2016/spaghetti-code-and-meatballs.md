---
title: Spaghetti Code and Meatballs
date: 2016-05-27
image: spaghetti.jpg
---
Who doesn't love spaghetti? I do, I hate it! But I'm not talking about your regular everyday spaghetti. I'm talking about spaghetti code.

## What Is Spaghetti Code?

**Spaghetti code** is a term used to describe source code that is so badly written, unreadable, and unstructured, that it just looks like a tangled mess of pasta.

Here are a few specific reasons why you should avoid writing spaghetti code:

- When you review code you have worked on before, the more likely you are to understand it.
- When you ask for someone's assistance in debugging your code, they may decline to help you because they don't want to go through the headache of cleaning up your codebase so that they can actually understand it and find the error.
- When you are collaborating with a team of developers, it is absolutely crucial that everyone can understand the code you write and you can understand theirs.

## Clean Code Basics

One of the most important rules to follow to have a clean codebase is the proper usage of indentation and whitespace. Always make sure that every pair of HTML tags, parentheses, brackets, and braces that aren't on the same line align perfectly. It can be very frustrating to go over an HTML document or a collection of functions where you can't clearly see where something starts and ends.

Line breaks can also add more clarity to your code. In a webpage for instance, there are usually related groups of HTML tags that form major components of the page. You can make these components easily distinguishable at a glance by adding line breaks before and after its opening and closing tags.

As for [non-breaking] spaces, I've found that they're especially useful for control structures such as if-statements. When you have multiple conditions they can be made easily readable by adding spaces between conditions and operators. The same idea applies when you are using several functions in one line. You can use spaces to separate the multiple parentheses that are beside each other so that they aren't confusing to look at.

It's not only important to code neatly, it's also important to code *consistently*. Decide on a coding style. Whether you indent with tabs or spaces and no matter where you place curly braces, it's not really a big deal if you're just working on code by yourself. Just stick with it and try to avoid sporadically changing your coding style between projects. And if you're working with a team, make sure that you all decide to use the same style, regardless of whether or not it's the style you personally always use.

## A Place for Everything and Everything in Its Place

Don't mix everything into one file. The more lines of code you add the harder it will be to find things. Its better to split your code into several files with clear and descriptive filenames. You might think that it's tedious to sift through dozens of files and folders, but lots of code editors nowadays have a *fuzzy-finder* feature that makes opening files extremely quick and easy.

Review your code and break it up into smaller chunks by asking the question, "What is the purpose of this code?" An easy and very straightforward example would be CSS and JavaScript. They have a distinct purpose. You should place them in external files and refrain from inserting portions of them in your HTML as much as possible.

The same goes for any other language you are using in your projects, not just these front-end languages. There should always be a separation of concerns. The MVC pattern is a good example to follow. **Models** should contain code that handle database interactions, **Controllers** take the data retrieved by the models and perform various operations on them, and **Views** take the processed data from the controllers and display them to the user.
