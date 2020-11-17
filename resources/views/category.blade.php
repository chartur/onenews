@extends('layouts.main')

@section('meta')
	<title>{{ getAttributeByLang($category, 'name').' '.getAttributeByLang($seo, 'title') }}</title>

	<meta name="title" content="{{ getAttributeByLang($category, 'name').' '.getAttributeByLang($seo, 'title') }}">
	<meta name="description" content="{{ getAttributeByLang($seo, 'description') }}">
	<meta name="keywords" content="{{ getAttributeByLang($seo, 'keywords') }}">

	<meta property="og:type" content="website">
	<meta property="og:url" content="{{ url()->current() }}">
	<meta property="og:title" content="{{ getAttributeByLang($category, 'name').' '.getAttributeByLang($seo, 'title') }}">
	<meta property="og:description" content="{{ getAttributeByLang($seo, 'description') }}">

	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="{{ url()->current() }}">
	<meta property="twitter:title" content="{{ getAttributeByLang($category, 'name').' '.getAttributeByLang($seo, 'title') }}">
	<meta property="twitter:description" content="{{ getAttributeByLang($seo, 'description') }}">

	<meta property="og:image" content="{{ asset($page->image) }}">
	<meta property="twitter:image" content="{{ asset($page->image) }}">
@endsection

@section('content')
	<article class="overflow-hidden p-3 about-page">
		<header class="text-center">
			<h1>{{ getAttributeByLang($category, 'name').' '.getAttributeByLang($seo, 'title') }}</h1>
		</header>
			<div class="row">
				<div class="col-12 col-sm-3">
					<h3 class="category-section-title mb-3">
						<span class="d-inline-block pb-2 main-active-border-color">Facebook</span>
					</h3>
					<div class="mb-2">
						<div class="fb-group" data-href="https://www.facebook.com/groups/940317612749000" data-width="280" data-show-social-context="true" data-show-metadata="false"><blockquote cite="https://www.facebook.com/groups/940317612749000" class="fb-xfbml-parse-ignore">OneNews հետաքրքիր, հումորային փաստեր, նորություններ</blockquote></div>
					</div>
					<hr>
					<div class="mb-2">
						<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fonenews.am%2F&tabs&width=340&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=182306942842208" style="border:none;overflow:hidden;max-width: 100%" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
						</iframe>
					</div>
					<div>
						<div style="overflow-y: scroll">
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
				</div>
				<div class="col-12 col-sm-9">
					<h3 class="category-section-title mb-3">
						<span class="d-inline-block pb-2 main-active-border-color">{{ getAttributeByLang($category, 'name') }}</span>
					</h3>
					@foreach($posts as $post)
						@include('components.small-post-component')
					@endforeach
					<div class="mt-3 text-center">{!! $posts->links('vendor.pagination.bootstrap-4') !!}</div>
				</div>
			</div>
	</article>
@endsection