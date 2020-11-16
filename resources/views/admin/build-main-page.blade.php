@extends('admin.layouts.admin')

@section('content')
	<section class="section">
		<div class="row sameheight-container">
			<div class="col-3">
				<ul class="mb-0 p-2 page-screen" id="widgets-list">
					@foreach($widgets as $widget)
						@include($widget->admin_file_url)
					@endforeach
				</ul>
			</div>
			<div class="col-9">
				<div style="height: 100%;">
					<div class="page-screen">
						<div class="d-flex justify-content-between p-2" style="min-height: 100%">
							<ul class="mb-0 p-2 bg-secondary w-25 page-screen-emulator sortable"
							    data-place="left"
							>
								@foreach($activeWidgets->where('place', 'left') as $widget)
									@include($widget->widget->admin_file_url)
								@endforeach
							</ul>
							<ul class="mb-0 p-2 bg-success w-50 page-screen-emulator sortable"
							    data-place="middle"
							>
								@foreach($activeWidgets->where('place', 'middle') as $widget)
									@include($widget->widget->admin_file_url)
								@endforeach
							</ul>
							<ul class="mb-0 p-2 bg-warning w-25 page-screen-emulator sortable"
							    data-place="right"
							>
								@foreach($activeWidgets->where('place', 'right') as $widget)
									@include($widget->widget->admin_file_url)
								@endforeach
							</ul>
						</div>
						@csrf
					</div>
					<button type="button" class="btn btn-success mt-2 float-right save-widget">Save</button>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('scripts')
	<script>
		$(function () {
			$(".sortable").sortable({
				revert: true,
				update: function (e, v) {
					var place_slug = $(e.target).data('place');
					v.item.find('.place-id').val(place_slug);
				}
			});
			$(".draggable").draggable({
				connectToSortable: ".sortable",
				helper: "clone",
				revert: "invalid"
			});
			$("ul, li").disableSelection();


		});

		$(document).on('keypress', "input[type=number]", function (evt) {
			console.log('gag');
			evt.preventDefault();
		});

		$('.save-widget').click(function (e) {
			var req = [];
			$('.sortable li').each(function () {
				var d = $(this).find('form').serializeArray();
				req.push(d);
			});

			req = Object.assign({}, req);

			$.ajax({
				url: '/cabinet/save-build',
				type: 'post',
				dataType: 'json',
				data: req,
				beforeSend: NProgress.start,
				complete: NProgress.done,
				success: function (res) {
					showMessage(res.status, res.message);
				},
				error: function (err) {
					showMessage(err.responseJSON.status, err.responseJSON.message);
				}
			})
		});

		$(document).on('click', '.delete-widget-button', function () {
			$(this).closest('li').remove();
		})
	</script>
@endsection