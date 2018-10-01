@extends('layouts.template')

@section('content')

<section class="section bg-white text-center">



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
	                                <div class="col-xs-4">
	                                	{{ date('d.m.Y',strtotime($order->created_at)) }}
	                                </div>
	                                <div class="col-xs-5">
	                                	@if(Auth::check() && Auth::user()->id == $order->user_id)
		                                    	Ваша заявка
		                                @else
		                                	@if($order->active == 0)
		                                		<span style="color: #a94442;"><b class="text-closed-order">Заявка закрыта</b></span>
		                                	@endif
		                                @endif
	                                </div> 
	                                <div class="col-xs-3 text-left">
	                                	<span id="views_{{ $order->id }}" class="fa fa-eye views_order">&nbsp;{{ $order->views }}</span> 
	                                	
	                                </div>
                                </div>
                                 <div class="row">
	                                <div class="col-xs-12">
	                                	<a class="toogle-order-detailed" href="/api/views_order/{{ $order->id }}" order-id={{ $order->id }}>{{ 'Куплю '.$order->corn['name'] }}, {{ $order->count . ' тонн' }}</a>
	                                <div class="order-detailed toogle-off">
                                		<ul>
                                			<li><u>Цена:</u>
                                				{{ Auth::check() ? $order->price : '*******' }} тенге
                                			</li>
                                			<li><u>Упаковка:</u> {{ $packs->find($order->pack_id ? $order->pack_id : '1')->name }}</li>
                                			<li>{{ $loadprices->find($order->loadprice_id ? $order->loadprice_id : '1')->name }}, {{ $order->auction ? 'Торг' : 'Без торга' }}</li>
                                			
                                			@if($order->elevators->count() > 0)
	                                			<li><u>Элеваторы:</u>
	                                				@foreach($order->elevators as $elevator)
	                                					{{ $elevator->title }};
	                                				@endforeach
	                                			</li>
                                			@endif
                                			<li><u>Подробные параметры</u> </li>
                                			@if($order->sort_standart or $order->sort_other or $order->sort_gost1 or $order->sort_gost2)
	                                		<li>
	                                			&nbsp;&nbsp;&bull;Класс или сорт продукции: 
	                                			@foreach($order->gosts as $gost)
	                                				{{ $gost['name'] . ';' }} 
	                                			@endforeach
                                			</li>
                                			@endif
                                			@if($order->agreement or $order->rewrite )
                                			<li>
                                			&nbsp;&nbsp;&bull;Условия оплаты продукции: 
                                			{{ $order->agreement ? 'Договорные ;' : '' }} 
                                			{{ $order->rewrite  ? 'По факту переписки;' : '' }}
                                			</li>
                                			@endif
                                			@if($order->notice )
                                			<li>
                                			&nbsp;&nbsp;&bull;Комментарий: 
                                			{{ $order->notice }} 
                                			</li>
                                			@endif
                                			@if($order->active)
	                                			<li>Разместил пользователь</li>
	                                			@if(  $order->user->name )
	                                			<li>&nbsp;&nbsp;&bull;Имя: 
	                                				{{ Auth::check() ? $order->user->name : '*******' }}
	                                			</li>
	                                			@endif
	                                			@if( $order->user->email )
	                                			<li>&nbsp;&nbsp;&bull;E-mail: 
	                                				<a href="mailto:{{ Auth::check() ? $order->user->email : '#' }}">
	                                					{{ Auth::check() ? $order->user->email : '*******' }}
	                                				</a>
	                                			</li>
	                                			@endif
	                                			@if(  $order->user->phone )
	                                				<li>&nbsp;&nbsp;&bull;Телефон: 
	                                					{{ Auth::check() ? $order->user->phone : '*******' }}	                                					
	                                				</li>
	                                			@endif
	                                			@if( $order->user->whatsapp )
	                                			<li>&nbsp;&nbsp;&bull;WhatsApp: 
	                                				<a href="https://wa.me/{{  Auth::check() ? Func::phoneOnlyNumber($order->user->whatsapp): '111' }}">{{ Auth::check() ? $order->user->whatsapp : '*******' }}</a>
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
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Завершить заявку</h4>
      </div>
      <!-- Основное содержимое модального окна -->
      <div class="modal-body modal-order-content">
        Вы действительно хотитите завершить заявку ?
      </div>
      <!-- Футер модального окна -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Нет</button>
        <button type="button" name="" class="btn btn-primary yes-close-modal" data-dismiss="modal">Да</button>
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

@push('scripts')
<script src="{{ asset('js/project.scripts.js') }}"></script>

<script>
$(document).ready(function() {
	$('#close-order-modal').on('show.bs.modal', function(e) {
	    
	    var $modal = $(this),
	        orderName = e.relatedTarget.name;
	        orderId = e.relatedTarget.id;
	            $modal.find('.modal-order-content').html(orderName);
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