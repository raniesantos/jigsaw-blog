@extends('_layouts.master')

@section('title', "Posts tagged '{$page->name()}'")

@section('content')
    <h1 class="title has-text-centered">Posts tagged '{{ $page->name() }}'</h1>

    <div class="columns is-centered">
        <div class="column is-8-tablet is-9-desktop">

            <div class="field">
                <a href="/blog" class="button">
                    <icon>mdi-chevron-double-left</icon>
                    <span>Blog index</span>
                </a>
            </div>

            @postlist(['posts' => posts_filter($posts, $page)])
            @endpostlist

        </div>
    </div>
@endsection
