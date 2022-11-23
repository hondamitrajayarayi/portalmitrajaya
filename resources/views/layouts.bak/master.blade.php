
<!doctype html>
{{-- <html lang="en" data-layout="twocolumn" data-layout-style="default" data-layout-position="fixed" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-layout-width="fluid"> --}}
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
    <head>
        
        <meta charset="utf-8" />
        <title>@yield('title') | {{ config('app.name')}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0" viewport-fit=cover/>
        <meta content="Chatbot Indonesia" name="description" />
        <meta content="Lenna" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">

        <!-- Layout config Js -->
        <script src="{{ asset('assets/js/layout.js')}}"></script>
        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- custom Css-->
        <link href="{{ asset('assets/css/lenna.custom.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/daterangepicker.css')}}" />
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        @stack('styles')
    </head>

    <body>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
            @include('layouts.topbar')
</header>
            <!-- ========== App Menu ========== -->
            @include('layouts.sidebar')

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
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">@yield('title')</h4>
                        
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            {{-- <li class="breadcrumb-item">
                                                <a href="javascript: void(0);">Pages</a></li>
                                            <li class="breadcrumb-item active">Starter</li> --}}
                                        </ol>
                                    </div>
                        
                                </div>
                            </div>
                        </div>
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
                                <script>document.write(new Date().getFullYear())</script> © Ticketing System.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                   {{-- Copyright @2022 Lenna.ai --}}
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
        @stack('before-scripts')
        
        <!-- JAVASCRIPT -->
        
        {{-- <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script> --}}
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{ asset('assets/libs/feather-icons/feather.min.js')}}"></script>
        <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
        <script src="{{ asset('assets/js/plugins.js')}}"></script>

        <script type="text/javascript" src="{{ asset('assets/scripts/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('assets/scripts/daterangepicker.min.js')}}"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        {{-- <script type="text/javascript" src="{{ asset('assets/js/pages/form-validation.init.js')}}"></script> --}}
        <!-- App js -->
        @stack('center-scripts')

        <script src="{{ asset('assets/js/app.min.js')}}"></script>
        <script src="{{ asset('assets/js/app.js')}}"></script>
        
        @stack('scripts')

    </body>

</html>