<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-warning">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link navbar-warning">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="Apis Melli" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Apis Melli</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->image ? asset('dist/img/'.Auth::user()->image) : asset('dist/img/user2-160x160.jpg') }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('user.show') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                {{-- <li
                    class="nav-item has-treeview {{ request()->is(['user', 'user/show', 'user/edit/*', 'user/password/edit']) ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ request()->is(['user', 'user/show', 'user/edit/*', 'user/password/edit']) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profile
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.show') }}"
                                class="nav-link {{ request()->is('user/show') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Diri</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.password.edit') }}"
                                class="nav-link {{ request()->is('user/password/edit') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Password</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ request()->is([
                        'bee',
                        'bee/create',
                        'bee/edit/*',
                        'bee/password/edit',
                        'bee/history',
                        ]) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is([
                            'bee',
                            'bee/create',
                            'bee/edit/*',
                            'bee/password/edit',
                            'bee/history',
                            ]) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Bee
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('bee.index') }}"
                                class="nav-link {{ request()->is('bee') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Index</p>
                            </a>
                        </li>
                        @admin
                        <li class="nav-item has-treeview {{ request()->is(['bee/history']) ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('bee/history') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                        Package
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('bee.history.index') }}"
                                        class="nav-link {{ request()->is('bee/history') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Index</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endadmin
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                        class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
