@extends('_layouts.master')

@section('title', 'Projects')

@section('content')
    <section class="section">
        <div class="container">

            <h1 class="title has-text-centered">Projects</h1>

            <div class="columns is-multiline">
                @foreach ($projects as $project)
                    <div class="column is-4-widescreen is-6-tablet">

                        @card(['title' => $project->title])
                            <small>{{ strip_tags($project->getContent()) }}</small>

                            @slot('footer')
                                <a class="card-footer-item" target="_blank" {!! $project->source ? 'href="' . $project->source . '"' : 'disabled' !!}>
                                    <fa icon="code"></fa>
                                    Source code
                                </a>
                                <a class="card-footer-item" target="_blank" {!! $project->demo ? 'href="' . $project->demo . '"' : 'disabled' !!}>
                                    <fa icon="list-alt"></fa>
                                    Live demo
                                </a>
                            @endslot
                        @endcard

                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection
