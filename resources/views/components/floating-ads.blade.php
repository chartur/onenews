<div class="floating-news" id="floating-ads">
	<div class="mb-3">
		<button type="button" class="close" onclick="closeFloating(this, false)">
			<span aria-hidden="true">×</span>
		</button>
	</div>
	<div>
		@if($ads->count())
			<div class="mt-2 mb-2 w-100 text-center">
				{!! $ads->toArray()[1]['content'] !!}
			</div>
		@endif
	</div>
</div>