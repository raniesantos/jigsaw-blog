<nav class="navbar is-primary">
    <div class="container">
        <div class="navbar-brand">
            <a href="/" class="navbar-item">
                <img src="{{ $page->imageCdn('logo-160x160.png') }}">
                {{ $page->site->title }}
            </a>
            <div class="navbar-burger" :class="{ 'is-active': navbarActive }" @click="navbarActive = !navbarActive">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div><!-- .navbar-brand -->
        <div class="navbar-menu" :class="{ 'is-active': navbarActive }">
            <div class="navbar-end">
                <a href="/blog" class="navbar-item{{ $page->isActive('/blog') }}">
                    <icon>mdi-pencil</icon>
                    <span>Blog</span>
                </a>
                <a href="/about" class="navbar-item{{ $page->isActive('/about') }}">
                    <icon>mdi-account</icon>
                    <span>About</span>
                </a>
                <a href="/projects" class="navbar-item{{ $page->isActive('/projects') }}">
                    <icon>mdi-xml</icon>
                    <span>Projects</span>
                </a>
                <a href="/resume" class="navbar-item{{ $page->isActive('/resume') }}">
                    <icon>mdi-file-document</icon>
                    <span>Resume</span>
                </a>
                <a href="/contact" class="navbar-item{{ $page->isActive('/contact') }}">
                    <icon>mdi-email</icon>
                    <span>Contact</span>
                </a>
            </div>
        </div><!-- .navbar-menu -->
    </div><!-- .container -->
</nav>
