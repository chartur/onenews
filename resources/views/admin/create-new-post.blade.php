@extends('admin.layouts.admin')

@section('styles')
	<link rel="stylesheet" href="{{ asset('/admin/fancybox/jquery.fancybox.min.css') }}">
@endsection

@section('content')
	<div class="overlay"></div>
	<div class="title-block">
		<h3 class="title"> Ստեղծել նոր փոստ <span class="sparkline bar" data-type="bar"></span>
		</h3>
	</div>

	<section class="section">
		<input type="hidden" name="post_id" value="">
		<div class="d-flex justify-content-around align-items-center mb-3">
			<button type="button" class="btn btn-primary-outline btn-primary language-container-switcher" data-lang="hy">
				<i class="fa fa-arrow-left mr-2"></i>
				Հայերեն
			</button>
			<div class="input-group w-50">
				<input id="post-url-input" type="text" class="form-control" disabled="disabled" placeholder="Փոստի հասցեն կլինի այստեղ">
				<span class="input-group-append pointer-cursor">
          <button class="input-group-text bg-success text-white">
	          <i class="fa fa-copy"></i>
          </button>
        </span>
			</div>
			<button type="button" class="btn btn-primary-outline language-container-switcher" data-lang="ru">
				Русский
				<i class="fa fa-arrow-right mr-2"></i>
			</button>
		</div>


		<div class="row">
			<div class="col-12">
				<div class="overflow-hidden main-post-content w-100">

					<div class="post-language-container float-left d-flex justify-content-between align-items-center" data-lang="hy" style="width: 200%">
						<div class="row sameheight-container w-50">
							<div class="mb-2 col-12">
								<input type="text" name="hy_title" class="form-control form-control-lg" placeholder="Վերնագիր">
							</div>
							<div class="col-12">
								<textarea class="tiny-area" id="hy_content" name="hy_content"></textarea>
							</div>
						</div>

						<div class="row sameheight-container w-50">
							<div class="mb-2 col-12">
								<input type="text" name="ru_title" class="form-control form-control-lg" placeholder="Загаловок">
							</div>
							<div class="col-12">
								<textarea class="tiny-area" id="ru_content" name="ru_content"></textarea>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>


		<div class="options-container overlay-close card" style="padding-bottom: 5rem">
			<div class="position-relative">
				<div class="options-toggle-button">
					<i class="fa fa-cogs"></i>
				</div>
			</div>
			<div class="p-3 pt-4 options-container-content">
				<div class="form-group">
					<label>Կատեգորիա</label>
					<select class="form-control" required name="category_id">
						<option value="">---</option>
						@foreach($categories as $category)
							<option value="{{ $category->id }}">{{ $category->hy_name }}</option>
						@endforeach
					</select>
					<div class="text-center mt-2 text-success" data-toggle="modal" data-target="#add-category-modal">
						<a href="#">
							<i class="fa fa-plus-circle"></i> Ավելացնել
						</a>
					</div>
					<hr>
					<ul class="pl-0 mb-0" style="list-style: none">
						<li>
							<label>
								<input name="is_general" class="checkbox" type="checkbox">
								<span>Նշել որպես գլխավոր</span>
							</label>
						</li>
						<li>
							<label>
								<input name="has_video" class="checkbox" type="checkbox">
								<span>Պարունակում է տեսանյութ</span>
							</label>
						</li>
					</ul>
					<hr>
					<div class="d-flex justify-content-between align-items-center mb-2">
						<label class="mb-0 mr-1">Ընտրել թեգեր</label>
						<div class="flex-grow-1">
							<input type="search" placeholder="Փնտրել" class="form-control form-control-sm" id="tag-search">
						</div>
					</div>
					<div class="tag-list p-2">
						@foreach($tags as $tag)
							<input type="checkbox" id="tag-{{ $tag->id }}" class="d-none tag-input" name="tags[]" value="{{ $tag->id }}">
							<label class="tag-label btn btn-danger-outline" for="tag-{{ $tag->id }}">
								{{ $tag->hy_name }}
							</label>
						@endforeach
					</div>
					<div class="text-center mt-2 text-success" data-toggle="modal" data-target="#add-tag-modal">
						<a href="#">
							<i class="fa fa-plus-circle"></i> Ավելացնել
						</a>
					</div>
					<hr>
					<label>Ընտրել գլխաոր նկար</label>
					<a href="/filemanager/dialog.php?field_id=imgField&lang=hy_AM&akey={{ config('rfm.default_access_key') }}" class="rfm-button">
						<div class="post-image">
							<img src="{{ asset('/images/image-placeholder.jpg') }}" id="post-image-preview">
						</div>
						<input type="hidden" name="image" id="imgField">
					</a>
				</div>
				<hr>
				<div class="form-group">
					<label class="w-100">
						<p class="mb-1">Նյութի հիմնական աղբյուր</p>
						<input type="text" name="source" class="form-control">
					</label>
				</div>
				<hr>
				<div class="form-group">
					<label class="w-100">
						<p class="mb-1">Նյութի կարճ նկարագրություն</p>
						<textarea minlength="120" name="hy_description" placeholder="Կարճ նկարագրություն" class="form-control" rows="3" style="resize: none;"></textarea>
					</label>
					<label class="w-100">
						<textarea minlength="120" name="ru_description" placeholder="Краткое описание" class="form-control" rows="3" style="resize: none;"></textarea>
					</label>
				</div>
			</div>
			<div class="card-footer position-fixed">
				<button class="btn btn-block btn-primary" onclick="validatePostDataAndSave(this)">
					Հրապարակել
				</button>
				<a class="d-none btn btn-block btn-secondary mt-2 create-new-post-href" href="/cabinet/posts/new">
					Ստեղծել նոր փոստ
				</a>
			</div>
		</div>
	</section>

	<div class="modal fade" id="add-tag-modal">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Ավելացնել նոր թեգ</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<form class="w-100" id="add-new-tag-form">
						<div class="form-group">
							<label class="w-100">
								Հայերեն անուն
								<input type="text" required name="hy_name" class="form-control">
							</label>
						</div>
						<div class="form-group">
							<label class="w-100">
								Ռուսերեն անուն
								<input type="text" required name="ru_name" class="form-control">
							</label>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" onclick="addNewTag()">Ավելացնել</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Փակել</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>

	<div class="modal fade" id="add-category-modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Ավելացնել նոր թեգ</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<form class="w-100" id="add-new-category-form">
						<div class="form-group">
							<label class="w-100">
								Հայերեն անուն
								<input type="text" required name="hy_name" class="form-control">
							</label>
						</div>
						<div class="form-group">
							<label class="w-100">
								Ռուսերեն անուն
								<input type="text" required name="ru_name" class="form-control">
							</label>
						</div>
						<div class="form-group">
							<label class="w-100">
								Կարճ անուն (պարտադիր անգլերեն) որը երևալու է URL հասցեում
								<br>
								(օր <b>{{ url('/category') }}/<span class="text-success">political</span></b>)
								<br>
								<div class="input-group">
	                <span class="input-group-prepend">
	                    <span class="input-group-text">{{ url('/category') }}/</span>
	                </span>
									<input type="text" required name="slug" class="form-control" placeholder="Some text here">
								</div>
							</label>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" onclick="addNewCategory()">Ավելացնել</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Փակել</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
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
			toolbar: 'embed media image table | emoticons hr insertdatetime charmap | ' +
					'link forecolor backcolor fontsizeselect alignleft aligncenter alignright alignjustify | numlist bullist pagebreak | ' +
					'fullscreen preview code | print searchreplace wordcount',
			quickbars_selection_toolbar: 'bold italic underline forecolor | formatselect fontsizeselect | ' +
					'quicklink blockquote | alignleft aligncenter alignright alignjustify',
			quickbars_insert_toolbar: 'embed image hr emoticons',
			filemanager_access_key: '{{ config('rfm.default_access_key') }}',
			external_filemanager_path: '/filemanager/',
			external_plugins: {filemanager: '/filemanager/plugin.min.js'}
		});

		function addNewTag() {
			if(!$('#add-new-tag-form').valid()) {
				return showMessage('danger', 'Բոլոր դաշտերը պարտադիր են')
			}

			var hy_name = $('#add-new-tag-form input[name=hy_name]').val();
			var ru_name = $('#add-new-tag-form input[name=ru_name]').val();

			var form = {hy_name: hy_name, ru_name: ru_name};

			$.ajax({
				url: '/cabinet/tags/add-new',
				type: 'post',
				data: form,
				beforeSend: NProgress.start,
				complete: NProgress.done,
				success: function (res) {
					showMessage(res.status, res.message);
					var tag = `<input type="checkbox" id="tag-${res.tag.id}" checked class="d-none tag-input" name="tags[]" value="${res.tag.id}">
										<label class="tag-label btn btn-danger" for="tag-${res.tag.id}">${res.tag.hy_name}</label>`;
					$('.tag-list').prepend(tag);
					$('#add-new-tag-form').trigger("reset");
					$('.modal').modal('hide');
				},
				error: function (err) {
					showMessage(err.responseJSON.status, err.responseJSON.message);
				}
			})
		}

		function addNewCategory() {
			if(!$('#add-new-tag-form').valid()) {
				return showMessage('danger', 'Բոլոր դաշտերը պարտադիր են')
			}

			var hy_name = $('#add-new-category-form input[name=hy_name]').val();
			var ru_name = $('#add-new-category-form input[name=ru_name]').val();
			var slug = $('#add-new-category-form input[name=slug]').val();

			var form = {hy_name: hy_name, ru_name: ru_name, slug: slug};

			$.ajax({
				url: '/cabinet/category/add-new',
				type: 'post',
				data: form,
				beforeSend: NProgress.start,
				complete: NProgress.done,
				success: function (res) {
					showMessage(res.status, res.message);
					var cat = `<option value="${res.category.id}" selected>${res.category.hy_name}</option>`;
					$('select[name=category_id]').append(cat);
					$('#add-new-category-form').trigger("reset");
					$('.modal').modal('hide');
				},
				error: function (err) {
					showMessage(err.responseJSON.status, err.responseJSON.message);
				}
			})
		}

		var errorMessagesForValidation = {
			oneOfLang: 'Նյութի վերնագիրը և կոնտենտը պարտադիր է լեզուներից որևէ մեկով',
			content: 'Նյութը որևէ լեզվով ստեղծելու համար տվյալ լեզվի վերնագիրը և կոնտենտը պետք լինեն լրացված',
			title: 'Նյութը որևէ լեզվով ստեղծելու համար տվյալ լեզվի վերնագիրը և կոնտենտը պետք լինեն լրացված',
			category: 'Ընտրեք նյութի կատեգորիան',
			image: 'Ընտրեք նկար նյութի համար',
		};

		function validatePostDataAndSave(el) {
			NProgress.start();
			var $this = $(el);
			var hy_content = tinymce.get('hy_content').getContent().trim();
			var hy_title = $('input[name=hy_title]').val().trim();
			var ru_content = tinymce.get('ru_content').getContent().trim();
			var ru_title = $('input[name=ru_title]').val().trim();
			var category_id = $('select[name=category_id]').val().trim();
			var image = $('input[name=image]').val().trim();
			var tags = $('.tag-input:checked').map(function() { return $(this).val() }).get();
			var is_general = +$('input[name=is_general]').prop('checked');
			var has_video = +$('input[name=has_video]').prop('checked');
			var source = $('input[name=source]').val().trim();
			var hy_desc = $('textarea[name=hy_description]').val().trim();
			var ru_desc = $('textarea[name=ru_description]').val().trim();
			var postId = $('input[name=post_id]').val();

			if(!hy_title && !hy_content && !ru_title && !ru_content) {
				return showMessage('danger', errorMessagesForValidation.oneOfLang);
			}

			if((!hy_content && hy_title) || (!hy_title && hy_content)) {
				return showMessage('danger', errorMessagesForValidation.content)
			}

			if((!ru_content && ru_title) || (!ru_title && ru_content)) {
				return showMessage('danger', errorMessagesForValidation.content)
			}

			if(!category_id) {
				return showMessage('danger', errorMessagesForValidation.category)
			}

			if(!image){
				return showMessage('danger', errorMessagesForValidation.image)
			}
			$(this).prop('disabled', true);

			var data = {
				hy_title: hy_title,
				hy_content: hy_content,
				ru_content: ru_content,
				ru_title: ru_title,
				image: image,
				category_id: category_id,
				source: source,
				tags: tags,
				is_general: is_general,
				has_video: has_video,
				post_id: postId,
				hy_description: hy_desc,
				ru_description: ru_desc,
			};

			$.ajax({
				url: '/cabinet/posts/store',
				type: 'post',
				data: data,
				dataType: 'json',
				complete: NProgress.done,
				success: function(res) {
					$('input[name=post_id]').val(res.data.id);
					$('.create-new-post-href').removeClass('d-none');
					$('#post-url-input').val(res.data.url);
					copyToClipboard(res.data.url);
					$this.text('Թարմացնել');
					$this.prop('disabled', false);
					showMessage(res.status, res.message)
				},
				error: function (err) {
					showMessage(err.responseJSON.status, err.responseJSON.message);
				}
			})
		}

		function copyToClipboard (str) {
			const el = document.createElement('textarea');
			el.value = str;
			document.body.appendChild(el);
			el.select();
			document.execCommand('copy');
			document.body.removeChild(el);
		}

		function searchTag() {
			var val = $('#tag-search').val().toLowerCase().trim();
			$('.tag-label').each(function(){
				var text = $(this).text().toLowerCase().trim();
				(text.indexOf(val) >= 0) ? $(this).show() : $(this).hide();
			});
		};

		$('#tag-search').on('keyup', searchTag);

		$('#tag-search').on('search', searchTag);
	</script>
@endsection