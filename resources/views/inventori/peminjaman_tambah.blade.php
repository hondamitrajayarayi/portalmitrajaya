@extends('layouts.master')
@section('title', 'Tambah Data Peminjaman Inventaris')
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

    <div class="row">
        <div class="col-xl-9">
            <div div class="card">
                <div class="card-header" >
                    <h6 class="card-title mb-0 font-poppins fs-15" >Tambah Peminjaman Inventaris</h6>
                </div>
                <div class="card-body fs-12">
                    <form action="{{ route('inventaris.peminjaman.simpan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <label for="basiInput" class="form-label mb-1">Pilih Item <i class="text-danger">*</i></label>
                                    <select class="form-control" id="choices-multiple-remove-button" data-choices data-choices-removeItem name="item[]" multiple>
                                        <option value="">Pilih Item</option>
                                        @foreach($data as $result)
                                        <option value="{{ $result->inventory_id }}">{{ $result->inventory_id }} | {{ $result->item }} | {{ $result->deskripsi_item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div>
                                    <label for="basiInput" class="form-label mb-1">Divisi Peminjam<i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" name="divisi_peminjam" value="{{ old('divisi_peminjam') }}" required id="valueInput">
                                </div>
                            </div>
                            <div class="col-md-8 mt-3">
                                <div>
                                    <label for="basiInput" class="form-label mb-1">Nama Peminjam<i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" name="nama_peminjam" value="{{ old('nama_peminjam') }}" required id="valueInput">
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div>
                                    <label for="basiInput" class="form-label mb-1">Estimasi Dikembalikan<i class="text-danger">*</i></label>
                                    <input type="date" class="form-control" name="estimasi" value="{{ old('estimasi') }}" id="exampleInputdate" required>
                                    {{-- <input type="text" class="form-control flatpickr-input" id="datepicker-deadline-input" placeholder="Pilih tanggal" data-provider="flatpickr" readonly="readonly"> --}}
                                </div>
                            </div>
                            
                            
                            <div class="col-md-8 mt-3">
                                <div>
                                    <label for="basiInput" class="form-label mb-1">Keterangan<i class="text-danger">*</i></label>
                                    <textarea type="text" name="keterangan" class="form-control" id="valueInput" required>{{ old('keterangan') }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card-body">
                                    <div class="hstack gap-2 justify-content-end d-print-none">
                                        <button type="submit" class="btn btn-success"><i class="ri-save-3-fill align-bottom me-1"></i> Submit</button>
                                        <a href="{{ route('inventaris.peminjaman.tambah') }}" id="btnSubmit2" type="buttom" class="btn btn-danger"><i class="ri-restart-line align-bottom me-1"></i> Reset</a>
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

                                        <a href="{{ route('inventaris.peminjaman') }}" type="buttom" id="btnSubmit3" class="btn btn-primary"><i class="ri-arrow-go-back-line align-bottom me-1"></i> Back</a>
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
                                        class=" ri-briefcase-line" ></i></span></div>
                            <div class="flex-grow-1 ms-2 mt-0 mt-1 overflow-hidden" ><a
                                    href="{{ route('inventaris')}}" class="" >
                                    <h6 class=" text-truncate fs-13 mb-0 font-poppins" >
                                        Inventaris</h6>
                                </a></div>
                        </div>
                        <div class="d-flex mb-2 list-setting_item pointer" >
                            <div class="flex-shrink-0" ><span
                                    class="badge badge-soft-primary p-1 fs-15" ><i
                                        class="text-info ri-share-forward-2-fill" ></i></span></div>
                            <div class="flex-grow-1 ms-2 mt-0 mt-1 overflow-hidden" ><a
                                    href="{{ route('inventaris.peminjaman')}}" class="" >
                                    <h6 class="text-info text-truncate fs-13 mb-0 font-poppins" >
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
    <script src="{{ asset('assets/scripts/choices.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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
    @if ($errors->has('item'))
        <script>
            Toastify({
                text: "Pilih minimal 1 item untuk peminjaman !",
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
