<nav class="navbar navbar-default default">
    <div class="container">
        <div class="navbar-header">
            <div class="basic-wrapper"><a class="btn responsive-menu" data-toggle="collapse"
                                          data-target=".navbar-collapse"><i></i></a>
                <div class="navbar-brand"><a href="index.html"><img src="#"
                                                                    srcset="style/images/logo.png 1x, style/images/logo@2x.png 2x"
                                                                    class="logo-light"
                                                                    alt=""/><img src="#"
                                                                                 srcset="style/images/logo-dark.png 1x, style/images/logo-dark@2x.png 2x"
                                                                                 class="logo-dark"
                                                                                 alt=""/></a>
                </div>
                <!-- /.navbar-brand -->
            </div>
            <!-- /.basic-wrapper -->
        </div>
        <!-- /.navbar-header -->
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li class="dropdown"><a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Features
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="elements.html">Elements</a></li>
                        <li><a href="charts.html">Charts</a></li>
                        <li><a href="pricing.html">Pricing Tables</a></li>
                        <li><a href="headings.html">Headings</a></li>
                        <li><a href="disqus.html">Disqus</a></li>
                        <li><a href="icon-lulu.html">Lulu Icons</a></li>
                        <li><a href="icon-budicon.html">Budicon Icons</a></li>
                        <li><a href="icon-fontello.html">Fontello Icons</a></li>
                    </ul>
                </li>
                @guest
                    {{--                    <li><a href="{{ route('register') }}">Регистрация</a></li>--}}
                    <li><a href="{{ route('register_request.create') }}">Регистрация</a></li>
                    <li><a href="{{ route('login') }}">Войти</a></li>
                @endguest
                @auth
                    <li><a href="{{ route('dashboard') }}">Профиль</a></li>
                    <li><a href="{{ route('cart.show') }}">Корзина</a></li>


                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    <li>
                        {{\Illuminate\Support\Facades\Auth::user()->name}}
                    </li>
                @endauth
            </ul>
            <!-- /.navbar-nav -->
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<!-- /.navbar -->
