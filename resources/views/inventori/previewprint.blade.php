@extends('layouts.master')
@section('title', 'Preview QR')
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

   
<div class="row justify-content-center">
    <div class="col-xl-1 col-sm-1 col-1">
        {{-- <div class="card shadow-none" id="demo"> --}}
            <div class="row text-center">
                <div class="col-lg-12 col-sm-12 col-12">
                    {{-- <div class="card-body"> --}}
                        @foreach($data as $item)
                        <div class="row">
                            <div class="col-lg-4 col-sm-4 col-4 text-center mt-1">
                                <img height="37.44px" src="{{ asset('inventory/qr/'.$item->name_file) }}">
                                {{-- <img height="100px" src="{{ asset('inventory/qr/'.$item->name_file) }}"> --}}
                            </div>
                            {{-- <div class="col-lg-8 col-sm-8 col-8 text-center mt-1">   
                                <p class="mb-0 mt-3" style="font-size: 5px">
                                    {{ $item->inventory_id }}
                                </p>
                                <p class="mt-0 mb-0 fw-semibold" style="font-size: 7px">
                                    <a href="{{ asset('inventaris/getinfo/'. $item->inventory_id ) }}" style="text-decoration: none" target="_blank">
                                        {{ $item->inventory->item }}
                                    </a>
                                </p>
                            </div> --}}
                        </div>
                        @endforeach
                    {{-- </div> --}}
                    
                </div>
                {{-- <div class="col-lg-12">
                    <div class="card-body p-4">
                        <div class="hstack gap-2 justify-content-end d-print-none">
                            <a href="javascript:window.print()" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i> Print</a>
                            <a href="{{ route('inventaris') }}" class="btn btn-primary"><i class="ri-arrow-go-back-line align-bottom me-1"></i> Back</a>
                        </div>
                    </div>
                </div> --}}
            </div>
        {{-- </div> --}}
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
