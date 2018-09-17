@extends('layouts.template-100')

@section('content')

<section class="section section-lg bg-white text-center">
    <div class="shell">
        <div class="range range-xs-center range-60 range-lg-200">
            <div class="cell-xs-12">
                <div class="block-center" style="max-width: 520px">
                    <h2>
                        Регистрация
                    </h2>

                    <form class="text-left" method="POST" action="{{ route('register') }}">
                    	{{ csrf_field() }}
                        <div class="form-wrap form-wrap-validation {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="form-label" for="name">
                                Имя пользователя
                            </label>
                            <input class="form-input" id="name" type="text" name="name" required>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>
                                        {{ $errors->first('name') }}
                                    </strong>
                                </span>
                                @endif
                        </div>
                        
                        <div class="form-wrap form-wrap-validation {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="form-label" for="password">
                                Пароль
                            </label>
                            <input class="form-input" id="password" type="password" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>
                                        {{ $errors->first('password') }}
                                    </strong>
                                </span>
                                @endif
                        </div>
                        
                        <div class="form-wrap form-wrap-validation">
                            <label class="form-label" for="password_confirmation">
                                Подтвержение пароля
                            </label>
                            <input class="form-input" id="password_confirmation" type="password" name="password_confirmation" required>
                        </div>
                        
                        <div class="form-wrap form-wrap-validation">
                            <div class="cell-md-2 cell-xs-12">
                                <label class="radio-inline">
                                    <input type="radio" name="profile" value="trader" checked="checked"> Трейдер
                                </label>
                            </div>
                            <div class="cell-md-2 cell-xs-12">
                                <label class="radio-inline">
                                    <input type="radio" name="profile" value="farmer"> Фермер
                                </label>
                            </div>

                        </div>
                        
                        
                        <button class="button button-effect-ujarak button-block button-square button-primary" type="submit">
                            Регистрация
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
