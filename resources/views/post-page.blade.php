@extends('layouts.main')

@section('meta')
	<title>{{ getAttributeByLang($main_post, 'title') }}</title>
	<meta name="title" content="{{ getAttributeByLang($main_post, 'title') }}">
	<meta name="keywords" content="{{ $main_post->tags->pluck(app()->getLocale().'_name')->join(', ') }}">
	<meta name="description" content="{{ mb_strimwidth(getAttributeByLang($main_post, $main_post->description ? 'description' : 'title'), 0, 158, '...') }}">
	<meta name="author" content="OneNews">

	<meta property="og:type" content="website">
	<meta property="og:url" content="{{ url()->current() }}">
	<meta property="og:title" content="{{ getAttributeByLang($main_post, 'title') }}">
	<meta property="og:description" content="{{ mb_strimwidth(getAttributeByLang($main_post, $main_post->description ? 'description' : 'title'), 0, 158, '...') }}">
	<meta property="og:image" content="{{ asset($main_post->image) }}">

	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="{{ url()->current() }}">
	<meta property="twitter:title" content="{{ getAttributeByLang($main_post, 'title') }}">
	<meta property="twitter:description" content="{{ mb_strimwidth(getAttributeByLang($main_post, $main_post->description ? 'description' : 'title'), 0, 158, '...') }}">
	<meta property="twitter:image" content="{{ asset($main_post->image) }}">
@endsection

@section('styles')
	<link rel="stylesheet" href="{{ asset('/admin/fancybox/jquery.fancybox.min.css') }}">
@endsection


@section('content')
	<div id="post-page-content">
		<article class="p-3">
			<header>
				<h1 class="text-center">{{ getAttributeByLang($main_post, 'title') }}</h1>
			</header>
			@if($ads->count())
				<div class="mt-2 mb-2 w-100 text-center">
					{!! $ads->toArray()[1]['content'] !!}
				</div>
			@endif
			<div>
				<aside class="mb-3 pt-2 pb-2">
					<div class="row">
						<div class="col-12 col-lg-7 my-lg-auto mb-2 mb-lg-0">
							<ul class="post-details d-flex justify-content-center justify-content-lg-start">
								<li class="mr-3">
									<i class="fas fa-user mr-1"></i>
									onenews
								</li>
								<li class="mr-3">
									<i class="fas fa-folder-open mr-1"></i>
									<a class="main-color-hover" href="{{ url('/category/'.$main_post->category->slug) }}">{{ getAttributeByLang($main_post->category, 'name') }}</a>
								</li>
								<li class="mr-3">
									<i class="fas fa-calendar mr-1"></i>
									{{ $main_post->created_at->formatLocalized('%d %b, %Y %H:%M') }}
								</li>
								<li class="mr-3">
									<i class="fas fa-eye mr-1"></i>
									{{ $main_post->viewed }}
								</li>
							</ul>
						</div>
						<div class="col-12 col-lg-5 text-right my-auto">
							<div class="d-flex align-items-end justify-content-center justify-content-lg-end">
								<div class="d-flex align-items-end mr-2">
									<iframe src="https://www.facebook.com/plugins/like.php?href={{ url()->current() }}&width=110&layout=button_count&action=like&size=small&share=false&height=20&appId=182306942842208" width="110" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
								</div>
								<div class="d-flex align-items-end mr-2">
									<iframe src="https://www.facebook.com/plugins/share_button.php?href={{ url()->current() }}&layout=button_count&size=small&appId=182306942842208&width=115&height=20" width="120" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
								</div>
								<div class="d-flex align-items-end mr-2">
									<a href="https://t.me/share/url?url={{ url()->current() }}" target="_blank" class="telegram-share-button">Telegram</a>
								</div>
								<div>
									<a href="https://twitter.com/share" target="_blank" class="twitter-share-button">Tweet</a>
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
							@foreach($main_post->tags as $tag)
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
								<img src="{{ $main_post->image }}" alt="{{ getAttributeByLang($main_post, $main_post->description ? 'description' : 'title') }}">
								@if($ads->count())
									<div class="text-center">
										<div class="mt-2 mb-2" style="width: 320px; height: 100px">
											{!! $ads->toArray()[1]['content'] !!}
										</div>
									</div>
								@endif
								@if($main_post->hy_title && $main_post->ru_title)
									<div class="switch-post-locale mt-2 text-center">
										@if(app()->getLocale() == 'hy')
											<img width="30px" style="border: none" src="/images/flags/russia.png">
											<a href="{{ str_replace('/hy/', '/ru/', url()->current()) }}">Доступен на Русском</a>
										@else
											<img width="30px" style="border: none" src="/images/flags/armenia.png">
											<a href="{{ str_replace('/ru/', '/hy/', url()->current()) }}">Հասանելի է Հայերեն</a>
										@endif
									</div>
								@endif
							</div>
							<div class="post-content">
								{!! $post_content !!}
							</div>
							@if($main_post->source)
								<p class="mt-2">
									<b class="mr-2">{{ trans('main.href') }}</b>
									<span><i>{{ $main_post->source }}</i></span>
								</p>
							@endif
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
		<ul class="d-flex justify-content-start align-items-center flex-wrap overflow-hidden">
			<li class="mr-3">
				<span class="mr-3">{{ trans('main.you_are_here') }}</span>
				<i class="fas fa-caret-right main-color"></i>
			</li>
			<li class="mr-3 ">
				<a href="/" class="main-color-hover text-decoration-none">
					<span class="mr-3">{{ trans('main.menu.home.name') }}</span>
				</a>
				<i class="fas fa-caret-right main-color"></i>
			</li>
			<li class="mr-3 ">
				<a href="{{ url('/category/'.$main_post->category->slug) }}" class="main-color-hover text-decoration-none">
					<span class="mr-3">{{ getAttributeByLang($main_post->category, 'name') }}</span>
				</a>
				<i class="fas fa-caret-right main-color"></i>
			</li>
			<li class="mr-3 overflow-hidden d-flex align-items-center">
				<span>{{ getAttributeByLang($main_post, 'title') }}</span>
			</li>
		</ul>
	</div>
	@if($floating_post)
		@include('components.floating-news')
	@endif
