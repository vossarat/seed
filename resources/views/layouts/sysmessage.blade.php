@extends('layouts.template-100')

@section('content')

<section class="section section-lg bg-white text-center">
    <div class="shell">
        {!! $message or 'Доступ запрещен!' !!}
    </div>
</section>
@endsection