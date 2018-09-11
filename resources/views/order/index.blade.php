@extends('layouts.template')

@section('tableprice')
    @include('layouts.tableprice')
@endsection

@section('content')



<section class="section bg-white text-center">



    <div class="shell">

        <div class="range range-xs-center range-md-left">
            <div class="cell-xs-12 cell-md-4">

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
                            <div class="row order-table-row">

                                <div class="row">
	                                <div class="col-xs-3 col-xs-offset-9 text-right">
	                                	<span class="fa fa-eye"></span> 
	                                	<span id="views_{{ $order->id }}" class="views_order">{{ $order->views }}</span>
	                                </div>
                                </div>
                                
                                <div class="row">
	                                <div class="col-xs-6">
	                                	{{ date('d.m.Y',strtotime($order->created_at)) }}
	                                </div>
	                                <div class="col-xs-6">
	                                	{{ $order->price }} тенге
	                                </div>
                                </div>
                                 <div class="row">
	                                <div class="col-xs-12">
	                                	@if(Auth::check() && Auth::user()->id == $order->user_id)
		                                    	Ваша заявка</br>
		                                @endif	                                    	
	                                	<a class="toogle-order-detailed" href="/api/views_order/{{ $order->id }}" order-id={{ $order->id }}>{{ 'Заявка на '.$order->corn['name'] }}, {{ $order->count . ' тонн' }}</a>
	                                <div class="order-detailed">
                                		<ul>
                                			<li><u>Упаковка:</u> {{ $packs->find($order->pack_id ? $order->pack_id : '1')->name }}</li>
                                			<li>{{ $loadprices->find($order->loadprice_id ? $order->loadprice_id : '1')->name }}, {{ $order->auction ? 'Торг' : 'Без торга' }}</li>
                                			
                                			<li><u>Элеваторы:</u>
                                				@foreach($order->elevators as $elevator)
                                					{{ $elevator->title }};
                                				@endforeach
                                			</li>
                                			<li><u>Подробные параметры</u> </li>
                                			<li>
                                			&nbsp;&nbsp;&bull;Класс или сорт продукции: 
                                			{{ $order->sort_standart ? 'Стандарт;' : '' }} 
                                			{{ $order->sort_other ? 'Другое;' : '' }}
                                			{{ $order->sort_gost1 ? 'Гост 1;' : '' }}
                                			{{ $order->sort_gost2 ? 'Гост 2;' : '' }}
                                			</li>
                                			<li>
                                			&nbsp;&nbsp;&bull;Условия оплаты продукции: 
                                			{{ $order->agreement ? 'Договорные ;' : '' }} 
                                			{{ $order->rewrite  ? 'По факту переписки;' : '' }}
                                			{{ $order->rewrite  ? 'По факту переписки;' : '' }}
                                			</li>
                                			<li>
                                			&nbsp;&nbsp;&bull;Комментарий: 
                                			{{ $order->notice }} 
                                			</li>
                                			<li>Разместил пользователь</li>
                                			
                                			<li>&nbsp;&nbsp;&bull;Имя: {{ $order->user->name }}</li>
                                			<li>&nbsp;&nbsp;&bull;E-mail: {{ $order->user->email }}</li>
                                			<li>&nbsp;&nbsp;&bull;Телефон: {{ $order->user->phone }}</li>
                                			<li>&nbsp;&nbsp;&bull;WhatsApp: {{ $order->user->whatssapp }}</li>
                                		</ul>
                                	</div>
	                                </div>
                                </div>
                                
                            </div>
                            @endforeach


               <!-- <div class="divider-edgewise"></div>-->
            </div>
        
            
        
    </div>
</section>

<div class="range range-xs-center">
{{ $viewdata->appends([
		'filter' => $filter ? 'filter' : '',		
		'arrcorns' => $selected_corns,
		'filterByPriceMin' => $filterByPriceMin,		
		'filterByPriceMax' => $filterByPriceMax,		
		'filterByRegion' => $filterByRegion,		
	])->links() }}
</div>

@push('scripts')
<script src="{{ asset('js/project.scripts.js') }}"></script>
@endpush

@endsection