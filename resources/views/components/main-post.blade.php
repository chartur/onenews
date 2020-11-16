<a href="{{ createPostLink($post->id) }}" class="mb-3">
	<div class="w-100 main-post-container">
			<img src="{{ url($post->image) }}" width="100%">
			<div class="main-post-title">
				{{ getAttributeByLang($post, 'title') }}
			</div>
	</div>
	<div class="text-right order-sm-0">
			<span class="mr-3 main-color">
				<i class="fa fa-calendar mr-1"></i>
				{{ $post->created_at->formatLocalized('%d %b, %Y') }}
			</span>
		<span class="main-color mr-3">
				<i class="fa fa-eye mr-1"></i>
			{{ $post->viewed }}
			</span>
		@if($post->has_video)
			<span class="ml-2 main-color">
					<i class="fas fa-video"></i>
				</span>
		@endif
	</div>
</a>