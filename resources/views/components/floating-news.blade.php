<div class="floating-news">
	<div class="mb-3">
		<button type="button" class="close p-2" onclick="closeFloating(this)">
			<span aria-hidden="true">×</span>
		</button>
	</div>
	@php($post = $floating_post)
	@include('components.small-post-component')
</div>

<script>
	function closeFloating(el) {
		$(el).closest('.floating-news').removeClass('show');
	}

	setTimeout(function () {
		$('.floating-news').addClass('show');
	}, 10000)
</script>