@extends('layouts.template')

@section('content')

<section class="section section-lg bg-white text-center">
    <div class="shell">
        <div class="range range-xs-center range-60 range-lg-200">
            <div class="cell-xs-12">

                <div class="block-left" style="max-width: 720px">

                    <h2>
                        Добавить заявку
                    </h2>

                    <form id="form-order" class="form-horizontal" role="form" method="POST" action="{{ route('order.store') }}">
                        {{ csrf_field() }}

                        @include('order.form')

                        <div class="form-group">
                            <div class="col-xs-12">
                                <button type="submit" class="button button-effect-ujarak button-block button-primary">
                                    Разместить
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <a href="{{ route('order.index') }}" class="button button-effect-ujarak button-block button-default-outline" data-dismiss="alert" aria-hidden="true">
                                    Отмена
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection