@extends('layouts.master')
@section('title', 'Detail Pengajuan')
@section('nav_active_persetujuan', 'active')
@section('content')
    <div class="modal fade zoomIn" id="modaltolak" tabindex="-1" aria-labelledby="exampleModalgridLabel" data-v-01bddeea=""
        style="display: none;" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-primary" data-v-01bddeea="">
                    <h5 class="modal-title text-light" id="exampleModalgridLabel">Tolak Pengajuan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal" data-v-01bddeea=""></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('persetujuan.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="rb_id" id="id" value="{{ old('id') }}">
                        <input type="hidden" name="id_user" id="user" value="{{ old('id') }}">
                        <input type="hidden" value="5" name="status">
                        <div class="row g-3">

                            <div class="col-xxl-12">
                                <div>
                                    <label for="validationCustom02"
                                        class="form-label @error('alasantolak') text-danger @enderror">Alasan Pengajuan Ditolak</label>
                                        <textarea required class="form-control @error('alasantolak') is-invalid @enderror" name="alasantolak" id="alasantolak" rows="3">{{ old('alasantolak') }}</textarea>

                                    @error('alasantolak')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <div id="loadingedit" style="display:none;">
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
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-n4 mx-n4 mb-n5">
                <div class="bg-soft-success">
                    <div class="card-body pb-4 mb-5">
                        <div class="row">
                            <div class="col-md mt-5 mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-auto">

                                    </div>
                                    <!--end col-->
                                    <div class="col-md">
                                        <h4 class="fw-semibold" id="ticket-title">#{{ $data->rb_id }}</h4>
                                        <div class="hstack gap-3 flex-wrap">
                                            <div class="text-muted"><i class="ri-building-line align-bottom me-1"></i><span
                                                    id="ticket-client">{{ $data->cabang['branch_name'] }}</span></div>
                                            <div class="vr"></div>
                                            <div class="text-muted">Create Date : <span class="fw-medium "
                                                    id="create-date">@tanggal($data->created_date)</span></div>
                                                                                        
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div><!-- end card body -->
                </div>
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

    <div class="row">
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detail Pengajuan</h5>
                </div>
                <div class="card-body">
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
                                    <h6 class="mb-1"><a href="javascript:void(0);">{{ $file->dokumen_name }}</a></h6>
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
                                <h6 class="mb-1"><a href="javascript:void(0);">{{ $data->bukti_tf }}</a></h6>
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
                            <span id="note">@nl2br($data->keterangan)
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
                            <tbody>
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
                                {{-- <tr class="fs-15">
                                    <th scope="row" >Beban Pembagian (75%)</th>
                                    <th class="text-end bg-warning">@uang($data->total_harga*75/100)</th>
                                </tr> --}}
                            </tbody>
                        </table>
                        <!--end table-->
                    </div>
                    {{-- @if($data->status == 2)
                    <div class="mt-3">
                        <h6 class="text-muted fw-semibold mb-2">Tambahkan Beban pembagian (75% x Total Bayar) ?</h6>
                    </div> --}}

                    {{-- @endif --}}
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
                            <div class="fs-12">
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
                            <div class="fs-12">
                                <strong><u>{{ $result->karyawan->nama }}</u><br>
                                @if($result->karyawan->jabatan->nama_jabatan == 'Branch Head' )
                                {{ $result->karyawan->jabatan->nama_jabatan }}        
                                @else
                                {{ $result->karyawan->jabatan->nama_jabatan }} {{ $result->karyawan->departemen->nama_dept }}
                                @endif
                                </strong>
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
                            <div class="fs-12">
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
                    @if($user->AuthUsergrup->groupId == 20)
                    <form method="POST" action="{{ route('persetujuan.update') }}">
                        @csrf
                        <input type="hidden" name="id_user" value="{{ $user->nik }}">
                        <input type="hidden" name="rb_id" value="{{ $data->rb_id }}">
                        <input type="hidden" name="status" value="3">
                        <div class="row">
                            <div class="col-sm-6 mt-2">
                                <div>
                                    <label for="basiInput" class="form-label fs-16">Diketahui oleh <i class="text-danger">*</i></label>
                                    <select class="form-control" id="choices-multiple-remove-button" data-choices data-choices-removeItem name="diketahui[]" multiple required>
                                        <option value="">Pilih</option>
                                        @foreach($diketahui as $result)
                                        <option value="{{ $result->nik }}">{{ $result->jabatan->nama_jabatan }} {{ $result->departemen->nama_dept }} | {{ $result->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-2">
                                <div>
                                    <label for="basiInput" class="form-label fs-16">Disetujui oleh <i class="text-danger">*</i></label>
                                    <select class="form-control" id="choices-multiple-remove-button" data-choices data-choices-removeItem name="disetujui[]" multiple required>
                                        <option value="">Pilih</option>
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
                    @if($cekfinance == true)
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
                                        class="form-control" accept=".pdf,.png,.jpg">
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

    </div>
    <!--end row-->
@endsection
@push('before-scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
@endpush
@push('center-scripts')
<script src="{{ asset('assets/libs/list.js/prismjs.min.js') }}"></script>
<script src="{{ asset('assets/libs/list.js/list.js.min.js') }}"></script>
<script src="{{ asset('assets/libs/list.js/list.pagination.js.min.js') }}"></script>
<script src="{{ asset('assets/libs/list.js/listjs.init.js') }}"></script>
<script src="{{ asset('assets/libs/list.js/list.min.js') }}"></script>
<script src="{{ asset('assets/scripts/choices.min.js') }}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(".confirm-delete").click(function(e) {
        // console.log(e.target.dataset.id);
        id = e.target.dataset.id;
        Swal.fire({
            html: '<div class="mt-3">' +
                '<lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>' +
                '<div class="mt-4 pt-2 fs-15 mx-5">' + '<h4>Anda yakin ?</h4>' +
                '<p class="text-muted mx-4 mb-0">Data Akan terhapus permanen !</p>' + '</div>' +
                '</div>',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-primary w-xs me-2 mb-1',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            cancelButtonClass: 'btn btn-danger w-xs mb-1',
            buttonsStyling: false,
            showCloseButton: true
        }).then(function(result) {
            if (result.value) {
                // Swal.fire({
                //     title: 'Terhapus !',
                //     text: 'Data berhasil dihapus.',
                //     icon: 'success',
                //     confirmButtonClass: 'btn btn-primary w-xs mt-2',
                //     buttonsStyling: false
                // });
                $(`#delete-${id}`).submit();
            }
        });
    })
</script>
@endpush
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '.tolak', function() {
                console.log($(this).data('id'));
                var id = $(this).data('id');
                var user = $(this).data('user');
                $("#id").empty();
                $("#user").empty();
                $('#id').val(id);
                $('#user').val(user);
                $("#alasantolak").val('');
                $('#modaltolak').modal('show');
            });
        });
    </script>
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
    <script type="text/javascript">
        $('#btnSubmit').click(function() {
            $(this).css('display', 'none');
            $('#loading').show();
            return true;
        });
    </script>
    <script type="text/javascript">
        $('#btnSubmitedit').click(function() {
            $(this).css('display', 'none');
            $('#loadingedit').show();
            return true;
        });
    </script>
@endpush
