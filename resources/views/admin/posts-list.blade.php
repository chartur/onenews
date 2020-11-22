@extends('admin.layouts.admin')

@section('styles')
	<link rel="stylesheet" href="{{ asset('/admin/fancybox/jquery.fancybox.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/admin/datatable/datatables.min.css') }}">
@endsection

@section('content')
	<div class="overlay"></div>
	<div class="title-block">
		<h3 class="title"> Փոստեր <span class="sparkline bar" data-type="bar"></span>
		</h3>
	</div>

	<section class="section">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-block">
						<div class="card-title-block">
							<h3 class="title"> Responsive simple </h3>
						</div>
						<section class="example">
							<div class="table-responsive">
								<table class="data-table table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Նկար</th>
											<th>Վերնագիր</th>
											<th>Կատեգորիա</th>
											<th>Լեզուներ</th>
											<th>Աղբյուր</th>
											<th>Դիտում</th>
											<th>Ամսաթիվ</th>
											<th>Գործողություն</th>
										</tr>
									</thead>
									<tbody>
										{{--@foreach($posts as $post)--}}
											{{--<tr>--}}
												{{--<td>{{ $post->id }}</td>--}}
												{{--<td>--}}
													{{--<a href="{{ url($post->image) }}" class="fancy">--}}
														{{--<img src="{{ $post->image }}" width="50px">--}}
													{{--</a>--}}
												{{--</td>--}}
												{{--<td>{{ $post->hy_title ?: $post->ru_title }}</td>--}}
												{{--<td>{{ $post->category->hy_name }}</td>--}}
												{{--<td>--}}
													{{--@if($post->hy_title)--}}
														{{--<span class="text-success d-block text-center">Հայերեն</span>--}}
													{{--@endif--}}
													{{--@if($post->ru_title)--}}
														{{--<span class="text-primary d-block text-center">Ռուսերեն</span>--}}
													{{--@endif--}}
												{{--</td>--}}
												{{--<td>--}}
													{{--<a href="{{ $post->source }}" target="_blank">--}}
														{{--{{ $post->source }}--}}
													{{--</a>--}}
												{{--</td>--}}
												{{--<td>--}}
													{{--<i class="fa fa-eye mr-2"></i>--}}
													{{--{{ $post->viewed }}--}}
												{{--</td>--}}
												{{--<td>{{ $post->created_at->diffForHumans() }}</td>--}}
												{{--<td>--}}
													{{--<a class="btn btn-warning" href="{{ url('/cabinet/posts/update/'.$post->id) }}">--}}
														{{--<i class="fa fa-edit"></i>--}}
													{{--</a>--}}
												{{--</td>--}}
											{{--</tr>--}}
										{{--@endforeach--}}
									</tbody>
								</table>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('scripts')
	<script src="{{ asset('/admin/fancybox/jquery.fancybox.min.js') }}" ></script>
	<script src="{{ asset('/admin/datatable/datatables.min.js') }}" ></script>
	<script>
		$(document).ready(function () {
			$("a.fancy").fancybox({
				animationEffect: 'fade',
				autoScale: false,
				image: {
					// Wait for images to load before displaying
					//   true  - wait for image to load and then display;
					//   false - display thumbnail and load the full-sized image over top,
					//           requires predefined image dimensions (`data-width` and `data-height` attributes)
					preload: true
				},
			});
		});

		$(function () {

			var table = $('.data-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('posts.list') }}",
				columns: [
					{data: 'id', name: 'id'},
					{data: 'image', name: 'image', orderable: false, searchable: false},
					{data: 'hy_title', name: 'hy_title'},
					{data: 'category.hy_name', name: 'category.hy_name'},
					{data: 'langs', name: 'langs', orderable: false, searchable: false},
					{data: 'source', name: 'source'},
					{data: 'viewed', name: 'viewed'},
					{data: 'date', name: 'date'},
					{data: 'action', name: 'action', orderable: false, searchable: false},
				]
			});

		});

	</script>
@endsection