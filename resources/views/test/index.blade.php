@extends('layouts.master')
@section('title', 'Halaman Index Test CRUD')
@section('content')

    <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('simpan') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="validationCustom04"
                                        class="form-label @error('kode_barang') text-danger @enderror">Kode Barang</label>
                                    <input type="text" name="kode_barang" value="{{ old('kode_barang') }}"
                                        class="form-control @error('kode_barang') is-invalid @enderror"
                                        id="validationCustom04" autocomplete="off">
                                    @error('kode_barang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="validationCustom02"
                                        class="form-label @error('nama_barang') text-danger @enderror">Nama Barang</label>
                                    <input type="text" name="nama_barang" value="{{ old('nama_barang') }}"
                                        class="form-control @error('nama_barang') is-invalid @enderror"
                                        id="validationCustom02" autocomplete="off">
                                    @error('nama_barang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
    <div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="validationCustom04"
                                        class="form-label @error('edit_kode_barang') text-danger @enderror">Kode
                                        Barang</label>
                                    <input type="text" name="edit_kode_barang" id="edit_kode_barang"
                                        value="{{ old('edit_kode_barang') }}"
                                        class="form-control @error('edit_kode_barang') is-invalid @enderror"
                                        id="validationCustom04" autocomplete="off">
                                    @error('edit_kode_barang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="validationCustom02"
                                        class="form-label @error('edit_nama_barang') text-danger @enderror">Nama
                                        Barang</label>
                                    <input type="text" name="edit_nama_barang" id="edit_nama_barang"
                                        value="{{ old('edit_nama_barang') }}"
                                        class="form-control @error('edit_nama_barang') is-invalid @enderror"
                                        id="validationCustom02" autocomplete="off">
                                    @error('edit_nama_barang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
        <div class="col-xl-12">
            <div div class="card">
                <div class="card-header border-0" data-v-cd5f1dea="">
                    <div class="row g-4" data-v-cd5f1dea="">
                        <div class="col-12 col-md-6" data-v-cd5f1dea="">
                            @can('isAdmin')
                                <div class="d-flex justify-content-md-start justify-content-center" data-v-cd5f1dea=""
                                    data-bs-toggle="modal" data-bs-target="#exampleModalgrid">
                                    {{-- <a href="{{ route('tambah') }}"> --}}
                                    <button class="btn btn-outline-secondary" data-v-cd5f1dea="">
                                        <i class="ri-add-line align-bottom me-1" data-v-cd5f1dea=""></i> Tambah Data
                                    </button>
                                    {{-- </a> --}}
                                </div>
                            @endcan

                        </div>
                        <div class="col-12 col-md-6" data-v-cd5f1dea="">
                            <div class="d-flex justify-content-md-end justify-content-center" data-v-cd5f1dea="">
                                <div class="search-box ms-2" data-v-cd5f1dea=""><input type="text"
                                        class="form-control" placeholder="Search .." data-v-cd5f1dea="" id="myInput"
                                        name="search"><i class="ri-search-line search-icon" data-v-cd5f1dea=""></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card header -->
                <div class="card-body">

                    <div class="table-responsive table-card mb-1">
                        <table class="table align-middle table-nowrap" id="customerTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll"
                                                value="option">
                                        </div>
                                    </th>
                                    <th class="sort" data-sort="customer_name">No</th>
                                    <th class="sort" data-sort="email">Kode Barang</th>
                                    <th class="sort" data-sort="phone">Nama Barang</th>
                                    <th class="sort" data-sort="date">Updated</th>
                                    <th class="sort" data-sort="status">Created</th>
                                    <th class="sort" data-sort="action">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all" id="carirow">
                                @foreach ($data as $no => $item)
                                    <tr>
                                        <td scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="chk_child"
                                                    value="option1">
                                            </div>
                                        </td>


                                        <td class="status">{{ $data->firstItem() + $no }}</td>
                                        <td class="customer_name">{{ $item->kode_barang }}</td>
                                        <td class="email">{{ $item->nama_barang }}</td>
                                        <td class="phone">{{ $item->updated_at }}</td>
                                        <td class="date">{{ $item->created_at }}</td>
                                        <td>
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
                                                                data-id="{{ $item->id }}"><i
                                                                    class="ri-pencil-fill align-bottom me-2 text-muted"
                                                                    data-v-cd5f1dea=""></i> Edit</a>
                                                        </li>
                                                        <li data-v-cd5f1dea="">
                                                            <a class="dropdown-item remove-item-btn confirm-delete"
                                                                data-v-cd5f1dea="" data-id="{{ $item->id }}">
                                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"
                                                                    data-v-cd5f1dea="">
                                                                </i>
                                                                Delete
                                                                <form method="POST"
                                                                    action="{{ route('hapus', $item->id) }}"
                                                                    id="delete-{{ $item->id }}">
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>
                                                            </a>
                                                        </li>
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
                        {{-- <div class="pagination-wrap hstack gap-2" style="display: flex;">
                                <a class="page-item pagination-prev disabled" href="#">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0"><li class="active"><a class="page" href="#" data-i="1" data-page="8">1</a></li><li><a class="page" href="#" data-i="2" data-page="8">2</a></li></ul>
                                <a class="page-item pagination-next" href="#">
                                    Next
                                </a>
                            </div> --}}
                        {{ $data->links() }}
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
                confirmButtonText: 'Yes, Delete It!',
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
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#carirow tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script>
        $(document).on('click', '.edit', function() {
            var url = "crud/";
            var id = $(this).data('id');
            $.get(url + id + '/edit', function(data) {
                //success data
                console.log(data);
                $('#id').val(data.id);
                $('#edit_kode_barang').val(data.kode_barang);
                $('#edit_nama_barang').val(data.nama_barang);
                $('#modaledit').modal('show');
            })
        });
    </script>
    <script>
        @error('kode_barang')
            $(document).ready(function() {

                $('#exampleModalgrid').modal('show');

            });
        @enderror
        @error('nama_barang')
            $(document).ready(function() {

                $('#exampleModalgrid').modal('show');

            });
        @enderror
        @error('edit_kode_barang')

            $(document).ready(function() {

                $('#modaledit').modal('show');

            });
        @enderror
        @error('edit_nama_barang')

            $(document).ready(function() {

                $('#modaledit').modal('show');

            });
        @enderror
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
@endpush
