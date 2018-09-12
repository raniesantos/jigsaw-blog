@extends('_layouts.master')

@section('hero')
    @hero([
        'title' => 'Anecdotes of an Artisan',
        'size' => 'is-medium',
        'centered' => true,
        'image' => $page->imageCdn('code.jpg'),
    ])
    @endhero
@endsection

@section('content')
    <h2 class="subtitle has-text-centered">Blog entries</h2>

    <div class="columns is-multiline">
        @foreach ($posts->take(6) as $post)
            <div class="column is-4-widescreen is-6-tablet">

                @card(['title' => $post->title])
                    <small>{!! $post->excerpt(200) !!}</small>

                    @slot('footer')
                        <span class="card-footer-item">
                            {{ date('M j, Y', $post->date) }}
                        </span>
                        <span class="card-footer-item">
                            <a href="{{ $post->getPath() }}" class="button is-primary">
                                <icon>fa-angle-double-right</icon>
                                <span>Read more</span>
                            </a>
                        </span>
                    @endslot
                @endcard

            </div>
        @endforeach
    </div>

    <div class="has-text-centered">
        <a href="/blog" class="button is-text">
            View more posts
        </a>
    </div>
@endsection
