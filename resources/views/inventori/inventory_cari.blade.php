<!doctype html>
{{-- <html lang="en" data-topbar="light" data-sidebar-image="none"> --}}
    <html lang="en" data-layout="horizontal" data-layout-style="" data-layout-position="fixed" data-topbar="light">

<head>
    <meta charset="utf-8" />
    <title>Query Inventory | Intranet Mitra</title>
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
    <script src="https://kit.fontawesome.com/bdc70a6d76.js" crossorigin="anonymous"></script>
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
                    <div class="card">
                        <div class="card-header border-0 mt-4">
                            <div class="row justify-content-center mb-3">
                                {{-- <div class="col-lg-3">
                                    <span class="logo-sm">
                                        <img src="https://www.hondamitrajaya.com/static/frontend/images/logo.png" alt=""
                                            height="22">
                                    </span>
                                </div> --}}
                                <div class="col-lg-6">
                                    <form action="{{ route('inventaris.getinfo') }}" method="POST">
                                        @csrf
                                        <div class="row g-2">
                                            <div class="col">
                                                <div class="position-relative mb-2">
                                                    <input type="text" name="inv_id" class="form-control rounded-pill form-control-lg bg-light border-light" placeholder="Masukan kode inventaris disini..." autocomplete="off">
                                                    <button type="submit" id="btnSubmit" class="btn btn-lg link-primary position-absolute end-0 top-0 " aria-controls="offcanvasExample"><i class="ri-search-line"></i> &nbsp;&nbsp;</button>
                                                    <div id="loading" style="display:none;">
                                                        <button type="button" class="btn btn-lg link-primary btn-load position-absolute end-0 top-0 " aria-controls="offcanvasExample">
                                                            <i class="mdi mdi-loading mdi-spin fs-20 align-middle me-2"></i>&nbsp;&nbsp;
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                {{-- <div class="col-lg-3">
                                </div> --}}
                                <!--end col-->
                                <div class="col-lg-12">
                                    <p class="fs-6 text-center mb-0 mt-2">Sistem akan otomatis menampilkan inventaris sesuai kode yang dimasukan.</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#all" role="tab" aria-selected="true">
                                        <i class="ri-briefcase-line text-muted align-bottom me-1"></i> Detail Inventaris
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" id="images-tab" href="#images" role="tab" aria-selected="false" tabindex="-1">
                                        <i class="ri-wallet-3-line text-muted align-bottom me-1"></i> Detail Pengajuan RB
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#news" role="tab" aria-selected="false" tabindex="-1">
                                        <i class="ri-shopping-basket-line text-muted align-bottom me-1"></i> Peminjaman
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#video" role="tab" aria-selected="false" tabindex="-1">
                                        <i class="ri-service-line text-muted align-bottom me-1"></i> Pemeliharaan
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                        <div class="card-body p-4 ">
                            <div class="tab-content text-muted ">
                                {{-- info inventaris --}}
                                <div class="tab-pane active show" id="all" role="tabpanel">
                                    <div class="row">
                                        
                                        <div class="col-lg-12">
                                            <div class="text-center mt-sm-2 pt-2 mb-2">
                                                <div class="mb-sm-4 pb-sm-3 pb-2">
                                                <lord-icon
                                                    src="https://cdn.lordicon.com/tdrtiskw.json"
                                                    trigger="loop"
                                                    colors="primary:#f7b84b,secondary:#405189"
                                                    style="width:130px;height:130px">
                                                </lord-icon>
                                                </div>
                                                
                                                <div>                    
                                                    <div class="mt-4">
                                                        <h4>Data tidak ditemukan !</h4>
                                                        <p class="text-muted mb-0">Tidak ditemukan data inventaris 😊</p>
                                                    </div>                    
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                {{-- info rb --}}
                                <div class="tab-pane" id="images" role="tabpanel" aria-labelledby="#images-tab">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center mt-sm-2 pt-2 mb-2">
                                                <div class="mb-sm-4 pb-sm-3 pb-3">
                                                <lord-icon
                                                    src="https://cdn.lordicon.com/tdrtiskw.json"
                                                    trigger="loop"
                                                    colors="primary:#f7b84b,secondary:#405189"
                                                    style="width:130px;height:130px">
                                                </lord-icon>
                                                </div>
                                                
                                                <div>                    
                                                    <div class="mt-4">
                                                        <h4>Data tidak ditemukan !</h4>
                                                        <p class="text-muted mb-0">Tidak ditemukan riwayat rb 😊</p>
                                                    </div>                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- info peminjaman --}}
                                <div class="tab-pane" id="news" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center mt-sm-2 pt-2 mb-2">
                                                <div class="mb-sm-4 pb-sm-3 pb-3">
                                                <lord-icon
                                                    src="https://cdn.lordicon.com/tdrtiskw.json"
                                                    trigger="loop"
                                                    colors="primary:#f7b84b,secondary:#405189"
                                                    style="width:130px;height:130px">
                                                </lord-icon>
                                                </div>
                                                
                                                <div>                    
                                                    <div class="mt-4">
                                                        <h4>Data tidak ditemukan !</h4>
                                                        <p class="text-muted mb-0">Tidak ditemukan riwayat peminjaman 😊</p>
                                                    </div>                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                {{-- info perawatan --}}
                                <div class="tab-pane" id="video" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center mt-sm-2 pt-2 mb-2">
                                                <div class="mb-sm-4 pb-sm-3 pb-3">
                                                    <lord-icon
                                                        src="https://cdn.lordicon.com/tdrtiskw.json"
                                                        trigger="loop"
                                                        colors="primary:#f7b84b,secondary:#405189"
                                                        style="width:130px;height:130px">
                                                    </lord-icon>
                                                </div>
                                                
                                                <div>
                                                    
                    
                                                    <div class="mt-4">
                                                        <h4>Data tidak ditemukan !</h4>
                                                        <p class="text-muted mb-0">Tidak ditemukan riwayat pemeliharaan 😊</p>
                                                    </div>
                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end tab-pane-->
                            </div>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card -->
                </div>
                <!--end card -->
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Honda Mitrajaya | Intranet Mitrajaya
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

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
<script type="text/javascript">
    $('#btnSubmit').click(function() {
        $(this).css('display', 'none');
        $('#loading').show();
        return true;
    });
</script>        
</html>
