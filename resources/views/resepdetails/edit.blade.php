@extends('layouts.app')
@section('title', 'Edit Resep')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container col-md-12">
        <h3 class="mb-2 text-gray-800">Edit Resep</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header font-weight-bold text-primary">Pilih Bahan</div>
                    <div class="card-body">
                        <label>Nama Bahan</label>
                        <form action="{{ route('tambaheditresep') }}" method="POST">
                            @csrf
                            <select class="form-control bahans @error('bahan') is-invalid @enderror" name="bahan"
                                value="{{ old('bahan') }}">
                                <option value="" selected disabled>Pilih Bahan</option>
                                @foreach ($bahan as $bahans)
                                    @if (old('bahan') == $bahans->id)
                                        <option value="{{ $bahans->id }}" selected> {{ $bahans->nama_bahan }},
                                            {{ $bahans->satuan_bahan }} </option>
                                    @else
                                        <option value="{{ $bahans->id }}">{{ $bahans->nama_bahan }},
                                            {{ $bahans->satuan_bahan }}</option>
                                    @endif
                                @endforeach
                            </select>
                    </div>
                    <div class="card-body d-flex">
                        <div class="row">
                            <div class="col-11">
                                <input type="number" name="qty" class="form-control" placeholder="Jumlah" required>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Tambah</button>
                    </div>
                    @foreach ($daftar as $item)
                    <input type="hidden" name="idresep" value="{{ $item->id }}">
                    @endforeach
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 pt-3">
                @foreach ($daftar as $item)
                <div class="card shadow resepcard">
                    <div class="card-header font-weight-bold text-primary">Daftar Bahan</div>
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Bahan</th>
                                            <th>Satuan</th>
                                            <th>Quantity</th>
                                            <th align="right">Harga</th>
                                            <th>Sub Total</th>
                                            <th class="text-center">Hapus</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($item->resepdetail as $detail)
                                        <form method="post" action="{{ route('resepdetails.update', $detail->id) }}">
                                            @csrf
                                            @method('PUT')
                                        <tr class="cartpage">
                                            <input type="hidden" name="idresep" value="{{ $item->id }}">
                                            <input type="hidden" name="bahan" value="{{ $detail->id }}">
                                                <td>
                                                    {{ $detail->bahan->nama_bahan }}
                                                </td>

                                                <td>
                                                    {{ $detail->bahan->satuan_bahan }}
                                                </td>
                                                <td>
                                                    <input class="form-control" type="number" name="qtyres" id="" value="{{ $detail->qty }}">
                                                </td>
                                                <td>
                                                    <input class="form-control" readonly name="hargasatuan" value="Rp{{ $detail->bahan->harga_satuan }}">
                                                </td>
                                                <td>
                                                    @currency($detail->subtotal)
                                                </td>
                                                <td>
                                                    <form action="{{route('resepdetails.destroy', $detail->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="dropdown-item btn"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" type="submit">Update</button>
                                                </td>
                                            </tr>
                                        </form>
                                            @endforeach
                                    </tbody>
                                </table>
                                    <div class="text-right">
                                    <h5>Total @currency($item->total)</h5>
                                </div>
                            </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-12 col-md-4 pt-3">
                <form method="post" action="{{ route('resep.update', $item->id) }}">
                    @csrf
                    @method('PUT')
                <div class="card shadow hargacard">
                    <input type="hidden" name="total" id="totalhp" value="{{ $item->total }}">
                    <div class="card-header font-weight-bold text-primary">Input Harga</div>
                    <div class="card-body">
                        @foreach ($daftar as $resep)
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Nama Resep</span>
                                </div>
                                <input type="text" name="namaresep" placeholder="Nama Resep" class="form-control"
                                    required value="{{ $resep->nama_resep }}">
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Jumlah Produksi</span>
                                    </div>
                                <input type="number" name="jumlah_produksi" placeholder="Jumlah Produksi" id="produksi"
                                    onkeyup="sum();" class="form-control" required value="{{ $resep->jumlah_produksi }}">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Jual</span>
                                </div>
                                <input type="number" name="jual" placeholder="Jual" class="form-control" id="jual"
                                    onkeyup="hargajual();" required value="{{ $resep->harga_jual }}">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">HPP</span>
                                </div>
                                <input type="hidden" class="form-control" id="totalhp" value="" onkeyup="sum();" readonly>
                                <input type="number" name="hpp" class="form-control" id="hpp" onkeyup="hargajual();"
                                    aria-describedby="basic-addon3" readonly value="{{ $resep->hpp }}">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Harga Jual</span>
                                </div>
                                <input type="number" name="harga_jual" class="form-control" id="harga_jual"
                                aria-describedby="basic-addon3" readonly value="{{ $resep->harga_jual }}">
                            </div>
                            <div class="justify-align-center pt-2 text-right">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>


    <style>
        .select2 {
            width: 100% !important;
        }

    </style>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.bahans').select2();
        });

        function sum() {
            var produksi = document.getElementById('produksi').value;
            var total = document.getElementById('totalhp').value;

            var result = parseFloat(total) / parseFloat(produksi);
            if (!isNaN(result)) {
                document.getElementById('hpp').value = result;
            }
        }

        function hargajual() {
            var hpp = document.getElementById('hpp').value;
            var jual = document.getElementById('jual').value;

            var result = parseFloat(hpp) * parseFloat(jual);
            if (!isNaN(result)) {
                document.getElementById('harga_jual').value = result;
            } else {
                document.getElementById('harga_jual').value = "kosong";
            }
        }
    </script>
@endpush
