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

<div class="form-group{{ $errors->has('point_name') ? ' has-error' : '' }}">
	<label for="point_name" class="col-md-4 control-label">Населенный пункт</label>

	<div class="col-md-6">
		<input id="point_name" type="text" class="form-control" name="point_name" value="{{ $viewdata->point_name or old('point_name') }}">

		@if ($errors->has('point_name'))
		<span class="help-block">
			<strong>
				{{ $errors->first('point_name') }}
			</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('point_adress') ? ' has-error' : '' }}">
	<label for="point_adress" class="col-md-4 control-label">Адрес</label>

	<div class="col-md-6">
		<input id="point_adress" type="text" class="form-control" name="point_adress" value="{{ $viewdata->point_adress or old('point_adress') }}">

		@if ($errors->has('point_adress'))
		<span class="help-block">
			<strong>
				{{ $errors->first('point_adress') }}
			</strong>
		</span>
		@endif
	</div>
</div>

</div>{{-- /Див выбора другое --}}
