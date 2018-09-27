{{-- 
Данные формируются через композер class App\Http\ViewComposers\UserMenuComposer
сам композер UserMenuComposer подключен через провайдер App\Providers\ComposerServiceProvider
при рендеринге вида layuots.usermenu
 --}}
 <p>
 	{{ $username }}
 </p>
 @if( Auth::user()->id === 1 )
	<p>
        <a href="{{ route('dashboard') }}">Админ.панель</a>
    </p>
@endif
    
<p>
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
</p>


<p>
    <a href="{{ route('logout') }}"
        onclick="event.preventDefault();
        	document.getElementById('logout-form').submit();">
        <span class="fa fa-sign-out"></span> Выход
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</p>      
 
 {{--
 <nav class="navbar navbar-default usermenu" role="navigation">
	<ul class="nav navbar-nav">
	    <li class="dropdown"> 
	        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	        	мои данные
	            <b class="caret"></b>
	        </a>
	        <ul class="dropdown-menu usermenu-dropdown">
	            @if( Auth::user()->id === 1 )
					<li>
		                <a href="#">Админ.панель</a>
		            </li>
		        @endif
	            
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
	        </ul>
	    </li>              
	                   
	</ul>
</nav>
 --}}
{{-- 
<div class="rd-navbar-nav-wrap">
	<ul class="rd-navbar-nav">
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
	</ul>
</div>   
--}}