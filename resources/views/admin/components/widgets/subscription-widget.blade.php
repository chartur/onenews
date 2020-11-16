@if($widget instanceof \App\Models\Widget)
	<li class="card w-100 draggable">
		<form>
			<div class="card card-default">
				<div class="card-footer">{{ $widget->name }}</div>
				<input class="place-id" type="hidden" name="place" value="">
				<input type="hidden" name="widget_id" value="{{ $widget->id }}">
				<div class="widget-data-form card-body">
					<input class="form-control form-control-sm mb-3" placeholder="Վերնագիր" value="" name="title">
				</div>
				<div class="card-block text-small">
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
				<input class="place-id" type="hidden" name="place" value="{{ $widget->place }}">
				<input type="hidden" name="widget_id" value="{{ $widget->widget->id }}">
				<div class="widget-data-form card-body">
					<input class="form-control form-control-sm mb-3" placeholder="Վերնագիր" value="{{ $widget->data->title }}" name="title">
				</div>
				<div class="card-block text-small">
					<p>{{ $widget->widget->description }}</p>
				</div>
				<div>
					<button type="button" class="btn btn-danger btn-sm btn-block delete-widget-button">Delete</button>
				</div>
			</div>
		</form>
	</li>
@endif