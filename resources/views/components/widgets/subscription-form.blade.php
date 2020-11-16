<div class="category-content-loading mb-3">
	<h3 class="category-section-title mb-3">
		<span class="d-inline-block pb-2 main-active-border-color">{{ trans('main.newsletter.title') }}</span>
	</h3>
	<form action="/subscription" method="post">
		<input type="text" class="mb-3 form-control" placeholder="{{ trans('main.newsletter.name') }}">
		<input type="text" class="mb-3 form-control" placeholder="{{ trans('main.newsletter.email') }}">
		<div>
			<button class="btn btn-block main-active-background-color text-white">{{ trans('main.newsletter.subscribe') }}</button>
		</div>
	</form>
</div>