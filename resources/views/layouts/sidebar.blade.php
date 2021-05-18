<aside class="main-sidebar   sidebar-dark-olive">
    <a href="/" class="brand-link">
        <img src="/dist/img/Logo.png" alt="AdminLTE Logo" class="brand-image img-size-32">
        <span class="brand-text font-weight-light">SI APOTEK <strong>ALBA</strong></span>
    </a>

     <div class="sidebar nav-compact ">
         <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Dashboard</li>
                <x-navitem
                    to="/dashboard"
                    active="{{ (request()->is('dashboard*')) ? 'active' : '' }}"
                    icon="fas fa-tachometer-alt"
                    judul="Dashboard"
                />
                @switch(Auth::user()->akses)
                    @case('1')
                    @case('2')
                            @include('layouts.sidebaradmin')
                        @break
                    @case('3')
                            @include('layouts.sidebaruser')
                        @break
                    @case('4')
                            @include('layouts.sidebarkasir')
                        @break
                @endswitch

             </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
