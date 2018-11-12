<div id="other">{{-- Див выбора другое --}}

<div class="form-group">
		<label for="point_id" class="col-md-4 control-label">Укажите пункт</label>				
		<div class="col-md-6">
			<select class="" name="point_id">		
				@foreach($points as $item)
					@if(isset($viewdata))
						<option {{ $viewdata->point_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
					@else
						<option value="{{ $item->id }}">{{ $item->name }}</option>
					@endif
				@endforeach			
			</select>
		</div>
</div>

<div class="form-group{{ $errors->has('address_supply') ? ' has-error' : '' }}">
	<label for="address_supply" class="col-md-4 control-label">Адрес подачи</label>

	<div class="col-md-6">		
		<textarea class="form-control" id="address_supply" name="address_supply"  rows="3">{{ $viewdata->address_supply or old('address_supply') }}</textarea>

		@if ($errors->has('address_supply'))
		<span class="help-block">
			<strong>
				{{ $errors->first('address_supply') }}
			</strong>
		</span>
		@endif
	</div>
</div> 

<div class="form-group{{ $errors->has('address_delivery') ? ' has-error' : '' }}">
	<label for="address_delivery" class="col-md-4 control-label">Адрес доставки</label>

	<div class="col-md-6">		
		<textarea class="form-control" id="address_delivery" name="address_delivery"  rows="3">{{ $viewdata->address_delivery or old('address_delivery') }}</textarea>

		@if ($errors->has('address_delivery'))
		<span class="help-block">
			<strong>
				{{ $errors->first('address_delivery') }}
			</strong>
		</span>
		@endif
	</div>
</div>
						
</div>						