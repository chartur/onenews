<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>OneNews | Admin </title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<!-- Place favicon.ico in the root directory -->
	<link rel="stylesheet" href="{{ asset('/admin/css/vendor.css') }}">
	<link rel="stylesheet" href="/admin/css/app-green.css">
	<link rel="stylesheet" href="/admin/css/styles.css?v=0.0.1">
	<link rel="stylesheet" href="/admin/css/jquery-ui.min.css">
	@yield('styles')
	<link rel="icon" href="{{ asset('/images/fav.png') }}">
	<!-- Theme initialization -->
</head>
<body>
<div class="main-wrapper">
	<div class="app" id="app">
		<header class="header">
			<div class="header-block header-block-collapse d-lg-none d-xl-none">
				<button class="collapse-btn" id="sidebar-collapse-btn">
					<i class="fa fa-bars"></i>
				</button>
			</div>
			<div class="header-block header-block-search">
				<form role="search">
					<div class="input-container">
						<i class="fa fa-search"></i>
						<input type="search" placeholder="Search">
						<div class="underline"></div>
					</div>
				</form>
			</div>
			<div class="header-block header-block-nav">
				<ul class="nav-profile">
					<li class="notifications new">
						<a href="" data-toggle="dropdown">
							<i class="fa fa-bell-o"></i>
							<sup>
								<span class="counter">8</span>
							</sup>
						</a>
						<div class="dropdown-menu notifications-dropdown-menu">
							<ul class="notifications-container">
								<li>
									<a href="" class="notification-item">
										<div class="img-col">
											<div class="img" style="background-image: url('/admin/assets/faces/3.jpg')"></div>
										</div>
										<div class="body-col">
											<p>
												<span class="accent">Zack Alien</span> pushed new commit: <span class="accent">Fix page load performance issue</span>. </p>
										</div>
									</a>
								</li>
								<li>
									<a href="" class="notification-item">
										<div class="img-col">
											<div class="img" style="background-image: url('/admin/assets/faces/5.jpg')"></div>
										</div>
										<div class="body-col">
											<p>
												<span class="accent">Amaya Hatsumi</span> started new task: <span class="accent">Dashboard UI design.</span>. </p>
										</div>
									</a>
								</li>
								<li>
									<a href="" class="notification-item">
										<div class="img-col">
											<div class="img" style="background-image: url('/admin/assets/faces/8.jpg')"></div>
										</div>
										<div class="body-col">
											<p>
												<span class="accent">Andy Nouman</span> deployed new version of <span class="accent">NodeJS REST Api V3</span>
											</p>
										</div>
									</a>
								</li>
							</ul>
							<footer>
								<ul>
									<li>
										<a href=""> View All </a>
									</li>
								</ul>
							</footer>
						</div>
					</li>
					<li class="profile dropdown">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							<div class="img" style="background-image: url('https://avatars3.githubusercontent.com/u/3959008?v=3&s=40')">
							</div>
							<span class="name"> {{ auth()->user()->name }} </span>
						</a>
						<div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
							<a class="dropdown-item" href="#">
								<i class="fa fa-user icon"></i> Profile </a>
							<a class="dropdown-item" href="#">
								<i class="fa fa-bell icon"></i> Notifications </a>
							<a class="dropdown-item" href="#">
								<i class="fa fa-gear icon"></i> Settings </a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="/auth/logout">
								<i class="fa fa-power-off icon"></i> Logout </a>
						</div>
					</li>
				</ul>
			</div>
		</header>
		<aside class="sidebar">
			<div class="sidebar-container">
				<div class="sidebar-header">
					<div class="brand p-0">
						<a href="/" target="_blank">
							<div class="w-100 text-center">
								<img src="{{ asset('/images/full_logo.png') }}" width="150px">
							</div>
						</a>
					</div>
				</div>
				@include('admin.components.menu')
			</div>
			<footer class="sidebar-footer">
				<ul class="sidebar-menu metismenu" id="customize-menu">
					<li>
						<ul>
							<li class="customize">
								<div class="customize-item">
									<div class="row customize-header">
										<div class="col-4">
										</div>
										<div class="col-4">
											<label class="title">fixed</label>
										</div>
										<div class="col-4">
											<label class="title">static</label>
										</div>
									</div>
									<div class="row">
										<div class="col-4">
											<label class="title">Sidebar:</label>
										</div>
										<div class="col-4">
											<label>
												<input class="radio" type="radio" name="sidebarPosition" value="sidebar-fixed">
												<span></span>
											</label>
										</div>
										<div class="col-4">
											<label>
												<input class="radio" type="radio" name="sidebarPosition" value="">
												<span></span>
											</label>
										</div>
									</div>
									<div class="row">
										<div class="col-4">
											<label class="title">Header:</label>
										</div>
										<div class="col-4">
											<label>
												<input class="radio" type="radio" name="headerPosition" value="header-fixed">
												<span></span>
											</label>
										</div>
										<div class="col-4">
											<label>
												<input class="radio" type="radio" name="headerPosition" value="">
												<span></span>
											</label>
										</div>
									</div>
									<div class="row">
										<div class="col-4">
											<label class="title">Footer:</label>
										</div>
										<div class="col-4">
											<label>
												<input class="radio" type="radio" name="footerPosition" value="footer-fixed">
												<span></span>
											</label>
										</div>
										<div class="col-4">
											<label>
												<input class="radio" type="radio" name="footerPosition" value="">
												<span></span>
											</label>
										</div>
									</div>
								</div>
							</li>
						</ul>
						<a href="">
							<i class="fa fa-cog"></i> Customize </a>
					</li>
				</ul>
			</footer>
		</aside>
		<div class="sidebar-overlay" id="sidebar-overlay"></div>
		<div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
		<div class="mobile-menu-handle"></div>

		<article class="content dashboard-page">
			<div id="flash-message-container">
				@include('admin.components.flash-messages')
			</div>
			@yield('content')
		</article>

		<div class="modal fade" id="modal-media">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Media Library</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							<span class="sr-only">Close</span>
						</button>
					</div>
					<div class="modal-body modal-tab-container">
						<ul class="nav nav-tabs modal-tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link" href="#gallery" data-toggle="tab" role="tab">Gallery</a>
							</li>
							<li class="nav-item">
								<a class="nav-link active" href="#upload" data-toggle="tab" role="tab">Upload</a>
							</li>
						</ul>
						<div class="tab-content modal-tab-content">
							<div class="tab-pane fade" id="gallery" role="tabpanel">
								<div class="images-container">
									<div class="row">
									</div>
								</div>
							</div>
							<div class="tab-pane fade active in" id="upload" role="tabpanel">
								<div class="upload-container">
									<div id="dropzone">
										<form action="/" method="POST" enctype="multipart/form-data" class="dropzone needsclick dz-clickable" id="demo-upload">
											<div class="dz-message-block">
												<div class="dz-message needsclick"> Drop files here or click to upload. </div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Insert Selected</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<div class="modal fade" id="confirm-modal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-warning"></i> Alert</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Are you sure want to do this?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div>
</div>
<!-- Reference block for JS -->
<div class="ref" id="ref">
	<div class="color-primary"></div>
	<div class="chart">
		<div class="color-primary"></div>
		<div class="color-secondary"></div>
	</div>
</div>
<script src="{{ asset('/admin/js/vendor.js') }}"></script>
<script src="{{ asset('/admin/js/app.js') }}"></script>
<script src="{{ asset('/admin/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/admin/js/script.js?v=0.0.1') }}"></script>
@yield('scripts')
</body>
</html>
