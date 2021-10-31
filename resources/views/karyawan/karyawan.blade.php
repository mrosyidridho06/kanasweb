@extends('layouts.app')
@section('title', 'Karyawan')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Karyawan</h1>
        <div align="right" class="pt-1">
            <a href="" class="btn btn-success btn-xs"><i class="fa fa-sync"></i></a>
            <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary"><i class="fa fa-plus"> Tambah Karyawan</i></button>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table" id="myTable">
                <thead>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Nomor Telepon</th>
                    <th>Agama</th>
                    <th>Jabatan</th>
                    <th>Tanggal Masuk</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach ($karyawans as $karyawan)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $karyawan->nama_karyawan }}</td>
                            <td>{{ $karyawan->alamat_karyawan }}</td>
                            <td>{{ $karyawan->jenis_kelamin }}</td>
                            <td>{{ $karyawan->hp_karyawan }}</td>
                            <td>{{ $karyawan->agama }}</td>
                            <td>{{ $karyawan->jabatan }}</td>
                            <td>{{ $karyawan->tanggal }}</td>
                            <td><a href="{{asset('images/'. $karyawan->foto)}}" target="_blank"><img src="{{asset('images/'.$karyawan->foto)}}" width="50px" height="50px" alt=""></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fa fa-cog"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{route('karyawan.edit',$karyawan->id)}}"><i class="fa fa-edit"></i> Edit</a>
                                        <form action="{{route('karyawan.destroy', $karyawan->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item" type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i> Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        <div id="add_data_Modal" class="modal fade">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <form action="{{ route('karyawan.store') }}" id="insert_form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                            <label>Nama</label>
                            <div class="form-group" style="margin: 1px;padding: 0px;padding-bottom: 6px;">
                                <input class="form-control @error('nama_karyawan') is-invalid @enderror" name="nama_karyawan" value="{{ old('nama_karyawan') }}" type="text" name="nama_karyawan" placeholder="Nama">
                                @error('nama_karyawan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label>Alamat</label>
                            <div class="form-group" style="margin: 1px;padding: 0px;padding-bottom: 6px;">
                                <input class="form-control @error('alamat_karyawan') is-invalid @enderror" name="alamat_karyawan" value="{{ old('alamat_karyawan') }}" type="text" name="alamat_karyawan" placeholder="Alamat"  >
                                @error('alamat_karyawan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label>Jenis Kelamin</label>
                            <div class="form-group" style="margin: 1px;padding: 0px;padding-bottom: 6px;">
                                <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" value="{{ old('jenis_kelamin') }}" name="jenis_kelamin" >
                                    <option  value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                    @error('jenis_kelamin')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </select>
                            </div>
                            <label>Nomor Telpon</label>
                            <div class="form-group" style="margin: 1px;padding: 0px;padding-bottom: 6px;">
                                <input class="form-control @error('hp_karyawan') is-invalid @enderror" name="hp_karyawan" value="{{ old('hp_karyawan') }}" type="text" name="hp_karyawan" placeholder="No. Hp" >
                                @error('hp_karyawan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label>Agama</label>
                            <div class="form-group" style="margin: 1px;padding: 0px;padding-bottom: 6px;">
                                <input class="form-control @error('agama') is-invalid @enderror" name="agama" value="{{ old('agama') }}" type="text" name="agama" placeholder="Agama" >
                                @error('agama')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label>Jabatan</label>
                            <div class="form-group" style="margin: 1px;padding: 0px;padding-bottom: 6px;">
                                <input class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" value="{{ old('jabatan') }}" type="text" name="jabatan" placeholder="Jabatan" >
                                @error('jabatan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label>Tanggal Masuk</label>
                            <div class="form-group" style="margin: 1px;padding: 0px;padding-bottom: 6px;">
                                <input class="form-control @error('tanggal_masuk') is-invalid @enderror" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" type="date" name="tanggal_masuk" >
                                @error('tanggal_masuk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label>Gambar</label>
                            <div class="form-group" style="margin: 1px;padding: 0px;padding-bottom: 6px;">
                                <input class="form-control @error('foto') is-invalid @enderror" name="foto" value="{{ old('foto') }}" type="file" name="foto"  >
                                @error('foto')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
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
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
@endpush
