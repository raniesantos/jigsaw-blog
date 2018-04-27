---
title: Regrettable Ignorance, Part 2
date: 2016-02-28
tags:
  - git
image: puzzle.jpg
---
In [part 1](/blog/regrettable-ignorance-part-1), I shared a little bit about the issues surrounding our thesis project in college.

Now I will start going into detail on the tools and services that we should have used and how they could have made our development process faster, easier and more efficient.

## Managing Your Source Code

When we were working on the application, we did backups and sent each other code using **Google Drive**. One problem we had was we always had to remember what changes we did to which files *or* keep a list of all the changes we've made in a separate document. Another problem was that we always compressed the **ENTIRE FOLDER** and uploaded it to the cloud when we upload changes. The bandwidth in our country sucks, so uploading and downloading that *compressed-but-still-huge* file takes forever.

*"Why not just upload the changed files?"*

- Because we dropped the idea of listing changes in a text file, it was tedious.
- And because merging the files one by one was also tedious.

All these problems can be solved by **Git**, it's a Version Control System that tracks file changes so you don't have to remember them or list them down. It can also show you all the lines of code you removed and added.

You can also store your code online in a *remote repository*. When you upload to (push) or download from (fetch/pull) it, only the changes themselves are transferred, not entire files and folders.

Some online Git repository managers:

- **GitHub** provides free public repositories but you need to pay for private repositories, you can have an unlimited number of people contributing to a project in either case. It was the first site that offered high-quality Git hosting and is still quite popular, so you will see the use of GitHub in many Git tutorials and references.
- **GitLab** provides free public and private repositories and unlimited contributors. (If for some reason you cannot avoid including *certain files that contain sensitive data* - like passwords, database credentials, or API keys - then GitLab is likely the better option.)

In the [third and final post](/blog/regrettable-ignorance-part-3) of this series, the topic will be about how frameworks could drastically speed up the development of an application.
