<div class="card question-collapse mb-2">
	<div class="card-header" id="quiz-heading-{{$index}}">
		<h2 class="mb-0 w-100">
			<button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#quiz-collapse-{{$index}}" aria-expanded="true" aria-controls="quiz-collapse-{{$index}}">
				Հարց #{{$index+1}}
			</button>
		</h2>
	</div>

	<div id="quiz-collapse-{{$index}}" class="collapse" aria-labelledby="quiz-heading-{{$index}}" data-parent="#accordionExample">
		<div class="card-body">
			<div class="row">
				<div class="col-12 col-lg-4">
					<div class="form-group">
						<label class="text-center w-100">Ընտրել հարցի նկար</label>
						<a href="/filemanager/dialog.php?field_id=quiz-{{$index}}-imgField&lang=hy_AM&sort_by=date&akey={{ config('rfm.default_access_key') }}&fldr=/quizzes" class="rfm-button">
							<div class="post-image">
								<img src="{{ asset('/images/image-placeholder.jpg') }}" id="quiz-{{$index}}-imgField-preview">
							</div>
							<input type="hidden" class="question-image" id="quiz-{{$index}}-imgField">
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
								<input type="radio" value="0" class="form-control" name="right">
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
