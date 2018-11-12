{{-- 
Данные формируются через композер class App\Http\ViewComposers\UserMenuComposer
сам композер UserMenuComposer подключен через провайдер App\Providers\ComposerServiceProvider
при рендеринге вида layuots.usermenumobile
 --}}

@if( Auth::check() )
	<li>
		<a href="{{ route( "$profile.edit", $profileId) }}">Мой профиль</a>
	</li>	

	<li>
		<span>Изменить профиль</span>
		<ul>
          @foreach( $otherProfiles as $otherProfile )
          <li><a href="{{ route( "$otherProfile[tip].create") }}">на {{ $otherProfile['title'] }}</a></li>
          @endforeach
       </ul>
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

@push('scripts')
<script type="text/javascript">
	$(function() {
		$('#user-menu').mmenu({
			extensions: ["position-right", "theme-white", "border-full", "shadow-page"],
			navbar			: {
				title			: "{{ $profileTitle }}"
			},
			
		});
		
		
		$( ".user-menu" ).click(function( event ) {
			event.preventDefault();				
		});
	});	
</script>
@endpush