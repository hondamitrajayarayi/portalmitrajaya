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
    @stack('styles')
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <div class="row justify-content-center">
        <div class="col-12">
            <table class="text-start">
                @foreach($data as $item)
                <tr>
                    <td class="p-1">
                        <img height="56px" src="{{ asset('inventory/qr/'.$item->name_file) }}"></td>
                    <td class="p-1">
                        <p class="mb-0 fw-bold" style="font-size: 10px">
                            {{ $item->inventory_id }}
                        </p>
                        {{-- <p class="mt-0 mb-0 fw-semibold" style="font-size: 10px">
                            <a href="{{ asset('inventaris/getinfo/'. $item->inventory_id ) }}" style="text-decoration: none" target="_blank">
                                {{ $item->inventory->item }}
                            </a>
                        </p> --}}
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="col-lg-12">
                <div class="card-body p-4">
                    <div class="hstack gap-2 justify-content-start d-print-none">
                        <a href="javascript:window.print()" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i> Print</a>
                        <a href="{{ route('inventaris') }}" class="btn btn-primary"><i class="ri-arrow-go-back-line align-bottom me-1"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <!-- App js -->
    
    <script src="{{ asset('assets/js/app2.js') }}"></script>
    
</body>

</html>