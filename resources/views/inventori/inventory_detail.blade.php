<!doctype html>
{{-- <html lang="en" data-topbar="light" data-sidebar-image="none"> --}}
    <html lang="en" data-layout="horizontal" data-layout-style="" data-layout-position="fixed" data-topbar="light">

<head>
    <meta charset="utf-8" />
    <title>Detail Inventaris | Intranet Mitra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Budgeting & Inventory System" name="description" />
    <meta content="IT Development" name="author" />
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
                            <div class="row justify-content-center mb-4">
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
                                    <h5 class="fs-5 fw-semibold text-center mb-0 mt-2">Menampilkan detail inventaris "<span class="text-primary fw-medium">{{ $id }}</span>"</h5>
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
                                        @if(!empty($inventaris))
                                        <div class="col-xl-4 col-md-8 mx-auto">
                                            <div class="product-img-slider sticky-side-div">
                                                <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <img src="{{ asset('inventory/gambar/'.$inventaris->image) }}" alt="" class="img-fluid d-block" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-xl-8">
                                            <div class="mt-xl-0 mt-5">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <h4>{{ $inventaris->item }}</h4>
                                                        <div class="hstack gap-3 flex-wrap">
                                                            
                                                            <div class="text-muted">Created by : <span class="text-body fw-medium">{{ $inventaris->karyawan->nama }}</span></div>
                                                            <div class="vr"></div>
                                                            <div class="text-muted">Created Date : <span class="text-body fw-medium">@tanggal($inventaris->created_date)</span></div>
                                                            <div class="vr"></div>
                                                            <div class="text-muted">Branch : <span class="text-body fw-medium">{{ $inventaris->cabang->branch_name }}</span></div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                                                    <div class="text-muted fs-13">
                                                        <span class="badge badge-label bg-dark"><i class="mdi mdi-circle-medium"></i> {{ $inventaris->grupinventaris['group_name'] }}</span>
                                                       
                                                    </div>
                                                    <div class="text-muted fs-13">
                                                        <span class="badge badge-label bg-dark"><i class="mdi mdi-circle-medium"></i> {{ $inventaris->jenisinventaris->nama_jenis }}</span>
                                                    </div>
                                                    
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-lg-4 col-sm-6">
                                                        <div class="p-2 border border-dashed rounded">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm me-2">
                                                                    <div class="avatar-title rounded bg-transparent text-primary fs-24">
                                                                        <i class="ri-money-dollar-circle-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <p class="text-muted mb-1">Harga beli:</p>
                                                                    <h5 class="mb-0">Rp. @rupiah($inventaris->harga_beli)</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                    <div class="col-lg-4 col-sm-6">
                                                        <div class="p-2 border border-dashed rounded">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm me-2">
                                                                    <div class="avatar-title rounded bg-transparent text-primary fs-24">
                                                                        <i class="ri-stack-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <p class="text-muted mb-1">Stok :</p>
                                                                    <h5 class="mb-0">{{ $inventaris->qty }}</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                    <div class="col-lg-4 col-sm-6">
                                                        <div class="p-2 border border-dashed rounded">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm me-2">
                                                                    <div class="avatar-title rounded bg-transparent text-primary fs-24">
                                                                        <i class="ri-price-tag-3-line"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <p class="text-muted mb-1">Status :</p>
                                                                    <h5 class="mb-0">
                                                                        @if($inventaris->status == 1)
                                                                            <span class="badge badge-soft-dark badge-border text-wrap"> Close</span>
                                                                        @elseif($inventaris->status == 2)
                                                                            <span class="badge badge-soft-danger badge-border text-wrap"> Dipinjam</span>
                                                                        @endif
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
    
                                                    <div class="mt-4 text-muted">
                                                        <!-- Rounded Ribbon -->
                                                        <div class="card ribbon-box border shadow-none mb-lg-0">
                                                            <div class="card-body">
                                                                <div class="ribbon ribbon-primary round-shape">Deskripsi item</div>
                                                                {{-- <h5 class="fs-14 text-end">Rounded Ribbon</h5> --}}
                                                                <div class="ribbon-content mt-5 text-muted">
                                                                    <p class="mb-0">{{ $inventaris->deskripsi_item }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <h5 class="fs-14"> :</h5>
                                                        <p>{{ $inventaris->deskripsi_item }}</p> --}}
                                                    </div>
    
                                                </div>
                                            </div>
                                        </div>
                                        @else
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
                                        @endif
                                    </div>
                                </div>
                                {{-- info rb --}}
                                <div class="tab-pane" id="images" role="tabpanel" aria-labelledby="#images-tab">
                                    <div class="row">
                                        @if(empty($inventaris->rb_id))
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
                                                        <p class="text-muted mb-0">Tidak ditemukan data RB 😊</p>
                                                    </div>                    
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                            <div class="col-xl-3">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="card-title mb-0">Detail Pengajuan</h5>
                                                    </div>
                                                    <div class="card-body fs-12">
                                                        <div class="table-responsive table-card">
                                                            <table class="table table-borderless align-middle mb-0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="fw-medium">ID</td>
                                                                        <td>{{ $data->rb_id }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="fw-medium">By</td>
                                                                        <td id="t-client">{{ $data->karyawan->nama }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="fw-medium">Date</td>
                                                                        <td> @tanggal($data->created_date)</td>
                                                                    </tr>
                                                                    {{-- <tr>
                                                                        <td class="fw-medium">Last Update</td>
                                                                        <td id="t-client">{{ $data->update_user->karyawan->nama }}</td>
                                                                    </tr> --}}
                                                                    <tr>
                                                                        <td class="fw-medium">Update</td>
                                                                        <td>
                                                                            @if($data->update_date) 
                                                                                @tanggal($data->update_date)
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    @if($data->status == 0)
                                                                    <tr>
                                                                        <td colspan="2" class="text-center">
                                                                            <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:120px;height:120px"></lord-icon>
                                                                        </td>
                                                                    </tr>
                                                                    @endif
                                                                    <tr>
                                                                        <td class="fw-medium">Status</td>
                                                                        <td>
                                                                            @if ($data->status == 1)
                                                                                <span class="badge badge-soft-secondary badge-border text-wrap">
                                                                                    Menunggu Aproval Kacab/ Kabeng
                                                                                </span>
                                                                            @elseif($data->status == 2)
                                                                                <span class="badge badge-soft-secondary badge-border text-wrap">
                                                                                    Proses Validasi Pengesahan
                                                                                </span>
                                                                            @elseif($data->status == 3)
                                                                                <span class="badge badge-soft-secondary badge-border text-wrap">
                                                                                    Menunggu Aproval Terkait
                                                                                </span>
                                                                            @elseif($data->status == 4)
                                                                                <span class="badge badge-soft-secondary badge-border text-wrap">
                                                                                    Menunggu Approval Management Terkait
                                                                                </span>
                                                                            @elseif($data->status == 5)
                                                                                <span class="badge badge-soft-danger badge-border text-wrap">
                                                                                    Ditolak
                                                                                </span>
                                                                            @elseif($data->status == 6)
                                                                                <span class="badge badge-soft-success badge-border fs-12 text-wrap">
                                                                                    Menunggu otorisasi Kudus
                                                                                </span>
                                                                            @elseif($data->status == 0)
                                                                                <span class="badge badge-soft-success badge-border fs-12 text-wrap">
                                                                                    RB telah selesai 
                                                                                </span>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!--end card-body-->
                                                </div>
                                                <!--end card-->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h6 class="card-title fw-semibold mb-0">Files Attachment</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        @if($data->TrxRbDetailDokumen)
                                                            @foreach ($data->TrxRbDetailDokumen as $file)
                                                                <div class="d-flex align-items-center border border-dashed p-2 mt-2 rounded">
                                                                    <div class="flex-shrink-0 avatar-sm">
                                                                        <div class="avatar-title bg-light rounded">
                                                                            <i class="fa fa-file-pdf-o fs-5 text-danger fs-20"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <h6 class="mb-1 fs-12"><a href="javascript:void(0);">{{ $file->dokumen_name }}</a></h6>
                                                                    </div>
                                                                    <div class="hstack gap-3 fs-16">
                                                                        <a href="{{ asset('dokumen/' . $file->dokumen_name) }}" target="_blank" class="text-muted"><i
                                                                                class="mdi mdi-open-in-new"></i></a>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                @if($data->status == 0)
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h6 class="card-title fw-semibold mb-0">Bukti Transfer</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        @if($data->bukti_tf)
                                                            <div class="d-flex align-items-center border border-dashed p-2 mt-2 rounded">
                                                                <div class="flex-shrink-0 avatar-sm">
                                                                    <div class="avatar-title bg-light rounded">
                                                                        <i class="fa-solid fa-file-invoice-dollar text-info fs-20"></i>
                                                                        {{-- <i class="fa fa-file-pdf-o text-danger fs-20"></i> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <h6 class="mb-1 fs-12"><a href="javascript:void(0);">{{ $data->bukti_tf }}</a></h6>
                                                                </div>
                                                                <div class="hstack gap-3 fs-16">
                                                                    <a href="{{ asset('buktitf/' . $data->bukti_tf) }}" target="_blank" class="text-muted"><i
                                                                            class="mdi mdi-open-in-new"></i></a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <!--end col-->
                                            <div class="col-xl-9">
                                                <div class="card">
                                                    <div class="card-header border-bottom-dashed p-4 mb-0">
                                                        <div class="alert alert-info mb-0">
                                                            <p class="mb-0"><span class="fw-semibold">Note:</span>
                                                                <span id="note">{{ $data->keterangan }}
                                                                </span>
                                                            </p>
                                                        </div>
                                                        
                                                    </div>
                                                    <!--end card-body-->
                                                    <div class="card-header border-bottom-dashed p-4">
                                                        <h5 class="card-title mb-3">Tracking RB</h5>
                                                        <div class="table-responsive">
                                                            <table class="table align-middle mb-0">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th scope="col">#</th>
                                                                        <th scope="col">Date</th>
                                                                        <th scope="col">Status</th>
                                                                        <th scope="col">Deskripsi</th>
                                                                        <th scope="col">By</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="fs-12">
                                                                    @foreach ($tracking as $no => $item)
                                                                        <tr>
                                                                            <td>{{  $no+1 }}</td>
                                                                            <td>@tanggal($item->created_date)</td>
                                                                            <td>
                                                                                @if ($item->status == 'Solved')
                                                                                    <div class="text-success">
                                                                                        <i class="ri-checkbox-circle-line fs-17 align-middle"></i>
                                                                                        {{ $item->status }}
                                                                                    </div>
                                                                                @elseif($item->status == 'Ditolak')
                                                                                    <div class="text-danger">
                                                                                        <i class="ri-close-circle-line fs-17 align-middle"></i>
                                                                                        {{ $item->status }}
                                                                                    </div>
                                                                                @else
                                                                                    <div class="text-info">
                                                                                        <i class="ri-checkbox-circle-line fs-17 align-middle"></i>
                                                                                        {{ $item->status }}
                                                                                    </div>
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if ($item->deskripsi)
                                                                                    {{ $item->deskripsi }}
                                                                                @else
                                                                                    -
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                <div class="d-flex gap-2 align-items-center">
                                                                                    <div class="flex-shrink-0">
                                                                                        <div class="avatar-xs me-1">
                                                                                            <span
                                                                                                class="avatar-title bg-soft-info text-info rounded-circle fs-16">
                                                                                                <?php
                                                                                                $s = $item->karyawan['nama'];
                                                                                                
                                                                                                if (preg_match_all('/\b(\w)/', strtoupper($s), $m)) {
                                                                                                    $v = implode('', $m[1]);
                                                                                                }
                                                                                                
                                                                                                echo $v;
                                                                                                ?>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="flex-grow-1">
                                                                                        {{ $item->karyawan['nama'] }}
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                            <!-- end table -->
                                                        </div>
                                                        <!-- end table responsive -->
                                                    </div>
                                                    <div class="card-header border-bottom-dashed p-4">
                                                        <h5 class="card-title mb-3">Detail Item</h5>
                                                        <div class="table-responsive">
                                                            <table class="table table-borderless table-nowrap align-middle mb-0">
                                                                <thead>
                                                                    <tr class="table-active">
                                                                        <th scope="col" style="width: 50px;">#</th>
                                                                        <th scope="col">Keterangan</th>
                                                                        <th scope="col" class="text-center">QTY</th>
                                                                        <th scope="col" class="text-end">Harga</th>
                                                                        <th scope="col" class="text-end">Jumlah</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="products-list">
                                                                    @if($data->TrxRbDetailItem)
                                                                    @foreach($data->TrxRbDetailItem as $no => $item)
                                                                    <tr>
                                                                        <th scope="row">{{ $no+1 }}</th>
                                                                        <td class="text-start">
                                                                            <span class="fw-medium">{{ $item->item }}</span>
                                                                        </td>
                                                                        <td class="text-center">{{ $item->qty }}</td>
                                                                        <td class="text-end">@uang($item->harga)</td>
                                                                        <td class="text-end">@uang($item->qty*$item->harga)</td>
                                                                    </tr>
                                                                    @endforeach
                                                                    @endif
                                                                </tbody>
                                                            </table><!--end table-->
                                                        </div>
                                                        <div class="mt-2">
                                                            <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                                                <tbody>
                                                                    <tr class="border-top border-top-dashed fs-15">
                                                                        <th scope="row" >Total</th>
                                                                        <th class="text-end">@uang($data->total_harga)</th>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <!--end table-->
                                                        </div>
                                                        {{-- @if($data->status == 2)
                                                        <div class="mt-3">
                                                            <h6 class="text-muted fw-semibold mb-2">Tambahkan Beban pembagian (75% x Total Bayar) ?</h6>
                                                        </div>
                                    
                                                        @endif --}}
                                                        <div class="mt-3">
                                                            <h6 class="text-muted text-uppercase fw-semibold mb-2">Dana Ditransfer ke:</h6>
                                                            <p class="text-muted mb-1">Bank: <span class="fw-medium" id="payment-method">{{ $data->bank }}</span></p>
                                                            <p class="text-muted mb-1">No. Rekening: <span class="fw-medium" id="card-holder-name">{{ $data->no_rek }}</span></p>
                                                            <p class="text-muted mb-1">Atas Nama: <span class="fw-medium" id="card-number">{{ $data->nama_rek }}</span></p>
                                                            
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                    <div class="card-header border-bottom-dashed mb-2 p-4 text-center">
                                                        {{-- @if($data->status > 1 || $data->status == 0) --}}
                                                        <div class="row">
                                                            <div class="col mt-2 text-center">
                                                                Dibuat Oleh,<br>
                                                                <i class="ri-check-double-line text-success fs-1"></i>
                                                                <div class="fs-13">
                                                                    <strong><u>{{ $data->karyawan->nama }}</u><br>
                                                                    {{ $data->karyawan->jabatan->nama_jabatan }}</strong>
                                                                </div>
                                                            </div>
                                                            @foreach($mengetahui as $result)
                                                            <div class="col mt-2 text-center">
                                                                Mengetahui,<br>
                                                                @if($result->status == 1)
                                                                <i class="ri-check-double-line text-success fs-1"></i>
                                                                @elseif($result->status == 2)
                                                                <i class="ri-close-circle-line text-danger fs-1"></i>
                                                                @elseif($result->status == 3)
                                                                <i class="ri-stop-circle-line text-warning fs-1"></i>
                                                                @else
                                                                <i class="ri-time-line text-warning fs-1"></i>
                                                                @endif
                                                                <div class="fs-13">
                                                                    <strong><u>{{ $result->karyawan->nama }}</u><br>
                                                                    {{ $result->karyawan->jabatan->nama_jabatan }} {{ $result->karyawan->departemen->nama_dept }}</strong>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                            @foreach($menyetujui as $result)
                                                            <div class="col mt-2 text-center">
                                                                Menyetujui,<br>
                                                                @if($result->status == 1)
                                                                <i class="ri-check-double-line text-success fs-1"></i>
                                                                @elseif($result->status == 2)
                                                                <i class="ri-close-circle-line text-danger fs-1"></i>
                                                                @elseif($result->status == 3)
                                                                <i class="ri-stop-circle-line text-warning fs-1"></i>
                                                                @else
                                                                <i class="ri-time-line text-warning fs-1"></i>
                                                                @endif
                                                                <div class="fs-13">
                                                                    <strong><u>{{ $result->karyawan->nama }}</u><br>
                                                                    {{ $result->karyawan->jabatan->nama_jabatan }} {{ $result->karyawan->departemen->nama_dept }}</strong>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                        {{-- @endif --}}
                                                    </div>
                                                    <div class="card-body  mt-2 mb-2 p-4">
                                                        {{-- jika user kacab atau menyetujui bersangkutan--}}
                                                        @if($data->status == 1)
                                                        @if($user->AuthUsergrup->groupId == 1 || $cek != null)
                                                        <div class="text-center">
                                                        <form method="POST" action="{{ route('persetujuan.update') }}">
                                                            @csrf
                                                            <input type="hidden" name="id_user" value="{{ $user->nik }}">
                                                            <input type="hidden" name="rb_id" value="{{ $data->rb_id }}">
                                                            <input type="hidden" name="status" value="2">
                                                            
                                                            <button class="btn btn-success" type="submit">
                                                                
                                                                <i class="ri-check-double-line align-bottom me-1 "></i> <strong>SETUJUI
                                                            </strong>
                                                            </button>
                                                            <a href="javascript:void(0)" class="tolak" id="tolak"
                                                                data-v-cd5f1dea="" data-id="{{ $data->rb_id  }}" data-user="{{ $user->nik }}">
                                                                <button type="button" class="btn btn-danger text-center" >
                                                                    <i class="ri-close-fill align-bottom me-1 "></i>
                                                                    <strong>TOLAK</strong>
                                    
                                                                </button>
                                                                </a>
                                                        </form>
                                                        </div>
                                                        @endif
                                                        @endif
                                                        {{-- end jika user kacab --}}
                                    
                                                        {{-- jika user admin rb --}}
                                                        @if($data->status == 2)
                                                        @if($user->AuthUsergrup->groupId == 11 || $user->AuthUsergrup->groupId == 1)
                                                        <form method="POST" action="{{ route('persetujuan.update') }}">
                                                            @csrf
                                                            <input type="hidden" name="id_user" value="{{ $user->nik }}">
                                                            <input type="hidden" name="rb_id" value="{{ $data->rb_id }}">
                                                            <input type="hidden" name="status" value="3">
                                                            <div class="row">
                                                                <div class="col-sm-6 mt-2">
                                                                    <div>
                                                                        <label for="basiInput" class="form-label fs-16">Diketahui oleh</label>
                                                                        <select class="form-control" id="choices-multiple-remove-button" data-choices data-choices-removeItem name="diketahui[]" multiple>
                                                                            <option value="">Pilih Karyawan</option>
                                                                            @foreach($diketahui as $result)
                                                                            <option value="{{ $result->nik }}">{{ $result->jabatan->nama_jabatan }} {{ $result->departemen->nama_dept }} | {{ $result->nama }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6 mt-2">
                                                                    <div>
                                                                        <label for="basiInput" class="form-label fs-16">Disetujui oleh</label>
                                                                        <select class="form-control" id="choices-multiple-remove-button" data-choices data-choices-removeItem name="disetujui[]" multiple>
                                                                            <option value="">Pilih Karyawan</option>
                                                                            @foreach($disetujui as $result)
                                                                            <option value="{{ $result->nik }}">{{ $result->jabatan->nama_jabatan }} {{ $result->departemen->nama_dept }} | {{ $result->nama }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="text-end mt-3">
                                                                    <button class="btn btn-danger" type="submit">
                                                                        <i class="ri-save-3-fill align-bottom me-1 "></i> <strong>SIMPAN PERUBAHAN
                                                                        </strong>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            
                                                        </form>
                                                        @endif
                                                        @endif
                                                        {{-- end jika user admin rb --}}
                                    
                                                        {{-- jika user approval --}}
                                                        @if($data->status == 3 || $data->status == 4)
                                                        @if($user->AuthUsergrup->groupId == 1 || $cek != null)
                                                        
                                                        <div class="text-center mb-2">
                                                            <form method="POST" action="{{ route('persetujuan.update') }}">
                                                                @csrf
                                                                <input type="hidden" name="id_user" value="{{ $user->nik }}">
                                                                <input type="hidden" name="rb_id" value="{{ $data->rb_id }}">
                                                                <input type="hidden" name="status" value="4">
                                                                
                                                                <button class="btn btn-success text-center" type="submit">
                                                                    <i class="ri-check-double-line align-bottom me-1 "></i>
                                                                    <strong>SETUJUI</strong>
                                                                </button>
                                                                <a href="javascript:void(0)" class="tolak" id="tolak"
                                                                data-v-cd5f1dea="" data-id="{{ $data->rb_id  }}" data-user="{{ $user->nik }}">
                                                                <button type="button" class="btn btn-danger text-center" >
                                                                    <i class="ri-close-fill align-bottom me-1 "></i>
                                                                    <strong>TOLAK</strong>
                                    
                                                                </button>
                                                                </a>
                                                            </form>
                                                        </div>
                                                        @endif
                                                        @endif
                                    
                                                        {{-- Otorisasi grup otorisasi--}}
                                                        @if($data->status == 6)
                                                        @if($user->AuthUsergrup->groupId == 14)
                                                        <div>
                                    
                                                            <form method="POST" action="{{ route('persetujuan.update') }}" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="id_user" value="{{ $user->nik }}">
                                                                <input type="hidden" name="rb_id" value="{{ $data->rb_id }}">
                                                                <input type="hidden" name="status" value="0">
                                                                <div class="row">
                                                                    <div class="col-xl-10">
                                                                        <label for="exampleFormControlTextarea5" 
                                                                            class="form-label mb-1">Lampirkan bukti transfer</label>
                                                                        <input name="buktitf" type="file" 
                                                                            class="form-control" accept=".pdf,.png,.jpg" required>
                                                                        <div id="passwordHelpBlock" class="form-text">
                                                                            Extenstion yang diizinkan untuk diupload: .pdf, .jpg, .png.
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-2 pt-4 text-center">
                                                                        
                                                                        <button class="btn btn-primary text-center " type="submit">
                                                                            <i class="ri-save-3-fill align-bottom me-1 "></i> <strong>Submit
                                                                        </strong>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        @endif
                                                        @endif
                                                        {{-- stop --}}
                                    
                                                    </div>
                                                    
                                                    
                                                    <!-- end card body -->
                                                </div>
                                                <!--end card-->
                                            </div>
                                            <!--end col-->
                                        @endif
                                    </div>
                                </div>
                                {{-- info peminjaman --}}
                                <div class="tab-pane" id="news" role="tabpanel">
                                    <div class="row">
                                        @if(empty($peminjaman))
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
                                                        <p class="text-muted mb-0">Tidak ditemukan riwayat peminjaman 😊</p>
                                                    </div>                    
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        {{-- <div class="p-3">
                                            <div class="row g-2">
                                                <div class="col-lg">
                                                    <div class="search-box">
                                                        <input type="text" id="myInput" class="form-control search" placeholder="Search inventory id, rb id, item">
                                                        <i class="ri-search-line search-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-auto">
                                                    <div class="d-flex justify-content-md-start justify-content-center" data-v-cd5f1dea=""
                                                            data-bs-toggle="modal" data-bs-target="#exampleModalgrid">
                                                            <a href="{{ route('inventaris.tambah') }}" type="button" class="btn btn-secondary" data-v-cd5f1dea="">
                                                                <i class="ri-add-line align-bottom me-1" data-v-cd5f1dea=""></i> Tambah Data
                                                            </a>
                                                        </div>
                                                </div>
                                                <div class="col-lg-auto">
                                                    <button class="btn btn-primary" formaction="{{ route('inventaris.generateqr') }}" id="btnSubmit2" type="submit" data-v-cd5f1dea="">
                                                        <i class="ri-qr-code-line align-bottom me-1" data-v-cd5f1dea=""></i> Generate QR
                                                    </button>
                                                    <div id="loading2" style="display:none;">
                                                        <button type="button" class="btn btn-primary btn-load" disabled>
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
                                            </div>
                                        </div> --}}
                    
                                        <div class="card-body fs-12">

                                            <div class="table-responsive table-card mb-1">
                                                <table class="table align-middle table-nowrap" id="customerTable">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="sort" data-sort="customer_name">#</th>
                                                            <th class="sort" data-sort="date">Peminjam</th>
                                                            <th class="sort" data-sort="date">Divisi</th>
                                                            <th class="sort" data-sort="date">Item</th>
                                                            <th class="sort" data-sort="date">Tanggal Pinjam</th>
                                                            <th class="sort" data-sort="date">Tanggal Balik</th>
                                                            <th class="sort" data-sort="date">Estimasi Balik</th>
                                                            <th class="sort text-center" data-sort="status">Status</th>
                                                            <th class="sort" data-sort="status">Note</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list form-check-all" id="carirow">
                                                        @foreach ($peminjaman as $no => $item)
                                                            <tr>
                                                                <td class="status">{{ $peminjaman->firstItem() + $no }}</td>
                                                                <td class="email">{{ $item->peminjaman['nama_peminjam'] }}</td>
                                                                <td class="email">{{ $item->peminjaman['divisi_peminjam'] }}</td>
                                                                <td class="email">
                                                                    @foreach($item->peminjaman->ditem as $rslt)
                                                                    <div class="d-flex">
                                                                        <div class="flex-shrink-0">
                                                                            <i class="ri-checkbox-circle-fill text-primary"></i>
                                                                        </div>
                                                                        <div class="flex-grow-1 ms-2">
                                                                            <p class="mb-0">{{ $rslt->inventaris['item'] }}</p>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach 
                                                                </td>
                                                                <td class="email">@tanggal($item->peminjaman['tgl_pinjam'])</td>
                                                                <td class="email">
                                                                    @if($item->peminjaman['tgl_balik'] != null)
                                                                    @tanggal($item->peminjaman['tgl_balik'])
                                                                    @else -
                                                                    @endif
                                                                </td>
                                                                <td class="email">@tanggal($item->peminjaman['estimasi_balik'])</td>
                                                                
                                                                <td class="email text-center">
                                                                    @if($item->peminjaman['status'] == 1)
                                                                        <span class="badge badge-soft-danger badge-border text-wrap"> Dipinjam</span>
                                                                    @elseif($item->peminjaman['status'] == 0)
                                                                        <span class="badge badge-soft-primary badge-border text-wrap"> Dikembalikan</span>
                                                                    @endif
                                                                </td>
                                                                <td class="email">{{ $item->peminjaman['note'] }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="noresult" style="display: none">
                                                    <div class="text-center">
                                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                            colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                                        </lord-icon>
                                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                                        <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                                            orders for you search.</p>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <div class="d-flex justify-content-end">
                                                {{ $peminjaman->links() }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                </div>
                                {{-- info perawatan --}}
                                <div class="tab-pane" id="video" role="tabpanel">
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
                                                    <p class="text-muted mb-0">Tidak ditemukan riwayat pemeliharaan 😊</p>
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
                                </script> Honda Mitrajaya | Portalmitra
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
