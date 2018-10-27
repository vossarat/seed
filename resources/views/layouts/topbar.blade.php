<!-- RD Navbar-->
<div class="rd-navbar-wrap">
    <nav class="rd-navbar rd-navbar-widget" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-static" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-md-stick-up-offset="40px" data-lg-stick-up-offset="40px" data-stick-up="true" data-sm-stick-up="true" data-md-stick-up="true" data-lg-stick-up="true">
        
        
        
        
        <div class="rd-navbar-collapse-toggle user-menu" data-rd-navbar-toggle=".rd-navbar-collapse">           
             <a href="#user-menu" style="color: #000;"><span class="fa fa-user fa-2x"></span></a>
        </div>
        
    {{-- Поиск
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
        --}}
       <section>
        <div class="rd-navbar-top-panel">
            <div class="rd-navbar-top-panel-inner">
                <!-- RD Navbar Brand-->
                <div class="rd-navbar-brand">
                    
                    <a class="brand-name" href="/">
                    	{{-- Zelenka.Trade --}}    	
                     
                        <img src="/images/logo.png" alt="" width="622" height="184"/>
 						
                    </a> 
                <h1>ОНЛАЙН ПОКУПКА И ПРОДАЖА ЗЕРНА В КАЗАХСТАНЕ</h1>   
                </div>
                
                {{--Топбар (курс валют, инфо по заявкам, вход)--}}
                <div class="rd-navbar-collapse hidden-xs">
                    <ul class="list-spreader list-spreader-xl">
                        <li>
                            <div class="unit-link-with-icon unit unit-spacing-xs unit-horizontal">
                                <div class="unit-body">
                                    <p style="color: #f8a63d; ">
                                        С нами работают
                                    </p>
                                    <p>
                                        Трейдеры : {{ $cntTrader }}
                                    </p>
                                    <p>
                                        Производители СХП : {{ $cntFarmer }}
                                    </p>
                                    <p>
                                        Элеваторы : {{ $cntElevator }}
                                    </p>
                                    
                                    
                                </div>
                            </div>
                        </li>                        
                        <li>
                            <div class="unit-link-with-icon unit unit-spacing-xs unit-horizontal">
                                {{--
                                <div class="unit-left">
                                    <span class="icon icon-md-big icon-primary icon-circle mdi-phone">
                                    </span>
                                </div>
                                --}}
                                <div class="unit-body">
                                   
								{{-- Данные формируются через композер class App\Http\ViewComposers\RatesComposer, сам композер RatesComposer подключен через провайдер App\Providers\ComposerServiceProvider	при рендеринге вида layouts.topbar--}}
										 
                                    @foreach($rates as $rate)
                                    <p>
                                        {{ $rate['title'].' : '. $rate['description'] }}
                                    </p>                                  
                                    @endforeach
                                    
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="unit-link-with-icon unit unit-spacing-xs unit-horizontal">
                                <div class="unit-body">
                                    <p>
                                        Всего заявок на сайте : {{ $cnt_orders }}
                                    </p>
                                    <p>
                                        Активных : {{ $cnt_active_orders }}
                                    </p>
                                    
                                    
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="unit-link-with-icon unit unit-spacing-xs unit-horizontal">
                                <div class="unit-body">                                	
							        <!-- Секция меню  пользователя -->
							        @if( Auth::check() )
								        @section('usermenu')
								        	@include('layouts.usermenu')
								        @show
							        @else
							        	<p>
											<a href="/login">
												Войти в систему
											</a>
										</p>
										<p>
											<a href="/register">
												Регистрация
											</a>
										</p>
							        @endif
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                {{--/Топбар (курс валют, инфо по заявкам, вход)--}}
                
            
            
            </div>
        </div>
        </section>
        <section>
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
                    	{{--Zelenka.Trade--}}
                        
                        <img src="/images/logo.png" alt="" width="522" height="84"/>
                        <h1 style="font-size: 2vw;">ОНЛАЙН ПОКУПКА И ПРОДАЖА ЗЕРНА В КАЗАХСТАНЕ</h1>
                        
                    </a>
                </div>

                @section('topmenu')
                @include('layouts.topmenu')
                @show

            </div>
        </div>
        </section>
    </nav>
</div>

<nav id="user-menu">
	<ul id="panel-menu">
		@section('usermenumobile')
        	@include('layouts.usermenumobile')
        @show
	</ul>
</nav>