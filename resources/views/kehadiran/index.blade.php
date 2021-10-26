@extends('layouts.app')
@section('title', 'Kehadiran')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kehadiran Pegawai</h1>
        <div align="right" class="pt-1">
            <a href="" class="btn btn-success btn-xs"><i class="fa fa-sync"></i></a>
            <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary"><i class="fa fa-plus"> Tambah Kehadiran</i></button>
        </div>
    </div>
<div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-2">
                    <div class="card-body">
                        <form action="{{route('kehadiran.index')}}" method="GET">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>From Date</label>
                                        <input type="date" name="from_date" value="{{date('Y-m-d')}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>To Date</label>
                                        <input type="date" name="to_date" value="{{date('Y-m-d')}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Click to Filter</label> <br>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-borderd">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Pegawai</th>
                                    <th>Jabatan</th>
                                    <th>Masuk</th>
                                    <th>Izin</th>
                                    <th>Lembur</th>
                                    <th>Tanggal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($keha as $karyawan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $karyawan->karyawan->nama_karyawan ?? 'Data Kosong' }}</td>
                                        <td>{{ $karyawan->karyawan->jabatan }}</td>
                                        <td>{{ $karyawan->masuk }}</td>
                                        <td>{{ $karyawan->izin }}</td>
                                        <td>{{ $karyawan->lembur }}</td>
                                        <td>{{ $karyawan->tanggal }}</td>
                                        <td align="center">
                                            <a href="{{route('kehadiran.edit',$karyawan->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                            <form class="d-inline" action="{{route('kehadiran.destroy',$karyawan->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm ('Apakah ingin dihapus')" class="btn btn-danger d-inline"><i class="fa fa-trash"></i> Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" align="center">Data Kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<!-- Modals Tambah data -->
<div id="add_data_Modal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
    <h4 class="modal-title">Input Kehadiran</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <form method="post" id="insert_form" action="{{ route('kehadiran.store') }}">
    {{ csrf_field() }}
    <label>Nama Karyawan</label>
    <select class="form-control @error('karyawan_id') is-invalid @enderror" name="karyawan_id" value="{{ old('karyawan_id') }}" name="karyawan_id" id="gaji" required>
        <option value="" selected="">Pilih Karyawan</option>
        @foreach ($karya as $karyawan )
            @if (old('karyawan_id') == $karyawan->id)
                <option value="{{ $karyawan->id }}" selected>{{ $karyawan->nama_karyawan }}</option>
            @else
                <option value="{{ $karyawan->id }}">{{ $karyawan->nama_karyawan }}</option>
            @endif
        @endforeach
    </select>
    <br />
    <label>Tanggal</label>
    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal') }}"></input>
    @error('tanggal')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
    @enderror
    <br>
    <label>Masuk</label>
    <input type="number" name="masuk" class="form-control @error('masuk') is-invalid @enderror" name="masuk" value="{{ old('masuk') }}"></input>
    @error('masuk')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
    @enderror
    <br>
    <label>Izin</label>
    <input type="number" name="izin" class="form-control @error('izin') is-invalid @enderror" name="izin" value="{{ old('izin') }}"></input>
    @error('izin')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
    @enderror
    <br>
    <label>lembur</label>
    <input type="number" name="lembur" id="lembur" class="form-control @error('lembur') is-invalid @enderror" name="lembur" value="{{ old('lembur') }}"></input>
    @error('lembur')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
    @enderror
    <br>
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

