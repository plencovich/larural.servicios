@php
$title = 'Not Found';
$description = '';
@endphp
@extends('layout_full',[
'title'=>$title,
'description'=>$description
])

@section('content_right')
    <div
        class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
        <div class="sw-lg-60 px-5">
            <div class="sh-11">
                <a href="{{ url('/') }}">
                    <div class="logo-default"></div>
                </a>
            </div>
            <div class="mb-5">
                <h2 class="cta-1 mb-0 text-primary">{{ __('error.error_page_not_found') }}</h2>
                <h2 class="display-2 text-primary">{{ __('error.error_page_not_found_code') }}</h2>
            </div>
            <div class="mb-5">
                <p class="h6">{{ __('error.error_page_not_found_message') }}</p>
            </div>
            <div>
                <a href="{{ url()->previous() }}" class="btn btn-icon btn-icon-start btn-primary">
                    <i data-cs-icon="arrow-left"></i>
                    <span>{{ __('forms.back') }}</span>
                </a>
            </div>
        </div>
    </div>
@endsection
