<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $title }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert/sweetalert.css') }}" type="text/css">
    <link href="{{ asset('assets/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @stack('style')
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon"></div>
                <div class="sidebar-brand-text mx-3">SILMI FASHION <sup>PAYROLL TAILOR</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->is('gaji-penjahit/dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url()->to('/gaji-penjahit/dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ request()->is('gaji-penjahit/data-master*') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-database"></i>
                    <span>Data Master</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded ">
                        <a class="collapse-item {{ request()->is('gaji-penjahit/data-master/jahit*') ? 'active' : '' }}"
                            href="{{ url()->to('/gaji-penjahit/data-master/jahit') }}">Data Jahit</a>
                        <a class="collapse-item {{ request()->is('gaji-penjahit/data-master/kebutuhan-jahit*') ? 'active' : '' }}"
                            href="{{ url()->to('/gaji-penjahit/data-master/kebutuhan-jahit') }}">Data Kebutuhan
                            Jahit</a>
                        <a class="collapse-item {{ request()->is('gaji-penjahit/data-master/karyawan*') ? 'active' : '' }}"
                            href="{{ url()->to('/gaji-penjahit/data-master/karyawan') }}">Data Karyawan</a>
                    </div>
                </div>
            </li>


            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item {{ request()->is('gaji-penjahit/pengaturan*') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-wrench"></i>
                    <span>Pengaturan</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ request()->is('gaji-penjahit/pengaturan/kompensasi-kasus*') ? 'active' : '' }}"
                            href="{{ url()->to('/gaji-penjahit/pengaturan/kompensasi-kasus') }}">Kompensasi Kasus</a>
                        <a class="collapse-item {{ request()->is('gaji-penjahit/pengaturan/kompensasi-total-jahit*') ? 'active' : '' }}"
                            href="{{ url()->to('/gaji-penjahit/pengaturan/kompensasi-total-jahit') }}">Kompensasi Total
                            Jahit</a>
                    </div>
                </div>
            </li>

            <li class="nav-item {{ request()->is('gaji-penjahit/entri-data-gaji*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url()->to('/gaji-penjahit/entri-data-gaji') }}">
                    <i class="fas fa-list"></i>
                    <span>Entri Data Gaji</span>
                </a>
            </li>

            <li class="nav-item {{ request()->is('gaji-penjahit/gaji*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url()->to('/gaji-penjahit/gaji') }}">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Take Home</span>
                </a>
            </li>

            <li class="nav-item {{ request()->is('gaji-penjahit/laporan*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url()->to('/gaji-penjahit/laporan') }}">
                    <i class="fas fa-table"></i>
                    <span>Laporan</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger count"></span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Evaluasi Bulan Ini
                                </h6>
                                <div class="dropdown-menuu">
                                </div>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hallo , Silmi</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <footer class="sticky-footer bg-white mt-3 mb-2">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Aplikasi Payroll Copyright &copy; 2022 - {{ date('Y') }} init by Aris Wahyudi</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apa Anda Yakin Keluar ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih Tombol Logout Untuk Keluar Sistem Ini</div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="{{ url()->to('/home') }}">Logout</a>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
    @stack('script')
</body>
