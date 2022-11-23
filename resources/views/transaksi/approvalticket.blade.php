@extends('layouts.master')
@section('title', 'Approval Ticket')
@section('nav_active_approval_ticket', 'active')
@section('content')


    <div class="modal fade zoomIn" id="modaledit" tabindex="-1" aria-labelledby="exampleModalgridLabel" data-v-01bddeea=""
        style="display: none;" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-primary" data-v-01bddeea="">
                    <h5 class="modal-title text-light" id="exampleModalgridLabel">Tugaskan Teknisi</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal" data-v-01bddeea=""></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ticket.updateStatus') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                        <input type="hidden" value="tugaskan_teknisi" name="aksi">
                        <div class="row g-3">

                            <div class="col-xxl-12">
                                <div>
                                    <label for="validationCustom02"
                                        class="form-label @error('teknisi') text-danger @enderror">Pilih Teknisi</label>                                          
                                        </select>
                                        <select class="form-select @error('teknisi') is-invalid @enderror" id="teknisi" name="teknisi" >
                                        </select>
                                    @error('teknisi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>

                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="submit" id="btnSubmit" class="btn btn-primary">Assigment</button>
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

    <div class="modal fade zoomIn" id="modaltolak" tabindex="-1" aria-labelledby="exampleModalgridLabel" data-v-01bddeea=""
        style="display: none;" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-primary" data-v-01bddeea="">
                    <h5 class="modal-title text-light" id="exampleModalgridLabel">Tolak Ticket</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal" data-v-01bddeea=""></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ticket.updateStatus') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="idTiket" value="{{ old('id') }}">
                        <input type="hidden" value="tolaktiket" name="aksi">
                        <div class="row g-3">

                            <div class="col-xxl-12">
                                <div>
                                    <label for="validationCustom02"
                                        class="form-label @error('alasantolak') text-danger @enderror">Alasan Tiket Ditolak</label>
                                        <textarea class="form-control @error('alasantolak') is-invalid @enderror" name="alasantolak" id="alasantolak" rows="3">{{ old('alasantolak') }}</textarea>

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
                                <div class="search-box ms-2" data-v-cd5f1dea=""><input type="text" class="form-control"
                                        placeholder="Search .." data-v-cd5f1dea="" id="myInput" name="search"><i
                                        class="ri-search-line search-icon" data-v-cd5f1dea=""></i>
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
                                    <th class="sort" data-sort="email">Reported</th>
                                    <th class="sort" data-sort="email">Kondisi</th>
                                    <th class="sort" data-sort="email">Nama Kategori</th>
                                    <th class="sort" data-sort="email">Masalah</th>
                                    <th class="sort" data-sort="status">Created</th>
                                    <th class="sort text-center" data-sort="action">Action Ticket</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all" id="carirow">
                                @foreach ($data as $no => $item)
                                    <tr>

                                        <td class="status">{{ $data->firstItem() + $no }}</td>
                                        <td class="customer_name">{{ $item->karyawan['nama'] }}</td>
                                        <td class="customer_name">{{ $item->kondisi['nama_kondisi'] }}</td>
                                        <td class="customer_name">{{ $item->kategori['nama_kategori'] }}</td>
                                        <td class="customer_name ">{{ $item->subjek_masalah }}</td>

                                        <td class="date">@tanggal($item->created_at)</td>
                                        <td class="text-center">
                                            @if ($item->status == 1)
                                                <a href="javascript:void(0)" class="setuju" id="setuju"
                                                    data-v-cd5f1dea="" data-id="{{ $item->idTiket }}" data-kategori="{{ $item->id_kategori }}">

                                                    <button type="button"
                                                        class="btn btn-success btn-sm btn-label waves-effect right waves-light rounded-pill">
                                                        <i
                                                            class="ri-mail-check-line label-icon align-middle rounded-pill fs-16 ms-2"></i>
                                                        Setujui
                                                    </button>
                                                </a>
                                                <a href="javascript:void(0)" class="tolak" id="tolak"
                                                    data-v-cd5f1dea="" data-id="{{ $item->idTiket }}">

                                                    <button type="button"
                                                        class="btn btn-danger btn-sm btn-label waves-effect right waves-light rounded-pill">
                                                        <i
                                                            class="ri-mail-close-line label-icon align-middle rounded-pill fs-16 ms-2"></i>
                                                        Tolak
                                                    </button>
                                                </a>
                                            @endif
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
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '.tolak', function() {
                var id = $(this).data('id');
                console.log($(this).data('id'));
                $("#idTiket").empty();
                $('#idTiket').val(id);
                $("#alasantolak").empty();
                $('#modaltolak').modal('show');
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '.setuju', function() {
                var url = "ticket/";
                var idtiket = $(this).data('id');
                var id = $(this).data('kategori');
                $('#id').val(idtiket);
                console.log(id);    
                $.ajax({
                    dataType: 'json',
                    type: 'get',
                    url: 'ticket/'+ id +'/kategori/teknisi',
                    success: function (data) {
                        
                        console.log(data);
                        if (data) {
                            $('#modaledit').modal('show');
                            $("#teknisi").empty();
                            $("#teknisi").append('<option value="">Pilih Teknisi</option>');

                            data.forEach((item, index) => {
                                $("#teknisi").append("<option value='"+item['nik']+"'>"+item['karyawan']['nama']+"</option>");
                            });
                        }
                        
                    },

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
    </script>

    <script>
        @if ($errors->has('alasantolak'))
            $(document).ready(function() {

                $('#modaltolak').modal('show');

            });
        @endif

        @if ($errors->has('teknisi'))

            $(document).ready(function() {
                var id =  old('id');
                
                $.ajax({
                    dataType: 'json',
                    type: 'get',
                    url: 'ticket/'+ id +'/kategori/teknisi',
                    success: function (data) {
                        
                        console.log(data);
                        if (data) {
                            $('#modaledit').modal('show');
                            $("#teknisi").empty();
                            $("#teknisi").append('<option value="">Pilih Teknisi</option>');

                            data.forEach((item, index) => {
                                $("#teknisi").append("<option value='"+item['nik']+"'>"+item['karyawan']['nama']+"</option>");
                            });
                        }
                        
                    },

                });

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
