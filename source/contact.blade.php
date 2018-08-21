@extends('_layouts.master')

@section('title', 'Contact')

@section('content')
    <div class="columns is-centered">
        <div class="column is-6-widescreen is-7-tablet">
            <notification></notification>

            <h1 class="title has-text-centered">Contact</h1>

            <contact-form jumprock-alias="{{ $page->services->jumprock }}"/>
        </div>
    </div>
@endsection
