<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">

        <!-- Группируем ссылки, формы, выпадающее меню и прочие элементы -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="">Административная панель Zelenka.Trader</a>
                </li>
                
                               
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    	   <i class="fa fa-user"></i>{{-- {{ Auth::user()->name  }}<b class="caret"></b>--}}
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('home') }}"
                            	<i class="fa fa-sign-out"></i> На главную
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>