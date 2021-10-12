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
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>From Date</label>
                                        <input type="date" name="from_date" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>To Date</label>
                                        <input type="date" name="to_date" value="" class="form-control">
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
                                    <th>ID</th>
                                    <th>Nama Pegawai</th>
                                    <th>Jabatan</th>
                                    <th>Masuk</th>
                                    <th>Izin</th>
                                    <th>Lembur</th>
                                </tr>
                            </thead>
                            <tbody>
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
    <form method="post" id="insert_form" action="proses_kehadiran.php">
    <label>Nama Karyawan</label>
    <select class="form-control" name="nama_karyawan" id="gaji" required>
        <option value="" selected="">Pilih Karyawan</option>
    </select>
    <br />
    <label>Tanggal</label>
    <input type="date" name="tanggal_priode" class="form-control"></input>
    <br>
    <label>Masuk</label>
    <input type="number" name="masuk" class="form-control"></input>
    <br>
    <label>Izin</label>
    <input type="number" name="izin" class="form-control"></input>
    <br>
    <label>lembur</label>
    <input type="number" name="jumlah_lembur" id="lembur" class="form-control"></input>
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
