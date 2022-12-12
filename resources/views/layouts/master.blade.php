<!doctype html>
<html lang="en" data-layout="horizontal" data-layout-style="" data-layout-position="fixed" data-topbar="light">

<head>

    <meta charset="utf-8" />
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- plugin css -->
    <link href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://kit.fontawesome.com/bdc70a6d76.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/multi.js/multi.min.css') }}" />
    @stack('styles')
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <div id="profileModals" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content border-0 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-lg-12">
                            <div class="modal-body p-4">
                                <div class="text-center mb-3 mt-1">
                                    <div class="profile-user position-relative d-inline-block mx-auto  mb-3">
                                        <div class="avatar-xl img-thumbnail rounded-circle flex-shrink-0 mb-0">
                                            <div class="avatar-title border bg-soft-info text-info rounded-circle text-uppercase fs-1">
                                                <?php 
                                                    $s = Auth::user()->name;
                
                                                    if(preg_match_all('/\b(\w)/',strtoupper($s),$m)) {
                                                        $v = implode('',$m[1]); 
                                                    }
                
                                                    echo $v;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="fs-16 mb-1">{{ Auth::user()->name }}</h5>
                                    <p class="text-muted mb-0">{{ Auth::user()->karyawan->jabatan->nama_jabatan }} {{ Auth::user()->karyawan->departemen->nama_dept }}</p>
                                </div>
                                <ul class="list-group">
                                    <li class="list-group-item"><i class="ri-user-line align-middle me-2 fs-15"></i> {{ Auth::user()->username }}</li>
                                    <li class="list-group-item"><i class="ri-mail-line align-middle me-2 fs-15"></i> {{ Auth::user()->email }}</li>
                                    <li class="list-group-item"><i class="ri-mind-map align-middle me-2 fs-15"></i>SCHEMA {{ Auth::user()->karyawan->cabang->schema_name }}</li>
                                    <li class="list-group-item"><i class="ri-building-4-line align-middle me-2 fs-15"></i>{{ Auth::user()->karyawan->cabang->branch_name }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        @include('layouts.header')
        <!-- ========== App Menu ========== -->
        @include('layouts.menubar')
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    @yield('content')
                    <!-- end page title -->


                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © IT Development.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Honda Mitrajaya | Intranet
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!-- JAVASCRIPT -->
    @stack('before-scripts')
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset('assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('assets/js/pages/dashboard-analytics.init.js') }}"></script>
    @stack('center-scripts')
    <!-- App js -->
    
    <script src="{{ asset('assets/js/app2.js') }}"></script>
    @stack('scripts')
</body>

</html>
