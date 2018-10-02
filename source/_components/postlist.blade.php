<div class="columns is-multiline">
    @foreach ($posts as $post)
        <div class="column is-12-tablet is-6-desktop">

            <div class="box is-fullheight">
                <a href="{{ $post->getPath() }}">
                    <h5 class="is-size-5">{{ $post->title }}</h5>
                </a>
                <span class="has-text-primary">
                    <icon>fa-calendar-o</icon>
                    {{ $post->prettyDate() }}
                </span>
            </div>

        </div>
    @endforeach
</div>
