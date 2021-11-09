@extends('layouts.app')
@section('title', 'Edit Master Gaji')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Master Gaji</h1>
    <div align="right" class="pt-1">
        <a href="{{route('mastergaji.index')}}" class="btn btn-warning btn-xs"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form method="POST" id="insert_form" action="{{ route('mastergaji.update', $mastergaji->id) }}">
            {{ csrf_field() }}
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label>Uang Harian</label>
                        <input type="number" name="harian" id="harian" class="form-control @error('harian') is-invalid @enderror" name="harian" value="{{ $mastergaji->harian }}" />
                        @error('harian')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br />
                </div>
                <div class="col-md-6">
                    <label>Uang Lembur</label>
                        <input type="number" name="lembur" id="lembur" class="form-control @error('lembur') is-invalid @enderror" name="lembur" value="{{ $mastergaji->lembur }}" />
                        @error('lembur')
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
