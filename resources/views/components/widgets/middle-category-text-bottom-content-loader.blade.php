<div class="mb-3">
	<a href="{{ url('/category/'.$category->slug) }}">
		<h3 class="category-section-title mb-3">
			<span class="d-inline-block pb-2 main-active-border-color">{{  getAttributeByLang($category, 'name') }}</span>
		</h3>
	</a>
	<div class="row row-eq-height">
		@foreach($posts as $post)
			<div class="col-12 col-sm-6 position-relative bottom-border mb-2">
				@include('components.middle-text-bottom-post-component')
			</div>
		@endforeach
	</div>
</div>