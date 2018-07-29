<input type="hidden" name="user_id" value="1">
<input type="hidden" name="town_id" value="1">

<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label for="title" class="col-md-4 control-label">
        Наименование элеватора
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

<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
    <label for="price" class="col-md-4 control-label">
        Цена за хранение
    </label>

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

<div class="form-group">
	<div class="{{ $errors->has('corn_id') ? ' has-error' : '' }}"> 
		
		<label for="corn_id" class="col-md-4 control-label">Принимает зерновые культуры</label>		
		
		<div class="col-md-6">
		<select multiple class="form-control" name="corns[]" name="corns" size="5">			
			@foreach($corns as $item)
				@if(isset($viewdata))
					<option {{ in_array($item->id, $elevator_corn )  ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
				@else
					<option value="{{ $item->id }}">{{ $item->name }}</option>
				@endif
			@endforeach			
		</select>

		@if ($errors->has('corn_id'))
		<span class="help-block">
			<strong>
				{{ $errors->first('corn_id') }}
			</strong>
		</span>
		@endif
		</div>
	</div>
</div>   

<div class="form-group">
	<div class="{{ $errors->has('state_id') ? ' has-error' : '' }}"> 
		
		<label for="state_id" class="col-md-4 control-label">Область</label>		
		
		<div class="col-md-6">
		<select class="form-control" name="state_id">		
			@foreach($states as $item)
				@if(isset($viewdata))
					<option {{ $viewdata->state_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
				@else
					<option value="{{ $item->id }}">{{ $item->name }}</option>
				@endif
			@endforeach			
		</select>

		@if ($errors->has('state_id'))
		<span class="help-block">
			<strong>
				{{ $errors->first('state_id') }}
			</strong>
		</span>
		@endif
		</div>
	</div>
</div> 

<div class="form-group">
	<div class="{{ $errors->has('region_id') ? ' has-error' : '' }}">
		
		<label for="region_id" class="col-md-4 control-label">Район</label>		
		
		<div class="col-md-6">
		<select class="form-control" name="region_id" id="region_id">
			<option value="">Не указано</option>		
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
	</div>
</div> 

<div class="form-group">
	<div class="{{ $errors->has('town_id') ? ' has-error' : '' }}">
		
		<label for="town_id" class="col-md-4 control-label">Населенный пункт</label>		
		
		<div class="col-md-6">
		<select class="form-control" name="town_id" id="town_id">
			<option value="">Не указано</option>		
			@foreach($towns as $item)
				@if(isset($viewdata))
					<option {{ $viewdata->town_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}" data-chained="{{$item->region->id}}">{{ $item->name }}</option>
				@else
					<option value="{{ $item->id }}" data-chained="{{$item->region->id}}">{{ $item->name }}</option>
				@endif
			@endforeach			
		</select>

		@if ($errors->has('town_id'))
		<span class="help-block">
			<strong>
				{{ $errors->first('town_id') }}
			</strong>
		</span>
		@endif
		</div>
	</div>
</div>

<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
    <label for="username" class="col-md-4 control-label">
        Контактное лицо
    </label>

    <div class="col-md-6">
        <input id="username" type="text" class="form-control" name="username" value="{{ $viewdata->username or old('username') }}">

        @if ($errors->has('username'))
        <span class="help-block">
            <strong>
                {{ $errors->first('username') }}
            </strong>
        </span>
        @endif
    </div>
</div>  

<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
    <label for="phone" class="col-md-4 control-label">
        Телефон
    </label>

    <div class="col-md-6">
        <input id="phone" type="text" class="form-control" name="phone" value="{{ $viewdata->phone or old('phone') }}">

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
	<label for="whatsapp" class="col-md-4  col-xs-7 control-label">WhatsApp</label>

	<div class="col-md-5 col-xs-9">
		<input id="whatsapp" type="text" class="form-control" name="whatsapp" value="{{ $viewdata->whatsapp or old('whatsapp')}}">

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

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
	<label for="description" class="col-md-4 control-label">Доп. услуги</label>

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


@push('scripts')
<script src="{{ asset('js/jquery.chained.js') }}"></script>
<script src="{{ asset('js/jquery.maskedinput.js') }}"></script>
<script src="{{ asset('js/project.scripts.js') }}"></script>
<script>
$(document).ready(function() {
		
		$("#town_id").chained("#region_id");
		//$("#town_id").chainedTo("#region_id");
		$("#series").chained("#mark");	
});
</script>

@endpush            