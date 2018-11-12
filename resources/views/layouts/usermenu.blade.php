{{-- 
Данные формируются через композер class App\Http\ViewComposers\UserMenuComposer
сам композер UserMenuComposer подключен через провайдер App\Providers\ComposerServiceProvider
при рендеринге вида layuots.usermenu
 --}}
 
 <p>
 	{{ $username }}
 </p> 
 
 <nav class="navbar navbar-default usermenu" role="navigation">
	<ul class="nav navbar-nav">
	    <li class="dropdown usermenu-dropdown"> 
	        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	        	Личный кабинет<b class="caret"></b>
	        </a>
	        <ul class="dropdown-menu">
	            @if( Auth::user()->id === 1 )
					<li>
		                 <a href="{{ route('dashboard') }}">Админ.панель</a>
		            </li>
		            <li class="divider"></li> <!--Separator-->
		        @endif
	            

				<li>
					<a href="{{ route( "$profile.edit", $profileId) }}">Мой профиль</a>
				</li>
				
				@foreach( $otherProfiles as $otherProfile )
				<li>
					<a href="{{ route( "$otherProfile[tip].create") }}">Изменить на {{ $otherProfile['title'] }}</a>
				</li>
				@endforeach
				<li class="divider"></li> <!--Separator-->
				
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