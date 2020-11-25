@extends('admin.layouts.admin')

@section('styles')
	<link rel="stylesheet" href="{{ asset('/admin/fancybox/jquery.fancybox.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/admin/datatable/datatables.min.css') }}">

	<style>
		.data-table th:nth-child(4), td:nth-child(4), th:nth-child(5), td:nth-child(5),th:nth-child(7), td:nth-child(7) {
			word-break: break-all;
			width: 100px!important;
		}
		.data-table th:nth-child(1), td:nth-child(1)  {
			width: 80px!important;
			word-break: break-all;
		}
	</style>
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
							<h3 class="title"> Փոստեր </h3>
						</div>
						<section class="example">
							<div class="table-responsive">
								<table class="data-table table table-striped table-bordered table-hover w-100">
									<thead>
										<tr>
											<th>Գործողություն</th>
											<th>#ID</th>
											<th>Նկար</th>
											<th class="title-th">Վերնագիր</th>
											<th>Կատեգորիա</th>
											<th>Լեզուներ</th>
											<th>Աղբյուր</th>
											<th>Դիտում</th>
											<th>Ամսաթիվ</th>
										</tr>
									</thead>
									<tbody>
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
				order: [[ 1, "desc" ]],
				columns: [
					{data: 'action', name: 'action', orderable: false, searchable: false},
					{data: 'id', name: 'id'},
					{data: 'image', name: 'image', orderable: false, searchable: false},
					{data: 'title', name: 'posts.hy_title'},
					{data: 'category.hy_name', name: 'category.hy_name'},
					{data: 'langs', name: 'langs', orderable: false, searchable: false},
					{data: 'source', name: 'source', orderable: false, searchable: false},
					{data: 'viewed', name: 'viewed', orderable: false, searchable: false},
					{data: 'date', name: 'date'},
					{data: 'title_ru', name: 'posts.ru_title', visible: false},
				]
			});

		});

	</script>
@endsection