<aside class="main-sidebar elevation-4 sidebar-light-warning">
    <a href="{{ route('home') }}"
       class="brand-link navbar-warning">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="Apis Melli" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Apis Melli</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img
                    src="{{ \Illuminate\Support\Facades\Auth::user()->image ? asset('dist/img/'.\Illuminate\Support\Facades\Auth::user()->image) : asset('dist/img/user2-160x160.jpg') }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('user.show', base64_encode(\Illuminate\Support\Facades\Auth::user()->id)) }}"
                   class="d-block">
                    <i id="online" class="fas fa-circle text-success"></i>
                    {{ \Illuminate\Support\Facades\Auth::user()->name}}
                </a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('bee.index') }}"
                       class="nav-link {{ request()->is(['bee', 'bee/*']) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Stup
                            @if($countStup)
                                <span class="badge badge-success right">{{ $countStup }}</span>
                            @endif
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('ledger.index') }}"
                       class="nav-link {{ request()->is(['ledger', 'ledger/*']) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>
                            Ledger
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('withdraw.index') }}"
                       class="nav-link {{ request()->is(['withdraw', 'withdraw/*']) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>
                            Withdraw
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('binary.index') }}"
                       class="nav-link {{ request()->is(['binary', 'binary/*']) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-network-wired"></i>
                        <p>
                            Binary
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
