<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">
        Заголовок новости
    </label>

    <div class="col-md-6">
        <input id="title" type="text" class="form-control" name="title" value="{{ $viewdata->title or old('title') }}" required>

        @if ($errors->has('title'))
        <span class="help-block">
            <strong>
                {{ $errors->first('title') }}
            </strong>
        </span>
        @endif
    </div>
</div>      

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
	<label for="description" class="col-md-4 control-label">Подробно</label>

	<div class="col-md-6">		
		<textarea class="form-control" id="description" name="description"  rows="3">{{ $viewdata->description or old('description') }}</textarea>

		@if ($errors->has('description'))
		<span class="help-block">
			<strong>
				{{ $errors->first('description') }}
			</strong>
		</span>
		@endif
	</div>
</div>        