@endsection
@php(addPostViewed($main_post->id))

@section('scripts')
	<script src="{{ asset('/admin/fancybox/jquery.fancybox.min.js') }}" ></script>
	<script>

		$(document).on('click', '.telegram-click', function (e) {
			e.stopPropagation();
			window.open('https://t.me/infoonenews');
			!localStorage.setItem('telegram-joined', 'clicked');
			$.fancybox.close();
		});

		$('.post-content img').click(function () {
			var src = $(this).attr('src');
			$.fancybox.open('<img src="'+ src +'">');
		});

		$.fancybox.open(`@include('components.post-popover')`, {
			// touch: false,
			modal : true,
			scrolling   : 'hidden',
			animationDuration: 0,
			closeClick  : false, // prevents closing when clicking INSIDE fancybox
			helpers     : {
				overlay : {
					closeClick: false,
					locked: true,
				} // prevents closing when clicking OUTSIDE fancybox
			},
			onInit: function () {
				if ($.fancybox.isMobile) {
					$('body').css('top', $('body').scrollTop() * -1).addClass('fancybox-iosfix');
				}
			},
			afterClose: function () {
				var offset;

				if ($('body').hasClass('fancybox-iosfix')) {
					offset = parseInt(document.body.style.top, 10);

					$('body').removeClass('fancybox-iosfix').css('top', '').scrollTop(offset * -1);
				}
			}
		});

		var clickTimer;

		function closePopover() {
			if(typeof clickTimer != 'undefined') {
				return;
			}

			clickTimer = setTimeout(function () {
				$.fancybox.close();
			}, 1200)
		}

		@if(false)
		if(localStorage.getItem('telegram-joined') != 'clicked'){
			setTimeout(function () {
				$.fancybox.open(`@include('components.telegram-join')`, {
					touch: false
				});
				setTimeout(function () {
					$('.telegram-join-page').addClass('active')
				}, 500)
			}, 5000);
		}
		@endif

		function getSelectionHtml() {
			var html = "";
			if (typeof window.getSelection != "undefined") {
				var sel = window.getSelection();
				if (sel.rangeCount) {
					var container = document.createElement("div");
					for (var i = 0, len = sel.rangeCount; i < len; ++i) {
						container.appendChild(sel.getRangeAt(i).cloneContents());
					}
					html = container.innerHTML;
				}
			} else if (typeof document.selection != "undefined") {
				if (document.selection.type == "Text") {
					html = document.selection.createRange().htmlText;
				}
			}
			return html;
		}

		function addLink() {

			var selection = getSelectionHtml();
			pagelink = `<p><b>Ամբողջական նյութը այստեղ</b> - <u><a href="${document.location.href }">${document.location.href }</a></u></p>`;
			copytext = selection + pagelink;

			newdiv = document.createElement('div');

			newdiv.style.position = 'absolute';
			newdiv.style.left = '-99999px';

			document.body.appendChild(newdiv);
			newdiv.innerHTML = copytext;
			window.getSelection().selectAllChildren(newdiv);

			window.setTimeout(function () {
				document.body.removeChild(newdiv);
			}, 100);
		}
		document.addEventListener('copy', addLink);

	</script>
@endsection
