{{-- 
Данные формируются через композер class App\Http\ViewComposers\UserMenuComposer
сам композер UserMenuComposer подключен через провайдер App\Providers\ComposerServiceProvider
при рендеринге вида layuots.usermenu
 --}}

<ul class="nav navbar-nav navbar-right">
	<li class="dropdown">
		<a href="" class="dropdown-toggle" data-toggle="dropdown">
			{{ $username }}
			<b class="caret"></b>
		</a>
		<ul class="dropdown-menu">
		@if( Auth::check() )
			<li>
				@if($routeprofile === 'create')
					<a href="{{ route('trader.create') }}">
						{{ $titleprofile }}
					</a>
				@else
					<a href="{{ route('trader.edit', $trader_id) }}">
						{{ $titleprofile }}
					</a>
				@endif
			</li>

			<li>
	            <a href="{{ route('logout') }}"
	                onclick="event.preventDefault();
	                	document.getElementById('logout-form').submit();">
	                <i class="fa fa-sign-out"></i> Выход
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
</ul>