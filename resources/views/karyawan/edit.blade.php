@extends('layouts.app')
@section('title', 'Edit Karyawan')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Karyawan</h1>
    <div align="right" class="pt-1">
        <a href="{{route('karyawan.index')}}" class="btn btn-warning btn-xs"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 order-lg-2">

        <div class="card shadow">
            <a class="card-profile-image mt-4" href="{{asset('images/'. $karyawan->foto)}}" target="_blank">
                <img id="preview-image" src="{{asset('images/'.$karyawan->foto)}}" />
            </a>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-12">
                        <form method="POST" id="insert_form" action="{{ route('karyawan.update',$karyawan->id) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <input type="file" class="form-control" name="foto" id="foto">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-8 order-lg-1">
        <div class="card shadow">
            <div class="card-body">


                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <label>Nama Karyawan</label>
                                <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control @error('nama_karyawan') is-invalid @enderror" name="nama_karyawan" value="{{ $karyawan->nama_karyawan }}" />
                                @error('nama_karyawan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            <br />
                        </div>
                        <div class="col-md-12">
                            <label>Alamat</label>
                            <textarea id="alamat_karyawan" class="form-control @error('alamat_karyawan') is-invalid @enderror" name="alamat_karyawan"> {{ $karyawan->alamat_karyawan }} </textarea>                            @error('alamat_karyawan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <br />
                        </div>
                        <div class="col-md-6">
                            <label>Jenis Kelamin</label>
                                <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" value="{{ $karyawan->jenis_kelamin }}" name="jenis_kelamin">
                                    <option value="" selected="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ $karyawan->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $karyawan->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <br />
                        </div>
                        <div class="col-md-6">
                            <label>Hp</label>
                                <input type="text" name="hp_karyawan" id="hp_karyawan" class="form-control @error('hp_karyawan') is-invalid @enderror" name="hp_karyawan" value="{{ $karyawan->hp_karyawan }}" />
                                @error('hp_karyawan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <br />
                        </div>
                        <div class="col-md-6">
                            <label>Agama</label>
                            <select class="form-control @error('agama') is-invalid @enderror" name="agama" value="{{ $karyawan->agama }}" name="agama">
                                <option value="" selected="">Pilih Agama</option>
                                <option value="islam" {{ $karyawan->agama == 'islam' ? 'selected' : '' }}>Islam</option>
                                <option value="katolik" {{ $karyawan->agama == 'katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="buddha" {{ $karyawan->agama == 'buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="kristen" {{ $karyawan->agama == 'kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="hindu" {{ $karyawan->agama == 'hindu' ? 'selected' : '' }}>Hindu</option>
                            </select>
                            @error('agama')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <br />
                        </div>
                        <div class="col-md-6">
                            <label>Jabatan</label>
                                <input type="text" name="jabatan" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" value="{{ $karyawan->jabatan }}" />
                                @error('jabatan')
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
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $('#foto').change(function(){

        let reader = new FileReader();
        reader.onload = (e) => {
        $('#preview-image').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

    });
    </script>
@endpush
