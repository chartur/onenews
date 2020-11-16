<div class="category-content-loading mb-3">
	@if(isset($title) && $title)
	<h3 class="category-section-title mb-3">
		<span class="d-inline-block pb-2 main-active-border-color">{{ $title }}</span>
	</h3>
	@endif
	<div class="html">{!! $content !!}</div>
</div>