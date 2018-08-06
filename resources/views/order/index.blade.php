@extends('layouts.template')

@section('content')



<section class="section bg-white text-center">



    <div class="shell">

        <div class="range range-xs-center range-md-left">
            <div class="cell-xs-12 cell-md-4">

                <form action="{{ route('order.create') }}">
                    <button type="submit" class="button button-effect-ujarak button-block button-default-outline">
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

        <div class="range range-xs-center">
            <div class="cell-xs-12">

                <div class="table-custom-responsive">
                    <table class="table-custom table-custom-striped table-custom-primary">
                        <thead>
                            <tr>
                                <th>
                                    Дата
                                </th>
                                <th>
                                    Наименование заявки
                                </th>
                                <th>
                                    Объем
                                </th>
                                <th>
                                    Цена
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($viewdata as $order)
                            <tr>
                                <td>
                                    {{ date('d.m.Y',strtotime($order->created_at)) }}
                                </td>
                                <td>
                                	@if(Auth::check())
	                                	@if(Auth::user()->id == $order->user_id)
	                                    	Ваша заявка
	                                    	<p>
	                                    	<a href="{{route('order.edit', $order->id)}}">{{ 'Заявка на '.$order->corn['name'] }}</a>
	                                    	</p>
	                                    @else
	                                    	<a href="{{route('order.show', $order->id)}}">{{ 'Заявка на '.$order->corn['name'] }}</a>
	                                	@endif 
	                                @else
	                                   	<a href="{{route('order.show', $order->id)}}">{{ 'Заявка на '.$order->corn['name'] }}</a>
	                                @endif
                                </td>
                                <td>
                                    {{ $order->count . ' тонн' }}
                                </td>
                                <td>
                                    {{ $order->price }}
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
</section>

<div class="range range-xs-center">
{{ $viewdata->appends([
		'filterByTitle' => isset($filterByTitle) ? $filterByTitle :'',
		'filter' => 'filter',
	])->links() }}
</div>
@endsection