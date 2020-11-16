<div class="category-content-loading mb-3">
	<a href="{{ url('/category/'.$category->slug) }}">
		<h3 class="category-section-title mb-3">
			<span class="d-inline-block pb-2 main-active-border-color">{{ getAttributeByLang($category, 'name') }}</span>
		</h3>
	</a>
	@foreach($posts as $post)
		@include('components.small-post-component')
	@endforeach
</div>