@extends('dashboard.template')

@section('content')

	<h1 class="page-header">Элеваторы</h1>

	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"> {{-- заголовок окна --}}
				Редактировать элеватор
				<a href="{{ route('elevator.index') }}" class="close" data-dismiss="alert" aria-hidden="true">&times;</a> {{-- х закрыть --}}
			</div>

			<div class="panel-body">
				<form class="form-horizontal" role="form" method="POST" action="{{ route('elevator.update', $viewdata->id) }}">
					{{ csrf_field() }}
					
					<input type="hidden" name="id" value="{{ $viewdata->id }}">
                	<input type="hidden" name="_method" value="put"/>

					@include('dashboard.elevator.form')

					<div class="form-group">
						<div class="col-xs-12">
							<button type="submit" class="btn btn-primary btn-block">
								Редактировать
							</button>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-xs-12">
							<a href="{{ route('elevator.index') }}" class="btn btn-warning btn-block" data-dismiss="alert" aria-hidden="true">Отмена</a>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>

@endsection