<div class="rd-navbar-nav-wrap">
    <!-- RD Navbar Nav-->
    <ul class="rd-navbar-nav">
        
        	<li>
                <a href="{{ route('order.index') }}">
                    Главная
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
                Карта элеваторов
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

    </ul>
</div>