@extends('layouts.template')

@section('content')

	<h1 class="page-header">Просмотр заявки</h1>

	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"> {{-- заголовок окна --}}
			.
				<a href="{{ route('order.index') }}" class="close" data-dismiss="alert" aria-hidden="true">&times;</a> {{-- х закрыть --}}
			</div>

			<div class="panel-body">
				<form class="form-horizontal" role="form"">
					{{ csrf_field() }}

					@include('order.form')

					<div class="form-group">
						<div class="col-xs-12">
							<a href="{{ route('order.index') }}" class="btn btn-info btn-block" data-dismiss="alert" aria-hidden="true">Ок</a>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>

@endsection