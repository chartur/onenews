@extends('layouts.main')

@section('meta')
	<title>{{ getAttributeByLang($seo, 'title') }}</title>

	<meta name="title" content="{{ getAttributeByLang($seo, 'title') }}">
	<meta name="description" content="{{ getAttributeByLang($seo, 'description') }}">
	<meta name="keywords" content="{{ getAttributeByLang($seo, 'keywords') }}">

	<meta property="og:type" content="website">
	<meta property="og:url" content="{{ url()->current() }}">
	<meta property="og:title" content="{{ getAttributeByLang($seo, 'title') }}">
	<meta property="og:description" content="{{ getAttributeByLang($seo, 'description') }}">

	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="{{ url()->current() }}">
	<meta property="twitter:title" content="{{ getAttributeByLang($seo, 'title') }}">
	<meta property="twitter:description" content="{{ getAttributeByLang($seo, 'description') }}">

	@if($page && $page->image)
		<meta property="og:image" content="{{ asset($page->image) }}">
		<meta property="twitter:image" content="{{ asset($page->image) }}">
	@endif
@endsection

@section('content')
	<div class="p-3 contact-page">
		<div class="row">
			@if ($message = Session::get('success'))
				<div class="col-12">
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>{{ $message }}</strong>
					</div>
				</div>
			@endif
			<div class="col-12 col-md-6">
				<div class="image mb-2">
					<img src="{{ asset($page->image) }}" width="100%">
				</div>
				<form action="{{ routingWithLang('/support') }}" method="POST">
					@csrf
					<input type="text" required name="name" class="form-control mb-2 {{ $errors->contact->count() &&  $errors->contact->first('name') ? 'is-invalid' : '' }}" placeholder="{{ trans('main.contact_form.name') }}">
					<input type="email" required name="email" class="form-control mb-2 {{ $errors->contact->count() &&  $errors->contact->first('email') ? 'is-invalid' : '' }}" placeholder="{{ trans('main.contact_form.email') }}">
					<textarea required name="mess" class="form-control mb-2 {{ $errors->contact->count() &&  $errors->contact->first('message') ? 'is-invalid' : '' }}" placeholder="{{ trans('main.contact_form.message') }}" rows="5" style="resize: none"></textarea>
					<button class="btn btn-primary btn-block" style="background-color: #3d566e">{{ trans('main.contact_form.send') }}</button>
				</form>
			</div>
			<header>
				<h1>{{ getAttributeByLang($seo, 'title') }}</h1>
				<p>
					{!! getAttributeByLang($page, 'content') !!}
				</p>
			</header>
		</div>
	</div>
@endsection