@extends('dashboard.template')

@section('content')
<div class="row content-dashboard">
	<a href="/dashboard/dashboard_user">
		<div class="col-xs-4 col-xs-offset-4 text-center">
			<div class="dashboard-info">
			    <h3>Пользователей: </br>{{ $cntUser }}</h3>
			</div>
		</div>
	</a>
</div>

<div class="row content-dashboard">	
	<a href="/dashboard/dashboard_trader">
		<div class="col-xs-3 text-center">
			<div class="dashboard-info">
			    <h3>Трейдеры: </br>{{ $cntTrader }}</h3>
			</div>
		</div>
	</a>
	<a href="/dashboard/dashboard_farmer">
		<div class="col-xs-3 text-center">
			<div class="dashboard-info">
			    <h3>Прозводители СПХ: </br>{{ $cntFarmer }}</h3>
			</div>
		</div>
	</a>	
	<a href="/dashboard/dashboard_forwarder">
		<div class="col-xs-3 text-center">
			<div class="dashboard-info">
			    <h3>Экспедиторы: </br>{{ $cntForwarder }}</h3>
			</div>
		</div>
	</a>	
	<a href="/dashboard/elevator">
		<div class="col-xs-3 text-center">
			<div class="dashboard-info">
			    <h3>Элеваторы: </br>{{ $cntElevator }}</h3>
			</div>
		</div>
	</a>
	
	

</div>

@endsection