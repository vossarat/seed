@extends('layouts.template-100')

@section('content')

<section class="section section-lg bg-white text-center">
    <div class="shell">
        <div class = "row">
            <div class = "col-xs-12 col-sm-8 col-sm-offset-2 help-content">

                <h2>
                    Частые вопросы по разделам сайта
                </h2>
                <p class="help-section text-left">
                    Как отслеживать заявки на портале для Производителя СХП
                </p>
                <p class="text-left">
                    Вы (Производитель СХП) получите уведомление о размещенной заявке путем SMS на Ваш зарегистрированный в системе номер, а также на электронный почтовый адрес. Уведомления по заявкам будут приходить строго по указанным Вами культурам в вашем
                    @if( $profile_type === 'trader')
						@if( $profile_action === 'create' )
							<a href="{{ route('trader.create') }}">профиле</a>.
						@else
							<a href="{{ route('trader.edit', $profile_id) }}">профиле</a>.
						@endif
					@else
						@if( $profile_action === 'create' )
							<a href="{{ route('farmer.create') }}">профиле</a>.
						@else
							<a href="{{ route('farmer.edit', $profile_id) }}">профиле</a>.
						@endif
					@endif
Вы можете редактировать всю Вашу информацию в профиле, включая  зарегистрированный номер телефона и культуры, по которым Вы будете получать уведомления о новых заявках
                </p>
                <p>
                    <img src="http://seed.zelenka.ml/images/Screenshot_11.jpg"/>
                </p>
                <p class="help-section text-left">
                    Регистрация на Zelenka.trade
                </p>
                <p class="text-left">                   
Для того, чтобы размещать заявки на сайте и получать уведомления о поступающих предложениях необходимо <a href="/register">зарегистрироваться</a>. Для этого необходимо лишь заполнить Имя пользователи и придумать Пароль от Вашей учетной записи.
                </p>
                <p>
                    <img src="http://seed.zelenka.ml/images/Screenshot_12.jpg"/>
                </p>
                 <p class="help-section text-left">
                    Как разместить заявки на портале для трейдера
                </p>

                <p class="text-left">
                    Трейдер размещает объявление с детальным описанием по требующейся зерновой культуре в
                    <a href="{{ route('order.create') }}"> заявке</a>. Затем созданная заявка публикуется на главной странице в разделе <a href="{{ route('order.index') }}"> заявки</a>.
                </p>
                <p>
                    <img src="http://seed.zelenka.ml/images/Screenshot_10.jpg"/>
                </p>

            </div>
        </div>
    </div>
</section>
@endsection