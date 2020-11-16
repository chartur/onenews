@extends('admin.layouts.admin')

@section('styles')
	<link rel="stylesheet" href="{{ asset('/admin/fancybox/jquery.fancybox.min.css') }}">
	<style>
		.title-block:after {
			content: none;
		}
	</style>
@endsection

@section('content')
	<section class="section">
		<input type="hidden" name="page" value="main">
		<div class="overlay"></div>
		<div class="title-block d-flex justify-content-between align-items-center">
			<div>
				<h3 class="title"> Էջի կարգավորումներ <span class="sparkline bar" data-type="bar"></span></h3>
			</div>
			<div>
				<button class="save-page-data btn btn-primary">
					<i class="fa fa-save mr-2"></i>
					Պահպանել
				</button>
			</div>
		</div>
		
		<div class="row sameheight-container">
			<div class="col-4">
				<div>
					<label class="w-100">
						Էջի հայերեն վերնագիր
						<input type="text" name="hy_title" value="{{ $seo && $seo->hy_title ? $seo->hy_title : '' }}" class="form-control">
					</label>
					<label class="w-100">
						Էջի ռուսերեն վերնագիր
						<input type="text" name="ru_title" value="{{ $seo && $seo->ru_title ? $seo->ru_title : '' }}" class="form-control">
					</label>
				</div>
				<hr>
				<div>
					<a href="/filemanager/dialog.php?field_id=imgField&lang=hy_AM&akey={{ config('rfm.default_access_key') }}" class="rfm-button">
						<img id="post-image-preview" src="{{ asset($page && $page->image ? $page->image : '/images/image-placeholder.jpg') }}" width="100%">
					</a>
					<input type="hidden" value="{{ $page && $page->image ? $page->image : '' }}" name="image" id="imgField">
				</div>
				<hr>
			</div>
			<div class="col-8">
				<div class="metas">
					<div class="card p-1 meta-card">
						<div>
							<label class="label label-info w-100">
								Մետա keywords թեգի արժեքը՝ հայերեն
								<textarea type="text" class="form-control form-control-sm" name="hy_keywords" style="resize: none">{{ $seo && $seo->hy_keywords ? $seo->hy_keywords : '' }}</textarea>
							</label>
							<label class="label label-info w-100">
								Մետա keywords թեգի արժեքը՝ ռուսերեն
								<textarea type="text" class="form-control form-control-sm" name="ru_keywords" style="resize: none">{{ $seo && $seo->ru_keywords ? $seo->ru_keywords : '' }}</textarea>
							</label>
						</div>
						<hr>
						<div class="card p-1 meta-card">
							<label class="label label-info w-100">
								Մետա description թեգի արժեքը՝ հայերեն
								<textarea type="text" class="form-control form-control-sm" name="hy_description" style="resize: none">{{ $seo && $seo->hy_description ? $seo->hy_description : '' }}</textarea>
							</label>
							<label class="label label-info w-100">
								Մետա description թեգի արժեքը՝ ռուսերեն
								<textarea type="text" class="form-control form-control-sm" name="ru_description" style="resize: none">{{ $seo && $seo->ru_description ? $seo->ru_description : '' }}</textarea>
							</label>
						</div>
					</div>
					<hr>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('scripts')
	<script src="{{ asset('/admin/fancybox/jquery.fancybox.min.js') }}" ></script>
	<script>
		$('.rfm-button').fancybox({
			width: 900,
			height: 600,
			type: 'iframe',
			autoScale: false
		});

		function responsive_filemanager_callback(field_id){
			var url=jQuery('#'+field_id).val();
			$('#post-image-preview').attr('src', url);
		}


		$('.save-page-data').click(function (el) {
			var errorMessagesForValidation = {
				title: 'Էջի վերնագիրը պարտադիր է երկու լեզուներով',
				image: 'Նկարը պարտադիր է',
			};

			NProgress.start();
			var $this = $(this);
			var hy_title = $('input[name=hy_title]').val().trim();
			var ru_title = $('input[name=ru_title]').val().trim();
			var page = $('input[name=page]').val().trim();
			var image = $('input[name=image]').val().trim();
			var metas = {};
			$('.meta-card textarea').each(function() {
				metas[$(this).attr('name')] = $(this).val()
			});


			if(!hy_title || !ru_title) {
				return showMessage('danger', errorMessagesForValidation.title);
			}

			if(!image){
				return showMessage('danger', errorMessagesForValidation.image)
			}

			$(this).prop('disabled', true);

			var data = {
				hy_title: hy_title,
				ru_title: ru_title,
				image: image,
				metas: metas,
				page: page
			};

			$.ajax({
				url: '/cabinet/seo/page-save',
				type: 'post',
				data: data,
				dataType: 'json',
				complete: function() {
					NProgress.done();
					$this.prop('disabled', false);
				},
				success: function(res) {
					showMessage(res.status, res.message)
				},
				error: function (err) {
					showMessage(err.responseJSON.status, err.responseJSON.message);
				}
			})

		});

	</script>
@endsection