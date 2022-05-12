<div class="card tasks sameheight-item" data-exclude="xs,sm">
    <div class="card-header bordered">
        <div class="header-block">
            <h3 class="title"> Հատկություններ </h3>
        </div>
    </div>
    <div class="card-block">
        <div class="tasks-block">
            <ul class="item-list">
                @foreach($options as $option)
                    <li class="item">
                    <div class="item-row">
                        <div class="item-col item-col-title">
                            <label>
                                <input class="checkbox option-checkbox" data-id="{{ $option->id }}" type="checkbox" {{ $option->value ? 'checked' : '' }}>
                                <span>{{ $option->name }}</span>
                            </label>
                            <span onclick="loadOptionsContentCreatorTemplate({{$option->id}})">
                                <i class="fa fa-edit"></i>
                            </span>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>