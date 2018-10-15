@extends('_layouts.master')

@section('title', 'Projects')

@section('content')
    <h1 class="title has-text-centered">Projects</h1>

    <div class="columns is-multiline">
        @foreach ($projects as $project)
            <div class="column is-4-widescreen is-6-tablet">

                @card(['title' => $project->title])
                    <small>{{ strip_tags($project->getContent()) }}</small>

                    @slot('footer')
                        <a class="card-footer-item" target="_blank" {!! $project->source ? 'href="' . $project->source . '"' : 'disabled' !!}>
                            <icon>mdi-xml</icon> Source code
                        </a>
                        <a class="card-footer-item" target="_blank" {!! $project->demo ? 'href="' . $project->demo . '"' : 'disabled' !!}>
                            <icon>mdi-web</icon> Live demo
                        </a>
                    @endslot
                @endcard

            </div>
        @endforeach
    </div>
@endsection
