<div class="rd-navbar-nav-wrap">
    <!-- RD Navbar Nav-->
    <ul class="rd-navbar-nav">
        <li>
            <a href="#">
                Заявки
            </a>
            <ul class="rd-navbar-dropdown">
                <li>
                    <a href="{{ route('order.create') }}">
                        Добавить заявку
                    </a>
                </li>
                <li>
                    <a href="{{ route('order.index') }}">
                        Все заявки
                    </a>
                </li>
            </ul>
        </li>
       
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
        
        <!-- Секция меню  пользователя -->
        @section('usermenu')
        	@include('layouts.usermenu')
        @show
    </ul>
</div>