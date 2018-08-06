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
			<li><span><a href="#">{{ $region->name }}</a></span>
				<ul>
					@foreach($towns as $town)
						@if($town->region_id == $region->id)
						<li><span><a href="#">{{ $town->name }}</a></span>
							<ul>
								@foreach($elevators as $elevator)
									@if($elevator->town_id == $town->id)
										<li><span><input type="checkbox">&nbsp;&nbsp;{{ $elevator->title }}</span></li>
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