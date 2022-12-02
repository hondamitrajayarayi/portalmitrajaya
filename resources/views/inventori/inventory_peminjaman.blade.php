@extends('layouts.master')
@section('title', 'Peminjaman Inventaris')
@section('nav_active_inventaris', 'active')
@push('styles')
<style>
    .table-custom {
        max-height: 370px;
        overflow: auto;
        font-size: 12px;
    }
</style>
@endpush
@section('content')

   
    <div class="modal fade zoomIn" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" 
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-primary" >
                    <h5 class="modal-title text-light" id="exampleModalLabel" > Pilih Data </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal" ></button>
                </div>
                @if ($errors->has('item'))
                <div class="alert alert-danger  rounded-0 mb-0">
                    <p class="mb-0">Pilih minimal 1<span class="fw-semibold"> Data RB</span> yang akan dijadikan inventaris !</p>
                </div>
                @endif
                <form action="{{ route('inventaris.pilihrb') }}" method="POST">
                    @csrf
                    <div class="p-3 rounded">
                        <div class="row g-2">
                            
                            <div class="col-lg">
                                <div class="search-box">
                                    <input type="text" id="myInput2" class="form-control search" placeholder="Search rb id, item, branch">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <div class="col-lg-auto">
                                <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
                                <div id="loading" style="display:none;">
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
                            <div class="col-lg-auto">
                                <button class="btn btn-danger" data-bs-dismiss="modal" type="button">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body p-0">
                        <div class="table-custom">
                            <div class="table-responsive table-card mb-1 mt-0">
                                <table class="table align-middle table-nowrap" id="customerTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" data-sort="customer_name">Pilih Data</th>
                                            <th class="sort" data-sort="phone">RB ID</th>
                                            <th class="sort" data-sort="date">Item</th>
                                            <th class="text-center" data-sort="date">QTY</th>
                                            <th class="text-center" data-sort="date">Harga Beli</th>
                                            <th class="sort" data-sort="status">Branch</th>
                                            <th class="sort" data-sort="status">Created date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all" id="carirow2">
                                        @foreach ($data as $item)
                                            <tr>
                                                <td class="">
                                                    <div class="form-check form-check-outline text-center">
                                                        <input class="form-check-input" name="item" type="radio" value="{{ $item->item_id }}" id="cardtableCheck">
                                                        <label class="form-check-label" for="cardtableCheck"></label>
                                                    </div>
                                                </td>
                                                <td class="customer_name">{{ $item->rb_id }}</td>
                                                <td class="email">{{ $item->item }}</td>
                                                <td class="text-center">{{ $item->qty }}</td>
                                                <td class="text-end">@uang($item->harga)</td>
                                                <td class="email">{{ $item->cabang['branch_name'] }}</td>
                                                <td class="date">@tanggal($item->created_date)</td>
                                                
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
                        </div>  
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-9">
            <div div class="card">
                <div class="card-header" >
                    <h6 class="card-title mb-0 font-poppins fs-15" >Peminjaman Inventaris</h6>
                </div>
                <div class="card-body fs-12">
                    <form action="{{ route('inventaris.simpan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div>
                                    <label for="basiInput" class="form-label mb-1">No Revisi Budget <i class="text-muted">(optional)</i></label>
                                    <div class="input-group">
                                        
                                        <input type="text" class="form-control" id="norb" name="norb" @if($autofill != null) value="{{ $autofill->rb_id }}" @endif readonly aria-label="Recipient's username" aria-describedby="button-addon2">
                                        <button data-bs-toggle="modal" data-bs-target="#exampleModalgrid" class="btn btn-soft-primary" type="button" id="button-addon2"><i class="ri-search-line"></i></button>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div>
                                    <label for="basiInput" class="form-label mb-1">Nama Item<i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" name="item" required id="valueInput" @if($autofill != null) value="{{ $autofill->item }}" readonly @endif>
                                    <input type="hidden" class="form-control" name="item_id" required id="valueInput" @if($autofill != null) value="{{ $autofill->item_id }}" readonly @endif>
                                </div>
                            </div>
                            <div class="col-md-1 mt-2">
                                <div>
                                    <label for="basiInput" class="form-label mb-1">Stok<i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" name="qty" required id="valueInput" @if($autofill != null) value="{{ $autofill->qty }}" readonly @endif>
                                </div>
                            </div>
                            <div class="col-md-3 mt-2">
                                <div>
                                    <label for="basiInput" class="form-label mb-1">Harga Item<i class="text-danger">*</i></label>
                                    {{-- <input type="text" class="form-control" name="harga" required id="valueInput" @if($autofill != null) value="{{ $autofill->harga }}" @endif> --}}
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                                        <input type="text" name="harga" id="harga" @if($autofill != null) value="@rupiah($autofill->harga)" readonly @endif class="form-control text-end" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div>
                                    <label for="validationCustom04"
                                        class="form-label mb-1">Grup Item<i class="text-danger">*</i></label>
                                    
                                    <select class="form-control" data-choices name="grup" id="grup" required>
                                        <option value="">Pilih grup</option>
                                        {{-- @foreach($grup as $grp)
                                            <option value="{{ $grp->group_id }}" >{{ $grp->group_name }}</option>
                                        @endforeach --}}
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div>
                                    <label for="validationCustom04"
                                        class="form-label mb-1">Jenis Item<i class="text-danger">*</i></label>
                                    
                                    <select class="form-control" data-choices name="jenis" id="jenis" required>
                                        <option value="">Pilih jenis</option>
                                        
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div>
                                    <label for="basiInput" class="form-label mb-1">Gambar Item<i class="text-danger">*</i></label>
                                    <input type="file" name="gambar" accept="image/*" class="form-control" id="valueInput" required>
                                </div>
                            </div>
                            <div class="col-md-8 mt-2">
                                <div>
                                    <label for="basiInput" class="form-label mb-1">Deskripsi<i class="text-danger">*</i></label>
                                    <textarea type="text" name="deskripsi" class="form-control" id="valueInput" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card-body">
                                    <div class="hstack gap-2 justify-content-end d-print-none">
                                        <button type="submit" class="btn btn-success"><i class="ri-save-3-fill align-bottom me-1"></i> Submit</button>
                                        <a href="{{ route('inventaris.tambah') }}" id="btnSubmit2" type="buttom" class="btn btn-danger"><i class="ri-restart-line align-bottom me-1"></i> Reset</a>
                                        <div id="loading2" style="display:none;">
                                            <button type="button" class="btn btn-danger btn-load" disabled>
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

                                        <a href="{{ route('inventaris') }}" type="buttom" id="btnSubmit3" class="btn btn-primary"><i class="ri-arrow-go-back-line align-bottom me-1"></i> Back</a>
                                        <div id="loading3" style="display:none;">
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
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
        <div class="col-xl-3 col-md-3">
            <div class="card"  data-v-37db4fe8="">
                <div class="card-header" >
                    <h6 class="card-title mb-0 font-poppins fs-15" >Related Menu</h6>
                </div>
                {{-- <img src="{{ asset('inventory/qr/qr-IV-22-MITRA-001-000001.svg') }}" alt=""> --}}
                <div class="card-body" >
                    <div class="list-setting" >
                        <div class="d-flex mb-2 list-setting_item pointer" >
                            <div class="flex-shrink-0" ><span
                                    class="badge badge-soft-primary p-1 fs-15" ><i
                                        class="text-info ri-briefcase-line" ></i></span></div>
                            <div class="flex-grow-1 ms-2 mt-0 mt-1 overflow-hidden" ><a
                                    href="{{ route('karyawan')}}" class="" >
                                    <h6 class="text-info text-truncate fs-13 mb-0 font-poppins" >
                                        Inventaris</h6>
                                </a></div>
                        </div>
                        <div class="d-flex mb-2 list-setting_item pointer" >
                            <div class="flex-shrink-0" ><span
                                    class="badge badge-soft-primary p-1 fs-15" ><i
                                        class="ri-share-forward-2-fill" ></i></span></div>
                            <div class="flex-grow-1 ms-2 mt-0 mt-1 overflow-hidden" ><a
                                    href="{{ route('jabatan')}}" class="" >
                                    <h6 class="text-truncate fs-13 mb-0 font-poppins" >
                                        Peminjaman</h6>
                                </a></div>
                        </div>
                        <div class="d-flex mb-2 list-setting_item pointer" >
                            <div class="flex-shrink-0" ><span
                                    class="badge badge-soft-primary p-1 fs-15" ><i
                                        class="ri-service-line" ></i></span></div>
                            <div class="flex-grow-1 ms-2 mt-0 mt-1 overflow-hidden" ><a
                                    href="{{ route('departemen')}}" class="" >
                                    <h6 class=" text-truncate fs-13 mb-0 font-poppins" >
                                        Pemeliharaan</h6>
                                </a></div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    {{-- <script src="{{ asset('assets/libs/sweetalert2.min.js') }}"></script> --}}
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
    <script>
        
        var rupiah = document.getElementById("harga");
        
        rupiah.addEventListener("keyup", function(e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value);
        });
            
        

        function formatRupiah(angka) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return rupiah;
        }
    </script>

    <script>
        $(document).ready(function () {
  
            $('#grup').on('change', function () {
                var grup_id = this.value;
                console.log(grup_id);
                $("#jenis").html('');
                $.ajax({
                    url: "{{url('inventaris/getjenis')}}",
                    type: "POST",
                    data: {
                        grup_id: grup_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        console.log(result);
                        $('#jenis').html('<option value="">Pilih Jenis</option>');
                        $.each(result.jenis, function (key, value) {
                            
                            $("#jenis").append('<option value="' + value
                                .jenis_id + '">' + value.nama_jenis + '</option>');
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#carirow tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        $(document).ready(function() {
            $("#myInput2").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#carirow2 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script>
        @if ($errors->has('item'))
            $(document).ready(function() {

                $('#exampleModalgrid').modal('show');

            });
        @endif
        // @if ($errors->has('inventory'))
        //     $(document).ready(function() {

        //         $('#exampleModalgrid').modal('show');

        //     });
        // @endif

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
    @if ($errors->has('inventory'))
        <script>
            Toastify({
                text: "Pilih minimal 1 item untuk generate QR !",
                duration: 5000,
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
    @endif
    <script type="text/javascript">
        $('#btnSubmit').click(function() {
            $(this).css('display', 'none');
            $('#loading').show();
            return true;
        });
    </script>
    <script type="text/javascript">
        $('#btnSubmit2').click(function() {
            $(this).css('display', 'none');
            $('#loading2').show();
            return true;
        });
    </script>
    <script type="text/javascript">
        $('#btnSubmit3').click(function() {
            $(this).css('display', 'none');
            $('#loading3').show();
            return true;
        });
    </script>
@endpush
