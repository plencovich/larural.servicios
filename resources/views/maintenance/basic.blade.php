@php
$title = 'Coming Soon Page';
$description = 'Coming Soon Page';
@endphp
@extends('layout_full',[
'title'=>$title,
'description'=>$description
])

@section('content_right')
    <div
        class="sw-lg-80 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
        <div class="sw-lg-60 px-5">
            <div class="sh-11">
                <a href="{{ url('/') }}">
                    <div class="logo-default"></div>
                </a>
            </div>
            <div class="mb-3">
                <h2 class="cta-1 mb-0 text-primary">Acorn will be available soon!</h2>
            </div>

        </div>
    </div>
@endsection
