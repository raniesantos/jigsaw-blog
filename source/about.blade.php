@extends('_layouts.master')

@section('title', 'About')

@section('content')
    <h1 class="title has-text-centered">About</h1>

    <div class="columns is-centered">
        <div class="column is-7-widescreen is-9-desktop is-11-tablet">

            <div class="content">
                <p>
                    Hello there, my name is Ranie Santos and I live in the Philippines.
                    This site is a place where I dump and share what is on my mind, my learnings, and my opinions on all kinds of topics,
                    but mostly about technology and the web.
                </p>

                <h3>I <icon>mdi-heart</icon> the web</h3>
                <p>
                    I enjoy learning various new concepts in web development.
                    I make stuff with CSS, JavaScript and modern PHP.
                    I specifically work with the frameworks Laravel and Vue.js.
                    I care a lot about clean and tidy code.
                    I think code linting should be an essential part of anyone's coding workflow.
                </p>

                <h3>I <icon>mdi-heart</icon> Linux</h3>
                <p>
                    I'm a Linux enthusiast.
                    Ever since I switched to Linux, it has always made me feel at home
                    because it gives me a level of freedom, power, and control that I can't get elsewhere.
                    It's the perfect operating system for someone like me who is a tinkerer and a huge nerd.
                </p>

                <h3>I <icon>mdi-heart</icon> podcasts</h3>
                <p>
                    I really like listening to podcasts.
                    Besides being a time killer and source of entertainment,
                    I also learn a lot of things and get relevant updates about tech from them.
                </p>
            </div>

        </div>
    </div>
@endsection
