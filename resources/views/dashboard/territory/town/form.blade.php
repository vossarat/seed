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
	</div>{{-- end region/lpu field --}}
</div> 

<div class="form-group">
	<div class="{{ $errors->has('region_id') ? ' has-error' : '' }}">
		
		<label for="region_id" class="col-md-4 control-label">Район</label>		
		
		<div class="col-md-6">
		<select class="form-control" name="region_id">		
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

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">
        Наименование населенного пункта
    </label>

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