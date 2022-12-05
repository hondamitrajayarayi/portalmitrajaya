@extends('layouts.master')
@section('title', 'Peminjaman Inventaris')
@section('nav_active_peminjaman', 'active')
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
    <!-- staticBackdrop Modal -->
    <div class="modal fade zoomIn" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <lord-icon src="https://cdn.lordicon.com/kjkiqtxg.json" trigger="loop" colors="primary:#f7b84b,secondary:#405189" style="width:130px;height:130px">
                    </lord-icon>
                    <form action="{{ route('inventaris.peminjaman.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_pinjam" id="id_pinjam" value="{{ old('id_pinjam') }}">
                        
                        <div class="mt-3">
                            <h5 class="mb-1">Apakah anda yakin melakukan pengembalian ?</h5>
                            <p class="text-muted mb-2">Pastikan barang yang dikembalikan telah sesuai.</p>
                            {{-- <div class="card p-2"> --}}
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="mt-xl-0">
                                            <div class="mt-1 text-muted">
                                                <div class="card ribbon-box border shadow-none mb-lg-0">
                                                    <div class="card-body">
                                                        <div class="ribbon ribbon-primary round-shape">Info item</div>
                                                        <div class="ribbon-content mt-4 text-start text-muted">
                                                            
                                                            <div id="detailitem">

                                                            </div>
                                                                    
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 mt-3 text-start">
                                        <div>
                                            <label for="basiInput" class="form-label mb-1 text-start">Note<i class="text-danger">*</i></label>        
                                            <textarea class="form-control" name="note" placeholder="Tambah keterangan disini"></textarea>
                                        </div>
                                    </div>
                                </div>
                            {{-- </div> --}}
                            <div class="hstack gap-2 justify-content-center mt-4">
                                <button type="submit" class="btn btn-danger" id="btnSubmit2">Ya, yakin</button>
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
                                <a type="button" href="javascript:void(0);" class="btn btn-primary" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div div class="card">
                <div class="card-header" >
                    <h6 class="card-title mb-0 font-poppins fs-15" >Peminjaman Inventory</h6>
                </div>
                <form method="POST">
                    @csrf
                    <div class="p-3">
                        <div class="row g-2">
                            <div class="col-lg">
                                <div class="search-box">
                                    <input type="text" id="myInput" class="form-control search" placeholder="Search peminjaman id, nama peminjam, item">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <div class="col-lg-auto">
                                <div class="d-flex justify-content-md-start justify-content-center" data-v-cd5f1dea=""
                                        data-bs-toggle="modal" data-bs-target="#exampleModalgrid">
                                        <a href="{{ route('inventaris.peminjaman.tambah') }}" type="button" id="btnSubmit" class="btn btn-secondary" data-v-cd5f1dea="">
                                            <i class="ri-add-line align-bottom me-1" data-v-cd5f1dea=""></i> Tambah Data
                                        </a>
                                        <div id="loading" style="display:none;">
                                            <button type="button" class="btn btn-secondary btn-load" disabled>
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
                            {{-- <div class="col-lg-auto">
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
                            </div> --}}
                        </div>
                    </div>

                    <div class="card-body fs-12">

                        <div class="table-responsive table-card mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="customer_name">#</th>
                                        <th class="sort" data-sort="email">ID</th>
                                        <th class="sort" data-sort="date">Nama Peminjam</th>
                                        <th class="sort" data-sort="date">Divisi</th>
                                        <th class="sort" data-sort="date">Item</th>
                                        <th class="sort" data-sort="date">Tanggal Pinjam</th>
                                        <th class="sort" data-sort="date">Tanggal Balik</th>
                                        <th class="sort" data-sort="date">Estimasi Balik</th>
                                        <th class="sort text-center" data-sort="status">Status</th>
                                        <th class="sort text-center" data-sort="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all" id="carirow">
                                    @foreach ($datai as $no => $item)
                                        <tr>
                                            <td class="status">{{ $datai->firstItem() + $no }}</td>
                                            {{-- <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" name="inventory[]" type="checkbox" value="{{ $item->inventory_id }}" id="cardtableCheck">
                                                    <label class="form-check-label" for="cardtableCheck"></label>
                                                </div>
                                            </td> --}}
                                            <td class="customer_name">
                                                {{ $item->id_pinjam }}
                                                {{-- <p class="text-muted mb-0">Inventory ID</p> {{ $item->inventory_id }} --}}
                                                {{-- <p class="text-muted mt-1 mb-0">RB ID</p> {{ $item->rb_id ? $item->rb_id : '-' }} --}}
                                            </td>
                                            <td class="email">{{ $item->nama_peminjam }}</td>
                                            <td class="email">{{ $item->divisi_peminjam }}</td>
                                            <td class="email">
                                                @foreach($item->ditem as $rslt)
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0">
                                                        <i class="ri-checkbox-circle-fill text-primary"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <p class="mb-0">{{ $rslt->inventaris['item'] }}</p>
                                                    </div>
                                                </div>
                                                @endforeach 
                                            </td>
                                            <td class="email">@tanggal($item->tgl_pinjam)</td>
                                            <td class="email">
                                                @if($item->tgl_balik != null)
                                                @tanggal($item->tgl_balik)
                                                @else -
                                                @endif
                                            </td>
                                            <td class="email">@tanggal($item->estimasi_balik)</td>
                                            
                                            <td class="email text-center">
                                                @if($item->status == 1)
                                                    <span class="badge badge-soft-danger badge-border text-wrap"> Dipinjam</span>
                                                @elseif($item->status == 0)
                                                    <span class="badge badge-soft-primary badge-border text-wrap"> Dikembalikan</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($item->status == 1)
                                                <span data-v-cd5f1dea="">
                                                    <div class="dropdown" data-v-cd5f1dea=""><button
                                                            class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            data-v-cd5f1dea=""><i class="ri-more-fill"
                                                                data-v-cd5f1dea=""></i></button>
                                                        <ul class="dropdown-menu dropdown-menu-end" data-v-cd5f1dea=""
                                                            style="">
                                                            
                                                            <li data-v-cd5f1dea="">
                                                                <a href="javascript:void(0)" class="dropdown-item pengembalian"
                                                                    id="pengembalian" data-id="{{ $item->id_pinjam }}"><i
                                                                        class="ri-reply-fill align-bottom me-2 text-muted"
                                                                        data-v-cd5f1dea=""></i> Pengembalian</a>
                                                            </li>
                                                            
                                                            {{-- <li data-v-cd5f1dea="">
                                                                <a href="{{ asset('inventaris/getinfo/'. $item->id_pinjam ) }}" class="dropdown-item"
                                                                    target="_blank"><i
                                                                        class="ri-pages-line align-bottom me-2 text-muted"
                                                                        data-v-cd5f1dea=""></i> Detail</a>
                                                            </li> --}}
                                                            {{-- <li data-v-cd5f1dea="">
                                                                <a href="javascript:void(0)" class="dropdown-item edit"
                                                                    id="edit" data-v-cd5f1dea=""
                                                                    data-id="{{ $item->id_pinjam }}"><i
                                                                        class="ri-service-line align-bottom me-2 text-muted"
                                                                        data-v-cd5f1dea=""></i> Pemeliharaan</a>
                                                            </li> --}}
                                                            {{-- <li data-v-cd5f1dea="">
                                                                <a class="dropdown-item remove-item-btn confirm-delete"
                                                                    data-v-cd5f1dea="" data-id="{{ $item->id_pinjam }}">
                                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"
                                                                        data-v-cd5f1dea="">
                                                                    </i>
                                                                    Delete
                                                                    <form method="POST"
                                                                        action="{{ route('karyawan.hapus', $item->id_pinjam) }}"
                                                                        id="delete-{{ $item->id_pinjam }}">
                                                                        @csrf
                                                                        @method('delete')
                                                                    </form>
                                                                </a>
                                                            </li> --}}
                                                        </ul>
                                                    </div>
                                                </span>
                                                @else 
                                                <button disabled
                                                    class="btn btn-soft-dark btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false"
                                                    data-v-cd5f1dea=""><i class="ri-more-fill"
                                                        data-v-cd5f1dea=""></i>
                                                    </button>
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
                                        class="ri-briefcase-line" ></i></span></div>
                            <div class="flex-grow-1 ms-2 mt-0 mt-1 overflow-hidden" ><a
                                    href="{{ route('inventaris')}}" class="" >
                                    <h6 class="text-truncate fs-13 mb-0 font-poppins" >
                                        Inventaris</h6>
                                </a></div>
                        </div>
                        <div class="d-flex mb-2 list-setting_item pointer" >
                            <div class="flex-shrink-0" ><span
                                    class="badge badge-soft-primary p-1 fs-15" ><i
                                        class="text-info  ri-share-forward-2-fill" ></i></span></div>
                            <div class="flex-grow-1 ms-2 mt-0 mt-1 overflow-hidden" ><a
                                    href="{{ route('inventaris.peminjaman')}}" class="" >
                                    <h6 class="text-info  text-truncate fs-13 mb-0 font-poppins" >
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
        $(document).on('click', '.pengembalian', function() {
            var id = $(this).data('id');
            $.get('/inventaris/' + id + '/pengembalian', function(data) {
                $('#detailitem').html("");
                $.each(data, function (i, result) {
                    console.log(data[i]);
                    var image = data[i].image;
                    
                    $('#detailitem').append('<div class="row"><div class="col-xl-4 mt-2"><div class="product-img-slider sticky-side-div"><div class="swiper product-thumbnail-slider p-2 rounded bg-light"><div class="swiper-wrapper"><div><img id="displayPhoto" src="{{ url('inventory/gambar')}}/'+image +'" class="img-fluid d-block"></div></div></div></div></div><div class="col-xl-8"> <h5 class="mt-2">' + data[i].item + 
                        '</h5><p class="mb-0">'+ data[i].inventory_id +
                            '</p><p class="mb-0">' + data[i].deskripsi_item +'</p> </div></div>');
                });
                $('#id_pinjam').val(id);
                $('#staticBackdrop').modal('show');
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
