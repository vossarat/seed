@extends('dashboard.template')

@section('content')

	<h1 class="page-header">Атрибуты элеватора</h1>

	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"> {{-- заголовок окна --}}
				Добавить
				<a href="{{ route('attribute.index') }}" class="close" data-dismiss="alert" aria-hidden="true">&times;</a> {{-- х закрыть --}}
			</div>

			<div class="panel-body">
				<form class="form-horizontal" role="form" method="POST" action="{{ route('attribute.store') }}">
					{{ csrf_field() }}

					@include('dashboard.elevator.attribute.form')

					<div class="form-group">
						<div class="col-xs-12">
							<button type="submit" class="btn btn-primary btn-block">
								Сохранить
							</button>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-xs-12">
							<a href="{{ route('attribute.index') }}" class="btn btn-warning btn-block" data-dismiss="alert" aria-hidden="true">Отмена</a>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>

@endsection