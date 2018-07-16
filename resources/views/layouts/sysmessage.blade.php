@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            {!! $message or 'Доступ запрещен!' !!}
        </div>
    </div>
</div>
@endsection