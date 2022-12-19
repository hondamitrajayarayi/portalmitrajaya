<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="{{ route('/home') }}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="https://www.hondamitrajaya.com/static/frontend/images/logo.png" alt=""
                                height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="https://www.hondamitrajaya.com/static/frontend/images/logo.png" alt=""
                                height="45">
                        </span>
                    </a>

                    <a href="{{ route('/home') }}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="https://www.hondamitrajaya.com/static/frontend/images/logo.png" alt=""
                                height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="https://www.hondamitrajaya.com/static/frontend/images/logo.png" alt=""
                                height="45">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>

            <div class="d-flex align-items-center">

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <div class="avatar-xs me-1">
                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-16">
                                    <?php 
                                        $s = Auth::user()->name;
    
                                        if(preg_match_all('/\b(\w)/',strtoupper($s),$m)) {
                                            $v = implode('',$m[1]); 
                                        }
    
                                        echo $v;
                                    ?>
                                </span>
                            </div>
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ Auth::user()->name }}</span>
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{ Auth::user()->karyawan->jabatan->nama_jabatan }}</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome {{ Auth::user()->name }} !</h6>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModals"><i
                                class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Profile</span></a>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#passwordModals"><i
                                class="ri-shield-keyhole-line text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Password reset</span></a>
                        <a class="dropdown-item" href="{{ asset('/I-ManualBook.pdf')}}" target="_blank" ><i
                                class="ri-book-mark-line text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Manual Book</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item"  href="{{ route('logout') }}"><i
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle" data-key="t-logout">Logout</span></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</header>
@push('before-scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script>
        $('#password-input, #confirm-password-input').on('keyup', function () {
            if ($('#password-input').val() == $('#confirm-password-input').val()) {
                $('#message').html('<div class="d-flex fs-13"><div class="flex-shrink-0 text-success me-1"><i class="ri-checkbox-circle-fill fs-12 align-middle"></i></div><div class="flex-grow-1 text-success">Matching</div></div>');
                $('#message1').html('<div class="d-flex fs-13"><div class="flex-shrink-0 text-success me-1"><i class="ri-checkbox-circle-fill fs-12 align-middle"></i></div><div class="flex-grow-1 text-success">Matching</div></div>');
                // $('#password-input').addClass('is-valid');
                $('#button_password').removeAttr('disabled');
            } else {
                $('#message').html('<div class="d-flex fs-13"><div class="flex-shrink-0 text-danger me-1"><i class="ri-close-circle-fill fs-12 align-middle"></i></div><div class="flex-grow-1 text-danger">Not Matching</div></div>');
                $('#message1').html('<div class="d-flex fs-13"><div class="flex-shrink-0 text-danger me-1"><i class="ri-close-circle-fill fs-12 align-middle"></i></div><div class="flex-grow-1 text-danger">Not Matching</div></div>');
                $('#button_password').attr('disabled','disabled');

            }
        });
    </script>
    <script>
        $("#password-addon").click(function() {
            console.log('ada');
            $('#icon').removeClass('ri-eye-fill align-middle');
            $('#icon').addClass('ri-eye-off-fill align-middle');
            var x = document.getElementById("password-input");
            if (x.type === "password") {
                x.type = "text";
            } else {
                console.log('hide');
                $('#icon').removeClass('ri-eye-off-fill align-middle');
                $('#icon').addClass('ri-eye-fill align-middle');
                x.type = "password";
            }
        });
        $("#confirm-password-input-addon").click(function() {
            console.log('ada');
            $('#icon2').removeClass('ri-eye-fill align-middle');
            $('#icon2').addClass('ri-eye-off-fill align-middle');
            var x = document.getElementById("confirm-password-input");
            if (x.type === "password") {
                x.type = "text";
            } else {
                console.log('hide');
                $('#icon2').removeClass('ri-eye-off-fill align-middle');
                $('#icon2').addClass('ri-eye-fill align-middle');
                x.type = "password";
            }
        });
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@endpush
