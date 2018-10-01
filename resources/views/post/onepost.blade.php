@extends('layouts.template-100')

@section('content')

<section class="section section-lg bg-white text-center">
    <div class="shell">
        <div class = "row">
            <div class = "col-xs-12 col-sm-8 col-sm-offset-2 help-content">

                <h2>
                    {{ $viewdata->title }}
                </h2>
                <!--<p class="help-section text-left">
                    Регистрация на Zelenka.trade
                </p>-->
                <p>                   
					{!! $viewdata->description !!}
                </p>
                

            </div>
        </div>
    </div>
</section>
@endsection