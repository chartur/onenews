<nav class="menu">
	<ul class="sidebar-menu metismenu" id="sidebar-menu">
		<li class="{{ $activePage == 'index' ? 'active' : '' }}">
			<a href="/cabinet">
				<i class="fa fa-home"></i> Գլխավոր
			</a>
		</li>
		<li class="{{ $activePage == 'build' ? 'active' : '' }}">
			<a href="/cabinet/build">
				<i class="fa fa-thumb-tack"></i>Էջի կառավարում
			</a>
		</li>
		<li class="{{ in_array($activePage, ['new_post', 'all_posts', 'post']) ? 'active open' : '' }}">
			<a href="">
				<i class="fa fa-newspaper-o"></i>
				Փոստեր
				<i class="fa arrow"></i>
			</a>
			<ul class="sidebar-nav">
				<li class="{{ $activePage == 'new_post' ? 'active' : '' }}">
					<a href="/cabinet/posts/new">
						<i class="fa fa-plus mr-2"></i>
						Ստեղծել
					</a>
				</li>
				<li class="{{ $activePage == 'all_posts' ? 'active' : '' }}">
					<a href="/cabinet/posts/list">
						<i class="fa fa-list mr-2"></i>
						Ցանկ
					</a>
				</li>
			</ul>
		</li>
		<li class="{{ in_array($activePage, ['new_tag', 'all_tags', 'tag']) ? 'active open' : '' }}">
			<a href="">
				<i class="fa fa-tags"></i>
				Թեգեր
				<i class="fa arrow"></i>
			</a>
			<ul class="sidebar-nav">
				<li class="{{ $activePage == 'new_tag' ? 'active' : '' }}">
					<a href="/cabinet/tags/new">
						<i class="fa fa-plus mr-2"></i>
						Ստեղծել
					</a>
				</li>
				<li class="{{ $activePage == 'all_tags' ? 'active' : '' }}">
					<a href="/cabinet/tags/list">
						<i class="fa fa-list mr-2"></i>
						Ցանկ
					</a>
				</li>
			</ul>
		</li>
		<li class="{{ in_array($activePage, ['seo_main', 'seo_about', 'seo_contact']) ? 'active open' : '' }}">
			<a href="">
				<i class="fa fa-search"></i>
				SEO
				<i class="fa arrow"></i>
			</a>
			<ul class="sidebar-nav">
				<li class="{{ $activePage == 'seo_main' ? 'active' : '' }}">
					<a href="/cabinet/seo/main">
						<i class="mr-2"></i>
						Գլխավոր էջ
					</a>
				</li>
				<li class="{{ $activePage == 'seo_about' ? 'active' : '' }}">
					<a href="/cabinet/seo/about">
						<i class="mr-2"></i>
						Մեր մասին
					</a>
				</li>
				<li class="{{ $activePage == 'seo_contact' ? 'active' : '' }}">
					<a href="/cabinet/seo/contact">
						<i class="mr-2"></i>
						Հետադարձ կապ
					</a>
				</li>
			</ul>
		</li>
		<li class="{{ $activePage == 'ads' ? 'active' : '' }}">
			<a href="/cabinet/ads">
				<i class="fa fa-handshake-o"></i> Գովազդներ </a>
		</li>
		<li>
			<a href="">
				<i class="fa fa-area-chart"></i> Charts <i class="fa arrow"></i>
			</a>
			<ul class="sidebar-nav">
				<li>
					<a href="charts-flot.html"> Flot Charts </a>
				</li>
				<li>
					<a href="charts-morris.html"> Morris Charts </a>
				</li>
			</ul>
		</li>
		<li>
			<a href="">
				<i class="fa fa-table"></i> Tables <i class="fa arrow"></i>
			</a>
			<ul class="sidebar-nav">
				<li>
					<a href="static-tables.html"> Static Tables </a>
				</li>
				<li>
					<a href="responsive-tables.html"> Responsive Tables </a>
				</li>
			</ul>
		</li>
		<li>
			<a href="forms.html">
				<i class="fa fa-pencil-square-o"></i> Forms </a>
		</li>
		<li>
			<a href="">
				<i class="fa fa-desktop"></i> UI Elements <i class="fa arrow"></i>
			</a>
			<ul class="sidebar-nav">
				<li>
					<a href="buttons.html"> Buttons </a>
				</li>
				<li>
					<a href="cards.html"> Cards </a>
				</li>
				<li>
					<a href="typography.html"> Typography </a>
				</li>
				<li>
					<a href="icons.html"> Icons </a>
				</li>
				<li>
					<a href="grid.html"> Grid </a>
				</li>
			</ul>
		</li>
		<li>
			<a href="">
				<i class="fa fa-file-text-o"></i> Pages <i class="fa arrow"></i>
			</a>
			<ul class="sidebar-nav">
				<li>
					<a href="login.html"> Login </a>
				</li>
				<li>
					<a href="signup.html"> Sign Up </a>
				</li>
				<li>
					<a href="reset.html"> Reset </a>
				</li>
				<li>
					<a href="error-404.html"> Error 404 App </a>
				</li>
				<li>
					<a href="error-404-alt.html"> Error 404 Global </a>
				</li>
				<li>
					<a href="error-500.html"> Error 500 App </a>
				</li>
				<li>
					<a href="error-500-alt.html"> Error 500 Global </a>
				</li>
			</ul>
		</li>
		<li>
			<a href="">
				<i class="fa fa-sitemap"></i> Menu Levels <i class="fa arrow"></i>
			</a>
			<ul class="sidebar-nav">
				<li>
					<a href="#"> Second Level Item <i class="fa arrow"></i>
					</a>
					<ul class="sidebar-nav">
						<li>
							<a href="#"> Third Level Item </a>
						</li>
						<li>
							<a href="#"> Third Level Item </a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#"> Second Level Item </a>
				</li>
				<li>
					<a href="#"> Second Level Item <i class="fa arrow"></i>
					</a>
					<ul class="sidebar-nav">
						<li>
							<a href="#"> Third Level Item </a>
						</li>
						<li>
							<a href="#"> Third Level Item </a>
						</li>
						<li>
							<a href="#"> Third Level Item <i class="fa arrow"></i>
							</a>
							<ul class="sidebar-nav">
								<li>
									<a href="#"> Fourth Level Item </a>
								</li>
								<li>
									<a href="#"> Fourth Level Item </a>
								</li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
		</li>
		<li>
			<a href="https://github.com/modularcode/modular-admin-html">
				<i class="fa fa-sign-out-alt"></i> Logout
			</a>
		</li>
	</ul>
</nav>