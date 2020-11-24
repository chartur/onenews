<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="robots" content="index, follow">
	<meta property="fb:app_id" content="808625669696768">
	<meta property="fb:pages" content="268599243671295" />

	@yield('meta')

	@yield('styles')

	<script src="{{ asset('/js/jquery.js') }}"></script>
	<script src="{{ asset('/js/popper.js') }}"></script>
	<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('/js/script.js?v=1.0.1') }}"></script>
	<style>
		.main-color {
			color: #e74c3c!important;
		}
		.main-color-hover:hover {
			color: #e74c3c!important;
		}
		.main-bg-color-hover:hover {
			background: #e74c3c!important;
			color: #fff!important;
		}
		.main-active-color {
			color: #e74c3c!important;
		}
		.main-active-background-color {
			background-color: #e74c3c!important;
			color: #fff !important;
		}
		.main-active-background-color:hover {
			color: #fff!important;
		}
		.main-active-border-color {
			border-color: #e74c3c!important;
		}
	</style>
	<link rel="icon" href="{{ asset('/images/fav.png') }}">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-97208566-10"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-97208566-10');
	</script>


	@if(url('') !== 'http://localhost:8000')
		<script data-ad-client="ca-pub-4690904339142228" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	@endif
</head>
<body>
	<script>
		window.fbAsyncInit = function() {
			FB.init({
				appId            : '808625669696768',
				autoLogAppEvents : true,
				xfbml            : true,
				version          : 'v9.0'
			});
		};
	</script>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v9.0&appId=808625669696768&autoLogAppEvents=1" nonce="x5yd6zaq"></script>


	<div class="container pl-0 pr-0">
		<div class="main-container">
			@include('includes.breaking-news-loader')
			@include('components.header')
			@include('components.menu')
			@yield('content')
			@include('components.footer')
		</div>
	</div>

	<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/styles.css?v=1.1.0') }}">

	@yield('scripts')
</body>
</html>