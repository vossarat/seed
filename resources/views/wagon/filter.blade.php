<div class="row">		    	
	<div class="col-xs-6">		    	
		<a class="button button-effect-ujarak button-block button-default-outline toogle-order-filter button-filter">
			Фильтр
		</a>
	</div>

	<div class="col-xs-6">
		<a href="{{ route('order.index') }}" class="button button-effect-ujarak button-block button-default-outline button-filter">
			На зерно
		</a>
	</div>
</div>


{{-- Форма для фильтрации данных --}}
<div id="order-filter">	
	<form>
		<input type="hidden" name="filter" value="filter"/>
		
		{{--
		
		<div class="form-group">
		
			<select name="filterByRegion">
				<option value="0">По району</option>
				@foreach($regions as $item)
						<option value="{{ $item->id }}" {{ $item->id == $filterByRegion ? 'selected' : '' }}>
							{{ $item->name }}
						</option>
				@endforeach			
			</select>

		</div> 
		--}}
		
		<div class="form-group">
			<label class="col-md-4">По культуре</label>		
			
			<select type="hidden" id="select-corns"  name="arrcorns[]" size="5" multiple="multiple" >
				@foreach($corns as $item)
					@if(isset($selected_corns))
						<option class="col-md-6" {{ in_array($item->id, $selected_corns )  ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
					@else
					<option value="{{ $item->id }}">{{ $item->name }}</option>
					@endif
				@endforeach			
			</select>
		</div>
		
		{{--
		
		<div class="filter-price-set">
		<div class="row">
			<div class="col-xs-4">
				<label>Цена</label>
			</div>
			<div class="col-xs-4">
				<input class="form-control" type="text" name="filterByPriceMin" value="{{ $filterByPriceMin }}" placeholder="от"/>
			</div>
			<div class="col-xs-4">
				<input class="form-control" type="text" name="filterByPriceMax" value="{{ $filterByPriceMax }}" placeholder="до"/>
			</div>	
		</div>
		</div>
		--}}
		
		<div class="form-group">	
			<input class="button button-block button-default-outline button-filter" type="submit" value="Установить фильтр"/>		
		</div>
	</form>
</div>