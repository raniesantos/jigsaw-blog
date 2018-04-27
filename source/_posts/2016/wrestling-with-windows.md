---
title: Wrestling With Windows
date: 2016-04-01
image: windows.jpg
---
For most people, the first operating system they ever used was Windows, and that's no surprise since Windows has *completely dominated the desktop market for over 20 years*. And because of that, an overwhelming amount of software is made for Windows. It has all the programs and tools you could ever need ... or does it?

When I first started learning basic web development, all I needed were a computer with a working operating system, a text editor, and a browser. But one eternity later, I started learning some advanced tools that you would definitely need as a developer and some of them just don't work the same on Windows.

## What's Different?

### The Command Line

The Windows Command Prompt itself is different. If you manage your own server, it most likely runs Linux, and Windows uses completely different commands than Linux. This means you need to learn 2 different commands that do one thing. Now this isn't a major problem, but it would be more convenient if you could use just one set of commands all the time.

### Secure Shell

One thing Windows lacks is a built-in **SSH** client. A popular solution is to install **PuTTY**. But something that a lot of people may not know is that if you've already installed **Git for Windows**, it actually comes bundled with tools that enable SSH and a small selection of Linux/Unix commands. You can simply add the `Git\usr\bin` folder to the **Path system variable**. Again, not a huge problem but it would be better if Windows had SSH by default.

### Unix-dependent Tools and Software

Technologies like **Node.js** and **Ruby** are meant to run on Unix-based systems, so they may not work as you expect on Windows. In the past, I've had problems trying to install **Browsersync** because it has a dependency called **node-gyp** which relies on **Visual C++ libraries** to work properly. I've also had issues with certain terminal packages for Atom that were caused by leaking Node environment variables.

As for Ruby, I actually don't have much knowledge on this language yet, but I've seen many complaints that its slow on Windows, and that a lot of gems aren't supported.

## A Look at Other Operating Systems

### Linux Distros

*"If it's going to run on Linux then you should develop it on Linux"*. That was an argument I saw a few times while reading various online content. And I completely agree. One of the best ways to avoid the *It Works on My Machine* problem when deploying your project is to have your development and production environment as similar as possible.

Someone once asked me to help figure out why images won't display after deploying a web application. Apparently it was caused by capitalized file extensions (e.g. image.PNG instead of image.png). It's funny that a tiny detail such as Windows being case-insensitive would actually cause a problem.

Other advantages of a Linux desktop:

- Built-in SSH client
- Node.js, Ruby, and other technologies meant to run on servers just work
- Immunity to the countless viruses and malware affecting Windows
- Its **FREE**

Recommendations:

- Ubuntu
- Linux Mint
- Zorin OS (Windows-like interface)
- Elementary OS (OS X-like interface)

One important thing to note though is that a lot of proprietary software is unavailable on Linux. If you're a web designer that absolutely must have **Photoshop** then this is probably not the best option for you.

### OS X

Like Linux distros, Mac OS X is a Unix-based operating system. It shares a lot of the same advantages such as having SSH built-in, and safety against most malware. Additionally, you get access to a lot more proprietary software compared to Linux.

But the greatest barrier to entry for OS X remains to be its price. This is because Macs are premium products. They have excellent hardware and if you were to purchase another machine with comparable specs, it would more or less be around the same price range.

## Should I Make the Switch Right Now?

Don't jump the gun, every operating system has pros and cons. If Windows works for you then that's perfectly fine. In the end, it still boils down to personal preference.
