@extends('layouts.main')

@section('meta')
	<title>{{ getAttributeByLang($post, 'title') }}</title>
	<meta name="title" content="{{ getAttributeByLang($post, 'title') }}">
	<meta name="keywords" content="{{ $post->tags->pluck(app()->getLocale().'_name')->join(', ') }}">
	<meta name="description" content="{{ mb_strimwidth(getAttributeByLang($post, $post->description ? 'description' : 'title'), 0, 158, '...') }}">
	<meta name="author" content="OneNews">

	<meta property="og:type" content="website">
	<meta property="og:url" content="{{ url()->current() }}">
	<meta property="og:title" content="{{ getAttributeByLang($post, 'title') }}">
	<meta property="og:description" content="{{ mb_strimwidth(getAttributeByLang($post, $post->description ? 'description' : 'title'), 0, 158, '...') }}">
	<meta property="og:image" content="{{ asset($post->image) }}">

	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="{{ url()->current() }}">
	<meta property="twitter:title" content="{{ getAttributeByLang($post, 'title') }}">
	<meta property="twitter:description" content="{{ mb_strimwidth(getAttributeByLang($post, $post->description ? 'description' : 'title'), 0, 158, '...') }}">
	<meta property="twitter:image" content="{{ asset($post->image) }}">
@endsection


@section('content')
	<div id="post-page-content">
		<article class="p-3">
			<header>
				<h1>{{ getAttributeByLang($post, 'title') }}</h1>
			</header>
			<div>
				<aside class="mb-3 pt-2 pb-2">
					<div class="row">
						<div class="col-12 col-lg-7 my-lg-auto mb-2 mb-lg-0">
							<ul class="post-details d-flex justify-content-center justify-content-lg-start">
								<li class="mr-3">
									<i class="fas fa-user mr-1"></i>
									onenews.am
								</li>
								<li class="mr-3">
									<i class="fas fa-folder-open mr-1"></i>
									<a class="main-color-hover" href="{{ url('/category/'.$post->category->slug) }}">{{ getAttributeByLang($post->category, 'name') }}</a>
								</li>
								<li class="mr-3">
									<i class="fas fa-calendar mr-1"></i>
									{{ $post->created_at->formatLocalized('%d %b %Y') }}
								</li>
								<li class="mr-3">
									<i class="fas fa-eye mr-1"></i>
									{{ $post->viewed }}
								</li>
							</ul>
						</div>
						<div class="col-12 col-lg-5 text-right my-auto">
							<div class="d-flex align-items-end justify-content-center justify-content-lg-end">
								<div class="d-flex align-items-end mr-2">
									<iframe src="https://www.facebook.com/plugins/share_button.php?href={{url()->current()}}&layout=button_count&size=small&appId=182306942842208&width=145&height=20" width="113" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
								</div>
								<div class="d-flex align-items-end mr-2">
									<script async src="https://telegram.org/js/telegram-widget.js?14" data-telegram-share-url="{{ url()->current() }}"></script>
								</div>
								<div>
									<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
								</div>
							</div>

						</div>
					</div>
				</aside>
			</div>
			<div class="row position-relative">
				<div class="col-12 col-md-9" style="height: max-content">
					<div class="mb-3">
						<div class="single-post-tags">
							@foreach($post->tags as $tag)
								<a href="{{ url('/search?q='.getAttributeByLang($tag, 'name')) }}" class="text-decoration-none">
								<span class="single-post-tag-item mr-1 main-bg-color-hover">
										#{{ getAttributeByLang($tag, 'name') }}
								</span>
								</a>
							@endforeach
						</div>
					</div>
					<div>
						<div class="overflow-hidden">
							<div class="post-image-container">
								<img src="{{ $post->image }}" alt="{{ getAttributeByLang($post, $post->description ? 'description' : 'title') }}">
							</div>
							<div class="post-content">
								{!! getAttributeByLang($post, 'content') !!}
							</div>
							<p class="mt-2">
								<b class="mr-2">{{ trans('main.href') }}</b>
								<a href="{{ $post->source }}" target="_blank"><i>{{ $post->source }}</i></a>
							</p>
						</div>
					</div>
					<hr>
					<div class="fb-comments" data-numposts="10" data-width="100%"></div>
				</div>
				<div class="col-12 col-md-3 position-absolute position-xs-static h-100" style="right: 0; overflow-y: scroll">
					<div class="category-content-loading mb-3">
						<h3 class="category-section-title mb-3">
							<span class="d-inline-block pb-2 main-active-border-color">{{ trans('main.breaking_news') }}</span>
						</h3>
						<div class="h-100">
							@foreach($more_posts as $post)
								@include('components.middle-text-bottom-post-component')
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</article>
	</div>
	<div class="single-post-position p-3">
		<ul class="overflow-hidden">
			<li class="mr-3 d-inline-block">
				<span class="mr-3">{{ trans('main.you_are_here') }}</span>
				<i class="fas fa-caret-right main-color"></i>
			</li>
			<li class="mr-3 d-inline-block">
				<a href="/" class="main-color-hover text-decoration-none">
					<span class="mr-3">{{ trans('main.menu.home.name') }}</span>
				</a>
				<i class="fas fa-caret-right main-color"></i>
			</li>
			<li class="mr-3 d-inline-block">
				<a href="{{ url('/category/'.$post->category->slug) }}" class="main-color-hover text-decoration-none">
					<span class="mr-3">{{ getAttributeByLang($post->category, 'name') }}</span>
				</a>
				<i class="fas fa-caret-right main-color"></i>
			</li>
			<li class="mr-3 overflow-hidden d-inline-block">
				<span class="mr-3 no-wrapp">{{ getAttributeByLang($post, 'title') }}</span>
			</li>
		</ul>
	</div>
@endsection

@php($post->viewed++)
@php($post->save())