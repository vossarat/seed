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
	
		@foreach($states as $state)
		<li><span><a href="#">{{ $state->name . "  (" .$state->countElevator($state->id). ")" }}</a></span>
		<ul>
			@foreach($regions as $region)
			@if($region->state_id == $state->id)
				<li><span><a href="#">{{ $region->name."  (" .$region->countElevator($region->id). ")" }}</a></span>
					<ul>
						@foreach($elevators as $elevator)
							@if($elevator->region_id == $region->id)
								<li>
								<span>
								<span class="link-elevator" elevator-id="{{ $elevator->id }}">&nbsp;&nbsp;{{ $elevator->title }}
										</span>
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
    
    $('body').on('click', '.link-elevator', function(){
		console.log('link-elevator');
		var elevator_id = $(this).attr('elevator-id');
		var api = $("#menu-elevator").data( "mmenu" );
		$('#elevator_id').val( elevator_id );
		$('#lbl-elevator-name').text( $(this).text() );
		api.close();
	});
    
});
</script>
@endpush