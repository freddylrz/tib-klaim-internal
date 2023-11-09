<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/favicon/tib1.ico') }}" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>KLAIM APP</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
       @stack('levelPluginsJsh')
    <!-- END PAGE LEVEL SCRIPTS -->
</head>

@guest

    <body class="hold-transition login-page">
    @else

        <body class="hold-transition skin-green fixed sidebar-mini">
        @endguest

        <!-- Site wrapper -->
        @guest
            @yield('content')
        @else
            <!-- Site wrapper -->
            <div class="wrapper">
                <!-- Navbar -->
                <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                    class="fas fa-bars"></i></a>
                        </li>
                    </ul>

                    <!-- Right navbar links -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <i class="far fa-user mr-1"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="fas fa-moon mr-2"></i> Dark Mode
                                    <span class="float-right text-muted text-sm">
                                        <input type="checkbox" class="nav-link" id="modeToggle" name="my-checkbox"
                                            onclick="toggleFunction()" value="1" data-bootstrap-switch
                                            data-off-color="light" data-on-color="gray-dark"
                                            data-on="<i class='fa fa-moon'></i>" data-off="<i class='fa fa-sun'">
                                    </span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();""
                                    class="dropdown-item">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- /.navbar -->

                <!-- Main Sidebar Container -->
                <aside class="main-sidebar sidebar-dark-primary elevation-4">
                    <!-- Brand Logo -->
                    <a href="/" class="brand-link bg-light">
                        <img src="{{ asset('img/tib1.png') }}" alt="AdminLTE Logo" class="brand-image img-circle"
                            style="opacity: .8">
                        <span class="brand-text font-weight-light">TUGUBRO</span>
                    </a>

                    <!-- Sidebar -->
                    <div class="sidebar">
                        <!-- Sidebar user (optional) -->
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                            <div class="image">
                                <img src="{{ asset('img/user.png') }}" class="img-circle elevation-2 bg-white"
                                    alt="User Image">
                            </div>
                            <div class="info">
                                <a href="/" class="d-block">
                                    {{ Auth::user()->name }}
                                </a>
                            </div>
                        </div>

                        <!-- Sidebar Menu -->
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column text-uppercase" data-widget="treeview"
                                role="menu" data-accordion="false">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-home"></i>
                                        <p>
                                            Dashboard
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item {{{ Request::is('claim/list','claim/input') ? 'active' : '' }}}">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-book"></i>
                                        <p>
                                            Klaim Data
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item {{{ Request::is('claim/list') ? 'active' : '' }}}">
                                            <a href="/claim/list" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>List Data</p>
                                            </a>
                                        </li>
                                        <li class="nav-item {{{ Request::is('claim/input') ? 'active' : '' }}}">
                                            <a href="/claim/input" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Input Data</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-database"></i>
                                        <p>
                                            Utility
                                        </p>
                                        <i class="right fas fa-angle-left"></i>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Cause Of Loss</p>
                                                <i class="right fas fa-angle-left "></i>
                                            </a>
                                            <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="/utility/col/list" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>list</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/utility/col/input" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Input</p>
                                            </a>
                                        </li>

                                    </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Loss Adjuster</p>
                                                <i class="right fas fa-angle-left"></i>
                                            </a>
                                             <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="/utility/lar/list" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>list</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/utility/lar/input" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Input</p>
                                            </a>
                                        </li>

                                    </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Workshop</p>
                                                <i class="right fas fa-angle-left"></i>
                                            </a>

                                        <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="/utility/ws/list" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>list</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/utility/ws/input" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Input</p>
                                            </a>
                                        </li>

                                    </ul>
                                    </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-archive"></i>
                                        <p>
                                            Data Rekap Klaim
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-building"></i>
                                        <p>
                                            Klaim BNI
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <!-- /.sidebar-menu -->
                    </div>
                    <!-- /.sidebar -->
                </aside>

                   <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- /.content-wrapper -->

                <footer class="main-footer">
                    <strong>Copyright &copy; <span id="year"></span> Tugu Insurance Broker
                </footer>
                <script>
                    document.getElementById("year").innerHTML = new Date().getFullYear();
                </script>

                <!-- Control Sidebar -->
                <aside class="control-sidebar control-sidebar-dark">
                    <!-- Control sidebar content goes here -->
                </aside>
                <!-- /.control-sidebar -->
            </div>
            <!-- ./wrapper -->
        @endguest

        <!-- jQuery -->
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Bootstrap switch -->
        <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        @stack('levelPluginsJs')
        <!-- END PAGE LEVEL SCRIPTS -->
        <script>
            $(function() {
                // Initialize the switch based on the stored dark mode state
                var darkModeState = localStorage.getItem('darkModeState');
                if (darkModeState === 'true') {
                    $('#modeToggle').bootstrapSwitch('state', true);
                    $('body').addClass('dark-mode');
                } else {
                    $('#modeToggle').bootstrapSwitch('state', false);
                    $('body').removeClass('dark-mode');
                }

                // Handle the switch change event
                $('#modeToggle').on('switchChange.bootstrapSwitch', function(event, state) {
                    if (state) {
                        $('body').addClass('dark-mode');
                    } else {
                        $('body').removeClass('dark-mode');
                    }

                    // Store the dark mode state in localStorage
                    localStorage.setItem('darkModeState', state);
                });
            });
        </script>
    </body>

</html>
