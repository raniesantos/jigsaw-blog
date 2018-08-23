<div class="card is-fullheight">
    <header class="card-header">
        <p class="card-header-title">{{ $title }}</p>
    </header>
    <div class="card-content" v-pre>
        {{ $slot }}
    </div>
    <footer class="card-footer">
        {{ $footer }}
    </footer>
</div>
