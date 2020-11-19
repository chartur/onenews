@foreach($tags as $tag)
	<input type="checkbox" id="tag-{{ $tag->id }}" class="d-none tag-input" name="tags[]" value="{{ $tag->id }}">
	<label class="tag-label btn btn-danger-outline" for="tag-{{ $tag->id }}">
		{{ $tag->hy_name }}
	</label>
@endforeach