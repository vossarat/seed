@extends('layouts.template-100')

@section('content')

<footer class="section section-lg bg-white text-center">
    <div class="shell">
        <div class="range range-xs-center range-60 range-lg-200">
            <div class="cell-xs-12">
                <h2 class="text-regular">
                    Обратная связь
                </h2>
                
                {{-- информационное сообщение --}}
				@if(Session::has('message'))
				<div class="alert alert-success block-center" style="max-width: 840px">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{Session::get('message')}}
				</div>
				@endif
				{{-- /информационное сообщение --}}
                
                <!-- RD Mailform-->
                <form class="block-center" data-form-output="form-output-global" data-form-type="contact" method="post" action="{{ route('feedback_send') }}" style="max-width: 840px" novalidate="novalidate">
                	{{ csrf_field() }}
                    <div class="range range-xs-center range-20 range-narrow">
                        <div class="cell-sm-5">
                            <div class="form-wrap form-wrap-validation has-error">
                                <label class="form-label rd-input-label" for="forms-name">
                                    Ваше имя
                                </label>
                                <input class="form-input form-control-has-validation form-control-last-child" id="forms-name" name="name" data-constraints="@Required" type="text">
                            </div>
                        </div>
                        <div class="cell-sm-5">
                            <div class="form-wrap form-wrap-validation has-error">
                                <label class="form-label rd-input-label" for="forms-phone">
                                    Телефон
                                </label>
                                <input class="form-input form-control-has-validation form-control-last-child" id="forms-phone" name="phone" data-constraints="@Required" type="text">

                            </div>
                        </div>
                        <div class="cell-sm-10">
                            <div class="form-wrap form-wrap-validation has-error">
                                <label class="form-label rd-input-label" for="forms-message">
                                    Ваше сообщение
                                </label>
                                <textarea class="form-input form-control-has-validation form-control-last-child" id="forms-message" name="message" data-constraints="@Required"></textarea>

                            </div>
                        </div>
                        <div class="cell-sm-5">
                            <div class="form-wrap form-wrap-validation">
                                <label class="form-label rd-input-label" for="forms-email">
                                    E-mail
                                </label>
                                <input class="form-input form-control-has-validation form-control-last-child" id="forms-email" name="email" data-constraints="@Email @Required" type="email">
                                <span class="form-validation">
                                </span>
                            </div>
                        </div>
                        <div class="cell-sm-5">
                            <div class="form-button">
                                <button class="button button-effect-ujarak button-primary button-block button-square" type="submit">
                                    Отправить сообщение
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</footer>

@endsection