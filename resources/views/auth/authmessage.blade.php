@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            {{$message}} Вам необходимо <a href="/login">авторизоваться</a> или <a href="/register">зарегистрироваться</a>
        </div>
    </div>
</div>
@endsection