<!doctype html>
<html lang="hy" prefix="op: http://media.facebook.com/op#">
	<head>
		<meta charset="utf-8">
		<!-- URL of the web version of this article -->
		<!-- TODO: Change the domain to match the domain of your website -->
		<link rel="canonical" href="{{ $url }}">
		<meta property="op:markup_version" content="v1.0">
		<meta property="fb:article_style" content="custom"/>
	</head>
	<body>
		<article>
			<header>
				<!-- The title and subtitle shown in your Instant Article -->
				<h1>{{ $title }}</h1>

				<!-- The date and time when your article was originally published -->
				<time class="op-published" datetime="{{ $datetime }}">{{ $datetime_print }}</time>

				<!-- The authors of your article -->
				<address>
					<a rel="facebook" href="https://www.facebook.com/onenews.am">OneNews</a>
				</address>

				<!-- The cover image shown inside your article -->
				<!-- TODO: Change the URL to a live image from your website -->
				<figure>
					<img src="{{ $image }}" />
				</figure>

			</header>

			<!-- Article body goes here -->

			<!-- Body text for your article -->
			{!! $content !!}

			@foreach($tags as $tag)
				<figure class="{{ $tag['type'] == 'iframe' ? 'op-interactive' : '' }}">
					{!! $tag['content'] !!}
				</figure>
			@endforeach

			<footer>
				<!-- Copyright details for your article -->
				<small>Copyright © 2019 OneNews. All Rights Reserved by onenews.am</small>
			</footer>
		</article>
	</body>
</html>
