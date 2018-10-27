@extends('layouts.template')

@section('content')

<section class="section bg-white text-center index-order">



    <div class="shell">

        <div class="range range-xs-center range-md-left visible-xs">
            <div class="cell-xs-12">

                <form action="{{ route('order.create') }}">
                    <button type="submit" class="button button-effect-ujarak button-block button-primary">
                        Добавить заявку
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
            Заявки
        </h3>

        <div class="row-filter">
        
        	@include('order.filter')
        	
        </div>
        
                
          
           
            <div class="order-table">
            

                            @foreach($viewdata as $order)
	                            @if(Auth::check() && Auth::user()->id == 1)
	                            <div class="row">
	                            	
	                            	<form action="{{ route('order.destroy', $order->id) }}" method="POST">
									<input type="hidden" name="_method" value="DELETE">
									{{ csrf_field() }}
					                	<button type="submit" class="btn btn-danger">удалить</button>
					                </form>
	                            	
	                            	
	                            </div>
	                            @endif
                            <div class="row order-table-row {{ $order->active ? '' : 'closed'}}" id="row-order-{{ $order->id }}">
                                @if(Auth::check() && Auth::user()->id == $order->user_id)
                                <div class="row">
	                                <div class="col-xs-6">
	                                	<a href="{{ route('order.edit', $order->id ) }}">Редактировать</a>
	                                </div>
	                                <div class="col-xs-6">
	                                	@if($order->active)
	                                	<a href="#close-order-modal" id="{{ $order->id }}" data-toggle="modal" data-backdrop="false" name = "{{ $order->corn['name'] }}, {{ $order->count . ' тонн' }}">Завершить</a>
	                                	@else
	                                	<span style="color: #a94442;"><b>Заявка завершена</b></span>
	                                	@endif
	                                	
	                                </div>
                                </div>
                                @endif
                                
                                <div class="row">
	                                <div class="col-xs-4 text-center" id="created_at_{{ $order->id }}">
	                                	{{ date('d.m.Y',strtotime($order->created_at)) }}
	                                </div>
	                                <div class="col-xs-4 text-center">
	                                	@if(Auth::check() && Auth::user()->id == $order->user_id)
		                                    	Ваша заявка
		                                @else
		                                	@if($order->active == 0)
		                                		<span style="color: #a94442;"><b class="text-closed-order">Заявка закрыта</b></span>
		                                	@endif
		                                @endif
	                                </div> 
	                                <div class="col-xs-4 text-center">
	                                	<span id="views_{{ $order->id }}" class="fa fa-eye views_order">&nbsp;{{ $order->views }}</span> 
	                                	
	                                </div>
                                </div>
                                 <div class="row">
	                                <div class="col-xs-12">
	                                	@if( $order->active )
	                                	<a class="toogle-order-detailed" href="/api/views_order/{{ $order->id }}" order-id={{ $order->id }}>{{ 'Куплю:'.$order->corn['name'] }}, {{ $order->count . ' тонн' }}</a>
	                                	@else
	                                	<a href="javascript:void(0);">{{ 'Куплю:'.$order->corn['name'] }}, {{ $order->count . ' тонн' }}</a>
	                                	@endif
	                                <div class="order-detailed toogle-off">
                                		<ul>
                                			<li><u>Цена:</u>
                                				@if( Auth::check() )
                                					{{ $order->price }} тенге, {{ $order->loadprice_id ? 'Цена с доставкой' : 'Цена с места' }}, {{ $order->auction ? 'Торг' : 'Без торга' }}
                                				@else
                                					<a href="/login">*******</a> тенге
                                				@endif
                                			</li>
                                			<li><u>Упаковка:</u> {{ $packs->find($order->pack_id ? $order->pack_id : '1')->name }}</li>
                                			
                                			
                                			@if($order->elevators->count() > 0)
	                                			<li><u>Элеваторы:</u>
	                                				@foreach($order->elevators as $elevator)
	                                					{{ $elevator->title }};
	                                				@endforeach
	                                			</li>
                                			@endif
                                			<li><u>Подробные параметры</u> </li>
                                			@if($order->gosts->count() > 0)
	                                		<li>
	                                			&nbsp;&nbsp;&bull;Качество: 
	                                			@foreach($order->gosts as $gost)
	                                				{{ $gost['name'] . ';' }} 
	                                			@endforeach
                                			</li>
                                			@endif
                                			@if($order->class_corn )
	                                			<li>
		                                			&nbsp;&nbsp;&bull;Класс: 
		                                			{{ $order->class_corn }} 
	                                			</li>
                                			@endif
                                			@if($order->notice )
	                                			<li>
		                                			&nbsp;&nbsp;&bull;Доп.параметры: 
		                                			{{ $order->notice }} 
	                                			</li>
                                			@endif
                                			{{--
                                			@if($order->agreement or $order->rewrite )
                                			<li>
                                			&nbsp;&nbsp;&bull;Условия оплаты продукции: 
                                			{{ $order->agreement ? 'Договорные ;' : '' }} 
                                			{{ $order->rewrite  ? 'По факту переписки;' : '' }}
                                			</li>
                                			@endif
                                			--}}
                                			
                                			@if($order->active)
	                                			<li><u>Разместил пользователь</u></li>
	                                			{{--
	                                			@if(  $order->user->name )
	                                			<li>&nbsp;&nbsp;&bull;Имя: 
	                                				@if( Auth::check() )
	                                				{{  $order->user->name }}
	                                				@else
                                						<a href="/login">*******</a>
                                					@endif
	                                			</li>
	                                			@endif
	                                			--}}
	                                			@if( $order->user->email )
	                                			<li>&nbsp;&nbsp;&bull;E-mail: 
	                                				@if( Auth::check() )
	                                				<a href="mailto:{{ $order->user->email }}">{{$order->user->email }}
	                                				</a>
	                                				@else
	                                					<a href="/login">*******</a>
	                                				@endif
	                                			</li>
	                                			@endif
	                                			@if(  $order->user->phone )
	                                				<li>&nbsp;&nbsp;&bull;Телефон: 
	                                					@if( Auth::check() )
	                                					{{ $order->user->phone }}
	                                					@else
	                                						<a href="/login">*******</a>
	                                					@endif
	                                				</li>
	                                			@endif
	                                			@if( $order->user->whatsapp )
	                                			<li>&nbsp;&nbsp;&bull;WhatsApp: 
	                                			@if( Auth::check() )
	                                				<a href="https://wa.me/{{Func::phoneOnlyNumber($order->user->whatsapp)}}">{{$order->user->whatsapp}}</a>
	                                				@else
	                                					<a href="/login">*******</a>
	                                				@endif
	                                				
	                                			</li>
	                                			@endif
                                			@endif
                                			
                                		</ul>
                                	</div>
	                                </div>
                                </div>
                                
                            </div>
                            @endforeach

            
            </div>
         
            
            <div id="more-order-list-2"></div>
            

            
        
    </div>

