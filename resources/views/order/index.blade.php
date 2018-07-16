@extends('layouts.template')

@section('content')
<h1 class="page-header">Заявки</h1>

<div class="form-group">
	<form action="{{ route('order.create') }}">
			<button type="submit" class="btn btn-primary">
				<i class="fa fa-plus"></i> Добавить заявку
			</button>
	</form>
</div>

@if(Session::has('message'))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	{{Session::get('message')}}
</div>
@endif

@include('order.filter') {{-- подключение формы для фильтрации данных --}}

<table class="table table-striped">
	<thead>
		<tr>
			<th>Номер</th>
			<th>Наименование</th>
			<th colspan="2"></th>
		</tr>
	</thead>
	<tbody>
		@foreach($viewdata as $order)
		<tr>
			<td>{{ $order->id }}</td>
			<td>{{ $order->title }}</td>            
			<td>
				
			@if( Auth::check() )
				@if($order->user_id == Auth::user()->id)
					<form action="{{ route('order.edit', $order->id) }}">
	                	<button type="submit" class="btn btn-success"><i class="fa fa-edit"></i></button>
	                </form>
            	@else
            		<form action="{{ route('order.show', $order->id) }}">
	                	<button type="submit" class="btn btn-info"><i class="fa fa-eye"></i></button>
	                </form>
            	@endif
            @else
            	<form action="{{ route('order.show', $order->id) }}">
                	<button type="submit" class="btn btn-info"><i class="fa fa-eye"></i></button>
                </form>
            @endif
			</td> 
			
			<td>
			@if( Auth::check() )
				@if($order->user_id == Auth::user()->id)
					<form action="{{ route('order.destroy', $order->id) }}" method="POST">
	                    <input type="hidden" name="_method" value="DELETE">
	                    {{ csrf_field() }}
	                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
	                </form>
	            @endif
            @endif
			</td>            
		</tr>
		@endforeach
	</tbody>
</table>

{{ $viewdata->appends([
		'filterByTitle' => isset($filterByTitle) ? $filterByTitle :'',
		'filter' => 'filter',
	])->links() }}

@endsection