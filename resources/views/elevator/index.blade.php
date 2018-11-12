@extends('layouts.template-100')

@section('tableprice')
    @include('layouts.tableprice')
@endsection


@section('content')



<section class="section bg-white text-center">

<div class="shell">
<div class = "row">
<div class = "col-xs-12 col-sm-8">

	    <h2>
	        Элеваторы
	    </h2>
	    
	   
	    <div class="row-filter visible-xs">	        
	        <div class="row">		    	
				<div class="col-xs-6">		    	
				@if($filter)
					<a href="{{ route('mapelevator') }}" class="button button-effect-ujarak button-block button-default-outline button-filter">
			        	Очистить Фильтр
			        </a>
			    @else			    	
			        <a class="button button-effect-ujarak button-block button-default-outline toogle-elevator-filter button-filter">
			        	Фильтр
			        </a>
			    @endif		
				</div>
				
				{{--
				<div class="col-xs-6">
					@if($fav)
						<a class="button button-effect-ujarak button-block button-default-outline button-filter" href="/mapelevator">Все</a>
					@else
						<a class="button button-effect-ujarak button-block button-default-outline button-filter" href="/mapelevator/fav">Избранные</a>
			        @endif
					
				</div>
				--}}
			</div>	        	
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
	                    		{{ mb_strlen($elevator->region->name, 'utf-8') > 18 ? mb_substr($elevator->region->name, 0, 15).'...' : $elevator->region->name }}
	                    </div>
	                    <div class="col-xs-5">
	                    	{{ $elevator->price }}
	                    </div>
	                </div>
	                
	                <div class="row">
	                    <div class="col-xs-12">
	                    	<a class="toogle-order-detailed" href="#">
	                    		{{ $elevator->title }}
	                    	</a>
	                    	<div class="order-detailed toogle-off">
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
	                        			<li>&nbsp;&nbsp;&bull;E-mail: <a href="mailto:{{  $elevator->email }}">{{ $elevator->email }}</a></li>
	                        			@endif
	                        			@if($elevator->phone)
	                        				<li>&nbsp;&nbsp;&bull;Телефон:<a href="tel:+{{Func::phoneOnlyNumber($elevator->phone)}}"> {{ $elevator->phone }}</a></li>
	                        			@endif
	                        			@if($elevator->whatsapp)
	                        				<li>&nbsp;&nbsp;&bull;WhatsApp:<a href="https://wa.me/{{Func::phoneOnlyNumber($elevator->whatsapp)}}"> {{ $elevator->whatsapp }}</a></li>
	                        			@endif
	                        		@if($elevator->attributes->count() > 0)
		                    			<li><u>Услуги:</u>                    				
		                    				@foreach($elevator->attributes as $attribute)
		                    					@if($attribute->pivot->attr_value != '')
		                    					{{ $attribute->name }} - {{ $attribute->pivot->attr_value }}</br>
		                    					@endif
		                    				@endforeach	                    			
		                    			</li>
	                    			@endif

	                    		</ul>
	                    	</div>
	                    </div>
	                </div>
	            </div>
	            @endforeach            

	    </div>
	    
	    <div id="more-elevator-list-2"></div>
	    <section id="more-elevator" class="section bg-white text-center">      
  
</div> {{-- <div class = "col-xs-12 col-sm-8"> --}}

<div class = "col-sm-4 hidden-xs">
	<div class="row-filter">
	        
	        @include('elevator.filter')
	        	
	    </div>
</div>

</div> {{-- <div class = "row"> --}}
</div> {{-- <div class="shell"> --}}

</section> 

{{--

<div class = "row">
    <div class = "col-xs-12 col-sm-8">
        <section id="more-elevator" class="section bg-white text-center">
        </section>
    </div>
</div>
--}}

<section class="section bg-white text-center hidden">
    <div class = "row">
        <div class = "col-xs-12 col-sm-8 col-sm-offset-2">
            {{ $viewdata->appends([
            'filter' => $filter ? 'filter' : '',
            'arrcorns' => $selected_corns,
            'filterByPriceMin' => $filterByPriceMin,
            'filterByPriceMax' => $filterByPriceMax,
            'filterByState' => $filterByState,
            ])->links() }}
        </div>
    </div>
</section>

@push('scripts')
<script src="{{ asset('js/project.scripts.js') }}"></script>
<script>
$(document).ready(function() {
            
        $( ".fav" ).click(function( event ) {
                var elevator_id = $(this).attr('id').substring(4);
                console.log( 'elevator_id = '+elevator_id );
                {{-- // по умолчанию удалить из избранных --}}
                var url_action = "/api/fav/remove/"+{{ Auth::id() ?  Auth::id() : 0 }}+"/"+elevator_id ; 
                if( $(this).hasClass("fa-star-o") ) {
					 {{-- // если звезда не закрашена то добавляем в избранные --}}
					 url_action = "/api/fav/add/"+{{ Auth::id() ?  Auth::id() : 0 }}+"/"+elevator_id ;
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
            
        // парсим строку адрса ссылки чтоб получить номер страницы
		var getLinkParameter = function getLinkParameter(sParam, link) {
			    var sPageURL = decodeURIComponent( link ),
			        sURLVariables = sPageURL.split('&'),
			        sParameterName,
			        i;

			    for (i = 0; i < sURLVariables.length; i++) {
			        sParameterName = sURLVariables[i].split('=');

			        if (sParameterName[0] === sParam) {
			            return sParameterName[1] === undefined ? true : sParameterName[1];
			        }
			    }
			};
		
		{{-- на див показать еще вешаем ссылку следующей cтраницы --}}
		$('#more-elevator').append( $('#more-next') ); 
		$('body').on('click', '#more-next', function(e) {
			e.preventDefault();
			var page = getLinkParameter('page', $( this ).attr('href') );
					
			$('#more-elevator-list-' + page).load( $( this ).attr('href') + ' .order-table' );
			
			$('.order-table').addClass("border-bottom-3px");
			var nextpage = parseInt(page) + 1;
			$('#more-elevator-list-' + page).after('<div id="more-elevator-list-' + nextpage + '"></div>');
			$('#more-elevator').load( $( this ).attr('href') + ' #more-next' ); 
		});
});
</script>
@endpush	

@endsection