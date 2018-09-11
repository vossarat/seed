@extends('layouts.template')

@section('tableprice')
    @include('layouts.tableprice')
@endsection


@section('content')



<section class="section bg-white text-center">



    <div class="shell">

        <h3>
            Карта элеваторов
        </h3>
        
        <div class="range range-xs-center">           
        	@include('elevator.filter')
        </div>{{-- /range range-xs-center --}}
        
        <div class="range range-xs-center">
            <div class="cell-xs-12">

                <div class="table-custom-responsive">
                    <table class="table-custom table-custom-striped table-custom-primary">
                        <thead>
                            <tr>
                                @if(Auth::check())
                                <th>
                                    Изб.
                                </th>
                                @endif
                                <th>
                                    Наименование элеватора
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($viewdata as $elevator)
                            <tr>
                                @if(Auth::check())
                                <td>
                                    <input type="checkbox" class="fav" id="fav-{{ $elevator->id }}" {{ $elevator->fav }}/>
                                </td>
                                @endif
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
{!! $viewdata->appends([
		'filter' => 'filter',		
		'arrcorns' => $selected_corns,		
		'filterByPriceMin' => $filterByPriceMin,		
		'filterByPriceMax' => $filterByPriceMax,		
	])->links() !!}
</div>
</section>

@push('scripts')
<script src="{{ asset('js/project.scripts.js') }}"></script>
<script>
$(document).ready(function() {
        $( ".fav" ).change(function( event ) {
                var elevator_id = $(this).attr('id').substring(4);
                {{-- // по умолчанию удалить из избранных --}}
                var url_action = "/api/fav/remove/"+{{ Auth::id() }}+"/"+elevator_id ; 
                if( $(this).prop("checked") ) {
					 {{-- // если чекнутый то добавляем в избранные --}}
					 url_action = "/api/fav/add/"+{{ Auth::id() }}+"/"+elevator_id ;
				}
				console.log( 'url_action = '+url_action );
                $.ajax({
                        url: url_action,
                    });
            });
    });
</script>
@endpush	

@endsection