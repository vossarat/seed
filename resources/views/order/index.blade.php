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
                                    Тест 1
                                </th>
                                <th>
                                    Тест 2
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($viewdata as $order)
                            <tr>
                                <td>
                                    19.07.2018
                                </td>
                                <td>
                                	@if(Auth::check())
	                                	@if(Auth::user()->id == $order->user_id)
	                                    	<a href="{{route('order.edit', $order->id)}}">{{ $order->title }}</a>
	                                    	<p>Ваша заявка</p>
	                                    @else
	                                    	<a href="{{route('order.show', $order->id)}}">{{ $order->title }}</a>
	                                	@endif 
	                                @else
	                                   	<a href="{{route('order.show', $order->id)}}">{{ $order->title }}</a>
	                                @endif
                                </td>
                                <td>
                                    -
                                </td>
                                <td>
                                    -
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