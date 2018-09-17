<input type="hidden" name="user_id" value="{{ Auth::id() }}">{{-- how users = traders --}}

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	<label for="name" class="col-md-4 control-label">Имя пользователя</label>

	<div class="col-md-6">
		<input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>

		@if ($errors->has('name'))
		<span class="help-block">
			<strong>
				{{ $errors->first('name') }}
			</strong>
		</span>
		@endif
	</div>
</div>	

<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
	<label for="title" class="col-md-4 control-label">Наименование компании</label>

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

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	<label for="email" class="col-md-4 control-label">Email</label>

	<div class="col-md-6">
		<input id="email" type="text" class="form-control" name="email" value="{{ isset($viewdata->user) ? $viewdata->user->email : old('email') }}" >

		@if ($errors->has('email'))
		<span class="help-block">
			<strong>
				{{ $errors->first('email') }}
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

<div class="form-group">
	<div class="col-md-12">
			<label class="lbl-sms-agree">
			<input type="checkbox" name="sms" value="0" hidden="hidden" checked="checked">
			<input class="form-check-input" type="checkbox" name="sms" value="1" id="sms" 
			
			@if(isset($viewdata->sms))
				{{ $viewdata->sms === 1 ? 'checked' : '' }}
			@endif 
			
			>				
				Я соглашаюсь с тем, что мне будут приходить СМС на телефон<br> с уведомлением о новых заявках по интересующей меня продукции
			</label>
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