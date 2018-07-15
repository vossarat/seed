@extends('layouts.template')

@section('content')

@if(Session::has('message'))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	{{Session::get('message')}}
</div>
@endif

<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title">
            Страница в разработке                
        </div>
    </div>
</div>

@endsection