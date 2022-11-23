@extends('layouts.master')
@section('title', 'Halaman Tambah Test CRUD')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Tambah Data</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('simpan')}}" class="row g-3" novalidate>
                        @csrf
                        <div class="col-md-6">
                            <label for="validationCustom04" class="form-label @error('kode_barang') text-danger @enderror">Kode Barang</label>
                            <input type="text" name="kode_barang" value="{{ old('kode_barang')}}" class="form-control @error('kode_barang') is-invalid @enderror" id="validationCustom04" autocomplete="off">
                            @error('kode_barang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>    
                            @enderror
                            
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label @error('nama_barang') text-danger @enderror">Nama Barang</label>
                            <input type="text" name="nama_barang" value="{{ old('nama_barang')}}" class="form-control @error('nama_barang') is-invalid @enderror" id="validationCustom02" autocomplete="off">
                            @error('nama_barang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>    
                            @enderror
                        </div>
                        
                        
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('before-script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
@endpush

@push('center-scripts')
    <script src="{{ asset('assets/libs/prismjs/prismjs.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
@endpush

@push('scripts')
@endpush
