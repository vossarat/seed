<div class="form-group">
<div class="col-xs-12">
	@if($filter)
		<a href="{{ route('mapelevator') }}" class="button button-effect-ujarak button-block button-default-outline">
        	Очистить Фильтр
        </a>
    @else			    	
        <a class="button button-effect-ujarak button-block button-default-outline toogle-elevator-filter">
        	Фильтр
        </a>
    @endif
</div> 
</div>

<div id="elevator-filter" class="cell-xs-12">	       

    <div class="table-custom-responsive">
        <table class="table-custom">
            <tbody>
                @if( isset($filterByRegion) )
                	<tr>

                        <td>                        	
                        	<a href=" {{ route('mapelevator').'?filterByState='.$regions->state_id.'&filter=filter&page=1'.$filterByCorn }} "><span class="fa fa-long-arrow-left"></span> {{ $regions->name."  (" .$regions->countElevator($regions->id). ")" }} </a>
                        </td>
                    </tr>
                
                @elseif( isset($filterByState) )
                	<tr>
                        <td>                        	
                        	<a href=" {{ route('mapelevator').'?filterByState=&filter=filter&page=1'.$filterByCorn }} "><span class="fa fa-long-arrow-left"></span> {{ $states->name."  (" .$states->countElevator($states->id). ")" }} </a>
                        </td>
                    </tr>                     
                
                    @foreach($regions as $region)
                    <tr>
                        <td>
                        	
                        	<a href=" {{ route('mapelevator').'?filterByRegion='.$region->id.'&filter=filter&page=1'.$filterByCorn }} "> &nbsp; &nbsp; &nbsp;{{ $region->name."  (" .$region->countElevator($region->id). ")" }} <span class="fa fa-long-arrow-right"></span></a>
                        </td>
                    </tr>
                     @endforeach
                
                @else
                    @foreach($states as $state)	                            
                    <tr>
                        <td>
                        	
                        	<a href=" {{ route('mapelevator').'?filterByState='.$state->id.'&filter=filter&page=1'.$filterByCorn }} ">{{ $state->name."  (" .$state->countElevator($state->id). ")" }} <span class="fa fa-long-arrow-right"></span> </a>
                        </td>
                    </tr>
                    @endforeach
                @endif 
                
            </tbody>

        </table>
    </div>
    
    <form>
	<div class="form-group">

			<input type="hidden" name="filter" value="filter"/>
			<input type="hidden" name="page" value="1"/>
			
			@if( isset($filterByRegion) )
			<input type="hidden" name="filterByRegion" value="{{ $filterByRegion }}"/>
			@endif
			
			@if( isset($filterByState) )
			<input type="hidden" name="filterByState" value="{{ $filterByState }}"/>
			@endif
			
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
			
			
			


	</div> 
	<input type="submit" value="Установить фильтр"/>
	</form>
    
</div>