<input type="hidden" name="user_id" value="{{ Auth::id() }}">{{-- how users = traders --}}

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

<div class="form-group">
	<div class="{{ $errors->has('corn_id') ? ' has-error' : '' }}"> 
		
		<label for="corn_id" class="col-md-4 control-label">Выращиваемые культуры</label>		
		
		<div class="col-md-6">
		<select id="select-corns" multiple class="form-control" name="corns[]" name="corns" size="5">			
			@foreach($corns as $item)
				@if(isset($viewdata))
					<option {{ in_array($item->id, $farmer_corn )  ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
				@else
					<option value="{{ $item->id }}">{{ $item->name }}</option>
				@endif
			@endforeach			
		</select>
		</div>
	</div>
</div>	

<div class="form-group{{ $errors->has('volume') ? ' has-error' : '' }}">
	<label for="volume" class="col-md-4 control-label">Ориентировочный объем</label>

	<div class="col-md-6">
		<input id="volume" type="text" class="form-control" name="volume" value="{{ $viewdata->volume or old('volume') }}">

		@if ($errors->has('volume'))
		<span class="help-block">
			<strong>
				{{ $errors->first('volume') }}
			</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group">
	<div class="{{ $errors->has('region_id') ? ' has-error' : '' }}">
		
		<label for="region_id" class="col-md-4 control-label">Район</label>		
		
		<div class="col-md-6">
		<select class="" name="region_id">		
			@foreach($regions as $item)
				@if(isset($viewdata))
					<option {{ $viewdata->region_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
				@else
					<option value="{{ $item->id }}">{{ $item->name }}</option>
				@endif
			@endforeach			
		</select>

		@if ($errors->has('region_id'))
		<span class="help-block">
			<strong>
				{{ $errors->first('region_id') }}
			</strong>
		</span>
		@endif
		</div>
	</div>{{-- end region/lpu field --}}
</div> 	

<div class="form-group{{ $errors->has('fio') ? ' has-error' : '' }}">
	<label for="fio" class="col-md-4 control-label">ФИО</label>

	<div class="col-md-6">
		<input id="fio" type="text" class="form-control" name="fio" value="{{ $viewdata->fio or old('fio') }}">

		@if ($errors->has('fio'))
		<span class="help-block">
			<strong>
				{{ $errors->first('fio') }}
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