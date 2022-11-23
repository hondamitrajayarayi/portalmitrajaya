@extends('layouts.master')
@section('title', 'Master Data Teknisi')
@section('nav_active_teknisi', 'active')
@section('content')


    <div class="modal fade zoomIn" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel"
        data-v-01bddeea="" style="display: none;" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-primary" data-v-01bddeea="">
                    <h5 class="modal-title text-light" id="exampleModalLabel" data-v-01bddeea=""> Tambah Teknisi </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal" data-v-01bddeea=""></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('teknisi.simpan') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <div>
                                    <label for="validationCustom02"
                                        class="form-label">Nama Teknisi</label>
                                        <select class="form-control" data-choices name="teknisi" id="choices-single-default">
                                            <option value="">Pilih Teknisi</option>
                                            @foreach ($teknisi as $kg)
                                                <option value="{{ $kg->username }}" @if(old('teknisi') == $kg->username) selected @endif>{{ $kg->name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="mt-2">
                                    <label for="validationCustom04"
                                        class="form-label">Spesialis</label>
                                    <select class="form-control" data-choices name="kategori" id="choices-single-default">
                                        <option value="">Pilih Spesialis</option>
                                        @foreach ($kategori as $kg)
                                            <option value="{{ $kg->id }}" @if(old('kategori') == $kg->id) selected @endif>{{ $kg->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if($errors->any())
                            <div class="col-xl-12">
                                <hr>
                                    {!! implode('', $errors->all('
                                    
                                        <div class="d-flex mt-0">
                                                <div class="flex-shrink-0 mt-0">
                                                    <i class="ri-information-line text-danger mt-0"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-1 mt-0">
                                                    <p class="mt-0 mb-0 text-danger">:message</p>
                                                </div>
                                            </div>
                                    ')) !!}
                                @endif

                            </div>

                            
                            <!--end col-->
                            <div class="col-lg-12 mt-2">
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
                    <form action="{{ route('teknisi.update') }}" method="POST">
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
                          
                                <div class="d-flex justify-content-md-start justify-content-center" data-v-cd5f1dea=""
                                    data-bs-toggle="modal" data-bs-target="#exampleModalgrid">
                                    {{-- <a href="{{ route('tambah') }}"> --}}
                                    <button class="btn btn-outline-secondary" data-v-cd5f1dea="">
                                        <i class="ri-add-line align-bottom me-1" data-v-cd5f1dea=""></i> Tambah Data
                                    </button>
                                    {{-- </a> --}}
                                </div>
                       
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
                                    <th class="sort" data-sort="email">Nama Teknisi</th>
                                    <th class="sort" data-sort="email">Spesialis</th>
                                    <th class="sort" data-sort="email">Status</th>
                                    <th class="sort" data-sort="status">Updated</th>
                                    <th class="sort" data-sort="status">Created</th>
                                    <th class="sort" data-sort="action">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all" id="carirow">
                                @foreach ($data as $no => $item)
                                    <tr>

                                        <td class="status">{{ $data->firstItem() + $no }}</td>
                                        <td class="customer_name">{{ $item->karyawan->nama }}</td>
                                        <td class="customer_name">{{ $item->kategori->nama_kategori }}</td>
                                        <td class="customer_name">
                                            <div class="form-check form-switch" id='editstatus'>
                                                <input class="form-check-input" data-id="{{ $item->id }}" data-status="{{ $item->status }}" type="checkbox" role="switch" id="SwitchCheck7" name="status" @if($item->status == '1') checked @endif>
                                            </div>
                                            <div id="showloading" style="display:none;">
                                                <span class="spinner-border spinner-border-sm flex-shrink-0"> </span>

                                            </div>
                                            
                                        </td>
                                        <td class="phone"> @tanggal($item->updated_at) </td>
                                        <td class="date">@tanggal($item->created_at)</td>
                                        <td>
                                            <span data-v-cd5f1dea="">
                                                <div class="dropdown" data-v-cd5f1dea=""><button
                                                        class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false"
                                                        data-v-cd5f1dea=""><i class="ri-more-fill"
                                                            data-v-cd5f1dea=""></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-end" data-v-cd5f1dea=""
                                                        style="">

                                                        {{-- <li data-v-cd5f1dea="">
                                                            <a href="javascript:void(0)" class="dropdown-item edit"
                                                                id="edit" data-v-cd5f1dea=""
                                                                data-id="{{ $item->id }}"><i
                                                                    class="ri-pencil-fill align-bottom me-2 text-muted"
                                                                    data-v-cd5f1dea=""></i> Edit</a>
                                                        </li> --}}
                                                        <li data-v-cd5f1dea="">
                                                            <a class="dropdown-item remove-item-btn confirm-delete"
                                                                data-v-cd5f1dea="" data-id="{{ $item->id }}">
                                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"
                                                                    data-v-cd5f1dea="">
                                                                </i>
                                                                Delete
                                                                <form method="POST"
                                                                    action="{{ route('teknisi.hapus', $item->id) }}"
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
        $("input:checkbox").on("change", function () {
            console.log($(this).data('id'));
            console.log($(this).data('status'));
            var id = $(this).data('id');
            var status = $(this).data('status');
            var _token = "{{ csrf_token() }}";
            
            $.ajax({type: "POST",
                url     : 'teknisi/update',
                data    : {
                    _token:_token,
                    id: id
                    ,status:status
                },
                success :   function(){
                    
                    Toastify({
                        text: "Status berhasil diupdate!",
                        duration: 4000,
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "right", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "linear-gradient(to right, #0ab39c, #2982aa)",
                        },
                        //onClick: function(){} // Callback after click
                    }).showToast();
                    window.location.reload();
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '.edit', function() {
            var url = "teknisi/";
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
        @if ($errors->any())
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
        $('#editstatus').click(function() {
            $(this).css('display', 'none');
            $('#showloading').show();
            return true;
        });
    </script>
@endpush
