@extends('layouts.app')
@section('title', 'Tambah Bahan')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Kehadiran</h1>
    <div align="right" class="pt-1">
        <a href="{{ url()->previous() }}" class="btn btn-warning btn-xs"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form method="POST" id="insert_form" action="{{ route('kehadiran.update', $kehadiran->id) }}">
            {{ csrf_field() }}
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label>Nama Karyawan</label>
                        {{-- <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control @error('nama_karyawan') is-invalid @enderror" name="nama_karyawan" value="{{ $kehadiran->nama_karyawan }}" /> --}}
                        <select class="form-control @error('karyawan_id') is-invalid @enderror" name="karyawan_id" value="{{ $kehadiran->nama_karyawan }}" name="karyawan_id">
                            <option value="" selected disabled>Pilih Supplier</option>
                            @foreach ($karyawan as $karya )
                                @if ($kehadiran->karyawan_id == $karya->id)
                                    <option value="{{ $karya->id }}" selected>{{ $kehadiran->karyawan->nama_karyawan }}</option>
                                @else
                                    <option value="{{ $karya->id }}">{{ $karya->nama_karyawan }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('karyawan_id')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    <br />
                </div>
                <div class="col-md-6">
                    <label>Masuk</label>
                        <input type="number" name="masuk" id="masuk" class="form-control @error('masuk') is-invalid @enderror" name="masuk" value="{{ $kehadiran->masuk}}"></input>
                        @error('masuk')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br />
                </div>
                <div class="col-md-6">
                    <label>Izin</label>
                        <input type="number" name="izin" id="izin" class="form-control @error('izin') is-invalid @enderror" name="izin" value="{{ $kehadiran->izin }}" />
                        @error('izin')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br />
                </div>
                <div class="col-md-6">
                    <label>Lembur</label>
                        <input type="number" name="lembur" id="lembur" class="form-control @error('lembur') is-invalid @enderror" name="lembur" value="{{ $kehadiran->lembur }}" />
                        @error('lembur')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br />
                </div>
                <div class="col-md-6">
                    <label>Dari Tanggal</label>
                        <input type="date" name="from_date" id="from_date" class="form-control @error('from_date') is-invalid @enderror" name="from_date" value="{{ $kehadiran->from_date }}" />
                        @error('from_date')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br />
                </div>
                <div class="col-md-6">
                    <label>Sampai Tanggal</label>
                        <input type="date" name="to_date" id="to_date" class="form-control @error('to_date') is-invalid @enderror" name="to_date" value="{{ $kehadiran->to_date }}" />
                        @error('to_date')
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
