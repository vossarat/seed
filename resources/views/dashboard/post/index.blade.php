@extends('dashboard.template')

@section('content')
<h1 class="page-header">Новости</h1>

<div class="form-group">
	<form action="{{ route('post.create') }}">

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
  
<table class="table table-striped">
	<thead>
		<tr>
			<th>Заголовок</th>
			<th class="col-md-4" colspan="2"></th>
		</tr>
	</thead>
	<tbody>
		@foreach($viewdata as $post)
		<tr>
			<td>{{ $post->title }}</td>
			<td>
				<form action="{{ route('post.edit', $post->id) }}">
                	<button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                </form>
			</td> 
			
			<td>
				<form action="{{ route('post.destroy', $post->id) }}" method="POST">
				<input type="hidden" name="_method" value="DELETE">
				{{ csrf_field() }}
                	<button type="submit" class="btn btn-danger"><i class="fa fa-remove"></i></button>
                </form>
			</td>            
		</tr>
		@endforeach
	</tbody>
</table>

@endsection