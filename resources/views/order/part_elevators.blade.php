{{-- указать подробные параметры --}}

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <a href="#menu-elevator" class="button button-effect-ujarak button-block button-default-outline">
            Выбрать элеватор
        </a>
    </div>
</div>

<div id="menu-elevator" class="menu-elevator">
	<ul>
	
		<li><span>Избранные <span class="col-fav-elevator fa fa-star"></span></span>
			<ul>
				<li>					
					<span class="col-fav-elevator">
						<input id = 'all-fav-elevators' type="checkbox" />&nbsp;&nbsp;Выбрать все избранные
					</span>
					
				</li>
				@foreach($fav_elevators as $fav)
				<li>					
					<span>
						<input name="elevators" type="checkbox" class="order-elevator fav-elevators" elevator-id="{{ $fav->id }}" value="{{ in_array( $fav->id, $elevator_order ) ? $fav->id : '' }}" {{ in_array( $fav->id, $elevator_order ) ? 'checked' : '' }}/>&nbsp;&nbsp;{{ $fav->title }}
					</span>
					
				</li>
				@endforeach
				
			</ul>
		</li>
		@foreach($regions as $region)
			<li><span><a href="#">{{ $region->name."  (" .$region->countElevator($region->id). ")" }}</a></span>
				<ul>
					@foreach($towns as $town)
						@if($town->region_id == $region->id)
						<li><span><a href="#">{{ $town->name."  (" .$town->countElevator($town->id). ")" }}</a></span>
							<ul>
								@foreach($elevators as $elevator)
									@if($elevator->town_id == $town->id)
										<li>
										<span>
										<input name="elevators" type="checkbox" class="order-elevator" elevator-id="{{ $elevator->id }}" value="{{ in_array( $elevator->id, $elevator_order ) ? $elevator->id : '' }}" {{ in_array( $elevator->id, $elevator_order ) ? 'checked' : '' }}/>&nbsp;&nbsp;{{ $elevator->title }}
										</span>

										</li>
										

										
										
									@endif
								@endforeach
							</ul>
						</li>
						@endif
					@endforeach
				</ul>
			</li>
		@endforeach	
	
	</ul>
	
	
		           
</div>

@push('scripts')
<script>
$(document).ready(function() {
     
    $( "#all-fav-elevators" ).change(function( event ) {    	
        if( $(this).prop("checked") ) {
			$('.fav-elevators').each(function() {
				$(this).prop('checked', true);
				var elevator_id = $(this).attr('elevator-id');
				$("#order-elevators").append('<input name="elevators[]" value="' + elevator_id + '">');
			}); 
		} else {
			$('.fav-elevators').each(function() {
				$(this).prop('checked', false);
				var elevator_id = $(this).attr('elevator-id');
				$('#order-elevators').children('[value = "' + elevator_id + '" ]').remove() ;
				
			});
		}
    });
    
    $( ".order-elevator" ).change(function( event ) {    	
        var elevator_id = $(this).attr('elevator-id');        
        if( $(this).prop("checked") ) {
			 {{-- // если чекнутый то добавляем в избранные --}}
			 $("#order-elevators").append('<input name="elevators[]" value="' + elevator_id + '">');
		} else {
			$('#order-elevators').children('[value = "' + elevator_id + '" ]').remove() ;
		}
    });
});
</script>
@endpush