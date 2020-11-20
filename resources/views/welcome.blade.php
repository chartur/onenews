@extends('layouts.main')

@section('meta')
    <title>{{ getAttributeByLang($seo, 'title') }}</title>

    <meta name="title" content="{{ getAttributeByLang($seo, 'title') }}">
    <meta name="description" content="{{ getAttributeByLang($seo, 'description') }}">
    <meta name="keywords" content="{{ getAttributeByLang($seo, 'keywords') }}">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ getAttributeByLang($seo, 'title') }}">
    <meta property="og:description" content="{{ getAttributeByLang($seo, 'description') }}">
    <meta property="og:image" content="{{ asset($page->image) }}">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ getAttributeByLang($seo, 'title') }}">
    <meta property="twitter:description" content="{{ getAttributeByLang($seo, 'description') }}">
    <meta property="twitter:image" content="{{ asset($page->image) }}">
@endsection

@section('content')
    <div class="row mr-0 ml-0">
        <div class="col-12 col-sm-6 col-md-3 mb-2 order-2 order-sm-1">
            <div class="data-loader" data-place="left">
                {!! $left_place_content !!}
            </div>
        </div>
        <div class="col-12 col-md-6 order-1 order-sm-2 mb-2">
            <header class="main-page-header">
                <h1 class="text-center">{{ getAttributeByLang($seo, 'title') }}</h1>
            </header>
            <hr>
            <div class="general-post mb-3">
                {!! $general_post_content !!}
            </div>
            <div class="data-loader" data-place="middle">
                {!! $middle_place_content !!}
            </div>
            {{--<div class="ad-vertical text-center">--}}
                {{--<img src="/images/top-banner.png" class="w-100">--}}
            {{--</div>--}}
        </div>
        <div class="col-12 col-sm-6 col-md-3 mb-2 order-last">
            <div class="data-loader" data-place="right">
                {!! $right_place_content !!}
            </div>
        </div>
    </div>
@endsection