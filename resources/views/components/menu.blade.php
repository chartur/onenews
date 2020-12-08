<nav class="container position-relative">
	<div class="d-none d-sm-block w-100">
		<div class="w-100 d-flex justify-content-between align-items-center">
			<ul class="menu d-sm-flex justify-content-start align-items-center" itemscope itemtype="https://schema.org/SiteNavigationElement" role="menu">
				@foreach(trans('main.menu') as $menu)
					<li itemprop="name" role="menuitem">
						<a itemprop="url" title="{{ $menu['name'] }}" class="main-color-hover {{ url()->current() == url(routingWithLang($menu['link'])) ? 'main-active-background-color' : '' }}" href="{{ routingWithLang($menu['link']) }}">{{ $menu['name'] }}</a>
					</li>
				@endforeach
			</ul>
			<div class="mr-2 d-flex justify-content-between align-items-center">
				<div class="switch-locale">
					<button type="button" class="mr-2 switch-search-input" onclick="openSearchInput()">
						<i class="fa fa-search text-white"></i>
					</button>
					<div class="search-form d-none position-absolute search-input-container">
						<form action="{{ routingWithLang('search') }}" class="position-relative" method="GET">
								<input type="search" name="q" class="main-search-input" placeholder="{{ trans('main.search') }}">
								<button type="submit" class="main-search-button position-absolute">
									<i class="fa fa-search"></i>
								</button>
						</form>
					</div>
				</div>
				<form class="switch-locale" action="/change-locale" method="post">
					<button name="locale" class="{{ app()->getLocale() == 'hy' ? 'main-active-border-color' : '' }}" value="hy">
						<img width="20px" src="{{ asset('/images/flags/armenia.png') }}">
					</button>
					<button name="locale" class="{{ app()->getLocale() == 'ru' ? 'main-active-border-color' : '' }}" value="ru">
						<img width="20px" src="{{ asset('/images/flags/russia.png') }}">
					</button>
					@csrf
				</form>
			</div>
		</div>

	</div>

	<div class="d-block d-sm-none position-relative w-100">
		<div class="mobile-menu-container d-flex justify-content-between position-relative">
			<div class="d-flex justify-content-between align-items-center">
				<div class="switch-locale mr-2">
					<button type="button" class="mr-2 switch-search-input" onclick="openSearchInput()">
						<i class="fa fa-search text-white"></i>
					</button>
					<div class="search-form d-none position-absolute search-input-container">
						<form action="{{ routingWithLang('search') }}" class="position-relative" method="GET">
							<input type="search" name="q" class="main-search-input" placeholder="{{ trans('main.search') }}">
							<button type="submit" class="main-search-button position-absolute">
								<i class="fa fa-search"></i>
							</button>
						</form>
					</div>
				</div>
				<form class="switch-locale" action="/change-locale" method="post">
					<button name="locale" class="{{ app()->getLocale() == 'hy' ? 'main-active-border-color' : '' }}" value="hy">
						<img width="20px" src="{{ asset('/images/flags/armenia.png') }}">
					</button>
					<button name="locale" class="{{ app()->getLocale() == 'ru' ? 'main-active-border-color' : '' }}" value="ru">
						<img width="20px" src="{{ asset('/images/flags/russia.png') }}">
					</button>
					@csrf
				</form>
			</div>
			<a class="d-block position-absolute logo-in-mobile-menu" href="/">
				<div style="padding-left: 30px" class="position-relative">
					<div class="d-inline-block main-color logo-name">ONE</div>
					<img src="{{ asset('/images/fav.png') }}" width="30px">
				</div>
			</a>
			<div class="hamburger-menu-toggle">
				<i class="fa fa-bars"></i>
			</div>
			<ul class="d-none mobile-menu position-absolute" itemscope itemtype="https://schema.org/SiteNavigationElement" role="menu">
				@foreach(trans('main.menu') as $menu)
					<li itemprop="name" role="menuitem">
						<a itemprop="url" title="{{ $menu['name'] }}" class="main-color-hover w-100  {{ url()->current() == url(routingWithLang($menu['link'])) ? 'main-active-background-color' : '' }}" href="{{ routingWithLang($menu['link']) }}">{{ $menu['name'] }}</a>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
</nav>