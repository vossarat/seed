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
    
   
    <div class="row-filter">
        
        @include('elevator.filter')
        	
    </div>
    
    
    <div class="order-table">

            @foreach($viewdata as $elevator)
            <div class="row order-table-row">
            	<div class="row">
                    <div class="col-xs-2 col-fav-elevator">
                    	{{-- 
                    	$elevator->fav - возращает звезду
                    	закрашенную или нет в зависимости от того избран или нет пользователь
                    	 --}}
                    	@if(Auth::check())
                    		<span id="fav-{{ $elevator->id }}" class="fav {{ $elevator->fav }}"></span>
                    	@endif 
                    </div>
                    <div class="col-xs-5 text-left">
                    		{{ mb_strlen($elevator->region_name, 'utf-8') > 18 ? mb_substr($elevator->region_name, 0, 15).'...' : $elevator->region_name }}
                    </div>
                    <div class="col-xs-5">
                    	{{ round($elevator->price,0) }} тг/т
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12">
                    	<a class="toogle-order-detailed" href="#">
                    		{{ $elevator->title }}
                    	</a>
                    	<div class="order-detailed">
                    		<ul>
                    			@if($elevator->corns->count() > 0)
	                    			<li><u>Принимает культуры:</u>                    				
	                    				@foreach($elevator->corns as $corn)
	                    					{{ $corn->name }};
	                    				@endforeach	                    			
	                    			</li>
                    			@endif
                    			<li><u>Контактные данные</u></li>                                			
                        			@if($elevator->username)
                        				<li>&nbsp;&nbsp;&bull;Контактное лицо : {{ $elevator->username }}</li>
                        			@endif
                        			@if($elevator->email)
                        			<li>&nbsp;&nbsp;&bull;E-mail: {{ $elevator->email }}</li>
                        			@endif
                        			@if($elevator->phone)
                        				<li>&nbsp;&nbsp;&bull;Телефон: {{ $elevator->phone }}</li>
                        			@endif
                        			@if($elevator->whatssapp)
                        				<li>&nbsp;&nbsp;&bull;WhatsApp: {{ $elevator->whatssapp }}</li>
                        			@endif

                    		</ul>
                    	</div>
                    </div>
                </div>
            </div>
            @endforeach            

    </div>      
    
</div>
</section>

<section class="section bg-white text-center">
{{ $viewdata->appends([
		'filter' => $filter ? 'filter' : '',		
		'arrcorns' => $selected_corns,		
		'filterByPriceMin' => $filterByPriceMin,		
		'filterByPriceMax' => $filterByPriceMax,		
	])->links() }}
</section>

@push('scripts')
<script src="{{ asset('js/project.scripts.js') }}"></script>
<script>
$(document).ready(function() {
        /*$( ".fav" ).change(function( event ) {
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
            });*/
            
        $( ".fav" ).click(function( event ) {
                var elevator_id = $(this).attr('id').substring(4);
                console.log( 'elevator_id = '+elevator_id );
                {{-- // по умолчанию удалить из избранных --}}
                var url_action = "/api/fav/remove/"+{{ Auth::id() }}+"/"+elevator_id ; 
                if( $(this).hasClass("fa-star-o") ) {
					 {{-- // если звезда не закрашена то добавляем в избранные --}}
					 url_action = "/api/fav/add/"+{{ Auth::id() }}+"/"+elevator_id ;
					 $(this).removeClass("fa-star-o");
					 $(this).addClass("fa-star"); // ставим избранное
				} else {
					$(this).removeClass("fa-star"); // убираем избранное
					$(this).addClass("fa-star-o");
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