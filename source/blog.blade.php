@extends('_layouts.master')

@section('title', 'Blog')

@section('content')
    <h1 class="title has-text-centered">Blog</h1>

    <div class="columns">
        <div class="column is-4-tablet is-3-desktop">

            <div class="box">
                <h2 class="subtitle">Tags</h2>
                <div class="tags">
                    @foreach ($tags->keys() as $tag)
                        <a href="/blog/tags/{{ $tag }}" class="tag is-primary">
                            {{ $tag }} ({{ $page->countPostsWithTag($posts, $tag) }})
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
        <div class="column">

            @postlist(compact('posts'))
            @endpostlist

        </div>
    </div>
@endsection
