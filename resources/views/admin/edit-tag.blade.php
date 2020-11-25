@extends('admin.layouts.admin')

@section('styles')
	<link rel="stylesheet" href="{{ asset('/admin/datatable/datatables.min.css') }}">
@endsection

@section('content')
	<div class="overlay"></div>
	<div class="title-block">
		<h3 class="title"> Թարմացնել թեգը <span class="sparkline bar" data-type="bar"></span>
		</h3>
	</div>

	<section class="section">
		<form class="w-100" id="add-new-tag-form">
			<input type="hidden" name="tag_id" value="{{ $tag->id }}">
			<div class="form-group">
				<label class="w-100">
					Հայերեն անուն
					<input type="text" value="{{ $tag->hy_name }}" required name="hy_name" class="form-control">
				</label>
			</div>
			<div class="form-group">
				<label class="w-100">
					Ռուսերեն անուն
					<input type="text" value="{{ $tag->ru_name }}" required name="ru_name" class="form-control">
				</label>
			</div>
			<div class="text-right">
				<button type="button" onclick="saveTag()" class="btn btn-primary">
					<i class="fa fa-save"></i>
					<span class="ml-2">Save</span>
				</button>
				<button type="button" data-toggle="modal" data-target="#delete-tag-confirmation" class="btn btn-danger">
					<i class="fa fa-trash"></i>
					<span class="ml-2">Ջնջել</span>
				</button>
			</div>
		</form>
		<p class="mt-2">
			<span class="font-weight-bold mr-2">Փոստերի քանակ</span>
			<span class="font-italic" style="text-decoration: underline">{{ $tag->posts_count }}</span>
		</p>
	</section>

	<div class="modal fade" id="delete-tag-confirmation">
		<div class="modal-dialog modal-{{ $tag->posts_count ? 'lg' : 'sm' }}" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Ջնջել թեգը</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Դուք վստա՞հ եք որ ցանկանում եք ջնջել տվյալ թեգը</p>
					<div class="{{ $tag->posts_count ? 'd-block' : 'd-none' }}">
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
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" onclick="deleteTag()">Այո</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Փակել</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
@endsection
@section('scripts')
	<script src="{{ asset('/admin/datatable/datatables.min.js') }}" ></script>
	<script>
		$(function () {

			var table = $('.data-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('tag.update', [$tag->id]) }}",
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

		function saveTag() {
			if(!$('#add-new-tag-form').valid()) {
				return showMessage('danger', 'Բոլոր դաշտերը պարտադիր են')
			}

			var hy_name = $('#add-new-tag-form input[name=hy_name]').val();
			var ru_name = $('#add-new-tag-form input[name=ru_name]').val();
			var tag_id = $('#add-new-tag-form input[name=tag_id]').val();

			var form = {hy_name: hy_name, ru_name: ru_name, tag_id: tag_id};

			$.ajax({
				url: '/cabinet/tags/save',
				type: 'post',
				data: form,
				beforeSend: NProgress.start,
				complete: NProgress.done,
				success: function (res) {
					showMessage(res.status, res.message);
				},
				error: function (err) {
					showMessage(err.responseJSON.status, err.responseJSON.message);
				}
			})
		}

		function deleteTag() {
			var tag_id = $('#add-new-tag-form input[name=tag_id]').val();
			var replace_tag = $('input[name=replace-post-tag]:checked').val();

			$.ajax({
				url: '/cabinet/tags/delete',
				type: 'post',
				data: {tag_id: tag_id, replace: replace_tag},
				beforeSend: NProgress.start,
				complete: NProgress.done,
				success: function (res) {
					// showMessage(res.status, res.message);
					// return history.go(-1);
				},
				error: function (err) {
					// showMessage(err.responseJSON.status, err.responseJSON.message);
				}
			})
		}
	</script>
@endsection