{{-- указать подробные параметры --}}

{{-- Предварительно заполним форму значениями выбранных элеваторов для сохранения  --}}

@foreach($regions as $region)
@foreach($towns as $town)
@foreach($elevators as $elevator)
	@if($elevator->town_id == $town->id)
		<input type="hidden" name="elevators[]" value="{{ $elevator->id }}" {{ in_array($elevator->id, $elevator_order) ? 'checked' : '' }}>		
	@endif
@endforeach
@endforeach
@endforeach

{{-- /Предварительно заполним форму значениями выбранных элеваторов для сохранения  --}}

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
										<span><input type="checkbox" name="elevators[]" value="{{ $elevator->id }}" {{ in_array($elevator->id, $elevator_order) ? 'checked' : '' }}>
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