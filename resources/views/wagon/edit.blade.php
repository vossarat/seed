@extends('layouts.template')

@section('tableprice')
    @include('layouts.tableprice')
@endsection

@section('content')

<section class="section section-lg bg-white text-center">
    <div class="shell">
        <div class="range range-xs-center range-60 range-lg-200">
             <div class="cell-xs-12 order-wagon-form">               

                    <h2>
                        Редактирование заявки экспедитора
                    </h2>

                    <form id="form-order-wagon" class="form-horizontal" role="form" method="POST" action="{{ route('wagon.update', $viewdata->id) }}">
                        {{ csrf_field() }}
                        
                        <input type="hidden" name="id" value="{{ $viewdata->id }}">
                		<input type="hidden" name="_method" value="put"/>

                        @include('wagon.form')

                        <div class="form-group">
                            <div class="col-xs-12">
                                <button type="submit" class="button button-effect-ujarak button-block button-primary">
                                    Редактировать
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <a href="{{ route('wagon.index') }}" class="button button-effect-ujarak button-block button-default-outline" data-dismiss="alert" aria-hidden="true">
                                    Отмена
                                </a>
                            </div>
                        </div>

                    </form>
               
            </div>
        </div>
    </div>
</section>

@endsection