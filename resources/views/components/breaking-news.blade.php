<div id="breaking-news" class="d-flex justify-content-between align-items-center">
	@if($news->count())
		<div class="flex-grow-1 br-component d-none d-sm-block">
			{{ trans('main.breaking_news') }}
		</div>
	<div id="breaking-news-list" class="w-100 ticker br-component d-none d-sm-block">
		<div id="moving-line" class="moving-line ticker__list">
			@for($i = 0; $i <= $news->count() - 1; $i++ )
				<span>
					<a href="{{ createPostLink($news->get($i)->id) }}">
						<span>{{ $news->get($i)->hy_title }} </span>
					</a>
				</span>
				@if($news->count() - 1 != $i)
					<i class="fa fa-ellipsis-h main-color"></i>
				@endif
			@endfor
		</div>
	</div>
	@endif
	<div class="flex-grow-1 head-date br-component text-center">
		{{ $date }}
	</div>
</div>