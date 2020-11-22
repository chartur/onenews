<footer class="pt-4 pb-4">
	<div class="row mr-0 ml-0">
		<div class="col-12 col-md-6 col-lg-4">
			<h3 class="category-section-title text-white mb-3">
				<span class="d-inline-block pb-2 main-active-border-color">{{ trans('main.menu.about.name') }}</span>
			</h3>
			<div class="text-center">
				<img src="/images/full_logo.png" height="90px">
			</div>
			<p>
				{{ $aboutSite }}
			</p>
			<div class="d-flex align-items-center justify-content-start socializer">
				<a href="https://www.facebook.com/onenews.am/" target="_blank">
					<div class="mr-2">
							<i class="fab fa-facebook-f"></i>
					</div>
				</a>
				<a href="https://t.me/infoonenews" target="_blank">
					<div class="mr-2">
							<i class="fab fa-telegram-plane"></i>
					</div>
				</a>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-4 mt-3 mt-md-0">
			<h3 class="category-section-title text-white mb-3">
				<span class="d-inline-block pb-2 main-active-border-color">{{ trans('main.categories') }}</span>
			</h3>
			<ul class="footer-categories pl-0">
				@foreach($categories as $category)
					<a href="/category/{{ $category->slug }}">
						<li class="border-bottom d-flex justify-content-between align-items-center">
							<div class="mr-2"><i class="fas fa-folder-open"></i></div>
							<div class="flex-grow-1">{{ getAttributeByLang($category, 'name') }}</div>
							<div>( {{ $category->posts_count }} )</div>
						</li>
					</a>
				@endforeach
			</ul>
		</div>
		<div class="col-12 col-md-6 col-lg-4 mt-3 mt-md-0">
			<h3 class="category-section-title text-white mb-3">
				<span class="d-inline-block pb-2 main-active-border-color">{{ trans('main.popular_tags') }}</span>
			</h3>
			<ul class="footer-tags pl-0">
				@foreach($tags as $tag)
					<a href="/search?q={{ getAttributeByLang($tag, 'name') }}">
						<li class="d-inline-block mr-2 mb-2 text-lowercase">
							#{{ getAttributeByLang($tag, 'name') }}
						</li>
					</a>
				@endforeach
			</ul>
		</div>
	</div>
</footer>
<section class="t3-copyright">
	<div class="container">
		<div class="custom copyright">
			<p class="mb-0">Copyright © 2019 OneNews. All Rights Reserved by onenews.info</p>
		</div>
	</div>
</section>