<div class="breaking-news-component"></div>
<script>
	$(document).ready(function () {
		$('.breaking-news-component').load('{{ routingWithLang('/loader/breaking-news') }}', breakingNewsAnimationDuration)
	})
</script>