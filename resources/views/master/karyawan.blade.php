@extends('layouts.master')
@section('title', 'Master Data Karyawan')
@section('nav_active_karyawan', 'active')
@section('nav_active_master_data', 'active')
@section('content')

   
    <div class="modal fade zoomIn" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" data-v-01bddeea=""
        style="display: none;" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-primary" data-v-01bddeea="">
                    <h5 class="modal-title text-light" id="exampleModalLabel" data-v-01bddeea=""> Tambah Karyawan </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal" data-v-01bddeea=""></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('karyawan.simpan') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <div>
                                    <label for="validationCustom04"
                                        class="form-label @error('nama') text-danger @enderror">Nama Karyawan</label>
                                    <input type="text" name="nama" value="{{ old('nama') }}"
                                        class="form-control @error('nama') is-invalid @enderror" id="validationCustom04"
                                        autocomplete="off">
                                    @error('nama')
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
                                        class="form-label @error('jk') text-danger @enderror">Jenis Kelamin</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jk" value="L"
                                                id="inlineRadio1" @if(old('jk') == 'L') checked @endif>
                                            <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jk" value="P"
                                                id="inlineRadio2" @if(old('jk') == 'P') checked @endif>
                                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                        </div>
                                    </div>
                                    @error('jk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-12">
                                <div>
                                    <label for="validationCustom04"
                                        class="form-label @error('telp') text-danger @enderror">Telepon</label>
                                    <input type="text" name="telp" value="{{ old('telp') }}"
                                        class="form-control @error('telp') is-invalid @enderror" id="validationCustom04"
                                        autocomplete="off">
                                    @error('telp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-12">
                                <div>
                                    <label for="validationCustom04"
                                        class="form-label @error('branch') text-danger @enderror">Branch</label>
                                    
                                    <select class="form-control" data-choices name="branch" id="choices-single-default">
                                        <option value="">Pilih Branch</option>
                                        @foreach($branch as $kry)
                                            <option value="{{ $kry->branch_id }},{{ $kry->schema_name }}" @if(old('branch') == $kry->branch_id) selected @endif>{{ $kry->schema_name }} | {{ $kry->branch_name }}</option>
                                        @endforeach
                                    </select>
                                    
                                    @error('branch')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-12">
                                <div>
                                    <label for="validationCustom04"
                                        class="form-label @error('bagdept') text-danger @enderror">Bagian
                                        Departemen</label>
                                    
                                    <select class="form-control" data-choices name="bagdept" id="choices-single-default">
                                        <option value="">Pilih Departemen</option>
                                        @foreach($dep as $kry)
                                            <option value="{{ $kry->id }}" @if(old('bagdept') == $kry->id) selected @endif>{{ $kry->nama_dept }}</option>
                                        @endforeach
                                    </select>
                                    
                                    @error('bagdept')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-12">
                                <div>
                                    <label for="validationCustom04"
                                        class="form-label @error('jabatan') text-danger @enderror">Bagian
                                        Jabatan</label>
                                    
                                    <select class="form-control" data-choices name="jabatan" id="choices-single-default">
                                        <option value="">Pilih Departemen</option>
                                        @foreach($jabatan as $kry)
                                            <option value="{{ $kry->id }}" @if(old('jabatan') == $kry->id) selected @endif>{{ $kry->nama_jabatan }}</option>
                                        @endforeach
                                    </select>
                                    
                                    @error('jabatan')
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
                    <h5 class="modal-title text-light" id="exampleModalgridLabel">Edit Karyawan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal" data-v-01bddeea=""></button>
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
                                        @foreach($dep as $kry)
                                            <option value="{{ $kry->id }}" @if(old('bagdept') == $kry->id) selected @endif>{{ $kry->nama_dept }}</option>
                                        @endforeach
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
                    <h6 class="card-title mb-0 font-poppins fs-15" >Master Karyawan</h6>
                </div>
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
                                    <th class="sort" data-sort="email">Nama</th>
                                    <th class="sort" data-sort="phone">Jenis Kelamin</th>
                                    <th class="sort" data-sort="date">Cabang</th>
                                    {{-- <th class="sort" data-sort="date">Schema</th> --}}
                                    <th class="sort" data-sort="date">Departemen</th>
                                    <th class="sort" data-sort="date">Jabatan</th>
                                    <th class="sort" data-sort="date">No Telepon</th>
                                    {{-- <th class="sort" data-sort="status">Updated</th> --}}
                                    <th class="sort" data-sort="status">Created</th>
                                    <th class="sort" data-sort="action">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all" id="carirow">
                                @foreach ($data as $no => $item)
                                    <tr>
                                        <td class="status">{{ $data->firstItem() + $no }}</td>
                                        <td class="customer_name">{{ $item->nama }}</td>
                                        <td class="email"> {{ $item->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                        <td class="email">{{ $item->cabang['branch_name'] }}</td>
                                        {{-- <td class="email">{{ $item->schema }}</td> --}}
                                        <td class="email">{{ $item->departemen['nama_dept'] }}</td>
                                        <td class="email">{{ $item->jabatan['nama_jabatan'] }}</td>
                                        <td class="email">{{ $item->no_telp }}</td>
                                        {{-- <td class="phone">@tanggal($item->updated_at)</td> --}}
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

                                                        <li data-v-cd5f1dea="">
                                                            <a href="javascript:void(0)" class="dropdown-item edit"
                                                                id="edit" data-v-cd5f1dea=""
                                                                data-id="{{ $item->nik }}"><i
                                                                    class="ri-pencil-fill align-bottom me-2 text-muted"
                                                                    data-v-cd5f1dea=""></i> Edit</a>
                                                        </li>
                                                        <li data-v-cd5f1dea="">
                                                            <a class="dropdown-item remove-item-btn confirm-delete"
                                                                data-v-cd5f1dea="" data-id="{{ $item->nik }}">
                                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"
                                                                    data-v-cd5f1dea="">
                                                                </i>
                                                                Delete
                                                                <form method="POST"
                                                                    action="{{ route('karyawan.hapus', $item->nik) }}"
                                                                    id="delete-{{ $item->nik }}">
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
        <div class="col-xl-3 col-md-3">
            <div class="card"  data-v-37db4fe8="">
                <div class="card-header" >
                    <h6 class="card-title mb-0 font-poppins fs-15" >Related Master Data</h6>
                </div>
                <!---->
                <div class="card-body" >
                    <div class="list-setting" >
                        <div class="d-flex mb-2 list-setting_item pointer" >
                            <div class="flex-shrink-0" ><span
                                    class="badge badge-soft-primary p-1 fs-15" ><i
                                        class="text-info ri-user-2-line" ></i></span></div>
                            <div class="flex-grow-1 ms-2 mt-0 mt-1 overflow-hidden" ><a
                                    href="{{ route('karyawan')}}" class="" >
                                    <h6 class="text-info text-truncate fs-13 mb-0 font-poppins" >
                                        Karyawan</h6>
                                </a></div>
                        </div>
                        <div class="d-flex mb-2 list-setting_item pointer" >
                            <div class="flex-shrink-0" ><span
                                    class="badge badge-soft-primary p-1 fs-15" ><i
                                        class="ri-hand-coin-line" ></i></span></div>
                            <div class="flex-grow-1 ms-2 mt-0 mt-1 overflow-hidden" ><a
                                    href="{{ route('jabatan')}}" class="" >
                                    <h6 class=" text-truncate fs-13 mb-0 font-poppins" >
                                        Jabatan</h6>
                                </a></div>
                        </div>
                        <div class="d-flex mb-2 list-setting_item pointer" >
                            <div class="flex-shrink-0" ><span
                                    class="badge badge-soft-primary p-1 fs-15" ><i
                                        class="ri-node-tree" ></i></span></div>
                            <div class="flex-grow-1 ms-2 mt-0 mt-1 overflow-hidden" ><a
                                    href="{{ route('departemen')}}" class="" >
                                    <h6 class=" text-truncate fs-13 mb-0 font-poppins" >
                                        Departemen</h6>
                                </a></div>
                        </div>
                        <div class="d-flex mb-2 list-setting_item pointer" >
                            <div class="flex-shrink-0" ><span
                                    class="badge badge-soft-primary p-1 fs-15" ><i
                                        class=" ri-building-line" ></i></span></div>
                            <div class="flex-grow-1 ms-2 mt-0 mt-1 overflow-hidden" ><a
                                    href="{{ route('branch')}}" class="" >
                                    <h6 class=" text-truncate fs-13 mb-0 font-poppins" >
                                        Branch</h6>
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
        @if ($errors->has('nama') || $errors->has('telp') || $errors->has('jk') || $errors->has('bagdept'))
            $(document).ready(function() {

                $('#exampleModalgrid').modal('show');

            });
        @endif

        @if($errors->has('edit_nama')||$errors->has('edit_telp')||$errors->has('edit_jk')||$errors->has('edit_bagdept'))

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
