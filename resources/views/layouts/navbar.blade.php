  <nav class="main-header navbar navbar-expand border-bottom-0 navbar-dark  ">
  <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          {{-- <i class="far fa-bell"></i> --}}
            <i class="fas fa-user-alt    "></i>&nbsp;
            {{-- {{Auth::check()}} --}}
            @if (Auth::user())
                  {{ ucwords(Auth::user()->nama) }}
            @else
                Belum login
            @endif
            {{-- <i class="fas fa-user-alt    "></i>&nbsp; {{ ucwords(Auth::user()->username) }} --}}
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="dropdown-item dropdown-footer">Log Out</a>
          <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </div>
      </li>

    </ul>
  </nav>