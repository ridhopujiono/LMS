<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf_token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>LMSSESPIM | {{$title}}</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{asset('dashboard/dist/assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('dashboard/dist/assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('dashboard/dist/assets/vendors/themify-icons/css/themify-icons.css')}}" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="{{asset('dashboard/dist/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="{{asset('dashboard/dist/assets/css/main.min.css')}}" rel="stylesheet" />
    <link rel="shortcut icon" href="{{url('admin/sespimmen/logo-sespim.ico')}}" type="image/x-icon">
    <!-- PAGE LEVEL STYLES-->
</head>
<style>
    .side-menu>li a:focus,
    .side-menu>li a:hover {
        color: #fff;
        background-color: #efdc35;
    }

    .side-menu>li.active>a,
    .side-menu>li.active>a:focus,
    .side-menu>li.active>a:hover {
        color: #fff;
        background-color: #efdc35;
    }

    .side-menu li a.active {
        color: #fff;
        background-color: #EFDC35;
    }

    .side-menu li a.active2 {
        color: #fff;
        background-color: #ee2a2a;
    }

    .sidebar-mini .side-menu>li:hover>a {
        background-color: #efdc35;
        color: #fff;
    }

    .items-account {
        display: none;
    }

    @media only screen and (max-width: 768px) {
        .nav-account {
            display: none;
        }

        .items-account {
            display: block;
        }

        #sespim-watermark {
            -moz-opacity: 0;
            opacity: 0;
        }
    }
</style>

<body class="fixed-navbar">

    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand">
                <a class="link text-center" href="">
                    <div class="brand">LMS SESPIM </div>
                    <span class="brand-mini">LMS</span>
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar" id="hamburger-icons">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar nav-account">
                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown" style="text-transform: capitalize;">
                            <img src="{{asset('admin/sespimmen/foto_gadik/user_default.png')}}" style="border-radius: 50%;" />
                            <span></span>{{auth()->user()->level}} ({{auth()->user()->bagian}})<i class="fa fa-angle-down m-l-5"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="fa fa-user"></i>Profile</a>
                            <a class="dropdown-item" href="#"><i class="fa fa-cog"></i>Settings</a>
                            <a class="dropdown-item" href="javascript:;"><i class="fa fa-support"></i>Support</a>
                            <li class="dropdown-divider"></li>
                            <a class="dropdown-item" href="{{url('logout')}}"><i class="fa fa-power-off"></i>Logout</a>
                        </ul>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img src="{{asset('admin/sespimmen/foto_gadik/user_default.png')}}" width="45px" height="45px" style="border-radius: 50%;" />
                    </div>
                    <div class="admin-info">
                        <div class="font-strong">{{auth()->user()->name}}</div><small></small>
                    </div>
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a class="{{ request()->is('sespimmen') ? 'active' : ''}}" href="{{url('sespimmen')}}"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">BERANDA</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{url('gadik')}}" class="{{ request()->is('gadik') ? 'active' : ''}} {{ request()->is('serdik_sespimmen') ? 'active' : ''}} {{ request()->is('pokjar_sespimmen') ? 'active' : ''}} {{ request()->is('agenda_sespimmen') ? 'active' : ''}} {{ request()->is('kurikulum_sespimmen') ? 'active' : ''}} {{ request()->is('kirim_pesan_sespimmen') ? 'active' : ''}}"><i class="sidebar-item-icon fa fa-book"></i>
                            <span class="nav-label">ADMINISTRASI</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse {{ request()->is('gadik') ? 'in' : ''}} {{ request()->is('serdik_sespimmen') ? 'in' : ''}} {{ request()->is('pokjar_sespimmen') ? 'in' : ''}} {{ request()->is('agenda_sespimmen') ? 'in' : ''}} {{ request()->is('kurikulum_sespimmen') ? 'in' : ''}} {{ request()->is('kirim_pesan_sespimmen') ? 'in' : ''}}">
                            <li>
                                <a class="{{ request()->is('gadik') ? 'active' : ''}}" href="{{url('gadik')}}"><i class="sidebar-item-icon fa fa-user"></i>DATA GADIK</a>
                            </li>

                            <li>
                                <a href="javascript:;" class="{{ request()->is('serdik_sespimmen') ? 'active' : ''}} {{ request()->is('pokjar_sespimmen') ? 'active' : ''}}">
                                    <span class="nav-label"><i class="sidebar-item-icon fa fa-users"></i>DATA SERDIK</span><i class="fa fa-angle-left arrow"></i></a>
                                <ul class="nav-3-level collapse {{ request()->is('serdik_sespimmen') ? 'in' : ''}} {{ request()->is('pokjar_sespimmen') ? 'in' : ''}} ">
                                    <li>
                                        <a href="{{url('serdik_sespimmen')}}" class="{{ request()->is('serdik_sespimmen') ? 'active' : ''}}"><i class="sidebar-item-icon fa fa-user"></i>SERDIK</a>
                                    </li>
                                    <li>
                                        <a href="{{url('pokjar_sespimmen')}}" class="{{ request()->is('pokjar_sespimmen') ? 'active' : ''}}"><i class="sidebar-item-icon fa fa-users"></i>POKJAR</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="{{url('agenda_sespimmen')}}" class="{{ request()->is('agenda_sespimmen') ? 'active' : ''}}" style="font-size: 13px;"><i class="sidebar-item-icon fa fa-table "></i>KALENDER PENDIDIKAN</a>
                            </li>
                            <li>
                                <a href="{{url('kurikulum_sespimmen')}}" class="{{ request()->is('kurikulum_sespimmen') ? 'active' : ''}}"><i class="sidebar-item-icon fa fa-list"></i>KURIKULUM</a>
                            </li>
                            <li>
                                <a href="javascript:;" class="{{ request()->is('lihat_pesan_sespimmen') ? 'active' : ''}} {{ request()->is('kirim_pesan_sespimmen') ? 'active' : ''}}">
                                    <span class="nav-label"><i class="sidebar-item-icon fa fa-envelope"></i>PESAN</span><i class="fa fa-angle-left arrow"></i></a>
                                <ul class="nav-3-level collapse {{ request()->is('lihat_pesan_sespimmen') ? 'in' : ''}} {{ request()->is('kirim_pesan_sespimmen') ? 'in' : ''}} ">
                                    <li>
                                        <a href="{{url('lihat_pesan_sespimmen')}}" class="{{ request()->is('lihat_pesan_sespimmen') ? 'active' : ''}}"><i class="sidebar-item-icon fa fa-list"></i>LIHAT PESAN</a>
                                    </li>
                                    <li>
                                        <a href="{{url('kirim_pesan_sespimmen')}}" class="{{ request()->is('kirim_pesan_sespimmen') ? 'active' : ''}}"><i class="sidebar-item-icon fa fa-pencil"></i>KIRIM PESAN</a>
                                    </li>
                                </ul>
                            </li>


                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" class="{{ request()->is('mata_kuliah_sespimmen') ? 'active' : ''}} {{ request()->is('materi_belajar_sespimmen') ? 'active' : ''}} {{ request()->is('jadwal_belajar_sespimmen') ? 'active' : ''}}{{ request()->is('tugas_belajar_sespimmen') ? 'active' : ''}} {{ request()->is('tugas_akhir_sespimmen') ? 'active' : ''}} {{ request()->is('kelas_virtual_sespimmen') ? 'active' : ''}} {{ request()->is('bimbingan_sespimmen') ? 'active' : ''}} {{ request()->is('index_penilaian_sespimmen') ? 'active' : ''}}"><i class="sidebar-item-icon fa fa-graduation-cap"></i>
                            <span class="nav-label">PERKULIAHAN</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse {{ request()->is('mata_kuliah_sespimmen') ? 'in' : ''}} {{ request()->is('materi_belajar_sespimmen') ? 'in' : ''}} {{ request()->is('jadwal_belajar_sespimmen') ? 'in' : ''}} {{ request()->is('tugas_belajar_sespimmen') ? 'in' : ''}}  {{ request()->is('tugas_akhir_sespimmen') ? 'in' : ''}} {{ request()->is('kelas_virtual_sespimmen') ? 'in' : ''}} {{ request()->is('bimbingan_sespimmen') ? 'in' : ''}} {{ request()->is('index_penilaian_sespimmen') ? 'in' : ''}}">
                            <li>
                                <a href="{{url('mata_kuliah_sespimmen')}}" class="{{ request()->is('mata_kuliah_sespimmen') ? 'active' : ''}}"><i class="sidebar-item-icon fa fa-file-text-o"></i>MATA PELAJARAN</a>
                            </li>
                            <li>
                                <a href="{{url('materi_belajar_sespimmen')}}" class="{{ request()->is('materi_belajar_sespimmen') ? 'active' : ''}}"><i class="sidebar-item-icon fa fa-list-alt "></i>MATERI BELAJAR</a>
                            </li>
                            <li>
                                <a href="{{url('jadwal_belajar_sespimmen')}}" class="{{ request()->is('jadwal_belajar_sespimmen') ? 'active' : ''}}"><i class="sidebar-item-icon fa fa-table"></i>JADWAL KULIAH</a>
                            </li>


                            <li>
                                <a href="{{url('tugas_belajar_sespimmen')}}" class="{{ request()->is('tugas_belajar_sespimmen') ? 'active' : ''}}"><i class="sidebar-item-icon fa fa-list"></i>TUGAS BELAJAR</a>
                            </li>
                            <li>
                                <a href="{{url('bimbingan_sespimmen')}}" class="{{ request()->is('bimbingan_sespimmen') ? 'active' : ''}}"><i class="sidebar-item-icon fa fa-users"></i>BIMBINGAN</a>
                            </li>
                            <li>
                                <a href="{{url('kelas_virtual_sespimmen')}}" class="{{ request()->is('kelas_virtual_sespimmen') ? 'active' : ''}}"><i class="sidebar-item-icon fa fa-list"></i>KELAS VIRTUAL</a>
                            </li>
                            <li>
                                <a href="{{url('tugas_akhir_sespimmen')}}" class="{{ request()->is('tugas_akhir_sespimmen') ? 'active' : ''}}"><i class="sidebar-item-icon fa fa-file-o"></i>TUGAS AKHIR</a>
                            </li>
                            <li>
                                <a href="{{url('index_penilaian_sespimmen')}}" class="{{ request()->is('index_penilaian_sespimmen') ? 'active' : ''}}"><i class="sidebar-item-icon fa fa-pencil"></i>PENILAIAN</a>
                            </li>


                        </ul>
                    </li>
                    <li>
                        <a class="" href="https://sespimpolri.moco.co.id" target="_blank"><i class="sidebar-item-icon fa fa-tablet"></i>
                            <span class="nav-label">E - LIBRARY</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('sop_sespimmen') ? 'active' : ''}}" href="{{url('sop_sespimmen')}}"><i class="sidebar-item-icon fa fa-calendar-o"></i>
                            <span class="nav-label">SOP LMS</span>
                        </a>
                    </li>
                    <li class="items-account">
                        <a href="{{url('sespimmen')}}" class=""><i class="sidebar-item-icon fa fa-user"></i>
                            <span class="nav-label">AKUN</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href=""><i class="sidebar-item-icon fa fa-user"></i>PROFILE</a>
                            </li>

                            <li>
                                <a href=""><i class="sidebar-item-icon fa fa-cog"></i>SETTING</a>
                            </li>
                            <li>
                                <a href=""><i class="sidebar-item-icon fa fa-support"></i>SUPPORT</a>
                            </li>
                            <li>
                                <a href="{{url('logout')}}"><i class="sidebar-item-icon fa fa-power-off"></i>LOGOUT</a>
                            </li>


                        </ul>
                    </li>

                    <li style="bottom: 0;
                    position: fixed;
                    width: 220px;" id="sespim-watermark">
                        <a class="active2 text-center" href="">
                            <span class="nav-label"> <b>SESPIMMEN</b> </span>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
        @if(session('is_admin_session'))
        <script>
            alert('Maaf, fitur hanya tersedia untuk admin');
        </script>
        @endif
        <!-- END SIDEBAR-->
        @yield('content')
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->

    <script src="{{asset('dashboard/dist/assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('dashboard/dist/assets/vendors/metisMenu/dist/metisMenu.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('dashboard/dist/assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="{{asset('dashboard/dist/assets/vendors/chart.js/dist/Chart.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('dashboard/dist/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('dashboard/dist/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}" type="text/javascript"></script>
    <script src="{{asset('dashboard/dist/assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js')}}" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="{{asset('dashboard/dist/assets/js/app.min.js')}}" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script src="{{asset('dashboard/dist/assets/js/scripts/dashboard_1_demo.js')}}" type="text/javascript"></script>


    <script>
        let flag = false;
        $("#hamburger-icons").on('click', function() {
            if (flag) {
                $("#sespim-watermark").css('display', 'block');
                flag = false;
            } else {
                $("#sespim-watermark").css('display', 'none');
                flag = true;

            }
        });
    </script>

</body>

</html>