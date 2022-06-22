@extends('layouts.app')
@section('title', 'Tambah Bahan')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Supplier</h1>
    <div align="right" class="pt-1">
        <a href="{{route('supplier.index')}}" class="btn btn-warning btn-xs"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form method="POST" id="insert_form" action="{{ route('supplier.update', $supplier->id) }}">
            {{ csrf_field() }}
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <label>Nama Supplier</label>
                        <input type="text" name="nama_supplier" id="nama_supplier" class="form-control @error('nama_supplier') is-invalid @enderror" name="nama_supplier" value="{{ $supplier->nama_supplier }}" />
                        @error('nama_supplier')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    <br />
                </div>
                <div class="col-md-12">
                    <label>Alamat Supplier</label>
                        <input type="text" name="alamat_supplier" id="alamat_supplier" class="form-control @error('alamat_supplier') is-invalid @enderror" name="alamat_supplier" value="{{ $supplier->alamat_supplier}}"></input>
                        @error('alamat_supplier')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br />
                </div>
                <div class="col-md-12">
                    <label>HP</label>
                        <input type="text" name="hp_supplier" id="hp_supplier" class="form-control @error('hp_supplier') is-invalid @enderror" name="hp_supplier" value="{{ $supplier->hp_supplier }}" />
                        @error('hp_supplier')
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
