<a href="{{ createPostLink($post->id)  }}" class="text-decoration-none">
	<div class="middle-text-bottom-post-container">
		<div class="middle-text-bottom-post-image-container mb-2">
			<img src="{{ url($post->image) }}">
		</div>
		<div class="middle-text-bottom-post-attributes main-color">
			<span class="mr-2">
				<i class="fa fa-calendar"></i>
				{{ $post->created_at->formatLocalized('%d %b, %Y') }}
			</span>
			<span>
				<i class="fa fa-eye"></i>
				{{ $post->viewed }}
			</span>
			@if($post->has_video)
				<span class="ml-2">
					<i class="fas fa-video"></i>
				</span>
			@endif
		</div>
		<div class="middle-text-bottom-post-title mb-2">
			{{ getAttributeByLang($post, 'title') }}
		</div>
	</div>
</a>
