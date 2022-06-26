@extends('layouts.app')
@section('title', 'Edit Gaji')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Gaji</h1>
    <div align="right" class="pt-1">
        <a href="{{ url()->previous() }}" class="btn btn-warning btn-xs"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form method="POST" id="insert_form" action="{{ route('gaji.update', $gaji->id) }}">
            {{ csrf_field() }}
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label>Nama Karyawan</label>
                        <input type="hidden" name="kehadiran_id" value="{{ $gaji->kehadiran_id }}">
                        <input type="text" class="form-control" name="nama_karyawan" readonly value="{{ $gaji->kehadiran->karyawan->nama_karyawan}}">
                        @error('nama_karyawan')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    <br />
                </div>
                <div class="col-md-6">
                    <label>Masuk</label>
                        <input type="number" name="masuk" id="masuk" class="form-control @error('masuk') is-invalid @enderror" name="masuk" readonly value="{{ $gaji->kehadiran->masuk}}"></input>
                        @error('masuk')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br />
                </div>
                <div class="col-md-6">
                    <label>Lembur</label>
                        <input type="number" name="lembur" id="lembur" class="form-control @error('lembur') is-invalid @enderror" name="lembur" value="{{ $gaji->kehadiran->lembur }}" readonly/>
                        @error('lembur')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br />
                </div>
                <div class="col-md-6">
                    <label>Uang Lembur</label>
                        <select class="form-control @error('uang_lembur') is-invalid @enderror" height="100%" name="uang_lembur" value="{{ old('uang_lembur') }}" name="uang_lembur">
                            @foreach ($mgaji as $masgaji )
                                @if (old('uang_lembur') == $masgaji->lembur)
                                    <option value="{{ $masgaji->lembur }}" selected> {{ $masgaji->lembur }} </option>
                                @else
                                    <option value="{{ $masgaji->lembur }}">{{ $masgaji->lembur }}</option>
                                @endif
                            @endforeach
                        </select>
                </div>
                <div class="col-md-6">
                    <label>Uang Harian</label>
                    <select class="form-control @error('uang_harian') is-invalid @enderror" height="100%" name="uang_harian" value="{{ old('uang_harian') }}" name="uang_harian">
                        @foreach ($mgaji as $item)
                            @if (old('uang_harian') == $item->harian)
                                <option value="{{ $item->harian }}" selected> {{ $item->harian }} </option>
                            @else
                                <option value="{{ $item->harian }}">{{ $item->harian }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label>BPJS</label>
                        <input type="number" name="bpjs" id="bpjs" class="form-control @error('bpjs') is-invalid @enderror" name="bpjs" value="{{ $gaji->kehadiran->karyawan->bpjs }}" readonly />
                        @error('bpjs')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br />
                </div>
                <div class="col-md-6">
                    <label>Bonus</label>
                        <input type="number" name="bonus" id="bonus" class="form-control @error('bonus') is-invalid @enderror" name="bonus" value="{{ $gaji->bonus }}"  />
                        @error('bonus')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br />
                </div>
                <div class="col-md-6">
                    <label>Tunjangan</label>
                        <input type="number" name="tunjangan" id="tunjangan" class="form-control @error('tunjangan') is-invalid @enderror" name="tunjangan" value="{{ $gaji->kehadiran->karyawan->tunjangan }}" readonly />
                        @error('tunjangan')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br />
                </div>
                <div class="col-md-6">
                    <label>Potongan</label>
                        <input type="number" name="potongan" id="potongan" class="form-control @error('potongan') is-invalid @enderror" name="potongan" value="{{ $gaji->potongan }}" />
                        @error('potongan')
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
