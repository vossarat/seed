<input type="hidden" name="user_id" value="{{ Auth::id() }}">{{-- how users = traders --}}

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	<label for="name" class="col-md-4 control-label">Наименование компании</label>

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

<div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
	<label for="category" class="col-md-4 control-label">Категория (интересующая продукция)</label>

	<div class="col-md-6">		
		<textarea class="form-control" id="category" name="category"  rows="3">{{ $viewdata->category or old('category') }}</textarea>

		@if ($errors->has('category'))
		<span class="help-block">
			<strong>
				{{ $errors->first('category') }}
			</strong>
		</span>
		@endif
	</div>
</div>	

<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
	<label for="phone" class="col-md-4 control-label">Телефон</label>

	<div class="col-md-6">
		<input id="phone" type="text" class="form-control" name="phone" value="{{ isset($viewdata->user) ? $viewdata->user->phone : old('phone') }}" >

		@if ($errors->has('phone'))
		<span class="help-block">
			<strong>
				{{ $errors->first('phone') }}
			</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('whatsapp') ? ' has-error' : '' }}">
	<label for="whatsapp" class="col-md-4  col-xs-7 control-label">WhatsApp</label>

	<div class="col-md-5 col-xs-9">
		<input id="whatsapp" type="text" class="form-control" name="whatsapp" value="{{ isset($viewdata->user) ? $viewdata->user->whatsapp : old('whatsapp') }}">

		@if ($errors->has('whatsapp'))
		<span class="help-block">
			<strong>
				{{ $errors->first('whatsapp') }}
			</strong>
		</span>
		@endif
	</div>
	
	<div class="col-md-1 col-xs-1">
       <button id="btn-whatsapp" class="btn btn-primary"><i class="fa fa-phone"></i></button>
    </div>
	
</div>

<div class="form-group{{ $errors->has('telegram') ? ' has-error' : '' }}">
	<label for="telegram" class="col-md-4 col-xs-7 control-label">Телеграм</label>

	<div class="col-md-5 col-xs-9">
		<input id="telegram" type="text" class="form-control" name="telegram" value="{{ isset($viewdata->user) ? $viewdata->user->telegram : old('telegram') }}">

		@if ($errors->has('telegram'))
		<span class="help-block">
			<strong>
				{{ $errors->first('telegram') }}
			</strong>
		</span>
		@endif
	</div>
	<div class="col-md-1 col-xs-1">
        <button id="btn-telegram" class="btn btn-primary"><i class="fa fa-phone"></i></button>
    </div>	
</div>

<div class="form-group{{ $errors->has('newPassword') ? ' has-error' : '' }}">
                            <label for="newPassword" class="col-md-4 control-label">Изменить пароль</label>

                            <div class="col-md-6">
                                <input id="newPassword" type="password" class="form-control" name="newPassword">

                                @if ($errors->has('newPassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('newPassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="newPassword-confirm" class="col-md-4 control-label">Подтвержение пароля</label>

                            <div class="col-md-6">
                                <input id="newPassword-confirm" type="password" class="form-control" name="newPassword_confirmation">
                            </div>
                        </div>

@push('scripts')
<script src="{{ asset('js/jquery.maskedinput.js') }}"></script>
<script src="{{ asset('js/project.scripts.js') }}"></script>
@endpush					