<div class="rd-navbar-nav-wrap">
    <!-- RD Navbar Nav-->
    <ul class="rd-navbar-nav">
        
        	<li>
                <a href="{{ route('order.index') }}">
                    @lang('messages.mainpage')
                </a>
            </li>
            <li>
                <a href="{{ route('order.create') }}">
                    Добавить заявку
                </a>
            </li>
            {{--
            <li>
            <a href="#">
                Заявки
            </a>
            <ul class="rd-navbar-dropdown">
              
                
            </ul> 
            </li>
      		 --}}  
        
        <li>
            <a href="{{ route('mapelevator') }}">
                Элеваторы
            </a>
        </li>
        <li>
            <a href="{{ route('news') }}">
                Новости
            </a>
        </li>
        <li>
            <a href="{{ route('feedback') }}">
                Обратная связь
            </a>
        </li>
        <li>
            <a href="{{ route('help') }}">
                Помощь
            </a>
        </li>
        <li class="visible-xs">
            <p class="text-center" style="color: #f8a63d;">
                Зарегистрировано
            </p>
            <div class="count-user">
	            <p>
	                Трейдеры : {{ $cntTrader }}
	            </p>
	            <p>
	                Производители СПХ : {{ $cntFarmer }}
	            </p>
	            <p>
	                Элеваторы : {{ $cntElevator }}
	            </p>
            </div>
        </li>
       
        {{--
        <li>
            <a href="#">
                Язык
            </a>
            <ul class="rd-navbar-dropdown">
				<li>
				    <a href="/welcome/kz">
				        Казахский
				    </a>
				</li>
				<li>
				    <a href="/welcome/ru">
				        Русский
				    </a>
				</li> 
				<li>
				    <a href="/welcome/en">
				        Английский
				    </a>
				</li>                
            </ul> 
        </li>
      	--}}	

    </ul>
</div>