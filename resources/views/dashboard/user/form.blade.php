<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4  col-xs-7 control-label">
        Имя пользователя
    </label>

    <div class="col-md-5 col-xs-9">
        <input id="name" type="text" class="form-control" name="name" value="{{ $viewdata->name or old('name') }}"  {{ $disabled }} required>

        @if ($errors->has('name'))
        <span class="help-block">
            <strong>
                {{ $errors->first('name') }}
            </strong>
        </span>
        @endif
    </div>

    <div class="col-md-1 col-xs-1">
        <button id="btn-name" class="btn btn-primary">
            <i class="fa fa-phone">
            </i>
        </button>
    </div>

</div>

<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
    <label for="phone" class="col-md-4 control-label">
        Телефон
    </label>

    <div class="col-md-6">
        <input id="phone" type="text" class="form-control" name="phone" value="{{ $viewdata->phone or old('phone') }}" {{ $disabled }}>

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
    <label for="email" class="col-md-4 control-label">
        Email
    </label>

    <div class="col-md-6">
        <input id="email" type="text" class="form-control" name="email" value="{{ $viewdata->email or old('email') }}">

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
    <label for="whatsapp" class="col-md-4  col-xs-7 control-label">
        WhatsApp
    </label>

    <div class="col-md-5 col-xs-9">
        <input id="whatsapp" type="text" class="form-control" name="whatsapp" value="{{ $viewdata->whatsapp or old('whatsapp') }}"  {{ $disabled }}>

        @if ($errors->has('whatsapp'))
        <span class="help-block">
            <strong>
                {{ $errors->first('whatsapp') }}
            </strong>
        </span>
        @endif
    </div>

    <div class="col-md-1 col-xs-1">
        <button id="btn-whatsapp" class="btn btn-primary">
            <i class="fa fa-phone">
            </i>
        </button>
    </div>

</div>

<div class="form-group{{ $errors->has('telegram') ? ' has-error' : '' }}">
    <label for="telegram" class="col-md-4 col-xs-7 control-label">
        Телеграм
    </label>

    <div class="col-md-5 col-xs-9">
        <input id="telegram" type="text" class="form-control" name="telegram" value="{{ $viewdata->telegram or old('telegram') }}" {{ $disabled }}>

        @if ($errors->has('telegram'))
        <span class="help-block">
            <strong>
                {{ $errors->first('telegram') }}
            </strong>
        </span>
        @endif
    </div>
    <div class="col-md-1 col-xs-1">
        <button id="btn-telegram" class="btn btn-primary">
            <i class="fa fa-phone">
            </i>
        </button>
    </div>
</div>

<div class="form-group{{ $errors->has('newPassword') ? ' has-error' : '' }}">
    <label for="newPassword" class="col-md-4 control-label">
        Изменить пароль
    </label>

    <div class="col-md-6">
        <input id="newPassword" type="password" class="form-control" name="newPassword" >

        @if ($errors->has('newPassword'))
        <span class="help-block">
            <strong>
                {{ $errors->first('newPassword') }}
            </strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="newPassword-confirm" class="col-md-4 control-label">
        Подтвержение пароля
    </label>

    <div class="col-md-6">
        <input id="newPassword-confirm" type="password" class="form-control" name="newPassword_confirmation">
    </div>
</div>


<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
			<label class="lbl-sms-agree"> 
				<input class="form-check-input" type="checkbox" name="sms" value="1" id="sms">
				Отправить СМС о смене пароля
			</label>
		</div>
</div>

@push('scripts')
<script src="{{ asset('js/jquery.maskedinput.js') }}">
</script>
<script src="{{ asset('js/project.scripts.js') }}">
</script>
<script>
$(document).ready(function() {	
	$("#name").mask("+9 (999) 999-99-99", {placeholder: "" });
	
	$( "#btn-name" ).click(function( event ) {
                event.preventDefault();
                $("#name").val( $("#phone").val() );
            });
});	
</script>

@endpush                