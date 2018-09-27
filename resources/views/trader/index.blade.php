@extends('layouts.template')

@section('content')
<h1 class="page-header">Трейдеры</h1>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Наименование трейдера</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($viewdata as $trader)
		<tr>
			<td>{{ $trader->name }}</td>            
			<td>
				<form action="{{ route('trader.edit', $trader->id) }}">
                	<button type="submit" class="btn-action"><i class="fa fa-edit"></i></button>
                </form>
			</td> 
      
		</tr>
		@endforeach
	</tbody>
</table>

@endsection