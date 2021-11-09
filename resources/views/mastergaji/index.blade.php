@extends('layouts.app')
@section('title', 'Kehadiran')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Master Gaji</h1>
        <div align="right" class="pt-1">
            <a href="" class="btn btn-success btn-xs"><i class="fa fa-sync"></i></a>
            <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary"><i class="fa fa-plus"> Tambah Kehadiran</i></button>
        </div>
    </div>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card mt-4">
            <div class="card-body">
                <table class="table table-borderd">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Uang Harian</th>
                            <th>Uang Lembur</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mgaji as $gaji)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>@currency($gaji->harian)</td>
                                <td>@currency($gaji->lembur)</td>
                                <td align="center">
                                    <a href="{{ route('mastergaji.edit',$gaji->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                    <form class="d-inline" action="{{route('mastergaji.destroy',$gaji->id)}}" method="POST">
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
                    <form method="POST" id="insert_form" action="{{ route('mastergaji.store') }}">
                    {{ csrf_field() }}
                    <label>Uang Harian</label>
                    <input type="number" name="harian" class="form-control @error('harian') is-invalid @enderror" name="harian" value="{{ old('harian') }}"></input>
                    @error('harian')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    <br>
                    <label>Uang Lembur</label>
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
