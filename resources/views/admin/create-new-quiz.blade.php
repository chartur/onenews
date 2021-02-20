@extends('admin.layouts.admin')

@section('styles')
	<link rel="stylesheet" href="{{ asset('/admin/fancybox/jquery.fancybox.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/admin/css/codemirror.css') }}">
@endsection

@section('content')
	<div class="overlay"></div>
	<div class="title-block">
		<h3 class="title"> Ստեղծել նոր թեստ <span class="sparkline bar" data-type="bar"></span>
		</h3>
	</div>

	<section class="section">
		<div class="d-flex flex-wrap justify-content-between align-items-center">
			<div class="flex-grow-1 mb-2 mr-0 mr-md-2">
				<div class="input-group">
					<span class="input-group-prepend pointer-cursor">
		          <button class="input-group-text bg-success text-white" onclick="copyUrl('hy')">
			          <i class="fa fa-copy"></i>
		          </button>
	        </span>
					<input id="post-url-input-hy"  type="text" class="form-control" disabled="disabled" placeholder="Թեստի հասցեն հայերենի համար կլինի այստեղ">
				</div>
			</div>
			<div class="flex-grow-1 mb-2 ml-0 ml-md-2">
				<div class="input-group">
					<input id="post-url-input-ru"  type="text" class="form-control" disabled="disabled" placeholder="Ссилка теста для русского будет здесь">
					<span class="input-group-append pointer-cursor">
		          <button class="input-group-text bg-success text-white" onclick="copyUrl('ru')">
			          <i class="fa fa-copy"></i>
		          </button>
		        </span>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-12">
				<div class="accordion" id="accordionExample">

					<div class="card question-collapse mb-2">
						<div class="card-header" id="quiz-heading-0">
							<h2 class="mb-0 w-100">
								<button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#quiz-collapse-0" aria-expanded="true" aria-controls="quiz-collapse-0">
									Հարց #1
								</button>
							</h2>
						</div>

						<div id="quiz-collapse-0" class="collapse" aria-labelledby="quiz-heading-0" data-parent="#accordionExample">
							<div class="card-body">
								<div class="row">
									<div class="col-12 col-lg-4">
										<div class="form-group">
											<label class="text-center w-100">Ընտրել հարցի նկար</label>
											<a href="/filemanager/dialog.php?field_id=quiz-0-imgField&lang=hy_AM&sort_by=date&akey={{ config('rfm.default_access_key') }}&fldr=/quizzes" class="rfm-button">
												<div class="post-image">
													<img src="{{ asset('/images/image-placeholder.jpg') }}" id="quiz-0-imgField-preview">
												</div>
												<input type="hidden" class="question-image" id="quiz-0-imgField">
											</a>
										</div>
										<div class="form-group">
											<textarea type="text" class="form-control mb-2 hy_question_title" placeholder="Հարց" rows="3"></textarea>
											<textarea type="text" class="form-control mb-2 ru_question_title" placeholder="Вопрос" rows="3"></textarea>
										</div>
									</div>
									<div class="col-12 col-lg-8">
										<table class="table answers">
											<thead>
												<tr>
													<th>Ճիշտ է</th>
													<th>Հարցը հայերեն</th>
													<th>Հարցը Ռուսերեն</th>
													<th>Ջնջել</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<input type="radio" value="0" class="form-control right">
													</td>
													<td>
														<input type="text" placeholder="Տարբերակ" class="form-control hy_answer">
													</td>
													<td>
														<input type="text" placeholder="Вариант" class="form-control ru_answer">
													</td>
													<td>
														<button class="btn btn-danger btn-sm" onclick="deleteAnswer(this)">
															<i class="fa fa-trash mr-2"></i>
															Ջնջել
														</button>
													</td>
												</tr>
											</tbody>
										</table>
										<button class="btn btn-block btn-success-outline mt-4" onclick="addNewAnswer(this)">
											<i class="fa fa-plus mr-2"></i>
											Ավելացնել տարբերակ
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>

				<div class="mt-3">
					<button class="btn btn-block btn-warning" onclick="addNewQuestion()">
						<i class="fa fa-plus-circle mr-2"></i>
						Ավելացնել Հարց
					</button>
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
				<div class="form-group">
					<label class="w-100">
						<p class="mb-1">Թեստի վերնագիր</p>
						<input name="hy_title" placeholder="վերնագիր" class="form-control">
					</label>
					<label class="w-100">
						<input name="ru_title" placeholder=заголовок class="form-control">
					</label>
				</div>
				<hr>
				<div class="form-group">
					<label class="w-100">
						<p class="mb-1">Թեստի կարճ նկարագրություն</p>
						<textarea minlength="120" name="hy_description" placeholder="Կարճ նկարագրություն" class="form-control" rows="3" style="resize: none;"></textarea>
					</label>
					<label class="w-100">
						<textarea minlength="120" name="ru_description" placeholder="Краткое описание" class="form-control" rows="3" style="resize: none;"></textarea>
					</label>
				</div>
				<div class="form-group">
					<label>Ընտրել գլխաոր նկար</label>
					<a href="/filemanager/dialog.php?field_id=imgField&lang=hy_AM&sort_by=date&akey={{ config('rfm.default_access_key') }}&fldr=/quizzes" class="rfm-button">
						<div class="post-image">
							<img src="{{ asset('/images/image-placeholder.jpg') }}" id="imgField-preview">
						</div>
						<input type="hidden" name="image" id="imgField">
					</a>
				</div>
			</div>
			<div class="card-footer position-fixed">
				<button class="btn btn-block btn-primary" onclick="validatePostDataAndSave(this)">
					Հրապարակել
				</button>
				<a class="d-none btn btn-block btn-secondary mt-2 create-new-post-href" href="/cabinet/quiz/new">
					Ստեղծել նոր թեստ
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
			$('#'+field_id+'-preview').attr('src', url);
		}

		function addNewTag() {
			if(!$('#add-new-tag-form').valid()) {
				return showMessage('danger', 'Բոլոր դաշտերը պարտադիր են')
			}

			var hy_name = $('#add-new-tag-form input[name=hy_name]').val();
			var ru_name = $('#add-new-tag-form input[name=ru_name]').val();

			var form = {hy_name: hy_name, ru_name: ru_name, tag_type: 2};

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
			var hy_title = $('input[name=hy_title]').val().trim();
			var ru_title = $('input[name=ru_title]').val().trim();
			var image = $('input[name=image]').val().trim();
			var tags = $('.tag-input:checked').map(function() { return $(this).val() }).get();
			var hy_desc = $('textarea[name=hy_description]').val().trim();
			var ru_desc = $('textarea[name=ru_description]').val().trim();

			var questions = [];

			$('.question-collapse').each(function () {
				var hy_question_title = $(this).find('.hy_question_title').val().trim();
				var ru_question_title = $(this).find('.ru_question_title').val().trim();
				var right = $(this).find('input[type=radio]:checked').val();
				var question_image = $(this).find('.question-image').val().trim();
				var answers = [];
				$(this).find('tbody tr').each(function () {
					var answer = {
						hy_answer: $(this).find('.hy_answer').val().trim(),
						ru_answer: $(this).find('.ru_answer').val().trim()
					};
					answers.push(answer);
				});
				var question = {
					hy_title: hy_question_title,
					ru_title: ru_question_title,
					right: right,
					answers: answers,
					image: question_image,
				};
				questions.push(question);
			});

			var quiz = {
				hy_title: hy_title,
				ru_title: ru_title,
				image: image,
				tags: tags,
				hy_desc: hy_desc,
				ru_desc: ru_desc,
				questions: questions
			};

			console.log(quiz);

			return false;
			$(this).prop('disabled', true);


			$.ajax({
				url: '/cabinet/posts/store',
				type: 'post',
				data: data,
				dataType: 'json',
				complete: NProgress.done,
				success: function(res) {
					$('input[name=post_id]').val(res.data.id);
					$('.create-new-post-href').removeClass('d-none');

					if(res.data.urls.hy) {
						$('#post-url-input-hy').val(res.data.urls.hy);
					}

					if(res.data.urls.ru) {
						$('#post-url-input-ru').val(res.data.urls.ru);
					}

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
		}

		function addNewAnswer(el) {
			var index = $(el).parent().find('tbody tr').length;
			var answer = `<tr>
											<td>
												<input type="radio" value="${index}" class="form-control right">
											</td>
											<td>
												<input type="text" placeholder="Տարբերակ" class="form-control hy_answer">
											</td>
											<td>
												<input type="text" placeholder="Вариант" class="form-control ru_answer">
											</td>
											<td>
												<button class="btn btn-danger btn-sm" onclick="deleteAnswer(this)">
													<i class="fa fa-trash mr-2"></i>
													Ջնջել
												</button>
											</td>
										</tr>`;

			$(el).parent().find('.answers').append(answer);
		}

		function deleteAnswer(el) {
			$(el).closest('tr').remove();
		}

		function copyUrl(lang) {
			var url = $('#post-url-input-'+lang).val();
			var title = $('input[name='+ lang +'_title]').val().trim();
			copyToClipboard(url+' \n\r '+title);
		}

		function addNewQuestion() {
			var index = $('#accordionExample .question-collapse').length;
			$.ajax({
				complete: NProgress.done,
				url: '/cabinet/quiz/load-question/'+index,
				success: function(res) {
					$('#accordionExample').append(res.view);
					$('.rfm-button').fancybox({
						width: 900,
						height: 600,
						type: 'iframe',
						autoScale: false
					});
				},
				error: function (err) {
					showMessage(err.responseJSON.status, err.responseJSON.message);
				}
			})
		}

		$(document).on('click', '.right', function () {
			$(this).closest('tbody').find('input[type=radio]').prop('checked', false);
			$(this).prop('checked', true)
		});

		$('#tag-search').on('keyup', searchTag);

		$('#tag-search').on('search', searchTag);
	</script>
@endsection