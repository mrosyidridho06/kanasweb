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
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Bulan</label>
                                        <select name="bulan" class="form-control" id="bulan">
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
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <select name="tahun" id="tahun" class="form-control">
                                            <?php
                                            $year = date('Y');
                                            $min = $year - 60;
                                            $max = $year;
                                            for( $i=$max; $i>=$min; $i-- ) {
                                            echo '<option value='.$i.'>'.$i.'</option>';
                                            } ?>
                                        </select>
                                        <script>document.getElementById('tahun').value = "<?php if (isset($_GET['tahun']) && $_GET['tahun']) echo $_GET['tahun'];?>";</script>
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
                    <div class="card-body table-responsive">
                        <table class="table table-borderd">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Pegawai</th>
                                    <th>Jabatan</th>
                                    <th>Masuk</th>
                                    <th>Izin</th>
                                    <th>Lembur</th>
                                    <th class="text-center" colspan="2">Tanggal Periode</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($filter as $keha)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $keha->karyawan->nama_karyawan }}</td>
                                        <td>{{ $keha->karyawan->jabatan }}</td>
                                        <td>{{ $keha->masuk }}</td>
                                        <td>{{ $keha->izin }}</td>
                                        <td>{{ $keha->lembur }}</td>
                                        <td align="center" colspan="2">{{ date("d F Y", strtotime($keha->from_date)) }} - {{ date("d F Y", strtotime($keha->to_date)) }}</td>
                                        <td align="center">
                                            <a href="{{ route('kehadiran.edit',$keha->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                            <form class="d-inline" action="{{route('kehadiran.destroy',$keha->id)}}" method="POST">
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
    <form method="POST" id="insert_form" action="{{ route('kehadiran.store') }}">
    {{ csrf_field() }}
    <label>Nama Karyawan</label>
    <select class="form-control @error('nama_karyawan') is-invalid @enderror" name="nama_karyawan" value="{{ old('nama_karyawan') }}" name="nama_karyawan">
        <option value="" selected disabled>Pilih Karyawan</option>
        @foreach ($karyawan as $item )
            @if (old('nama_karyawan') == $item->id)
                <option value="{{ $item->id }}" selected> {{ $item->nama_karyawan }} </option>
            @else
                <option value="{{ $item->id }}">{{ $item->nama_karyawan }}</option>
            @endif
        @endforeach
    </select>
    @error('nama_karyawan')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
    @enderror
    <br />
    <label>Dari Tanggal</label>
    <input type="date" name="dari_tanggal" class="form-control @error('dari_tanggal') is-invalid @enderror" name="dari_tanggal" value="{{ old('dari_tanggal') }}"></input>
    @error('dari_tanggal')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
    @enderror
    <br>
    <label>Sampai Tanggal</label>
    <input type="date" name="ke_tanggal" class="form-control @error('ke_tanggal') is-invalid @enderror" name="ke_tanggal" value="{{ old('ke_tanggal') }}"></input>
    @error('ke_tanggal')
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

