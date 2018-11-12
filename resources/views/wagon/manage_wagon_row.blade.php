@extends('layouts.template')

@section('content')

<section class="section bg-white text-center index-order">



    <div class="shell">

        <div class="range range-xs-center range-md-left visible-xs">
            <div class="cell-xs-12">

                <form action="{{ route('wagon.create') }}">
                    <button type="submit" class="button button-effect-ujarak button-block button-primary">
                        Добавить заявку на вагоны
                    </button>
                </form>

            </div>
        </div>

		{{-- информационное сообщение --}}
		@if(Session::has('message'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			{{Session::get('message')}}
		</div>
		@endif
		{{-- /информационное сообщение --}}

        <h3>
            Заявки на вагоны
        </h3>

    	{{--
		
        <div class="row-filter">
        
        	@include('wagon.filter')
        	
        </div>
        --}}
                
          
           
		   
            <div class="wagon-table">
            

                            @foreach($viewdata as $wagon)
	                            @if(Auth::check() && Auth::user()->id == 1)
	                            <div class="row">
	                            	
	                            	<form action="{{ route('wagon.destroy', $wagon->id) }}" method="POST">
									<input type="hidden" name="_method" value="DELETE">
									{{ csrf_field() }}
					                	<button type="submit" class="btn btn-danger">удалить</button>
					                </form>
	                            	
	                            	
	                            </div>
	                            @endif
                            <div class="row wagon-table-row {{ $wagon->active ? '' : 'closed'}}" id="row-wagon-{{ $wagon->id }}">
                                @if(Auth::check() && Auth::user()->id == $wagon->user_id)
                                <div class="row">
	                                <div class="col-xs-6">
	                                	<a href="{{ route('wagon.edit', $wagon->id ) }}">Редактировать</a>
	                                </div>
	                                <div class="col-xs-6">
	                                	@if($wagon->active)
	                                	<a href="#close-wagon-modal" id="{{ $wagon->id }}" data-toggle="modal" data-backdrop="false" name = "{{ $wagon->corn['name'] }}, {{ $wagon->count . ' тонн' }}">Завершить</a>
	                                	@else
	                                	<span style="color: #a94442;"><b>Заявка завершена</b></span>
	                                	@endif
	                                	
	                                </div>
                                </div>
                                @endif
                                
                                <div class="row">
	                                <div class="col-xs-4 text-center" id="created_at_{{ $wagon->id }}">
	                                	{{ date('d.m.Y',strtotime($wagon->created_at)) }}
	                                </div>
	                                <div class="col-xs-4 text-center">
	                                	@if(Auth::check() && Auth::user()->id == $wagon->user_id)
		                                    	Ваша заявка
		                                @else
		                                	@if($wagon->active == 0)
		                                		<span style="color: #a94442;"><b class="text-closed-wagon">Заявка закрыта</b></span>
		                                	@endif
		                                @endif
	                                </div> 
	                                <div class="col-xs-4 text-center">
	                                	<span id="views_{{ $wagon->id }}" class="fa fa-eye views_order">&nbsp;{{ $wagon->views }}</span> 
	                                	
	                                </div>
                                </div>
                                 <div class="row">
	                                <div class="col-xs-12">
	                                	@if( $wagon->active )
	                                	<a class="toogle-order-detailed" href="/api/views_order/{{ $wagon->id }}" wagon-id={{ $wagon->id }}>{{ 'Перевезу:'.$wagon->corn['name'] }}, {{ $wagon->count . ' тонн' }}</a>
	                                	@else
	                                	<a href="javascript:void(0);">{{ 'Перевезу:'.$wagon->corn['name'] }}, {{ $wagon->count . ' тонн' }}</a>
	                                	@endif
	                                <div class="order-detailed toogle-off">
                                		<ul>
                                			<li><u>Цена:</u>
                                				@if( Auth::check() )
                                					{{ $wagon->price }} тенге, {{ $wagon->loadprice_id ? 'Цена с доставкой' : 'Цена с места' }}, {{ $wagon->auction ? 'Торг' : 'Без торга' }}
                                				@else
                                					<a href="/login">*******</a> тенге
                                				@endif
                                			</li>
                                			<li><u>Упаковка:</u> {{ $packs->find($wagon->pack_id ? $wagon->pack_id : '1')->name }}</li>
                                			
                                			
                                			
                                			<li><u>Подробные параметры</u> </li>
                                			
                                			{{-- информация о пользователе --}}
                                			@include('wagon.part_user_info') 
                                			
                                		</ul>
                                	</div>
	                                </div>
                                </div>
                                
                            </div>
                            @endforeach

            
            </div>
         
            
            <div id="more-wagon-list-2"></div>
            

            
        
    </div>

{{-- модальное окно для закрытия заявки по экспедиции --}}
@include('wagon.modal_close_wagon') 

</section>

<section id="more-wagon" class="section bg-white text-center"></section>

<section class="section bg-white text-center hidden">
{{ $viewdata->appends([
		'filter' => 'filter',
	])->links() }}
</section>

<section class="section bg-white text-center index-info">
<p>Zelenka. Trade - это уникальный автоматизированный портал, призванный помочь производителям, элеваторам и трейдерам в торговле зерновыми культурами.</p>
<p>С порталом Zelenka.Trade прибыль от Ваших сделок, не уйдет посредникам, Вам больше не придется осуществлять десятки телефонных звонков и тратить время на то, чтобы продать или приобрести зерновые культуры, с помощью данного портала Вы сможете не только расширить границы и возможности Вашего бизнеса, но  и сократить временной цикл сделки до 5 минут.</p>
</section>

@push('scripts')
<script src="{{ asset('js/project.scripts.js') }}"></script>

<script>
$(document).ready(function() {
	$('#close-wagon-modal').on('show.bs.modal', function(e) {
	    
	    var $modal = $(this),
	        orderName = e.relatedTarget.name;
	        orderId = e.relatedTarget.id;
	        orderViews = $('#views_'+orderId).text();
	        orderCreateDate = $('#created_at_'+orderId).text();
	        
	            contentModal = 	'<div class="row">'+
	            				'<div class="col-xs-6">'+
	            				  orderCreateDate+
	            				'</div>'+
	            				'<div class="col-xs-6">'+
	            				  '<span class="fa fa-eye views_order">'+ orderViews +'</span>' +
	            				'</div>'+
	            				'<div class="col-xs-12">'+
	            				  'Перевезу:' + orderName +
	            				'</div>'+
	            				'</div>';
	            //$modal.find('.modal-wagon-content').html( 'Перевезу:' + orderName + '_' +orderViews + '_'+ orderCreateDate );
	            $modal.find('.modal-wagon-content').html( contentModal );
	            $modal.find('.yes-close-modal').attr("name", orderId);
	    
	});
	
	$('.yes-close-modal').on('click', function(e) {
		orderId = $(this).attr("name");	    
		$.ajax({
		      cache: false,
		      type: 'GET',
		      url: '/api/closed_order/' + orderId,
		      success: function(data)
		      {
				$('#row-wagon-'+orderId).addClass('closed');
		      }
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
	$('#more-wagon').append( $('#more-next') ); 
	$('body').on('click', '#more-next', function(e) {
		e.preventDefault();
		var page = getLinkParameter('page', $( this ).attr('href') );
		
		console.log( 'page = ' + page );
				
		$('#more-wagon-list-' + page).load( $( this ).attr('href') + ' .wagon-table' );
		
		$('.wagon-table').addClass("border-bottom-3px");
		var nextpage = parseInt(page) + 1;
		$('#more-wagon-list-' + page).after('<div id="more-wagon-list-' + nextpage + '"></div>');
		$('#more-wagon').load( $( this ).attr('href') + ' #more-next' ); 
	});
	
	
});
</script>

@endpush

@endsection