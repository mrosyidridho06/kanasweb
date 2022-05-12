@extends('layouts.app')
@section('title', 'Edit Master Gaji')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Gaji</h1>
    <div align="right" class="pt-1">
        <a href="{{ route('gaji.index') }}" class="btn btn-warning btn-xs"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-4">
        <div class="card card-shadow">
            <div class="card-header">
                Pilih Karyawan
            </div>
                <div class="card-body">
                    <form action="" method="GET" id="form_id">
                        <div class="form-group">
                            <label for="bulan">Bulan</label>
                            <select class="form-control" id="bulan" name="bulan">
                                <option value="">--Pilih Bulan--</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                            <script>document.getElementById('bulan').value = "<?php if (isset($_GET['bulan']) && $_GET['bulan']) echo $_GET['bulan'];?>";</script>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <select name='tahun' id="tahun" class="form-control" onChange="document.getElementById('form_id').submit();">
                                @foreach ($dataTahun as $tahun)
                                    <option value="">-- Pilih Tahun --</option>
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                @endforeach
                            </select>
                            <script>document.getElementById('tahun').value = "<?php if (isset($_GET['tahun']) && $_GET['tahun']) echo $_GET['tahun'];?>";</script>
                        </div>
                    </form>
                    <form>
                        <hr>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nama Karyawan</label>
                            <select class="form-control" name="nama_karyawan" id="nama_karyawan">
                                <option value="">--Pilih Karyawan--</option>
                                @foreach ($filter as $item)
                                    <option value="{{ $item->id }}"> {{ $item->karyawan->nama_karyawan }}</option>
                                @endforeach
                            </select>
                            {{-- <script>document.getElementById('nama_karyawan').value = "<?php if (isset($_GET['nama_karyawan']) && $_GET['nama_karyawan']) echo $_GET['nama_karyawan'];?>";</script> --}}
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        @foreach ($karya as $kehadiran)
        <div class="col-12 col-md-8">
        <div class="card shadow">
            <div class="card-header">Penggajian</div>
            <div class="card-body">
                <form action="{{ route('gaji.store') }}" method="POST">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Nama<span class="small text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ $kehadiran->karyawan->nama_karyawan }}"  readonly></input>
                                    <input type="hidden" name="id_kehadiran" class="form-control"  value="{{ $kehadiran->id }}"></input>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="masuk">Masuk<span class="small text-danger">*</span></label>
                                    <input type="number" name="masuk" class="form-control" value="{{ $kehadiran->masuk }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="name">Lembur<span class="small text-danger">*</span></label>
                                    <input type="number" name="lembur"  class="form-control" value="{{ $kehadiran->lembur }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="uang_lembur">Uang Lembur<span class="small text-danger">*</span></label>
                                    {{-- <input type="number" class="form-control" name="uang_lembur" value="{{ $master->lembur }}" readonly> --}}
                                    <select class="form-control @error('uang_lembur') is-invalid @enderror" name="uang_lembur" value="{{ old('uang_lembur') }}">
                                        <option value="" selected disabled>Pilih Uang Lembur</option>
                                        @foreach ($mgaji as $lembur )
                                        @if (old('uang_lembur') == $lembur->lembur)
                                            <option value="{{ $lembur->lembur }}" selected>{{ $lembur->lembur }}</option>
                                        @else
                                            <option value="{{ $lembur->lembur }}">{{ $lembur->lembur }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="uang_harian">Uang Harian<span class="small text-danger">*</span></label>
                                    <select class="form-control @error('uang_harian') is-invalid @enderror" name="uang_harian" value="{{ old('uang_harian') }}">
                                        <option value="" selected disabled>Pilih Gaji Harian</option>
                                        @foreach ($mgaji as $harian )
                                            @if (old('uang_harian') == $harian->harian)
                                                <option value="{{ $harian->harian }}" selected>{{ $harian->harian }}</option>
                                            @else
                                                <option value="{{ $harian->harian }}">{{ $harian->harian }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    {{-- <input type="number" class="form-control" name="uang_harian" value="{{ $master->harian }}" readonly> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="bpjs">BPJS<span class="small text-danger">*</span></label>
                                        <input type="number" name="bpjs" class="form-control" value="{{ $kehadiran->karyawan->bpjs }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="name">Bonus<span class="small text-danger">*</span></label>
                                    <input type="number" name="bonus" class="form-control @error('bonus') is-invalid @enderror" value="{{ old('bonus') }}">
                                    @error('bonus')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="satuan">Tunjangan<span class="small text-danger">*</span></label>
                                    <input type="number" name="tunjangan" class="form-control" value="{{ $kehadiran->karyawan->tunjangan }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="satuan">Potongan<span class="small text-danger">*</span></label>
                                    <input type="number" name="potongan" class="form-control @error('potongan') is-invalid @enderror" value="{{ old('potongan') }}" >
                                    @error('potongan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="justify-align-center">
                            <button type="submit" name="save" class="btn btn-primary pl-2">Save Changes</button>
                        </div>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
