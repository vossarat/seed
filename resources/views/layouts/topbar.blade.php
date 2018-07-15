<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- Название компании и кнопка, которая отображается для мобильных устройств группируются для лучшего отображения при сужении -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">
					Навигационное меню
				</span>
				<span class="icon-bar"></span><!--Полоски на кнопке-->
				<span class="icon-bar"></span><!--Полоски на кнопке-->
				<span class="icon-bar"></span><!--Полоски на кнопке-->
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
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="{{ route('xxx') }}" class="dropdown-toggle" data-toggle="dropdown">
						{{ Auth::check() ? Auth::user()->name : 'Пользователь' }}
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
					@if( Auth::check() )					
						@if( \Func::traderByUserId(Auth::user()->id) )
						<li>
							<a href="{{ route('trader.edit', \Func::traderByUserId(Auth::user()->id) ) }}">
								Профиль трейдера
							</a>
						</li>
						@else
						<li>
							<a href="{{ route('trader.create') }}">
								Я трейдер
							</a>
						</li>
						@endif
						<li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                	document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> Выход
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
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>