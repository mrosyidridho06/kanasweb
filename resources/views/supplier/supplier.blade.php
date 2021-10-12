@extends('layouts.app')
@section('title', 'Supplier')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Supplier</h1>
        <div align="right" class="pt-1">
            <a href="" class="btn btn-success btn-xs"><i class="fa fa-sync"></i></a>
            <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary"><i class="fa fa-plus"> Tambah Supplier</i></button>
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
                    <h4 class="modal-title">Input Supplier</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                    <div class="modal-body">
                        <form method="POST" id="insert_form" action="{{ route('supplier.store') }}">
                            {{ csrf_field() }}
                            <label>Nama Supplier</label>
                            <input type="text" name="nama_supplier" id="nama_supplier" class="form-control @error('nama_supplier') is-invalid @enderror" name="nama_supplier" value="{{ old('nama_supplier') }}" />
                            @error('nama_supplier')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <br />
                            <label>Alamat Supplier</label>
                            <textarea name="alamat_supplier" id="alamat_supplier" class="form-control">{{ old('alamat_supplier') }}</textarea>
                            @error('alamat_supplier')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <br />
                            <br />
                            <label>Nomor Handphone</label>
                            <input type="text" name="hp_supplier" id="hp_supplier" class="form-control @error('hp_supplier') is-invalid @enderror" name="hp_supplier" value="{{ old('hp_supplier') }}" />
                            @error('hp_supplier')
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

