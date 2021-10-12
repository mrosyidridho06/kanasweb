@extends('layouts.app')

@section('content')
    <h3 class="mb-2 text-gray-800">Resep</h3>
    <form method="post" action="proses_resep.php" class="form-inline">
    <!-- <label>Nama Resep</label><div class="form-group" style="margin: 1px;padding: 0px;padding-bottom: 6px;"><input class="form-control" type="text" name="nama_resep" placeholder="Nama Resep"></div> -->
        <div class="form-group">
            <select class="form-control bahan" name="bahan" id="bahan" required>
                <option>Nama Bahan
                </option>
            </select>
        </div>
        <div class="fotm-group mx-1">
            <input type="number" name="qty" class="form-control" placeholder="Jumlah" required>
        </div>
        <div class="form-group mx-2">
            <button class="btn btn-primary" type="submit">Tambah</button>
        </div>
    </form>
    <br><br>
    <div class="card shadow mb-4">
            <div class="card-body">
            <h3>Resep Details</h3>
            <form action="tambah_resep.php" method="post" class="form-inline my-4">
                <input type="hidden" name="total">
                <div class="form-group mx-2">
                    <input type="text" name="namaresep" placeholder="Nama Resep" class="form-control" required>
                </div>
                <div class="form-group mx-2">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Nama Bahan</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Quantity</th>
                        <th align="right">Harga</th>
                        <th align="center">Aksi</th>
                        <th>Sub Total</th>
                    </tr>
                </table>
                <h5 align="right">Total Rp.</h5>
            </div>
        </div>
    </div>
@endsection
