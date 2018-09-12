<section
    class="hero
        {{ isset($size) ? " {$size}" : '' }}
        {{ isset($type) ? " {$type}" : '' }}
        {{ isset($image) ? ' hero-image' : '' }}
        {{ isset($image) && $title ? ' overlay-dark' : '' }}
    "
    {!! isset($image) ? ' style="background-image: url(' . $image . ');"' : '' !!}
>
    <div class="hero-body{{ isset($centered) ? ' has-text-centered' : '' }}">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-9-widescreen is-10-desktop is-11-tablet">
                    <h1 class="title">{{ $title }}</h1>
                    @if (isset($subtitle))
                        <h2 class="subtitle">{{ $subtitle }}</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
