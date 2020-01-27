<aside class="main-sidebar elevation-4 sidebar-light-warning">
  {{--navbar-warning--}}
  <a href="{{ route('home') }}"
     class="brand-link">
    <img src="{{ asset('dist/img/ApisMelli.png') }}" alt="Apis Melli" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Apis Melli</span>
  </a>

  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img
            src="{{ \Illuminate\Support\Facades\Auth::user()->image ? asset('dist/img/'.\Illuminate\Support\Facades\Auth::user()->image) : asset('dist/img/user.png') }}"
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
              @lang('menu.home')
            </p>
          </a>
        </li>
        @admin
        <li class="nav-item">
          <a href="{{ route('user.index') }}"
             class="nav-link {{ request()->is(['user', 'user/*']) ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              @lang('menu.list') @lang('menu.user.index')
              @if($users)
                <span class="badge badge-info right">{{ $users }}</span>
              @endif
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('bee.index') }}"
             class="nav-link {{ request()->is(['bee', 'bee/*']) ? 'active' : '' }}">
            <i class="nav-icon fas fa-box-open"></i>
            <p>
              @lang('menu.stup')
              @if($countStup)
                <span class="badge badge-success right">{{ $countStup }}</span>
              @endif
            </p>
          </a>
        </li>
        @endadmin
        <li class="nav-item">
          <a href="{{ route('ledger.index') }}"
             class="nav-link {{ request()->is(['ledger', 'ledger/*']) ? 'active' : '' }}">
            <i class="nav-icon fas fa-book-open"></i>
            <p>
              @lang('menu.ledger')
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('withdraw.index') }}"
             class="nav-link {{ request()->is(['withdraw', 'withdraw/*']) ? 'active' : '' }}">
            <i class="nav-icon fas fa-cash-register"></i>
            <p>
              @lang('menu.withdraw')
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('binary.index') }}"
             class="nav-link {{ request()->is(['binary', 'binary/*']) ? 'active' : '' }}">
            <i class="nav-icon fas fa-network-wired"></i>
            <p>
              @lang('menu.binary')
            </p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
