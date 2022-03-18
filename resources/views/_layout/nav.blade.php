<div class="nav-content d-flex">
    <!-- Logo Start -->
    <div class="logo position-relative">
        <a href="/">
            <img src="{{ asset('/img/logo/logo-larural-dark.svg') }}" alt="logo" />
        </a>
    </div>
    <!-- Logo End -->
    <!-- User Menu Start -->
    <div class="user-container d-flex">
        <a href="#" class="d-flex user position-relative" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <img class="profile" alt="profile"
                src="https://avatar.oxro.io/avatar.svg?name={{ strtoupper(Auth::user()->name) }}" />
            <div class="name">{{ Auth::user()->name }}</div>
        </a>
        <div class="dropdown-menu dropdown-menu-end user-menu wide">
            <div class="row mb-3 ms-0 me-0">
                <div class="col-12 ps-1 mb-2">
                    <div class="text-extra-small text-primary">{{ __('view.account') }}</div>
                </div>
                <div class="col-6 ps-1 pe-1">
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('password.change') }}">{{ __('view.security') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row mb-1 ms-0 me-0">
                <div class="col-12 p-1 mb-3 pt-0">
                    <div class="separator-light"></div>
                </div>
                <div class="col-12 pe-1 ps-1">
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i data-cs-icon="logout" class="me-2" data-cs-size="17"></i>
                                <span class="align-middle">{{ __('view.logout') }}</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- User Menu End -->
    <!-- Menu Start -->
    <div class="menu-container flex-grow-1">
        <ul id="menu" class="menu">
            <li>
                <a href="{{ route('backoffice.home') }}"
                    class="{{ Request::routeIs('backoffice.home') ? 'active' : '' }}">
                    <i data-cs-icon="home" class="icon" data-cs-size="18"></i>
                    <span class="label">Inicio</span>
                </a>
            </li>
            @cannot('viewAny', App\Models\EventRequest::class)
                <li>
                    <a href="{{ route('backoffice.events') }}"
                        class="{{ Request::routeIs('backoffice.events') ? 'active' : '' }}">
                        <i data-cs-icon="calendar" class="icon" data-cs-size="18"></i>
                        <span class="label">Eventos</span>
                    </a>
                </li>
            @endcannot
            @can('viewAny', App\Models\EventRequest::class)
                <li>
                    <a href="#events" data-bs-toggle="collapse" data-role="button" aria-expanded="false"
                        class="{{ Request::segment(2) == 'events' ? 'active' : '' }}">
                        <i data-cs-icon="calendar" class="icon" data-cs-size="18"></i>
                        <span class="label">Eventos</span>
                    </a>
                    <ul id="events" class="collapse">
                        <li>
                            <a href="{{ route('backoffice.events') }}"
                                class="{{ Request::routeIs('backoffice.events') ? 'active' : '' }}">
                                <span class="label">Listado</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('backoffice.events.requests') }}"
                                class="{{ Request::routeIs('backoffice.events.requests') ? 'active' : '' }}">
                                <span class="label">Solicitudes</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            <li>
                <a href="{{ route('backoffice.budgets.list') }}"
                    class="{{ Request::routeIs('backoffice.budgets.list') ? 'active' : '' }}">
                    <i data-cs-icon="money" class="icon" data-cs-size="18"></i>
                    <span class="label">Presupuesto</span>
                </a>
            </li>
            <li>
                <a href="#products" data-bs-toggle="collapse" data-role="button" aria-expanded="false"
                    class="{{ Request::segment(2) == 'products' ? 'active' : '' }}">
                    <i data-cs-icon="abacus" class="icon" data-cs-size="18"></i>
                    <span class="label">Productos</span>
                </a>
                <ul id="products" class="collapse">
                    <li>
                        <a href="{{ route('backoffice.products.list') }}"
                            class="{{ Request::routeIs('backoffice.products.list') ? 'active' : '' }}">
                            <span class="label">Listado</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('backoffice.products.categories') }}"
                            class="{{ Request::routeIs('backoffice.products.categories') ? 'active' : '' }}">
                            <span class="label">Categorias</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('backoffice.customers') }}"
                    class="{{ Request::routeIs('backoffice.customers') ? 'active' : '' }}">
                    <i data-cs-icon="notebook-1" class="icon" data-cs-size="18"></i>
                    <span class="label">Clientes</span>
                </a>
            </li>
            <li>
                <a href="{{ route('backoffice.zones') }}"
                    class="{{ Request::routeIs('backoffice.zones') ? 'active' : '' }}">
                    <i data-cs-icon="home-garage" class="icon" data-cs-size="18"></i>
                    <span class="label">Zonas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('backoffice.users') }}"
                    class="{{ Request::routeIs('backoffice.users') ? 'active' : '' }}">
                    <i data-cs-icon="user" class="icon" data-cs-size="18"></i>
                    <span class="label">Usuarios</span>
                </a>
            </li>
            @can('viewConfig', App\Models\User::class)
                <li>
                    <a href="{{ route('backoffice.setting') }}"
                        class="{{ Request::routeIs('backoffice.setting') ? 'active' : '' }}">
                        <i data-cs-icon="gear" class="icon" data-cs-size="18"></i>
                        <span class="label">Configuración</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
    <!-- Menu End -->
    <!-- Mobile Buttons Start -->
    <div class="mobile-buttons-container">
        <!-- Scrollspy Mobile Button Start -->
        <a href="#" id="scrollSpyButton" class="spy-button" data-bs-toggle="dropdown">
            <i data-cs-icon="menu-dropdown"></i>
        </a>
        <!-- Scrollspy Mobile Button End -->
        <!-- Scrollspy Mobile Dropdown Start -->
        <div class="dropdown-menu dropdown-menu-end" id="scrollSpyDropdown"></div>
        <!-- Scrollspy Mobile Dropdown End -->
        <!-- Menu Button Start -->
        <a href="#" id="mobileMenuButton" class="menu-button">
            <i data-cs-icon="menu"></i>
        </a>
        <!-- Menu Button End -->
    </div>
    <!-- Mobile Buttons End -->
</div>
<div class="nav-shadow"></div>
