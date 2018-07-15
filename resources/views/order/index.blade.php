@extends('layouts.template')

@section('content')
<h1 class="page-header">Заявки</h1>

<div class="form-group">
	<form action="{{ route('order.create') }}">
			<button type="submit" class="btn btn-primary btn-block">
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

<table class="table table-striped">
	<thead>
		<tr>
			<th>Номер</th>
			<th>Наименование</th>
			<th class="col-sm-2" colspan="3"></th>
		</tr>
	</thead>
	<tbody>
		@foreach($viewdata as $order)
		<tr>
			<td>{{ $order->id }}</td>
			<td>{{ $order->title }}</td>            
			<td>
				<form action="{{ route('order.show', $order->id) }}">
                	<button type="submit" class="btn btn-info"><i class="fa fa-eye"></i></button>
                </form>
			</td> 
			
			<td>
			@if( Auth::check() )
				@if($order->user_id == Auth::user()->id)
					<form action="{{ route('order.edit', $order->id) }}">
	                	<button type="submit" class="btn btn-success"><i class="fa fa-edit"></i></button>
	                </form>
            	@endif
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

@endsection