<!-- HTML-код модального окна -->
<div id="close-order-modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Заголовок модального окна -->
      <div class="modal-header">
        <h4 class="modal-title">Хотитите завершить заявку?</h4>
      </div>
      <!-- Основное содержимое модального окна -->
      <div class="modal-body modal-order-content">
        Вы действительно хотитите завершить заявку ?
      </div>
      <!-- Футер модального окна -->
      <div class="modal-footer row">        
        <button type="button" name="" class="btn btn-primary yes-close-modal col-xs-4 col-xs-offset-2" data-dismiss="modal">Завершить</button>
        <button type="button" class="btn btn-default col-xs-4 col-xs-offset-1" data-dismiss="modal">Отмена</button>
      </div>
    </div>
  </div>
</div>

</section>

<section id="more-order" class="section bg-white text-center"></section>

<section class="section bg-white text-center hidden">
{{ $viewdata->appends([
		'filter' => $filter ? 'filter' : '',		
		'arrcorns' => $selected_corns,
		'filterByPriceMin' => $filterByPriceMin,		
		'filterByPriceMax' => $filterByPriceMax,		
		'filterByRegion' => $filterByRegion,		
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
	$('#close-order-modal').on('show.bs.modal', function(e) {
	    
	    console.log( $('#views_' + e.relatedTarget.id ).text() );
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
	            				  'Куплю:' + orderName +
	            				'</div>'+
	            				'</div>';
	            //$modal.find('.modal-order-content').html( 'Куплю:' + orderName + '_' +orderViews + '_'+ orderCreateDate );
	            $modal.find('.modal-order-content').html( contentModal );
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
				$('#row-order-'+orderId).addClass('closed');
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
	$('#more-order').append( $('#more-next') ); 
	$('body').on('click', '#more-next', function(e) {
		e.preventDefault();
		var page = getLinkParameter('page', $( this ).attr('href') );
				
		$('#more-order-list-' + page).load( $( this ).attr('href') + ' .order-table' );
		
		$('.order-table').addClass("border-bottom-3px");
		var nextpage = parseInt(page) + 1;
		$('#more-order-list-' + page).after('<div id="more-order-list-' + nextpage + '"></div>');
		$('#more-order').load( $( this ).attr('href') + ' #more-next' ); 
	});
	
	
});
</script>

@endpush

@endsection