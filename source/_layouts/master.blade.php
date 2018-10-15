<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title')
        {{ !empty($__env->yieldContent('title')) ? ' | ' : '' }}
        {{ $page->site->title }}
    </title>

    @include('_partials.head.favicon')
    @include('_partials.head.meta')

    <link rel="stylesheet" href="{{ mix('css/main.css', '') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=News+Cycle:400,700|Raleway:200,300">
</head>
<body>
    <div id="app">
        @include('_partials.navbar')

        @yield('hero')

        <section class="section" id="main">
            <div class="container">
                @yield('content')
            </div>
        </section>

        @include('_partials.footer')
    </div>

    <script src="{{ mix('js/manifest.js', '') }}"></script>
    <script src="{{ mix('js/vendor.js', '') }}"></script>
    <script src="{{ mix('js/main.js', '') }}"></script>
    @includeWhen($page->production, '_partials.analytics')
</body>
</html>
