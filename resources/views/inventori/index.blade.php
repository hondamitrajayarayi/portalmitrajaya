@extends('layouts.master')
@section('title', 'Master Data Inventaris')
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

   
    

    <div class="modal fade zoomIn" id="modaledit" tabindex="-1" aria-labelledby="exampleModalgridLabel" 
        style="display: none;" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-primary" >
                    <h5 class="modal-title text-light" id="exampleModalgridLabel">Edit Karyawan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal" ></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('karyawan.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                        <div class="row g-3">
                            
                            <div class="col-xxl-12">
                                <div>
                                    <label for="validationCustom04"
                                        class="form-label @error('edit_nama') text-danger @enderror">Nama Karyawan</label>
                                    <input type="text" id="edit_nama" name="edit_nama" value="{{ old('edit_nama') }}"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('edit_nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-12">
                                <div>
                                    <label for="validationCustom02"
                                        class="form-label @error('edit_jk') text-danger @enderror">Jenis Kelamin</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="edit_jk" value="L"
                                                id="inlineRadio1" @if(old('edit_jk') == 'L') checked @endif>
                                            <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="edit_jk" value="P"
                                                id="inlineRadio2" @if(old('edit_jk') == 'P') checked @endif>
                                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                        </div>
                                    </div>
                                    @error('edit_jk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-12">
                                <div>
                                    <label for="validationCustom04"
                                        class="form-label @error('edit_bagdept') text-danger @enderror">Bagian
                                        Departemen</label>
                                    
                                    <select class="form-control" id="edit_bagdept" data-choices name="edit_bagdept" id="choices-single-default">
                                        <option value="">Pilih Departemen</option>
                                        {{-- @foreach($dep as $kry)
                                            <option value="{{ $kry->id }}" @if(old('bagdept') == $kry->id) selected @endif>{{ $kry->nama_dept }}</option>
                                        @endforeach --}}
                                    </select>
                                    @error('edit_bagdept')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-12">
                                <div>
                                    <label for="validationCustom04"
                                        class="form-label @error('edit_telp') text-danger @enderror">Telepon</label>
                                    <input type="text" id="edit_telp" name="edit_telp" value="{{ old('edit_telp') }}"
                                        class="form-control @error('edit_telp') is-invalid @enderror" id="validationCustom04"
                                        autocomplete="off">
                                    @error('edit_telp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="submit" id="btnSubmitedit" class="btn btn-primary">Submit</button>
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
        <div class="col-xl-9">
            <div div class="card">
                <div class="card-header" >
                    <h6 class="card-title mb-0 font-poppins fs-15" >Master Inventory</h6>
                </div>
                <form action="{{ route('inventaris.generateqr') }}" method="POST">
                    @csrf
                    <div class="p-3">
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
                                <button class="btn btn-primary" id="btnSubmit2" type="submit" data-v-cd5f1dea="">
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
                    </div>

                    <div class="card-body fs-12">

                        <div class="table-responsive table-card mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="customer_name">#</th>
                                        <th class="sort" data-sort="email">Inventory ID</th>
                                        <th class="sort" data-sort="phone">RB ID</th>
                                        <th class="sort" data-sort="date">Item</th>
                                        <th class="sort text-center" data-sort="date">QTY</th>
                                        <th class="sort text-center" data-sort="date">Harga Beli</th>
                                        <th class="sort text-center" data-sort="status">Status</th>
                                        <th class="sort" data-sort="status">Created</th>
                                        {{-- <th class="sort" data-sort="action">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all" id="carirow">
                                    @foreach ($datai as $no => $item)
                                        <tr>
                                            {{-- <td class="status">{{ $datai->firstItem() + $no }}</td> --}}
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" name="inventory[]" type="checkbox" value="{{ $item->inventory_id }}" id="cardtableCheck">
                                                    <label class="form-check-label" for="cardtableCheck"></label>
                                                </div>
                                            </td>
                                            <td class="customer_name">{{ $item->inventory_id }}</td>
                                            <td class="email"> {{ $item->rb_id }}</td>
                                            <td class="email">{{ $item->item }}</td>
                                            <td class="email text-center">{{ $item->qty }}</td>
                                            <td class="email text-end">@uang($item->harga_beli)</td>
                                            <td class="email text-center">
                                                @if($item->status == 1)
                                                    <span class="badge badge-soft-success badge-border text-wrap"> Free</span>
                                                @elseif($item->status == 2)
                                                    <span class="badge bg-warning"> Aproval Internal</span>
                                                @elseif($item->status == 3)
                                                    <span class="badge bg-info"> Menunggu Aproval Teknisi</span>
                                                @endif
                                            </td>
                                            <td class="date">@tanggal($item->created_date)</td>
                                            {{-- <td>
                                                <span data-v-cd5f1dea="">
                                                    <div class="dropdown" data-v-cd5f1dea=""><button
                                                            class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            data-v-cd5f1dea=""><i class="ri-more-fill"
                                                                data-v-cd5f1dea=""></i></button>
                                                        <ul class="dropdown-menu dropdown-menu-end" data-v-cd5f1dea=""
                                                            style="">

                                                            <li data-v-cd5f1dea="">
                                                                <a href="javascript:void(0)" class="dropdown-item edit"
                                                                    id="edit" data-v-cd5f1dea=""
                                                                    data-id="{{ $item->inventory_id }}"><i
                                                                        class="ri-qr-code-line align-bottom me-2 text-muted"
                                                                        data-v-cd5f1dea=""></i> Lihat QR</a>
                                                            </li>
                                                            <li data-v-cd5f1dea="">
                                                                <a href="javascript:void(0)" class="dropdown-item edit"
                                                                    id="edit" data-v-cd5f1dea=""
                                                                    data-id="{{ $item->inventory_id }}"><i
                                                                        class="ri-share-forward-2-fill align-bottom me-2 text-muted"
                                                                        data-v-cd5f1dea=""></i> Peminjaman</a>
                                                            </li>
                                                            <li data-v-cd5f1dea="">
                                                                <a href="javascript:void(0)" class="dropdown-item edit"
                                                                    id="edit" data-v-cd5f1dea=""
                                                                    data-id="{{ $item->inventory_id }}"><i
                                                                        class="ri-service-line align-bottom me-2 text-muted"
                                                                        data-v-cd5f1dea=""></i> Pemeliharaan</a>
                                                            </li>
                                                            <li data-v-cd5f1dea="">
                                                                <a class="dropdown-item remove-item-btn confirm-delete"
                                                                    data-v-cd5f1dea="" data-id="{{ $item->inventory_id }}">
                                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"
                                                                        data-v-cd5f1dea="">
                                                                    </i>
                                                                    Delete
                                                                    <form method="POST"
                                                                        action="{{ route('karyawan.hapus', $item->inventory_id) }}"
                                                                        id="delete-{{ $item->inventory_id }}">
                                                                        @csrf
                                                                        @method('delete')
                                                                    </form>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </span>
                                            </td> --}}
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
                            {{ $datai->links() }}
                        </div>
                    </div>
                </form>
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
        $(document).on('click', '.edit', function() {
            var url = "karyawan/";
            var id = $(this).data('id');
            $.get(url + id + '/edit', function(data) {
                //success data
                console.log(data);
                $('#id').val(data.nik);
                $('#edit_nama').val(data.nama);
                $('#edit_telp').val(data.no_telp);
                $('#edit_bagdept').val(data.id_bag_dept);
                $('input[type=radio][name="edit_jk"][value='+data.jk+']').prop('checked', true);
                $('#modaledit').modal('show');
            })
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
@endpush
