@extends('dashboard.template')

@section('content')
<h1 class="page-header">Пользователи</h1>

{{--
<div class="form-group">
	<form action="">
			<button type="submit" class="btn btn-primary btn-block">
				<i class="fa fa-plus"></i> Добавить пользователя
			</button>
	</form>
</div>

  
@if(Session::has('message'))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	{{Session::get('message')}}
</div>
@endif
  --}}
  
<table class="table table-striped">
	<thead>
		<tr>
			<th>Имя пользователя</th>
			<th>Email</th>
			<th class="col-md-4" colspan="3"></th>
		</tr>
	</thead>
	<tbody>
		@foreach($viewdata as $user)
		<tr>
			<td>{{ $user->name }}</td>
			<td>{{ $user->email }}</td>            
			<td>
				<form action="">
                	<button type="submit" class="btn btn-info"><i class="fa fa-eye"></i></button>
                </form>
			</td> 
			
			<td>
				<form action="">
                	<button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                </form>
			</td> 
			
			<td>
				<form action="">
                	<button type="submit" class="btn btn-danger"><i class="fa fa-remove"></i></button>
                </form>
			</td>            
		</tr>
		@endforeach
	</tbody>
</table>

@endsection