<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">

        <!-- Группируем ссылки, формы, выпадающее меню и прочие элементы -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="">Административная панель Zelenka.Trader</a>
                </li>
                <li class="dropdown"> {{-- Справочники--}}
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    	Пользователи
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/dashboard/user">Все пользователи</a>
                        </li>
                        
                        <li>
                            <a href="">Трейдеры</a>
                        </li>                        
                        <li>
                            <a href="">Фермеры</a>
                        </li> 
                        <li>
                            <a href="/dashboard/elevator">Элеваторы</a>
                        </li>                        
                    </ul>
                </li> {{-- Конец Справочники--}}
                
                <li class="dropdown"> {{-- Настройка--}}
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    	Настройка
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('rate.edit', 1) }}">Курсы валют</a>
                        </li>                        
                    </ul>
                </li> {{-- Конец Настройка--}}
                <li>
                    <a href="/dashboard/post">Новости</a>
                </li>                
                
                
                
                <li class="dropdown"> {{-- Справочники--}}
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cправочники
                        <b class="caret"></b> <!--Стрелка вниз-->
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu"> {{-- Территория --}}
                            <a tabindex="-1" href="#">Территория</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a tabindex="-1" href="{{route('country.index')}}">Страны</a>
                                </li>
                                <li>
                                    <a tabindex="-1" href="{{route('state.index')}}">Области</a>
                                </li>
                                <li>
                                    <a tabindex="-1" href="{{route('region.index')}}">Районы</a>
                                </li>
                                <li>
                                    <a tabindex="-1" href="{{route('town.index')}}">Населенные пункты</a>
                                </li>
                            </ul>
                        </li> {{-- / Территория --}}
                        <li class="divider"></li> <!--Separator-->
                        <li>
                            <a href="{{route('corn.index')}}">Зерновые культуры</a>
                        </li>
                        <li class="divider"></li> <!--Separator-->
                        <li>
                            <a href="{{route('gost.index')}}">ГОСТ на культуры</a>
                        </li>
                        <li class="divider"></li> <!--Separator-->
                        <li>
                            <a href="{{route('attribute.index')}}">Атрибуты элеватора</a>
                        </li>
                        <li class="divider"></li> <!--Separator-->
                    
                    </ul>
                </li> {{-- Конец Справочники--}}
                
                
                
                               
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ route('home') }}"
                    	<i class="fa fa-sign-out"></i> На главную
                    </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>