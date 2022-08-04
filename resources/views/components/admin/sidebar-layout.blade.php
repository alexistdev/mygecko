<div>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{route('adm.dashboard')}}" class="brand-link">
            <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">My-Gecko</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
        @if(Auth::user()->role_id == 1)
            <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                             alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{route('adm.dashboard')}}" class="d-block">Administrator</a>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="{{route('adm.dashboard')}}" @class(['nav-link', 'active' => $menuUtama == 'dashboard'])>
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li @class(['nav-item', 'menu-open' => $menuUtama == 'master'])>
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Master Data
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('adm.master.user')}}" @class(['nav-link', 'active' => $menuKedua == 'user'])>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('adm.master.gejala')}}" @class(['nav-link', 'active' => $menuKedua == 'gejala'])>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Gejala</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('adm.master.penyakit')}}" @class(['nav-link', 'active' => $menuKedua == 'penyakit'])>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Penyakit</p>
                                    </a>
                                </li>
                                {{--                            <li class="nav-item">--}}
                                {{--                                <a href="" @class(['nav-link', 'active' => $menuKedua == 'menu'])>--}}
                                {{--                                    <i class="far fa-circle nav-icon"></i>--}}
                                {{--                                    <p>Rule</p>--}}
                                {{--                                </a>--}}
                                {{--                            </li>--}}
                            </ul>
                        </li>
                        {{--                    <li class="nav-item">--}}
                        {{--                        <a href="#" class="nav-link">--}}
                        {{--                            <i class="nav-icon fas fa-chart-pie"></i>--}}
                        {{--                            <p>--}}
                        {{--                                Report--}}
                        {{--                                <i class="right fas fa-angle-left"></i>--}}
                        {{--                            </p>--}}
                        {{--                        </a>--}}
                        {{--                        <ul class="nav nav-treeview">--}}
                        {{--                            <li class="nav-item">--}}
                        {{--                                <a href="{{route('adm.penjualan')}}" class="nav-link">--}}
                        {{--                                    <i class="far fa-circle nav-icon"></i>--}}
                        {{--                                    <p>Penjualan</p>--}}
                        {{--                                </a>--}}
                        {{--                            </li>--}}
                        {{--                        </ul>--}}
                        {{--                    </li>--}}
                        {{--                    <li class="nav-item">--}}
                        {{--                        <a href="#" class="nav-link">--}}
                        {{--                            <i class="nav-icon fas fa-comment"></i>--}}
                        {{--                            <p>--}}
                        {{--                                Support Ticket--}}
                        {{--                                <i class="fas fa-angle-left right"></i>--}}
                        {{--                            </p>--}}
                        {{--                        </a>--}}
                        {{--                        <ul class="nav nav-treeview">--}}
                        {{--                            <li class="nav-item">--}}
                        {{--                                <a href="{{route('adm.inbox')}}" class="nav-link">--}}
                        {{--                                    <i class="far fa-circle nav-icon"></i>--}}
                        {{--                                    <p>Inbox</p>--}}
                        {{--                                </a>--}}
                        {{--                            </li>--}}
                        {{--                            <li class="nav-item">--}}
                        {{--                                <a href="{{route('adm.outbox')}}" class="nav-link">--}}
                        {{--                                    <i class="far fa-circle nav-icon"></i>--}}
                        {{--                                    <p>Outbox</p>--}}
                        {{--                                </a>--}}
                        {{--                            </li>--}}

                        {{--                        </ul>--}}
                        {{--                    </li>--}}

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            @else
            <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                             alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{route('usr.dashboard')}}" class="d-block">User</a>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="{{route('usr.dashboard')}}" @class(['nav-link', 'active' => $menuUtama == 'dashboard'])>
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('user.caramerawat')}}" @class(['nav-link', 'active' => $menuUtama == 'caramerawat'])>
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Cara Merawat
                                </p>
                            </a>
                        </li>

{{--                        <li @class(['nav-item', 'menu-open' => $menuUtama == 'master'])>--}}
{{--                            <a href="#" class="nav-link">--}}
{{--                                <i class="nav-icon fas fa-copy"></i>--}}
{{--                                <p>--}}
{{--                                    Master Data--}}
{{--                                    <i class="fas fa-angle-left right"></i>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                            <ul class="nav nav-treeview">--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{route('adm.master.user')}}" @class(['nav-link', 'active' => $menuKedua == 'user'])>--}}
{{--                                        <i class="far fa-circle nav-icon"></i>--}}
{{--                                        <p>Users</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{route('adm.master.gejala')}}" @class(['nav-link', 'active' => $menuKedua == 'gejala'])>--}}
{{--                                        <i class="far fa-circle nav-icon"></i>--}}
{{--                                        <p>Gejala</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{route('adm.master.penyakit')}}" @class(['nav-link', 'active' => $menuKedua == 'penyakit'])>--}}
{{--                                        <i class="far fa-circle nav-icon"></i>--}}
{{--                                        <p>Penyakit</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                                            <li class="nav-item">--}}
{{--                                                                <a href="" @class(['nav-link', 'active' => $menuKedua == 'menu'])>--}}
{{--                                                                    <i class="far fa-circle nav-icon"></i>--}}
{{--                                                                    <p>Rule</p>--}}
{{--                                                                </a>--}}
{{--                                                            </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                                            <li class="nav-item">--}}
{{--                                                <a href="#" class="nav-link">--}}
{{--                                                    <i class="nav-icon fas fa-chart-pie"></i>--}}
{{--                                                    <p>--}}
{{--                                                        Report--}}
{{--                                                        <i class="right fas fa-angle-left"></i>--}}
{{--                                                    </p>--}}
{{--                                                </a>--}}
{{--                                                <ul class="nav nav-treeview">--}}
{{--                                                    <li class="nav-item">--}}
{{--                                                        <a href="{{route('adm.penjualan')}}" class="nav-link">--}}
{{--                                                            <i class="far fa-circle nav-icon"></i>--}}
{{--                                                            <p>Penjualan</p>--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                </ul>--}}
{{--                                            </li>--}}
{{--                                            <li class="nav-item">--}}
{{--                                                <a href="#" class="nav-link">--}}
{{--                                                    <i class="nav-icon fas fa-comment"></i>--}}
{{--                                                    <p>--}}
{{--                                                        Support Ticket--}}
{{--                                                        <i class="fas fa-angle-left right"></i>--}}
{{--                                                    </p>--}}
{{--                                                </a>--}}
{{--                                                <ul class="nav nav-treeview">--}}
{{--                                                    <li class="nav-item">--}}
{{--                                                        <a href="{{route('adm.inbox')}}" class="nav-link">--}}
{{--                                                            <i class="far fa-circle nav-icon"></i>--}}
{{--                                                            <p>Inbox</p>--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li class="nav-item">--}}
{{--                                                        <a href="{{route('adm.outbox')}}" class="nav-link">--}}
{{--                                                            <i class="far fa-circle nav-icon"></i>--}}
{{--                                                            <p>Outbox</p>--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}

{{--                                                </ul>--}}
{{--                                            </li>--}}

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            @endif
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
