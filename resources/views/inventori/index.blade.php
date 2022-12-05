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

    <div class="row">
        <div class="col-xl-12">
            <div div class="card">
                <div class="card-header" >
                    <h6 class="card-title mb-0 font-poppins fs-15" >Master Inventory</h6>
                </div>
                <form method="POST">
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
                    </div>

                    <div class="card-body fs-12">

                        <div class="table-responsive table-card mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="customer_name">#</th>
                                        <th class="sort" data-sort="email">ID</th>
                                        <th class="sort" data-sort="date">Item</th>
                                        <th class="sort text-center" data-sort="date">QTY</th>
                                        <th class="sort text-center" data-sort="date">Harga Beli</th>
                                        <th class="sort text-center" data-sort="status">Status</th>
                                        <th class="sort text-center" data-sort="status">Gambar</th>
                                        <th class="sort" data-sort="status">Cabang</th>
                                        <th class="sort" data-sort="status">Created</th>
                                        <th class="sort text-center" data-sort="action">Action</th>
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
                                            <td class="customer_name">
                                                {{ $item->inventory_id }}
                                                {{-- <p class="text-muted mb-0">Inventory ID</p> {{ $item->inventory_id }} --}}
                                                {{-- <p class="text-muted mt-1 mb-0">RB ID</p> {{ $item->rb_id ? $item->rb_id : '-' }} --}}
                                            </td>
                                            <td class="email">{{ $item->item }}</td>
                                            <td class="email text-center">{{ $item->qty }}</td>
                                            <td class="email text-end">@uang($item->harga_beli)</td>
                                            <td class="email text-center">
                                                @if($item->status == 1)
                                                    <span class="badge badge-soft-dark badge-border text-wrap"> Close</span>
                                                @elseif($item->status == 0)
                                                    <span class="badge badge-soft-danger badge-border text-wrap"> Dipinjamkan</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($item->image)
                                                <i class="ri-image-line fs-16 text-danger"></i> 
                                                <a href="{{ asset('inventory/gambar/' . $item->image) }}" target="_blank" class="text-muted"><i
                                                    class="mdi mdi-open-in-new"></i></a>
                                                @endif
                                            </td>
                                            <td class="date">{{ $item->cabang->schema_name }} | {{ $item->cabang->branch_name }}</td>
                                            <td class="date">@tanggal($item->created_date)</td>
                                            {{-- <td class="text-center">
                                                <a href="" type="buttom" class="btn btn-light btn-sm"> Detail</a>
                                            </td> --}}
                                            <td class="text-center">
                                                <span data-v-cd5f1dea="">
                                                    <div class="dropdown" data-v-cd5f1dea=""><button
                                                            class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            data-v-cd5f1dea=""><i class="ri-more-fill"
                                                                data-v-cd5f1dea=""></i></button>
                                                        <ul class="dropdown-menu dropdown-menu-end" data-v-cd5f1dea=""
                                                            style="">

                                                            <li data-v-cd5f1dea="">
                                                                <a href="{{ asset('inventaris/getinfo/'. $item->inventory_id ) }}" class="dropdown-item edit"
                                                                    id="edit" target="_blank"><i
                                                                        class="ri-pages-line align-bottom me-2 text-muted"
                                                                        data-v-cd5f1dea=""></i> Detail</a>
                                                            </li>
                                                            <li data-v-cd5f1dea="">
                                                                <a href="javascript:void(0)" class="dropdown-item edit"
                                                                    id="edit" data-v-cd5f1dea=""
                                                                    data-id="{{ $item->inventory_id }}"><i
                                                                        class="ri-service-line align-bottom me-2 text-muted"
                                                                        data-v-cd5f1dea=""></i> Pemeliharaan</a>
                                                            </li>
                                                            {{-- <li data-v-cd5f1dea="">
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
                                                            </li> --}}
                                                        </ul>
                                                    </div>
                                                </span>
                                            </td>
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
        {{-- <div class="col-xl-3 col-md-3">
            <div class="card"  data-v-37db4fe8="">
                <div class="card-header" >
                    <h6 class="card-title mb-0 font-poppins fs-15" >Related Menu</h6>
                </div>
                <div class="card-body" >
                    <div class="list-setting" >
                        <div class="d-flex mb-2 list-setting_item pointer" >
                            <div class="flex-shrink-0" ><span
                                    class="badge badge-soft-primary p-1 fs-15" ><i
                                        class="text-info ri-briefcase-line" ></i></span></div>
                            <div class="flex-grow-1 ms-2 mt-0 mt-1 overflow-hidden" ><a
                                    href="{{ route('inventaris')}}" class="" >
                                    <h6 class="text-info text-truncate fs-13 mb-0 font-poppins" >
                                        Inventaris</h6>
                                </a></div>
                        </div>
                        <div class="d-flex mb-2 list-setting_item pointer" >
                            <div class="flex-shrink-0" ><span
                                    class="badge badge-soft-primary p-1 fs-15" ><i
                                        class="ri-share-forward-2-fill" ></i></span></div>
                            <div class="flex-grow-1 ms-2 mt-0 mt-1 overflow-hidden" ><a
                                    href="{{ route('inventaris.peminjaman')}}" class="" >
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
        </div> --}}
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
                text: "Pilih minimal 1 item untuk melanjutkan proses !",
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
