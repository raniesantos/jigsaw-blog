---
pagination:
  collection: posts
---

@extends('_layouts.master')

@section('title', 'Blog')

@section('content')
    <h1 class="title has-text-centered">Blog</h1>

    <div class="columns">
        <div class="column is-4-tablet is-3-desktop">

            <div class="box">
                <h2 class="subtitle">Tags</h2>
                <div class="tags">
                    @foreach ($tags as $tag)
                        <a href="/blog/tags/{{ $tag->name() }}" class="tag is-primary">
                            {{ $tag->name() }} ({{ posts_filter($posts, $tag)->count() }})
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
        <div class="column">

            @postlist(['posts' => $pagination->items])
            @endpostlist

            <nav class="pagination">
                <a href="{{ $pagination->previous }}" class="pagination-previous"{{ $pagination->previous ? '' : ' disabled' }}>
                    Newer
                </a>
                <a href="{{ $pagination->next }}" class="pagination-next"{{ $pagination->next ? '' : ' disabled' }}>
                    Older
                </a>
            </nav>
            <p class="help has-text-centered">
                Page {{ $pagination->currentPage }} of {{ $pagination->totalPages }}
            </p>

        </div>
    </div>
@endsection
