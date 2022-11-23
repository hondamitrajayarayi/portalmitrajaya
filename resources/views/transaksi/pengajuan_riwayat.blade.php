@extends('layouts.master')
@section('title', 'Riwayat Pengajuan')
@section('nav_active_pengajuan', 'active')
@section('nav_active_pengajuan_list', 'active')
@section('content')


    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header  border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Riwayat Pengajuan</h5>
                        <div class="flex-shrink-0">
                            {{-- <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Create Order</button>
                            <button type="button" class="btn btn-info"><i class="ri-file-download-line align-bottom me-1"></i> Import</button>
                            <button class="btn btn-soft-danger" onclick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-7 col-sm-7">
                                <div class="search-box">
                                    <input type="text" class="form-control search"
                                        placeholder="Pencarian untuk Rb Id dan yang lainnya...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-sm-3">
                                <div>
                                    <input type="text" class="form-control flatpickr-input" data-provider="flatpickr"
                                        data-date-format="d M, Y" data-range-date="true" id="demo-datepicker"
                                        placeholder="Filter berdasarkan tanggal" readonly="readonly">
                                </div>
                            </div>
                            <!--end col-->
                            {{-- <div class="col-xxl-3 col-sm-3"> --}}
                                {{-- <select class="form-control" data-choices name="nik">
                                    <option value="">Filter berdasarkan status</option>
                                    <option value="1">Filter berdasarkan status 1</option>
                                    <option value="2">Filter berdasarkan status 2</option>
                                    
                                </select> --}}
                            {{-- </div> --}}
                            <!--end col-->
                            <div class="col-xxl-2 col-sm-2">
                                <div>
                                    <button type="button" class="btn btn-primary w-100"> <i
                                            class="ri-equalizer-fill me-1 align-bottom"></i>
                                        Filters
                                    </button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
                <div class="card-body pt-0">
                    <div>
                        <ul role="tablist">

                        </ul>

                        <div class="table-responsive table-card mb-1 mt-3">
                            <table class="table table-nowrap align-middle" id="orderTable">
                                <thead class="text-muted table-light">
                                    <tr class="text-uppercase">
                                        <th>#</th>
                                        <th class="sort desc" data-sort="id">RB ID</th>
                                        <th class="sort" data-sort="product_name">Createdby</th>
                                        <th class="sort" data-sort="amount">Items</th>
                                        <th class="sort" data-sort="status">Status</th>
                                        <th class="sort" data-sort="customer_name">Created date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($data as $no => $hist)
                                        <tr>
                                            <td class="align-top">{{ $data->firstItem() + $no }}</td>
                                            <td class="id align-top">
                                                    {{ $hist->rb_id }}
                                            </td>
                                            <td class="align-top">
                                                    {{ $hist->karyawan['nama'] }}
                                            </td>
                                            {{-- <td class="align-top">
                                                @foreach ($hist->TrxRbDetailDokumen as $dok)
                                                    <div
                                                        class="d-flex align-items-center border border-dashed p-2 mt-1 rounded">
                                                        <i class="fa fa-file-pdf-o fs-5 text-danger"
                                                            aria-hidden="true"></i>
                                                        <div class="hstack ms-3 gap-2">
                                                            <a href="{{ asset('dokumen/' . $dok['dokumen_name']) }}"
                                                                target="blank"> pdf
                                                                <i class="mdi mdi-open-in-new"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </td> --}}
                                            <td class="align-top">
                                                <ul class="ps-2 vstack mb-1">
                                                    @foreach ($hist->TrxRbDetailItem as $item)
                                                        <li>{{ $item->item }}<br>
                                                            <div class="text-muted">
                                                                {{ $item->qty }} pcs x @uang($item->harga) =
                                                                @uang($item->qty * $item->harga)
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td class="align-top">
                                                @if ($hist->status == 1)
                                                    <span class="badge badge-soft-secondary badge-border fs-12 text-wrap">
                                                        Menunggu Aproval Kacab/ Kabeng
                                                    </span>
                                                @elseif($hist->status == 2)
                                                    <span class="badge badge-soft-secondary badge-border fs-12 text-wrap">
                                                        Proses Validasi Pengesahan
                                                    </span>
                                                @elseif($hist->status == 3)
                                                    <span class="badge badge-soft-secondary badge-border fs-12 text-wrap">
                                                        Menunggu Aproval Terkait
                                                    </span>
                                                @elseif($hist->status == 4)
                                                    <span class="badge badge-soft-secondary badge-border fs-12 text-wrap">
                                                        Menunggu Approval Management Terkait
                                                    </span>
                                                @elseif($hist->status == 5)
                                                    <span class="badge badge-soft-danger badge-border fs-12 text-wrap">
                                                        Ditolak
                                                    </span>
                                                @elseif($hist->status == 6)
                                                    <span class="badge badge-soft-success badge-border fs-12 text-wrap">
                                                        Menunggu otorisasi Kudus
                                                    </span>
                                                @elseif($hist->status == 0)
                                                    <span class="badge badge-soft-success badge-border fs-12 text-wrap">
                                                        RB telah selesai 
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="align-top">
                                                    @tanggal($hist->created_date)
                                            </td>
                                            <td class="align-top text-center">
                                                {{-- @if ($item->status == 1) --}}
                                                {{-- <a href="javascript:void(0)" class="setuju" id="setuju"
                                                    data-v-cd5f1dea="" data-id="{{ $item->idTiket }}" data-kategori="{{ $item->id_kategori }}">

                                                    <button type="button"
                                                        class="btn btn-success btn-sm rounded-pill">
                                                        APPROVE
                                                    </button>
                                                </a>
                                                <a href="javascript:void(0)" class="tolak" id="tolak"
                                                    data-v-cd5f1dea="" data-id="{{ $item->idTiket }}">

                                                    <button type="button"
                                                        class="btn btn-danger btn-sm rounded-pill">
                                                        REJECT
                                                    </button>
                                                </a> --}}
                                                <a href="{{ route('pengajuan.detail', $hist->rb_id) }}" class="btn btn-sm btn-light">
                                                            Detail
                                                    
                                                </a>
                                            {{-- @endif --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px">
                                    </lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted">We've searched more than 150+ Orders We did not find any orders
                                        for you search.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end modal -->
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
@endpush
@push('scripts')
    <script>
        var i = 0;

        $("#add").click(function() {
            ++i;

            $("#dynamicTable").append(
                '<tr><td><input type="text" name="addmore[' +
                i +
                '][keterangan]" placeholder="Keterangan item" class="form-control" required /></td><td><input type="text" name="addmore[' +
                i +
                '][qty]" onkeyup="getJumlah(' + i +
                ')" placeholder="Banyak item" class="form-control" required /></td><td><div class="input-group"><span class="input-group-text" id="basic-addon1">Rp.</span><input type="text" name="addmore[' +
                i +
                '][harga]" onkeyup="getJumlah(' + i +
                ')" placeholder="Harga item" class="form-control" required /></div></td><td><div class="input-group"><span class="input-group-text" id="basic-addon1">Rp.</span><input type="text" name="addmore[' +
                i +
                '][jumlah]" class="form-control jumlahhh" readonly /></div></td><td><div class="mt-1"><button name="add" id="add" type="button" class="btn btn-danger btn-sm btn-label waves-effect waves-light remove-tr"><i class="ri-delete-bin-2-line label-icon align-middle fs-16 me-2"></i>Hapus Item</button></div></td></tr>'
            );
        });

        $(document).on("click", ".remove-tr", function() {
            $(this).parents("tr").remove();
            var total = 0;
            $('.jumlahhh').each(function() {
                let jumlah = parseInt($(this).val());
                // console.log(jumlah);
                total += jumlah;
            });
            $('.total').val(total);
        });
    </script>
    <script>
        function getJumlah(no) {

            var num = no;
            var iqty = $('input[name="addmore[' + num + '][qty]"]');
            var iharga = $('input[name="addmore[' + num + '][harga]"]');
            if (iharga.val() === '' || iqty.val() === '') {

                $('input[name="addmore[' + num + '][jumlah]"]').val('0');
            } else {
                var total = 0;
                var qty = parseInt(iqty.val());
                var harga = parseInt(iharga.val());
                var hasil = qty * harga;
                $('input[name="addmore[' + num + '][jumlah]"]').val(hasil);

                $('.jumlahhh').each(function() {
                    let jumlah = parseInt($(this).val());

                    total += jumlah;
                });
                $('.total').val(total);


            }

        }
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
        $('#btnSubmitedit').click(function() {
            $(this).css('display', 'none');
            $('#loadingedit').show();
            return true;
        });
    </script>
@endpush
