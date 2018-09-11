{{-- 
Данные формируются через композер class App\Http\ViewComposers\UserMenuComposer
сам композер UserMenuComposer подключен через провайдер App\Providers\ComposerServiceProvider
при рендеринге вида layuots.usermenu
 --}}

<li class="hidden-xs">
    <a href="#">
        {{ $username }}
    </a>
    <ul class="rd-navbar-dropdown">
        @if( Auth::check() )
			<li>
				@if( $profile_type === 'trader')
					@if( $profile_action === 'create' )
						<a href="{{ route('trader.create') }}">Мой профиль</a>
					@else
						<a href="{{ route('trader.edit', $profile_id) }}">Мой профиль</a>
					@endif
				@else
					@if( $profile_action === 'create' )
						<a href="{{ route('farmer.create') }}">Мой профиль</a>
					@else
						<a href="{{ route('farmer.edit', $profile_id) }}">Мой профиль</a>
					@endif
				@endif
			</li>
			
			{{--
			<li>
				@if( $profile_type === 'trader')
					<a href="{{ route('farmer.create') }}">Сменить профиль</a>
				@else
					<a href="{{ route('trader.create') }}">Сменить профиль</a>
				@endif
			</li>
			--}}
			
			@if( Auth::user()->id === 1 )
			<li>
                <a href="/dashboard">Админ.панель</a>
            </li>
            @endif

			<li>
	            <a href="{{ route('logout') }}"
	                onclick="event.preventDefault();
	                	document.getElementById('logout-form').submit();">
	                <span class="fa fa-sign-out"></span> Выход
	            </a>
	            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                {{ csrf_field() }}
	            </form>
	        </li>						
		@else
			<li>
				<a href="/login">
					Войти в систему
				</a>
			</li>
			<li>
				<a href="/register">
					Регистрация
				</a>
			</li>
	   	@endif
    </ul>
</li>