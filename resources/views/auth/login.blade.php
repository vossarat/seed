@extends('layouts.template')

@section('content')

<section class="section section-lg bg-white text-center">
    <div class="shell">
        <div class="range range-xs-center range-60 range-lg-200">
            <div class="cell-xs-12">
                <div class="block-center" style="max-width: 520px">
                    <h3>
                        Авторизация
                    </h3>
                    <form class="text-left" method="POST" action="{{ route('login') }}">
                    	{{ csrf_field() }}
                        <div class="form-wrap form-wrap-validation {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="form-label" for="name">
                                Имя пользователя
                            </label>
                            <input class="form-input" id="name" type="text" name="name" data-constraints="@Required">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        {{--
                        <div class="form-wrap form-wrap-validation {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="form-label" for="email">
                                E-Mail
                            </label>
                            <input class="form-input" id="email" type="text" name="email" data-constraints="@Required">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        --}}
                        
                        <div class="form-wrap form-wrap-validation {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="form-label" for="password">
                                Пароль
                            </label>
                            <input class="form-input" id="password" type="password" name="password" data-constraints="@Required">
                              @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button class="button button-effect-ujarak button-block button-square button-primary" type="submit">
                            Войти
                        </button>
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            Забыли пароль ?
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


