@extends('dashboard.template')

@section('content')
<h1 class="page-header">Элеваторы</h1>

<div class="form-group">
	<form action="{{ route('elevator.create') }}">

			<button type="submit" class="btn btn-primary">
				<i class="fa fa-plus"></i> Добавить
			</button>

	</form>
</div>

@if(Session::has('message'))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	{{Session::get('message')}}
</div>
@endif
  
<table id="viewtable" class="table table-striped">
	<thead>
		<tr>
			<th>Наименование элеватора</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($viewdata as $elevator)
		<tr>
			<td>{{ $elevator->title }}</td>
			<td>
				<form action="{{ route('elevator.edit', $elevator->id) }}">
                	<button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                </form>
			</td> 
			
			<td>
				<form action="{{ route('elevator.destroy', $elevator->id) }}" method="POST">
				<input type="hidden" name="_method" value="DELETE">
				{{ csrf_field() }}
                	<button type="submit" class="btn btn-danger"><i class="fa fa-remove"></i></button>
                </form>
			</td>            
		</tr>
		@endforeach
	</tbody>
</table>

@push('scripts')
<script>
$(document).ready(function() { 
	$('#viewtable').DataTable({
		"language": {
	        "sProcessing":    "Процесс...",
	        "sLengthMenu":    "Показать _MENU_ записей",
	        "sZeroRecords":   "Нет записей для отображения",
	        "sEmptyTable":    "Нет записей для отображения",
	        "sInfo":          "Показано с _START_ по _END_ из _TOTAL_ записей",
	        "sInfoEmpty":     "Нет записей для отображения",
	        "sInfoFiltered":  "",
	        "sInfoPostFix":   "",
	        "sSearch":        "Поиск:",
	        "sUrl":           "",
	        "sInfoThousands":  ",",
	        "sLoadingRecords": "Загрузка...",
	        "oPaginate": {
	            "sFirst":   "Первая",
	            "sLast":    "Последняя",
	            "sNext":    "След",
	            "sPrevious":"Пред"
	        },
    	},
    	"aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 1, 2 ] }
       ]
	}); 
} );
</script>
@endpush

@endsection