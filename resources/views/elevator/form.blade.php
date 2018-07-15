<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	<label for="name" class="col-md-4 control-label">Наименование заявки</label>

	<div class="col-md-6">
		<input id="name" type="text" class="form-control" name="name" value="{{ $viewdata->name or old('name') }}" required>

		@if ($errors->has('name'))
		<span class="help-block">
			<strong>
				{{ $errors->first('name') }}
			</strong>
		</span>
		@endif
	</div>
</div>	

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
	<label for="description" class="col-md-4 control-label">Описание заявки</label>

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

<div class="form-group{{ $errors->has('count') ? ' has-error' : '' }}">
	<label for="count" class="col-md-4 control-label">Количество (тонны)</label>

	<div class="col-md-6">
		<input id="count" type="text" class="form-control" name="count" value="{{ $viewdata->count or old('count') }}" required>

		@if ($errors->has('count'))
		<span class="help-block">
			<strong>
				{{ $errors->first('count') }}
			</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
	<label for="price" class="col-md-4 control-label">Цена</label>

	<div class="col-md-6">
		<input id="price" type="text" class="form-control" name="price" value="{{ $viewdata->price or old('price') }}" required>

		@if ($errors->has('price'))
		<span class="help-block">
			<strong>
				{{ $errors->first('price') }}
			</strong>
		</span>
		@endif
	</div>
</div>					