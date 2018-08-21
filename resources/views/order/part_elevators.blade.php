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
										<span><input type="checkbox" class="order-elevator" id="order-elevator-{{ $elevator->id }}" {{ in_array( $elevator->id, $elevator_order ) ? 'checked' : '' }}/>
											&nbsp;&nbsp;{{ $elevator->title }}
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
        $( ".order-elevator" ).change(function( event ) {
                var elevator_id = $(this).attr('id').substring(15);
                {{-- // по умолчанию удалить из избранных --}}
                var url_action = "/api/order_to_elevator/remove/"+{{ $viewdata->id }}+"/"+elevator_id ; 
                if( $(this).prop("checked") ) {
					 {{-- // если чекнутый то добавляем в избранные --}}
					 url_action = "/api/order_to_elevator/add/"+{{ $viewdata->id }}+"/"+elevator_id ;
				}
				console.log( 'url_action = '+url_action );
                $.ajax({
                        url: url_action,
                    });
            });
    });
</script>
@endpush