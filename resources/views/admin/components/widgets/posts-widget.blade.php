@if($widget instanceof \App\Models\Widget)
	<li class="card w-100 draggable">
		<form>
			<div class="card card-default">
				<div class="card-footer">{{ $widget->name }}</div>
				<div class="widget-data-form card-body">
					<input type="hidden" name="widget_id" value="{{ $widget->id }}">
					<input class="place-id" type="hidden" name="place" value="">
					<div class="d-flex justify-content-between align-items-center">
						<label class="mb-0">Քանակ</label>
						<input name="post_count" required class="w-50 form-control form-control-sm" type="number" min="2">
					</div>
					<hr>
					<div class="form-inline">
						<label>Կատեգորիա</label>
						<select class="form-control form-control-sm w-100" required name="category_id">
							<option>---</option>
							@foreach($cats as $cat)
								<option value="{{ $cat->id }}">{{ $cat->hy_name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="card-block">
					<p>{{ $widget->description }}</p>
				</div>
				<div>
					<button type="button" class="btn btn-danger btn-sm btn-block delete-widget-button">Delete</button>
				</div>
			</div>
		</form>
	</li>
@else
	<li class="card w-100 draggable">
		<form>
			<div class="card card-default">
				<div class="card-footer">{{ $widget->widget->name }}</div>
				<div class="widget-data-form card-body">
					<input type="hidden" name="widget_id" value="{{ $widget->widget->id }}">
					<input class="place-id" type="hidden" name="place" value="{{ $widget->place }}">
					<div class="d-flex justify-content-between align-items-center">
						<label class="mb-0">Քանակ</label>
						<input name="post_count" value="{{ $widget->data->post_count }}" required class="w-50 form-control form-control-sm" type="number" min="2">
					</div>
					<hr>
					<div class="form-inline">
						<label>Կատեգորիա</label>
						<select class="form-control form-control-sm w-100" required name="category_id">
							<option>---</option>
							@foreach($cats as $cat)
								<option value="{{ $cat->id }}" {{ $widget->data->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->hy_name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="card-block">
					<p>{{ $widget->widget->description }}</p>
				</div>
				<div>
					<button type="button" class="btn btn-danger btn-sm btn-block delete-widget-button">Delete</button>
				</div>
			</div>
		</form>
	</li>
@endif