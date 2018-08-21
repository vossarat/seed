<div class="form-group">
<div class="col-xs-12">
	@if($filter)
		<a href="{{ route('order.index') }}" class="button button-effect-ujarak button-block button-default-outline">
        	Очистить Фильтр
        </a>
    @else			    	
        <a class="button button-effect-ujarak button-block button-default-outline toogle-order-filter">
        	Фильтр
        </a>
    @endif
</div> 
</div>


{{-- Форма для фильтрации данных --}}
<div id="order-filter" class="cell-xs-12">	
	<form>
		<input type="hidden" name="filter" value="filter"/>
		
		<div class="form-group">
			<label>По культуре</label>		
			
			<select type="hidden" id="select-corns"  name="arrcorns[]" size="5" multiple="multiple" >
				@foreach($corns as $item)
					@if(isset($selected_corns))
						<option {{ in_array($item->id, $selected_corns )  ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
					@else
					<option value="{{ $item->id }}">{{ $item->name }}</option>
					@endif
				@endforeach			
			</select>
		</div>
		
		<div class="form-group">
			<label>По цене</label>
			<input type="text" name="filterByPriceMin" value="{{ $filterByPriceMin }}" placeholder="от"/>
			<input type="text" name="filterByPriceMax" value="{{ $filterByPriceMax }}" placeholder="до"/>
		</div>
		
		<div class="form-group">
		
			<label>Район</label>		
		
			<select style="width: auto;"  name="filterByRegion">
				<option value="0">Все районы</option>
				@foreach($regions as $item)
						<option value="{{ $item->id }}" {{ $item->id == $filterByRegion ? 'selected' : '' }}>
							{{ $item->name }}
						</option>
				@endforeach			
			</select>

		</div> 
		
		<input type="submit" value="Установить фильтр"/>
	</form>
</div>