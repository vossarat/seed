@extends('layouts.template')

@section('content')

<section class="section section-lg bg-white text-center">
    <div class="shell">
        <div class="range range-xs-center range-60 range-lg-200">
            <div class="cell-xs-12">

                <div class="block-center" style="max-width: 720px">


                    <h2>
                        Информация о производителе СХП
                    </h2>

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('farmer.update', $viewdata->id) }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="id" value="{{ $viewdata->id }}">
                        <input type="hidden" name="_method" value="put"/>

                        @include('farmer.form')
                        
                        
                        
                        <div class="form-group">
                            <div class="col-xs-12">
                                <button type="submit" class="button button-effect-ujarak button-block button-primary">
                                    Сохранить
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