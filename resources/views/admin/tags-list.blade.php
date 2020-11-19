@extends('admin.layouts.admin')

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
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Հայաերեն անվանում</th>
											<th>Ռուսերեն անվանում</th>
											<th>Փոստերի քանակ</th>
											<th>Ամսաթիվ</th>
											<th>Գործողություն</th>
										</tr>
									</thead>
									<tbody>
										@foreach($tags as $tag)
											<tr>
												<td>{{ $tag->id }}</td>
												<td>{{ $tag->hy_name }}</td>
												<td>{{ $tag->ru_name }}</td>
												<td>{{ $tag->posts_count }}</td>
												<td>{{ $tag->created_at->diffForHumans() }}</td>
												<td>
													<a class="btn btn-warning" href="{{ url('/cabinet/tags/update/'.$tag->id) }}">
														<i class="fa fa-edit"></i>
													</a>
												</td>
											</tr>
										@endforeach
									</tbody>
									<tfoot>
										<tr>
											<th>#</th>
											<th>Հայաերեն անվանում</th>
											<th>Ռուսերեն անվանում</th>
											<th>Փոստերի քանակ</th>
											<th>Ամսաթիվ</th>
											<th>Գործողություն</th>
										</tr>
									</tfoot>
								</table>
							</div>
							<div>
								{!! $tags->links('vendor.pagination.bootstrap-4') !!}
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection