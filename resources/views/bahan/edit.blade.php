@extends('layouts.app')
@section('title', 'Edit Bahan')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Bahan Baku</h1>
    <div align="right" class="pt-1">
        <a href="{{route('bahan.index')}}" class="btn btn-warning btn-xs"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form method="POST" id="insert_form" action="{{ route('bahan.update',$bahan->id) }}">
            {{ csrf_field() }}
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <label>Nama Bahan</label>
                        <input type="text" name="nama_bahan" id="nama_bahan" class="form-control @error('nama_bahan') is-invalid @enderror" name="nama_bahan" value="{{ $bahan->nama_bahan }}" />
                        @error('nama_bahan')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    <br />
                </div>
                <div class="col-md-12">
                    <label>Supplier</label>
                        <select class="form-control @error('supplier_id') is-invalid @enderror" name="supplier_id" value="{{ $bahan->supplier->nama_supplier }}" name="supplier_id">
                            <option value="" selected disabled>Pilih Supplier</option>
                            @foreach ($supp as $supplier )
                                @if ($bahan->supplier_id == $supplier->id)
                                    <option value="{{ $supplier->id }}" selected>{{ $bahan->supplier->nama_supplier }}</option>
                                @else
                                    <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                                @endif
                            @endforeach
                        </select>
                    @error('supplier_id')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    <br />
                </div>
                <div class="col-md-6">
                    <label>Jumlah bahan</label>
                        <input type="number" name="jumlah_bahan" id="jumlah_bahan" class="form-control @error('jumlah_bahan') is-invalid @enderror" name="jumlah_bahan" value="{{ $bahan->jumlah_bahan }}"></input>
                        @error('jumlah_bahan')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br />
                </div>
                <div class="col-md-6">
                    <label>Satuan</label>
                        <select class="form-control @error('satuan_bahan') is-invalid @enderror" name="satuan_bahan" value="{{ $bahan->satuan_bahan }}" name="satuan_bahan">
                            <option value="" selected="">Pilih Satuan</option>
                            <option value="Gram" {{ $bahan->satuan_bahan == 'Gram' ? 'selected' : '' }}>Gram</option>
                            <option value="Pcs" {{ $bahan->satuan_bahan == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                            <option value="mL" {{ $bahan->satuan_bahan == 'mL' ? 'selected' : '' }}>mL</option>
                        </select>
                        @error('satuan_bahan')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    <br />
                </div>
                <div class="col-md-12">
                    <label>Harga</label>
                        <input type="number" name="harga_bahan" id="harga_bahan" class="form-control @error('harga_bahan') is-invalid @enderror" name="harga_bahan" value="{{ $bahan->harga_bahan }}" />
                        @error('harga_bahan')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br />
                </div>
                <div class="col-md-12">
                    <input type="submit" name="insert" id="insert" value="Update" class="btn btn-success" />
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
