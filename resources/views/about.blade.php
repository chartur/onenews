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

	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="{{ url()->current() }}">
	<meta property="twitter:title" content="{{ getAttributeByLang($seo, 'title') }}">
	<meta property="twitter:description" content="{{ getAttributeByLang($seo, 'description') }}">

	@if($page && $page->image)
		<meta property="og:image" content="{{ asset($page->image) }}">
		<meta property="twitter:image" content="{{ asset($page->image) }}">
	@endif
@endsection

@section('content')
	<article class="overflow-hidden p-3 about-page">
		<div class="float-left about-us-image">
			<img src="{{ asset($page->image) }}">
		</div>
		<header>
			<h1>{{ getAttributeByLang($seo, 'title') }}</h1>
			<div>
				{!! getAttributeByLang($page, 'content') !!}
			</div>
		</header>
	</article>
@endsection