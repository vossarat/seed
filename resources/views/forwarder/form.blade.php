<input type="hidden" name="user_id" value="{{ isset($viewdata) ? $viewdata->user_id : Auth::id() }}">

<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
	<label for="title" class="col-md-4 control-label">Наименование компании</label>

	<div class="col-md-6">
		<input id="title" type="text" class="form-control" name="title" value="{{ $viewdata->title or old('title') }}">

		@if ($errors->has('title'))
		<span class="help-block">
			<strong>
				{{ $errors->first('title') }}
			</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group" {{ $errors->has('transport_tip') ? ' has-error' : '' }}">
	
	<label for="transport_tip" class="col-md-4 control-label">Тип транспорта</label>
	
	<div class="col-md-4 text-left">
	    <label class="radio-inline">
	    	@if( isset($viewdata->transport_tip) )
	        	<input type="radio" name="transport_tip" value="1" {{ $viewdata->transport_tip == '1' ? 'checked' :  '' }}> авто
	        @else
	        	<input type="radio" name="transport_tip" value="1"> авто
	        @endif
	    </label>
	    <label class="radio-inline">
	        @if( isset($viewdata->transport_tip) )
	        	<input type="radio" name="transport_tip" value="2" {{ $viewdata->transport_tip == '2' ? 'checked' :  '' }}> вагон
	        @else
	        	<input type="radio" name="transport_tip" value="2"> вагон
	        @endif
	    </label>
	
	@if ($errors->has('transport_tip'))
	    <span class="help-block">
	        <strong style="color:#a94442;">
	            {{ $errors->first('transport_tip') }}
	        </strong>
	    </span>
    @endif
    
	</div>
	
</div>

<div class="form-group{{ $errors->has('transport_cnt') ? ' has-error' : '' }}">
	<label for="transport_cnt" class="col-md-4 control-label">Количество машин, вагонов</label>

	<div class="col-md-3">
		<input id="transport_cnt" type="text" class="form-control" name="transport_cnt" value="{{ $viewdata->transport_cnt or old('transport_cnt') }}">

		@if ($errors->has('transport_cnt'))
		<span class="help-block">
			<strong>
				{{ $errors->first('transport_cnt') }}
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
	<div class="col-md-12 text-center">
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