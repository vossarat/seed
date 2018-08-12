@extends('layouts.template')

@section('content')



<section class="section bg-white text-center">



    <div class="shell">

        <h3>
            Карта элеваторов
        </h3>

        
        
        <div class="range range-xs-center">
            
        <div class="form-group">
			<div class="col-xs-12">
				@if(isset($filterByRegion))
					<a href="{{ route('mapelevator') }}" class="button button-effect-ujarak button-block button-default-outline">
			        	Очистить Фильтр
			        </a>
			    @else			    	
			        <a class="button button-effect-ujarak button-block button-default-outline toogle-filter">
			        	Фильтр
			        </a>
			    @endif
			</div> 
		</div>
            
            <div id="elevator-filtre" class="cell-xs-12">           

                <div class="table-custom-responsive">
                    <table class="table-custom">
                        <tbody>
                            @if( isset($filterByRegion) )
                            	<tr>
	                                <td>
	                                	<a href=" {{ route('mapelevator').'?filterByState='.$regions->state_id.'&filter=filter&page=1' }} "><i class="fa fa-arrow-left"></i> {{ $regions->name."  (" .$regions->countElevator($regions->id). ")" }} </a>
	                                </td>
                                </tr>
                            
                            @elseif( isset($filterByState) )
                            	<tr>
	                                <td>
	                                	<a href=" {{ route('mapelevator').'?filterByState=&filter=filter&page=1' }} "><b> < </b> {{ $states->name."  (" .$states->countElevator($states->id). ")" }} </a>
	                                </td>
                                </tr>                     
                            
  	                            @foreach($regions as $region)
	                            <tr>
	                                <td>
	                                	<a href=" {{ route('mapelevator').'?filterByRegion='.$region->id.'&filter=filter&page=1' }} "> &nbsp; &nbsp; &nbsp;{{ $region->name."  (" .$region->countElevator($region->id). ")" }} <b> > </b></a>
	                                </td>
	                            </tr>
	                             @endforeach
                            
                            @else
	                            @foreach($states as $state)	                            
	                            <tr>
	                                <td>
	                                	<a href=" {{ route('mapelevator').'?filterByState='.$state->id.'&filter=filter&page=1' }} ">{{ $state->name."  (" .$state->countElevator($state->id). ")" }} <b> > </b> </a>
	                                </td>
	                            </tr>
	                            @endforeach
                            @endif 
                            
                        </tbody>

                    </table>
                </div>
            </div>
        
        </div>{{-- /range range-xs-center --}}
        
        <div class="range range-xs-center">
            <div class="cell-xs-12">

                <div class="table-custom-responsive">
                    <table class="table-custom table-custom-striped table-custom-primary">
                        <thead>
                            <tr>
                                <th>
                                    Изб.
                                </th>
                                <th>
                                    Наименование элеватора
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($viewdata as $elevator)
                            <tr>
                                <td>
                                    <input type="checkbox"/>
                                </td>
                                <td>
                                	{{ $elevator->title }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="divider-edgewise"></div>
            </div>
        </div>
    </div>
<div class="range range-xs-center">
{{ $viewdata->appends([
		'filterByState'  => isset($filterByState)  ? $filterByState  : '',
		'filterByRegion' => isset($filterByRegion) ? $filterByRegion : '',
		'filter' => 'filter',
	])->links() }}
</div>
</section>

@push('scripts')
<script src="{{ asset('js/project.scripts.js_') }}"></script>
@endpush	

@endsection