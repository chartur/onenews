@extends('admin.layouts.admin')

@section('styles')
	<link rel="stylesheet" href="{{ asset('/admin/datatable/datatables.min.css') }}">
@endsection

@section('content')
	<div class="overlay"></div>
	<div class="title-block">
		<h3 class="title"> Թեգեր <span class="sparkline bar" data-type="bar"></span>
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
											<th>Գործողություն</th>
											<th>#ID</th>
											<th>Հայաերեն անվանում</th>
											<th>Ռուսերեն անվանում</th>
											<th>Փոստերի քանակ</th>
											<th>Ամսաթիվ</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
									<tfoot>
										<tr>
											<th>Գործողություն</th>
											<th>#ID</th>
											<th>Հայաերեն անվանում</th>
											<th>Ռուսերեն անվանում</th>
											<th>Փոստերի քանակ</th>
											<th>Ամսաթիվ</th>
										</tr>
									</tfoot>
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
	<script src="{{ asset('/admin/datatable/datatables.min.js') }}" ></script>
	<script>

		$(function () {

			var table = $('.data-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('tags.list') }}",
				order: [[ 1, "desc" ]],
				columns: [
					{data: 'action', name: 'action', orderable: false, searchable: false},
					{data: 'id', name: 'id'},
					{data: 'hy_name', name: 'hy_name'},
					{data: 'ru_name', name: 'ru_name'},
					{data: 'posts_count', name: 'posts_count', orderable: false, searchable: false},
					{data: 'date', name: 'date'},
				]
			});

		});

	</script>
@endsection