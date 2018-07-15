<input type="hidden" name="user_id" value="{{ Auth::id() }}">{{-- how users = orders --}}

<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
	<label for="title" class="col-md-4 control-label">Наименование заявки</label>

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

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	<label for="name" class="col-md-4 control-label">Имя пользователя</label>

	<div class="col-md-6">
		<input id="name" type="text" class="form-control" name="name" value="{{ isset($viewdata->user) ? $viewdata->user->name : $viewdata->name }}">

		@if ($errors->has('name'))
		<span class="help-block">
			<strong>
				{{ $errors->first('name') }}
			</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
	<label for="phone" class="col-md-4 control-label">Телефон</label>

	<div class="col-md-6">
		<input id="phone" type="text" class="form-control" name="phone" value="{{ isset($viewdata->user) ? $viewdata->user->phone : $viewdata->phone }}">

		@if ($errors->has('phone'))
		<span class="help-block">
			<strong>
				{{ $errors->first('phone') }}
			</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	<label for="email" class="col-md-4 control-label">Email</label>

	<div class="col-md-6">
		<input id="email" type="text" class="form-control" name="email" value="{{ isset($viewdata->user) ? $viewdata->user->email : $viewdata->email }}">

		@if ($errors->has('email'))
		<span class="help-block">
			<strong>
				{{ $errors->first('email') }}
			</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('whatsapp') ? ' has-error' : '' }}">
	<label for="whatsapp" class="col-md-4 control-label">WhatsApp</label>

	<div class="col-md-6">
		<input id="whatsapp" type="text" class="form-control" name="whatsapp" value="{{ isset($viewdata->user) ? $viewdata->user->whatsapp : $viewdata->whatsapp }}">

		@if ($errors->has('whatsapp'))
		<span class="help-block">
			<strong>
				{{ $errors->first('whatsapp') }}
			</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('telegram') ? ' has-error' : '' }}">
	<label for="telegram" class="col-md-4 control-label">Телеграм</label>

	<div class="col-md-6">
		<input id="telegram" type="text" class="form-control" name="telegram" value="{{ isset($viewdata->user) ? $viewdata->user->telegram : $viewdata->telegram }}">

		@if ($errors->has('telegram'))
		<span class="help-block">
			<strong>
				{{ $errors->first('telegram') }}
			</strong>
		</span>
		@endif
	</div>
</div>					