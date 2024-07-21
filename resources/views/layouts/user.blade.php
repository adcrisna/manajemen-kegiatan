<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="#" type="image/x-icon" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/ionslider/ion.rangeSlider.min.js') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css') }}">
    @yield('css')
    <style>
        .badge-notif {
            position: relative;
            color: white;
        }

        .badge-notif[data-badge]:after {
            content: attr(data-badge);
            position: absolute;
            top: -10px;
            right: -10px;
            font-size: .7em;
            background: #e53935;
            color: white;
            width: 18px;
            height: 18px;
            text-align: center;
            line-height: 18px;
            border-radius: 50%;
        }
    </style>
</head>

<body class="hold-transition skin-yellow sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <a href="/user/home" class="logo">
                <span class="logo-mini"><b>User</b></span>
                <span class="logo-lg"><b>User</b></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Navigation</span>
                </a>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu">
                    <li>
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-home"></i> <span>Home</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-edit"></i>
                            <span>Data Kegiatan</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('user.penegakan_hukum') }}"><i class="fa fa-envelope"></i> Penegakan
                                    Hukum</a></li>
                            <li><a href="{{ route('user.pendampingan_hukum') }}"><i class="fa fa-envelope"></i>
                                    Pendampingan Hukum / LA</a>
                            </li>
                            <li><a href="{{ route('user.bantuan_hukum_litigasi') }}"><i class="fa fa-envelope"></i>
                                    Bantuan Hukum
                                    Litigasi</a></li>
                            <li><a href="{{ route('user.bantuan_hukum_non_litigasi') }}"><i class="fa fa-envelope"></i>
                                    Bantuan Hukum Non
                                    Litigasi</a></li>
                            <li><a href="{{ route('user.pendapat_hukum') }}"><i class="fa fa-envelope"></i> Pendapat
                                    Hukum</a></li>
                            <li><a href="{{ route('user.pelayanan_hukum') }}"><i class="fa fa-envelope"></i> Pelayanan
                                    Hukum</a></li>
                            <li><a href="{{ route('user.audit_hukum') }}"><i class="fa fa-envelope"></i> Audit
                                    Hukum</a></li>
                            <li><a href="{{ route('user.bantuan_hukum_lainnya') }}"><i class="fa fa-envelope"></i>
                                    Bantuan Hukum Lainnya</a>
                            </li>
                            <li><a href="{{ route('user.perjanjian_kerjasama') }}"><i class="fa fa-envelope"></i>
                                    Perjanjian Kerjasama /
                                    MoU</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('user.profile') }}">
                            <i class="fa fa-wrench"></i> <span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}">
                            <i class="fa fa-sign-out"></i> <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </section>
        </aside>
        <div class="content-wrapper">
            @yield('content')
        </div>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Build with <span class="fa fa-coffee"></span> And <span class="fa fa-heart"></b>
            </div>
            <strong>Copyright &copy; 2023 .</strong>
        </footer>
        <div class="control-sidebar-bg"></div>
    </div>
    <script src="{{ asset('adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="{{ asset('adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/fastclick/fastclick.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/app.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
    @yield('javascript')
</body>

</html>
