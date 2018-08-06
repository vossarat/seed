<div id="elevators">{{-- Див выбора элеватора --}}

<div class="form-group">		
		<label for="state_id" class="col-md-4 control-label">Область</label>		
		<div class="col-md-6">
			<select class="" name="state_id">		
				@foreach($states as $item)
					@if(isset($viewdata))
						<option {{ $viewdata->state_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
					@else
						<option value="{{ $item->id }}">{{ $item->name }}</option>
					@endif
				@endforeach			
			</select>
		</div>
</div> 

<div class="form-group">		
		<label for="region_id" class="col-md-4 control-label">Район</label>			
		<div class="col-md-6">
			<select name="region_id" id="region_id">
				@foreach($regions as $item)
					@if(isset($viewdata))
						<option {{ $viewdata->region_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
					@else
						<option value="{{ $item->id }}">{{ $item->name }}</option>
					@endif
				@endforeach			
			</select>
		</div>
</div> 

<div class="form-group">		
		<label for="town_id" class="col-md-4 control-label">Населенный пункт</label>		
		<div class="col-md-6">
			<select name="town_id" id="town_id">
				<option value="">Не указано</option>
				@foreach($towns as $item)				
					@if(isset($viewdata))
						<option data-chained="{{$item->region->id}}" value="{{ $item->id }}" {{ $viewdata->town_id == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
					@else
						<option data-chained="{{$item->region->id}}" value="{{ $item->id }}" >{{ $item->name }}</option>
					@endif
				@endforeach			
			</select>
		</div>
</div>

<div class="form-group">		
		<label for="elevator_id" class="col-md-4 control-label">Элеватор</label>		
		<div class="col-md-6">
			<select class="" name="elevator_id">		
				@foreach($elevators as $item)
					@if(isset($viewdata))
						<option {{ $viewdata->elevator_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->title }}</option>
					@else
						<option value="{{ $item->id }}">{{ $item->title }}</option>
					@endif
				@endforeach			
			</select>
		</div>
</div> 

</div>{{-- /Див выбора элеватора --}}
