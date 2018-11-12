<div class="rd-navbar-nav-wrap">
    <!-- RD Navbar Nav-->
    <ul class="rd-navbar-nav">
        
        	<li>
                <a href="{{ route('order.index') }}">
                    @lang('topmenu.mainpage')
                </a>
            </li>
            <li>
                <a href="{{ route('order.create') }}">
                    @lang('topmenu.addorder')
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
                @lang('topmenu.elevators')
            </a>
        </li>
        <li>
            <a href="{{ route('news') }}">                
                @lang('topmenu.news')
            </a>
        </li>
        <li>
            <a href="{{ route('feedback') }}">
                @lang('topmenu.feedback')
            </a>
        </li>
        <li>
            <a href="{{ route('help') }}">
                @lang('topmenu.help')
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
           </ul>
</div>