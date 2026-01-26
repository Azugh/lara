<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">

        <div class="navbar-nav theme-brand flex-row  text-center">
            <div class="nav-logo">
                <div class="nav-item theme-logo">
                    <a href="{{route('home.index')}}">
                        <img src="" class="navbar-logo" alt="logo">
                    </a>
                </div>
                <div class="nav-item theme-text">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link"> CORK </a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-chevrons-left">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories ps ps--active-y" id="accordionExample">
            <li class="menu {{ (Request::is('admin/*') ? 'active' : '') }}">
                {{--aria-expanded положение стрелки--}}
                <a href="#dashboard" data-bs-toggle="collapse"
                   class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>Дэшбоард</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                {{--show открыи/закрыт список--}}
                <ul id="dashboard" class="collapse submenu list-unstyled" data-bs-parent="#accordionExample">
                    @if(Auth::user()?->isAdmin())
                        <li class="{{ (Request::routeIs('admin.slider.index') ? 'active' : '') }}">
                            <a href="{{ route('admin.slider.index') }}">
                                <span>Слайдеры</span></a>
                        </li>
                        <li class="{{ (Request::routeIs('admin.register_request.index') ? 'active' : '') }}">
                            <a href="{{ route('admin.register_request.index') }}"> Запросы на регистрацию </a>
                        </li>
                        <li class="{{ (Request::routeIs('admin.user.index') ? 'active' : '') }}">
                            <a href="{{ route('admin.user.index') }}">
                                <span>Пользователи</span>
                            </a>
                        </li>
                        <li class="{{ (Request::routeIs('admin.cart.index') ? 'active' : '') }}">
                            <a href="{{ route('admin.cart.index') }}">
                                <span>Корзины пользователей</span>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()?->isManager())
                        <li class="{{ (Request::routeIs('order.index') ? 'active' : '') }}">
                            <a href="{{ route('order.index') }}">
                                <span>Заказы пользователей</span></a>
                        </li>
                    @endif
                </ul>
            </li>
        </ul>

    </nav>

</div>
