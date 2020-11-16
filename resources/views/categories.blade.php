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

	<meta property="og:image" content="{{ asset($page->image) }}">
	<meta property="twitter:image" content="{{ asset($page->image) }}">
@endsection

@section('content')
	<article class="overflow-hidden p-3 about-page">
		<header>
			<h1>{{ getAttributeByLang($seo, 'title') }}</h1>
		</header>
			<div class="row">
				@foreach($categories as $category)
					<div class="col-12">
						<div class="category-content-loading mb-3">
							<a href="{{ url('category/'.$category->slug) }}">
								<h3 class="category-section-title mb-3">
									<span class="d-inline-block pb-2 main-active-border-color">{{ getAttributeByLang($category, 'name') }}</span>
								</h3>
							</a>
							<div class="row row-eq-height">
								@foreach($category->posts as $post)
									<div class="col-12 col-md-4 col-lg-2">
										@php($post->image = str_replace('upload', 'thumbs', $post->image))
										@include('components.middle-text-bottom-post-component')
									</div>
								@endforeach
							</div>
						</div>
					</div>
				@endforeach
			</div>
	</article>
@endsection