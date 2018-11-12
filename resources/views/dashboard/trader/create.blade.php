@extends('dashboard.template')

@section('content')

	<h1 class="page-header">Трейдеры</h1>

	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"> {{-- заголовок окна --}}
				Добавить трейдера
				<a href="{{ route('dashboard_trader.index') }}" class="close" data-dismiss="alert" aria-hidden="true">&times;</a> {{-- х закрыть --}}
			</div>

			<div class="panel-body">
				<form class="form-horizontal" role="form" method="POST" action="{{ route('dashboard_trader.store') }}">
					{{ csrf_field() }}

					@include('trader.form')

					<div class="form-group">
						<div class="col-xs-4 col-xs-offset-2">
							<button type="submit" class="btn btn-primary btn-block">
								Сохранить
							</button>
						</div>
						
						<div class="col-xs-4">
							<a href="{{ route('dashboard_trader.index') }}" class="btn btn-warning btn-block" data-dismiss="alert" aria-hidden="true">Отмена</a>
						</div>
					</div>
					
					

				</form>
			</div>
		</div>
	</div>

@endsection