---
title: Regrettable Ignorance, Part 3
date: 2016-03-05
tags:
  - css
  - laravel
image: gears.jpg
---
If you're building a vehicle and you need to finish it as fast as possible or within a deadline, you wouldn't need to build every single component from scratch right? As the saying goes, *"Don't reinvent the wheel."* But what if you didn't even know the wheel already existed at the time?

In the [previous part](/blog/regrettable-ignorance-part-2) of this series I talked about the wrong and right way to manage source code. In this third part of the series, the focus is on **frameworks** that will allow you to write less code but accomplish more, significantly increasing the development speed. Please note that the following is specifically related to web development.

## Designing Your User Interface

Among the first few requirements in our class were samples of the home page and some forms. We designed them from scratch, took screenshots, and submitted the documents. Easy right? Wrong! Designing the interface for a few pages is easy, but as the application grew, more and more components and variations of the layout were needed.

What we should have done was use a **Responsive Front-End Framework**. They are collections of CSS files (and a few JavaScript files) that contain a myriad of pre-designed components such as navigation menus, panels, alert boxes, buttons, form controls, modals, progress bars, and pagination links. Most of them also have responsive grid systems which not only allow you to easily align and arrange your layout, but also ensures that your layout looks good on devices with small screens such as mobile phones.

My recommendations:

- **Zurb Foundation**
- **Twitter Bootstrap**

As I write this, Bootstrap is still the most popular front-end framework, but I prefer Foundation for the following reasons:

- Foundation is written in *Sass* (my preferred CSS preprocessor) while Bootstrap is written in *Less*.
- I conducted an experiment where I created two identical layouts using these two frameworks. The HTML I wrote in Foundation used fewer elements and class names and was much cleaner to look at.

**NOTE:** Bootstrap 4 is in development and it will now be using Sass. Yay!

## Making Your Application Functional

We wrote our project in PHP and, you guessed it, we built all the functionality from scratch too. Embarrassing, I know.

In this case, we should have used **Laravel**, a PHP **MVC Framework**. *"If Laravel was a woman I'd give it babies"*, that's how in love I've been with this framework ever since I learned it.

Here are some of Laravel's most helpful features:

- **Eloquent ORM** (Object Relational Mapper) allows you to easily perform CRUD (Create, Read, Update, Delete) operations on the database. You will almost never have to write another raw SQL query again.
- **Blade Templating Engine** provides a clean syntax for outputting data onto pages. It also has *template inheritance*, an extremely useful technique for making reusable HTML layouts.
- **Carbon** gives you lots of functions for simplified date/time manipulation and calculation.
- Built-in authentication system for logging the user in and out.
- Built-in validator with a large selection of ready-to-use validation rules.
- Fast and simple pagination.

If you want to know more, there is an abundance of Laravel tutorials on the internet.

## When to Use a Framework

If you're working on a large, complicated project with tight deadlines, then use whatever resources you can find that would accelerate the development process. But if not, *go ahead and reinvent the wheel*. Write your own code, learn how something works, and build it your way.
