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
                        			<li>&nbsp;&nbsp;&bull;E-mail: {{ $elevator->email }}</li>
                        			@endif
                        			@if($elevator->phone)
                        				<li>&nbsp;&nbsp;&bull;Телефон: {{ $elevator->phone }}</li>
                        			@endif
                        			@if($elevator->whatssapp)
                        				<li>&nbsp;&nbsp;&bull;WhatsApp: {{ $elevator->whatssapp }}</li>
                        			@endif
                        		@if($elevator->attributes->count() > 0)
	                    			<li><u>Услуги:</u>                    				
	                    				@foreach($elevator->attributes as $attribute)
	                    					@if($attribute->pivot->attr_value != '')
	                    					{{ $attribute->name }} - {{ $attribute->pivot->attr_value }};
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
    
</div>
</section>

<section id="more-elevator" class="section bg-white text-center"></section>

<section class="section bg-white text-center hidden">
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