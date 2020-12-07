<div class="floating-news" id="floating-news">
	<div class="mb-3">
		<button type="button" class="close p-2" onclick="closeFloating(this, true)">
			<span aria-hidden="true">×</span>
		</button>
	</div>
	<div>
		<a href="{{ createPostLink($floating_post->id) }}?ref-float={{ $main_post->id }}" class="text-decoration-none">
			<div class="small-post-container">
				<div class="mr-2 float-left small-post-image-container">
					<img class="small-post-image" src="{{ url(str_replace('/upload/', '/thumbs/', $floating_post->image)) }}">
				</div>
				<div class="small-post-title-content">
					<h4 class="small-post-title">{{ getAttributeByLang($floating_post, 'title') }}</h4>
				</div>
				<div class="small-post-attributes text-center order-sm-0">
			<span class="mr-2 main-color">
				<i class="fa fa-calendar"></i>
				{{ $floating_post->created_at->formatLocalized('%d %b, %Y %H:%M') }}
			</span>
					<span class="main-color">
				<i class="fa fa-eye"></i>
						{{ $floating_post->viewed }}
			</span>
					@if($floating_post->has_video)
						<span class="ml-2 main-color">
					<i class="fas fa-video"></i>
				</span>
					@endif
				</div>
			</div>
		</a>

	</div>
</div>
@if(true)
	@include('components.floating-ads')
@endif
<script>
	function closeFloating(el, openAgain) {
		$(el).closest('.floating-news').removeClass('show');
		if(openAgain) {
			setTimeout(function () {
				$('#floating-ads').addClass('show')
			}, 6000)
		}
	}

	setTimeout(function () {
		$('#floating-news').addClass('show');
	}, 10000)
</script>