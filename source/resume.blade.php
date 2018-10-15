@extends('_layouts.master')

@section('title', 'Resume')

@section('content')
    <div class="has-text-centered">
        <h1 class="title">Resume</h1>

        <a href="{{ $page->owner->resume }}" class="button is-primary is-medium" target="_blank">
            <icon>mdi-file-pdf</icon>
            <span>View resume (PDF)</span>
        </a>
        <p class="help">Opens in a new tab</p>
    </div>
@endsection
