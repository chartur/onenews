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
		<input type="hidden" name="page" value="about">
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
			<div class="col-8">
				<div>
					<label>Հայերեն պարունակություն</label>
					<textarea class="tiny-area" id="hy_content"></textarea>
				</div>
				<hr>
				<div>
					<label>Ռուսերեն պարունակություն</label>
					<textarea class="tiny-area" id="ru_content"></textarea>
				</div>
			</div>
		</div>
	</section>

	<input type="hidden" name="hy_content_value" value="{{ $page ? $page->hy_content : '' }}">
	<input type="hidden" name="ru_content_value" value="{{ $page ? $page->ru_content : '' }}">
@endsection

@section('scripts')
	<script src="{{ asset('/admin/tinymce/tinymce.min.js') }}" ></script>
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

		tinymce.init({
			selector: '.tiny-area',
			height: '500',
			plugins: [
				'embed emoticons hr insertdatetime media table preview searchreplace',
				'autolink charmap image fullscreen link print textcolor',
				'code lists pagebreak quickbars wordcount filemanager',
			],
			toolbar1: 'embed media image table | emoticons hr insertdatetime charmap',
			toolbar2: 'link forecolor backcolor fontsizeselect alignleft aligncenter alignright alignjustify',
			toolbar3: 'numlist bullist pagebreak | fullscreen preview code | print searchreplace wordcount',
			quickbars_selection_toolbar: 'bold italic underline forecolor | formatselect fontsizeselect | ' +
					'quicklink blockquote | alignleft aligncenter alignright alignjustify',
			quickbars_insert_toolbar: 'embed image hr emoticons',
			filemanager_access_key: '{{ config('rfm.default_access_key') }}',
			external_filemanager_path: '/filemanager/',
			external_plugins: {filemanager: '/filemanager/plugin.min.js'},
			setup: function (editor) {
				editor.on('init', function () {
					editor.setContent($('input[name=' + editor.id + '_value]').val());
				})
			}
		});

		$('.save-page-data').click(function (el) {
			var errorMessagesForValidation = {
				content: 'Էջի պարունակությունը պարտադիր է երկու լեզուներով',
				title: 'Էջի վերնագիրը պարտադիր է երկու լեզուներով',
				image: 'Նկարը պարտադիր է',
			};

			NProgress.start();
			var $this = $(this);
			var hy_content = tinymce.get('hy_content').getContent().trim();
			var hy_title = $('input[name=hy_title]').val().trim();
			var ru_content = tinymce.get('ru_content').getContent().trim();
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

			if((!hy_content || !ru_content)) {
				return showMessage('danger', errorMessagesForValidation.content)
			}

			if(!image){
				return showMessage('danger', errorMessagesForValidation.image)
			}

			$(this).prop('disabled', true);

			var data = {
				hy_title: hy_title,
				ru_title: ru_title,
				hy_content: hy_content,
				ru_content: ru_content,
				image: image,
				metas: metas,
				page: page
			}

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