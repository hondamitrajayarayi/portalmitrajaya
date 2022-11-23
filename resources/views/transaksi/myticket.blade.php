@extends('layouts.master')
@section('title', 'My Ticket')
@section('nav_active_my_ticket', 'active')
@section('content')


    <div class="modal fade zoomIn" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel"
        data-v-01bddeea="" style="display: none;" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-primary" data-v-01bddeea="">
                    <h5 class="modal-title text-light" id="exampleModalLabel" data-v-01bddeea=""> Tambah Departemen </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal" data-v-01bddeea=""></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('departemen.simpan') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <div>
                                    <label for="validationCustom02"
                                        class="form-label @error('nama_dep') text-danger @enderror">Nama Departemen</label>
                                        <input type="text" name="nama_dep" 
                                        class="form-control @error('nama_dep') is-invalid @enderror" id="validationCustom04"
                                        autocomplete="off">
                                  
                                    @error('nama_dep')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            
                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
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

    <div class="modal fade zoomIn" id="modaledit" tabindex="-1" aria-labelledby="exampleModalgridLabel" data-v-01bddeea=""
        style="display: none;" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-primary" data-v-01bddeea="">
                    <h5 class="modal-title text-light" id="exampleModalgridLabel">Edit Departemen</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal" data-v-01bddeea=""></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('departemen.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                        <div class="row g-3">

                            <div class="col-xxl-12">
                                <div>
                                    <label for="validationCustom02"
                                        class="form-label @error('edit_nama') text-danger @enderror">Nama Departemen</label>
                                        <input type="text" id="edit_nama" name="edit_nama" 
                                        class="form-control @error('edit_nama') is-invalid @enderror" id="validationCustom04"
                                        autocomplete="off">
                                  
                                    @error('edit_nama')
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
        <div class="col-xl-12">
            <div div class="card">
                <div class="card-header border-0" data-v-cd5f1dea="">
                    <div class="row g-4" data-v-cd5f1dea="">
                        <div class="col-12 col-md-6" data-v-cd5f1dea="">
                          
                               
                       
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
                                    <th class="sort" data-sort="customer_name">No</th>
                                    <th class="sort" data-sort="email">Masalah</th>
                                    <th class="sort" data-sort="email">Nama Kategori</th>
                                    <th class="sort" data-sort="email">Kondisi</th>
                                    <th class="sort" data-sort="email">Progrss</th>
                                    <th class="sort" data-sort="email">Status</th>
                                    <th class="sort" data-sort="email">Rating</th>
                                    <th class="sort" data-sort="status">Updated</th>
                                    <th class="sort" data-sort="status">Created</th>
                                    <th class="sort" data-sort="action">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all" id="carirow">
                                @foreach ($data as $no => $item)
                                    <tr>

                                        <td class="status">{{ $data->firstItem() + $no }}</td>
                                        <td class="customer_name">{{ $item->subjek_masalah}}</td>
                                        <td class="customer_name">{{ $item->kategori['nama_kategori'] }}</td>
                                        <td class="customer_name">{{ $item->kondisi['nama_kondisi'] }}</td>
                                        <td class="customer_name">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar @if($item->status != 5) bg-success @else bg-danger @endif" role="progressbar" style="width: {{ $item->progress }}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td class="customer_name">
                                            @if($item->status == 1)
                                                <span class="badge bg-warning"> Menunggu Aproval Internal</span>
                                            @elseif($item->status == 2)
                                                <span class="badge bg-warning"> Aproval Internal</span>
                                            @elseif($item->status == 3)
                                                <span class="badge bg-info"> Menunggu Aproval Teknisi</span>
                                            @elseif($item->status == 4)
                                                <span class="badge bg-primary"> Sedang Dalam Pengerjaan</span>
                                            @elseif($item->status == 5)
                                                <span class="badge bg-danger"> Ditolak</span>
                                            @elseif($item->status == 0)
                                                <span class="badge bg-success"> Solved</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($item->ratting['rating']))
                                            <span>
                                                <span class="badge bg-light text-body fs-12 fw-medium">
                                                    <i class="mdi mdi-star text-warning me-1"></i> {{ $item->ratting['rating'] }}
                                                </span>
                                            </span>
                                            @else
                                            -
                                            @endif
                                            
                                        </td>
                                        <td class="phone"> @tanggal($item->updated_at) </td>
                                        <td class="date">@tanggal($item->created_at)</td>
                                        <td>
                                            <a href="{{ route('detail.ticket',$item->idTiket) }}" class="btn btn-sm btn-light btn-label">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0">
                                                        <i class="ri-eye-fill label-icon align-middle fs-12 me-2"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        Detail
                                                    </div>
                                                </div>
                                            </a>
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
    </script>
    <script>
        $(document).on('click', '.edit', function() {
            var url = "departemen/";
            var id = $(this).data('id');
            $.get(url + id + '/edit', function(data) {
                //success data
                console.log(data);
                $('#id').val(data.id);
                $('#edit_nama').val(data.nama_dept);
                $('#modaledit').modal('show');
            })
        });
    </script>
    <script>
        @if ($errors->has('nama_dep'))
            $(document).ready(function() {

                $('#exampleModalgrid').modal('show');

            });
        @endif

        @if ($errors->has('edit_nama'))

            $(document).ready(function() {

                $('#modaledit').modal('show');

            });
        @endif
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
