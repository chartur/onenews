<a href="{{ createPostLink($post->id) }}{{ isset($with_ref) && $with_ref ? '?ref-float='.$with_ref : '' }}" class="text-decoration-none">
	<div class="small-post-container">
		<div class="mr-2 float-left small-post-image-container">
			<img class="small-post-image" src="{{ url(str_replace('/upload/', '/thumbs/', $post->image)) }}">
		</div>
		<div class="small-post-title-content">
			<h4 class="small-post-title">{{ getAttributeByLang($post, 'title') }}</h4>
		</div>
		<div class="small-post-attributes text-center order-sm-0">
			<span class="mr-2 main-color">
				<i class="fa fa-calendar"></i>
				{{ $post->created_at->formatLocalized('%d %b, %Y %H:%M') }}
			</span>
			<span class="main-color">
				<i class="fa fa-eye"></i>
				{{ $post->viewed }}
			</span>
			@if($post->has_video)
				<span class="ml-2 main-color">
					<i class="fas fa-video"></i>
				</span>
			@endif
		</div>
	</div>
</a>
