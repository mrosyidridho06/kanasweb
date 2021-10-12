@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Penggajian</h1>
        <div align="right" class="pt-1">
            <a href="" class="btn btn-success btn-xs"><i class="fa fa-sync"></i></a>
            <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary"><i class="fa fa-plus"> Tambah Gaji</i></button>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover display" id="tb_gaji">
                <thead>
                    <tr>
                        <!-- <th>No.</th> -->
                        <th scope="row">Nama</th>
                        <th scope="row">Tanggal Pembayaran</th>
                        <th scope="row">Jumlah Kehadiran</th>
                        <th scope="row">BPJS</th>
                        <th scope="row">Bonus</th>
                        <th scope="row">Lembur</th>
                        <th scope="row">Gaji Harian</th>
                        <th scope="row">Potongan</th>
                        <th scope="row">Total Gaji</th>
                        <th colspan="2" class="text-center">Edit</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modals Tambah data -->
<div id="add_data_Modal" class="modal fade">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Input Gaji</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <form method="post" id="insert_form" action="proses_gaji.php">
        <label>Nama Karyawan</label>
        <select class="form-control" name="nama_karyawan" id="gaji" required>
            <option value="" selected="">Pilih Karyawan</option>
        </select>
        <br />
        <label>Tanggal Pembayaran</label>
        <input type="date" name="tanggal_priode" class="form-control"></input>
        <br>
        <label>Jumlah Hari</label>
        <input type="number" name="jumlah_hari" class="form-control" id="jmlh_hari" readonly></input>
        <br>
        <label>Gaji Harian</label>
        <input type="number" name="gaji_harian" class="form-control"></input>
        <br>
        <label>BPJS</label>
        <input type="number" name="tun_bpjs" class="form-control"></input>
        <br>
        <label>Bonus</label>
        <input type="number" name="bonus" class="form-control"></input>
        <br>
        <label>lembur</label>
        <input type="number" name="jumlah_lembur" id="lembur" class="form-control" readonly></input>
        <br>
        <label>Upah lembur</label>
        <input type="number" name="uang_lembur" id="uang_lembur" class="form-control"></input>
        <br>
        <label>Potongan</label>
        <input type="number" name="potongan" class="form-control"></input>
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
