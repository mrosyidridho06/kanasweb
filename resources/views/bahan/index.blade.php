@extends('layouts.app')

@section('title', 'Bahan')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Bahan Baku</h1>
    <div align="right" class="pt-1">
        <a href="" class="btn btn-success btn-xs"><i class="fa fa-sync"></i></a>
        <a href="{{route('bahan.create')}}" class="btn btn-primary">Tambah bahan</a>
        {{-- <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary"><i class="fa fa-plus"> Tambah Bahan</i></button> --}}
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        {{ $dataTable->table() }}
    </div>
</div>
<!-- Modals Tambah data -->
<div id="add_data_Modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Bahan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                <div class="modal-body">
                    <form method="POST" id="insert_form" action="{{ route('bahan.store') }}">
                        {{ csrf_field() }}
                        <label>Nama Bahan</label>
                            <input type="text" name="nama_bahan" id="nama_bahan" class="form-control @error('nama_bahan') is-invalid @enderror" name="nama_bahan" value="{{ old('nama_bahan') }}" />
                            @error('nama_bahan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        <br />
                        <label>Supplier</label>
                            <select class="form-control @error('supplier_id') is-invalid @enderror" name="supplier_id" value="{{ old('supplier_id') }}" name="supplier_id">
                                <option value="" selected disabled>Pilih Supplier</option>
                                {{-- @foreach ($supp as $supplier )
                                    @if (old('supplier_id') === $supplier->id)
                                        <option value="{{ $supplier->id }}" selected={{ $supplier->nama_supplier }} />
                                    @else
                                        <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                                    @endif
                                @endforeach --}}
                            </select>
                            @error('supplier_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        <br/>
                        <label>Jumlah bahan</label>
                            <input type="number" name="jumlah_bahan" id="jumlah_bahan" class="form-control @error('jumlah_bahan') is-invalid @enderror" name="jumlah_bahan" value="{{ old('jumlah_bahan') }}"></input>
                            @error('jumlah_bahan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        <br />
                        <label>Satuan</label>
                            <select class="form-control" name="satuan_bahan">
                                <option value="" selected="">Pilih Satuan</option>
                                <option value="Gram" {{ old('satuan_bahan') == 'Gram' ? 'selected' : '' }}>Gram</option>
                                <option value="Pcs" {{ old('satuan_bahan') == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                                <option value="mL" {{ old('satuan_bahan') == 'mL' ? 'selected' : '' }}>mL</option>
                            </select>
                        <br />
                        <label>Harga</label>
                            <input type="number" name="harga_bahan" id="harga_bahan" class="form-control @error('harga_bahan') is-invalid @enderror" name="harga_bahan" value="{{ old('harga_bahan') }}" />
                            @error('harga_bahan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        <br />
                            <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
                    </form>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush

