<!doctype html>
<html lang="en" data-layout="horizontal" data-layout-style="" data-layout-position="fixed" data-topbar="light">

<head>

    <meta charset="utf-8" />
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Budgeting & Inventory System" name="description" />
    <meta content="IT Development" name="author" />
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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
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
                                    <div class="text-center">
                                        @if(Auth::user()->karyawan->id_bag_dept == '1')
                                        <lord-icon src="https://cdn.lordicon.com/nobciafz.json" trigger="loop" style="width:130px;height:130px">
                                        </lord-icon>
                                        @elseif(Auth::user()->karyawan->jk == 'L')
                                        <lord-icon src="https://cdn.lordicon.com/eszyyflr.json" trigger="loop" style="width:130px;height:130px">
                                        </lord-icon>
                                        @else
                                        <lord-icon src="https://cdn.lordicon.com/bwnhdkha.json" trigger="loop" style="width:130px;height:130px">
                                        </lord-icon>
                                        @endif
                                    </div>
                                    <h5 class="fs-16 mb-1 mt-0">{{ Auth::user()->name }}</h5>
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
        <div id="passwordModals" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content border-0 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-lg-12">
                            <div class="modal-body p-4">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/rqqkvjqf.json" trigger="loop" style="width:130px;height:130px">
                                    </lord-icon>
                                </div>
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Password reset</h5>
                                    {{-- <p class="text-muted">Your new password must be different from previous used password.</p> --}}
                                </div>

                                <div class="p-2">
                                    <form action="{{ route('reset.password') }}" method="POST" class="needs-validation">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">New Password <i class="text-danger">*</i></label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password" class="form-control pe-5 password-input" minlength="8" onpaste="return false" placeholder="Enter password" id="password-input" aria-describedby="passwordInput" required>
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i id="icon" class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                            <div id="message1" class="mb-3 mt-1">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="confirm-password-input">Confirm New Password <i class="text-danger">*</i></label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password" class="form-control pe-5 password-input" name="newpassword" onpaste="return false" placeholder="Confirm password" id="confirm-password-input" required>
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="confirm-password-input-addon"><i id="icon2" class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                            <div id="message" class="mb-3 mt-1">
                                            </div>
                                        </div>

                                        {{-- <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                            <h5 class="fs-13">Password must contain:</h5>
                                            <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b></p>
                                            <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter (a-z)</p>
                                            <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b> letter (A-Z)</p>
                                            <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)</p>
                                        </div> --}}


                                        <div class="mt-4" >
                                            <button class="btn btn-success w-100" id="button_password" disabled type="submit">Reset Password</button>
                                        </div>

                                    </form>
                                </div>
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
    {{-- <script src="{{ asset('assets/js/pages/passowrd-create.init.js') }}"></script> --}}
    @stack('scripts')
    @if (session('message-password'))
        <script>
            Toastify({
                text: "Password Berhasil Diubah!",
                duration: 3000,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #0ab39c, #2982aa)",
                },
                //onClick: function(){} // Callback after click
            }).showToast();
        </script>
    @endif
</body>

</html>
