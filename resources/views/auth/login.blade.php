<!doctype html>
{{-- <html lang="en" data-topbar="light" data-sidebar-image="none"> --}}
    <html lang="en" data-layout="horizontal" data-layout-style="" data-layout-position="fixed" data-topbar="light">

<head>
    <meta charset="utf-8" />
    <title>Sign In | Intranet Mitra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="http://velzon.laravel-default.themesbrand.com/assets/images/favicon.ico">
    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/css/lenna.custom.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>


<div class="auth-page-wrapper pt-5">
    <!-- auth page bg -->
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        {{-- <div>
                            <a href="index" class="d-inline-block auth-logo">
                                <img src="http://velzon.laravel-default.themesbrand.com/assets/images/logo-light.png" alt="" height="20">
                            </a>
                        </div> --}}
                        {{-- <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p> --}}
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5 mt-3">
                    <div class="card mt-3">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p class="text-muted">Sign in to continue to system.</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    {{-- <input type="hidden" name="_token" value="GRnh6IhvowqWwRofYQN8ZcmpUSfR71R3UCjdubxi"> --}}
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" oninput="this.value = this.value.toUpperCase()" id="username"
                                            name="username" placeholder="Enter username">
                                    </div>

                                    <div class="mb-6">
                                        <div class="float-end">
                                            {{-- <a href="auth-pass-reset-basic" class="text-muted">Forgot password?</a> --}}
                                        </div>
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 " autocomplete="off"
                                                name="password" placeholder="Enter password" id="password-input">
                                            <button
                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted"
                                                type="button" id="password-addon"><i
                                                    class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>

                                    

                                    <div class="mt-4">
                                        <br>
                                        <button class="btn btn-success w-100" id="btnSubmit" type="submit">Sign In</button>
                                        <div id="loading" style="display:none;">
                                            <button type="button" class="btn btn-success w-100 btn-load" disabled>
                                                <span class="d-flex align-items-center">
                                                    <span class="spinner-border flex-shrink-0" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </span>
                                                    <span class="flex-grow-1 ms-2">
                                                        Loading...
                                                    </span>
                                                </span>
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="mt-4 text-center">
                        {{-- <p class="mb-0">Don't have an account ? <a href="register" class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p> --}}
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">&copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script> Honda Mitrajaya | Intranet
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>

{{-- <script src="http://velzon.laravel-default.themesbrand.com/assets/libs/bootstrap/bootstrap.min.js"></script>
    <script src="http://velzon.laravel-default.themesbrand.com/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="http://velzon.laravel-default.themesbrand.com/assets/libs/node-waves/node-waves.min.js"></script>
    <script src="http://velzon.laravel-default.themesbrand.com/assets/libs/feather-icons/feather-icons.min.js"></script>
    <script src="http://velzon.laravel-default.themesbrand.com/assets/js/pages/plugins/lord-icon-2.1.0.min.js"></script>
    <script src="http://velzon.laravel-default.themesbrand.com/assets/js/plugins.min.js"></script> --}}


<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ asset('assets/js/plugins.js') }}"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="http://velzon.laravel-default.themesbrand.com/assets/libs/particles.js/particles.js.min.js"></script>
<script src="http://velzon.laravel-default.themesbrand.com/assets/js/pages/particles.app.js"></script>
<script src="http://velzon.laravel-default.themesbrand.com/assets/js/pages/password-addon.init.js"></script>
@if (session('message'))
    <script>
        Toastify({
            text: "{{ session('message') }}",
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
@error('password')
    <script>
        Toastify({
            text: "Username atau Password Salah!",
            duration: 3000,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #621219, #a40a0a)",
            },
            //onClick: function(){} // Callback after click
            }).showToast();
    </script>
@enderror
@error('username')
    <script>
        Toastify({
            text: "Username atau Password Salah!",
            duration: 3000,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #621219, #a40a0a)",
            },
            //onClick: function(){} // Callback after click
            }).showToast();
    </script>
@enderror
<script type="text/javascript">
    $('#btnSubmit').click(function() {
        $(this).css('display', 'none');
        $('#loading').show();
        return true;
    });
</script>
</body>

</html>
