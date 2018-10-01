@extends('layouts.template-100')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">        	
            <p class="text-left" style="margin-top: 30px;">
                   Простите, но у нас возникли проблемы с поиском страницы, которую Вы запрашиваете. Вы можете вернуться на <a href="{!! URL::previous() !!}">предыдущую страницу</a> или открыть <a href="{{ route('order.index') }}">главную</a> страницу нашего портала.
            </p>
            <img class="img-fluid" src="http://seed.zelenka.ml/images/error404.jpg"/>
        </div>
    </div>
</div>
@endsection
