<!-- RD Navbar-->
<div class="rd-navbar-wrap">
    <nav class="rd-navbar rd-navbar-widget" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-static" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-md-stick-up-offset="40px" data-lg-stick-up-offset="40px" data-stick-up="true" data-sm-stick-up="true" data-md-stick-up="true" data-lg-stick-up="true">
        <div class="rd-navbar-collapse-toggle" data-rd-navbar-toggle=".rd-navbar-collapse">
            <span>
            </span>
        </div>
        <div class="rd-navbar-top-panel">
            <div class="rd-navbar-top-panel-inner">
                <!-- RD Navbar Brand-->
                <div class="rd-navbar-brand">
                    
                    <a class="brand-name" href="/">
                    	Zelenka.Trade     	
                    {{--  
                        <img src="images/logo-522x84.png" alt="" width="522" height="84"/>
 					--}}
                    </a> 
                   
                </div>
                <div class="rd-navbar-collapse">
                    <ul class="list-spreader list-spreader-xl">
                        <li>
                            <div class="unit-link-with-icon unit unit-spacing-xs unit-horizontal">
                                <div class="unit-left">
                                    <span class="icon icon-md-big icon-primary icon-circle mdi-phone">
                                    </span>
                                </div>
                                <div class="unit-body">
                                    <p>
                                        Emergency Help
                                    </p>
                                    <a href="tel:#">
                                        1-800-700-6200
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="unit-link-with-icon-1 unit unit-spacing-xs unit-horizontal">
                                <div class="unit-left">
                                    <span class="icon icon-md-big icon-primary icon-circle mdi-map-marker">
                                    </span>
                                </div>
                                <div class="unit-body">
                                    <a href="#">
                                        10 Firs Avenue, Muswell Hill, London N10
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="unit-link-with-icon-1 unit unit-spacing-xs unit-horizontal">
                                <div class="unit-left">
                                    <span class="icon icon-md-big icon-primary icon-circle mdi-share">
                                    </span>
                                </div>
                                <div class="unit-body">
                                    <p>
                                        Social Media
                                    </p>
                                    <ul class="list-inline">
                                        <li>
                                            <a class="icon icon-gray-darker fa-facebook" href="#">
                                            </a>
                                        </li>
                                        <li>
                                            <a class="icon icon-gray-darker fa-twitter" href="#">
                                            </a>
                                        </li>
                                        <li>
                                            <a class="icon icon-gray-darker fa-google-plus" href="#">
                                            </a>
                                        </li>
                                        <li>
                                            <a class="icon icon-gray-darker fa-pinterest-p" href="#">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="rd-navbar-inner rd-navbar-inner-bottom">
            <!-- RD Navbar Panel-->
            <div class="rd-navbar-panel">
                <!-- RD Navbar Toggle-->
                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap">
                    <span>
                    </span>
                </button>
                <!-- RD Navbar Brand-->
                <div class="rd-navbar-brand">
                    <a class="brand-name" href="/">
                    	Zelenka.Trade
                        {{--
                        <img src="images/logo-522x84.png" alt="" width="522" height="84"/>
                        --}}
                    </a>
                </div>

                @section('topmenu')
                @include('layouts.topmenu')
                @show

            </div>
            <div class="rd-navbar-search">
                <a class="rd-navbar-search-toggle" data-rd-navbar-toggle=".rd-navbar-search" href="#">
                    <span>
                    </span>
                </a>
                <form class="rd-search" action="search-results.html" data-search-live="rd-search-results-live" method="GET">
                    <div class="form-wrap">
                        <label class="form-label form-label" for="rd-navbar-search-form-input">
                            Search....
                        </label>
                        <input class="rd-navbar-search-form-input form-input" id="rd-navbar-search-form-input" type="text" name="s" autocomplete="off">
                        <div class="rd-search-results-live" id="rd-search-results-live">
                        </div>
                        <div class="rd-search-form-close fl-budicons-free-cross84">
                        </div>
                        <button class="rd-search-form-submit fl-bigmug-line-search74">
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </nav>
</div>


{{--
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Название компании и кнопка, которая отображается для мобильных устройств группируются для лучшего отображения при сужении -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">
                    Навигационное меню
                </span>
                <span class="icon-bar">
                </span><!--Полоски на кнопке-->
                <span class="icon-bar">
                </span><!--Полоски на кнопке-->
                <span class="icon-bar">
                </span><!--Полоски на кнопке-->
            </button>
            <a class="navbar-brand" href="#">
                Zelenka.Trade
            </a>
        </div>

        <!-- Группируем ссылки, формы, выпадающее меню и прочие элементы -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Заявки
                        <b class="caret">
                        </b>
                    </a>
                    <ul class="dropdown-menu">
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
                    <a href="{{ route('xxx') }}">
                        Карта элеваторов
                    </a>
                </li>
                <li>
                    <a href="{{ route('xxx') }}">
                        Поставщики
                    </a>
                </li>
                <li>
                    <a href="{{ route('xxx') }}">
                        Новости
                    </a>
                </li>
                <li>
                    <a href="{{ route('xxx') }}">
                        Обратная связь
                    </a>
                </li>

            </ul>

            <!-- Секция меню  пользователя -->
            @section('usermenu')
            @include('layouts.usermenu')
            @show

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
--}}