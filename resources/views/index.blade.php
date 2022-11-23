@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')

    <div class="row">
        
        <div class="col-xl-8">
            <div class="card crm-widget">
                <div class="card-body p-0">
                    <div class="row row-cols-xxl-3 row-cols-md-3 row-cols-1 g-0">
                        <div class="col">
                            <div class="py-4 px-3">
                                <h5 class="text-muted text-uppercase fs-13">Total RB </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="ri-shopping-bag-3-line display-6 text-muted"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0"><span class="counter-value" data-target="{{ $totalRb }}">0</span></h2>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                        <div class="col">
                            <div class="mt-3 mt-md-0 py-4 px-3">
                                <h5 class="text-muted text-uppercase fs-13">RB Ditolak </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="ri-close-circle-line display-6 text-muted"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0"><span class="counter-value" data-target="{{ $tolak }}">0</span></h2>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                        <div class="col">
                            <div class="mt-3 mt-md-0 py-4 px-3">
                                <h5 class="text-muted text-uppercase fs-13">RB Disetujui </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="ri-check-double-line display-6 text-muted"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0"><span class="counter-value" data-target="{{ $setuju }}">0</span></h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- end row -->
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-4">
            <div class="card card-animate">
                <div class="card-body mb-1">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0"> Total dana yang disetujui</p>
                            <h2 class="mt-4 ff-secondary fw-semibold">Rp. <span class="counter-value"
                                    data-target="{{ $totalDana }}">0</span></h2>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0"><span
                                    class="avatar-title bg-soft-info rounded-circle fs-2">
                                    <i class="ri-wallet-3-line text-info"></i>
                                </span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end row -->
    {{-- <div class="row">
    <div class="col-xxl-3 col-md-6">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Tickets Solved</h4>
                
            </div>
            <div class="card-body pb-0">
                <div id="sales-forecast-chart" data-colors='["--vz-primary", "--vz-success", "--vz-warning"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
    </div>

    <div class="col-xxl-3 col-md-6">
        <div class="card card-height-100">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Tickets On Process</h4>
                
            </div>
            <div class="card-body pb-0">
                <div id="deal-type-charts" data-colors='["--vz-warning", "--vz-danger", "--vz-success"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
    </div>
    <div class="col-xxl-6">
        <div class="card card-height-100">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Feedback users</h4>
                
            </div>
            <div class="card-body px-0">
                
                <div id="revenue-expenses-charts" data-colors='["--vz-success", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

@push('before-scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
@endpush

@push('scripts')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard-crm.init.js') }}"></script>
@endpush
