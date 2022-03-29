@extends('layouts.app')
@section('title', 'Tambah Resep')
@section('content')
    <div class="container col-md-12">
        <h3 class="mb-2 text-gray-800">Resep</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header font-weight-bold text-primary">Pilih Bahan</div>
                    <div class="card-body">
                    <label>Nama Bahan</label>
                    <form action="{{ route('tambahCart') }}" method="POST">
                    @csrf
                    <select class="form-control bahans @error('bahan') is-invalid @enderror" name="bahan" value="{{ old('bahan') }}">
                        <option value="" selected disabled>Pilih Bahan</option>
                            @foreach ($bahan as $bahans )
                            @if (old('bahan') == $bahans->id)
                                <option value="{{ $bahans->id }}" selected> {{ $bahans->nama_bahan }}, {{ $bahans->satuan_bahan }} </option>
                            @else
                                <option value="{{ $bahans->id }}">{{ $bahans->nama_bahan }}, {{ $bahans->satuan_bahan }}</option>
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
                        {{-- <button type="button" class="btn btn-sm btn-outline-secondary add-to-cart" data-id="{{$bahans->id}}" data-nama_bahan="{{$bahans->nama_bahan}}" data-harga_satuan="{{$bahans->harga_satuan}}">Add to Cart</button> --}}
                        <button class="btn btn-primary" type="submit">Tambah</button>
                        {{-- <a href="{{ url('add-to-cart/'.$bahans->id) }}" class="btn btn-warning btn-block text-center" role="button">Tambah</a> --}}
                        {{-- <p>{{ $bahans->nama_bahan }}</p> --}}
                    </div>
                </form>
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-12 col-md-4">
                <div class="card card-primary">
                    <form method="post" action="tambah_resep.php">
                        <div class="card-header font-weight-bold text-primary">Input Harga</div>
                            <div class="card-body">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Nama Resep</span>
                                    </div>
                                    <input type="text" name="namaresep" placeholder="Nama Resep" class="form-control" required>
                                    <?php $total = 0 ?>
                                    @if ($cart_data  != null)
                                    @foreach ($cart_data as $key => $detail)
                                    <?php $total += $detail['harga_satuan'] * $detail['qty'] ?>
                                        <input type="hidden" name="total" id="total" value="<?=$total?>">
                                    @endforeach
                                    @endif
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Jumlah Produksi</span>
                                    </div>
                                    <input type="number" name="jumlah_produksi" placeholder="Jumlah Produksi" id="produksi" onkeyup="sum();" class="form-control" required>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Jual</span>
                                    </div>
                                    <input type="number" name="jual" placeholder="Jual" class="form-control" id="jual" onkeyup="hargajual();" required>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">HPP</span>
                                    </div>
                                    <input type="hidden" class="form-control" id="total" value=""  onkeyup="sum();" readonly>
                                    <input type="number" name="hpp" class="form-control" id="hpp" onkeyup="hargajual();" aria-describedby="basic-addon3" readonly>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Harga Jual</span>
                                    </div>
                                    <input type="number" name="harga_jual" class="form-control" id="harga_jual" aria-describedby="basic-addon3" readonly>
                                </div>
                                <div class="justify-align-center pt-2 text-right">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="card card-primary">
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
                                            <th align="center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0 ?>
                                        @if ($cart_data  != null)
                                        @forelse ($cart_data as $key => $detail)

                                        <?php $total += $detail['harga_satuan'] * $detail['qty'] ?>
                                        <tr>
                                            <td>
                                                {{ $detail['nama_bahan'] }}
                                            </td>
                                            <td>
                                                {{ $detail['satuan_bahan'] }}
                                            </td>
                                            <td>
                                                {{ $detail['qty'] }}
                                            </td>
                                            <td>
                                                {{ $detail['harga_satuan'] }}
                                            </td>
                                            <td>
                                                {{ $detail['subtotal'] }}
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <form action="{{ route('updateresep') }}" method="post">
                                                    @method('patch')
                                                    @csrf()
                                                      <input type="hidden" name="param" value="kurang">
                                                      <button class="btn btn-primary btn-sm">
                                                      -
                                                      </button>
                                                    </form>
                                                    <button class="btn btn-outline-primary btn-sm" disabled="true">
                                                    {{ number_format($detail['qty']) }}
                                                    </button>
                                                    <form action="{{ route('updateresep') }}" method="post">
                                                    @method('patch')
                                                    @csrf()
                                                      <input type="hidden" name="param" value="tambah">
                                                      <button class="btn btn-primary btn-sm">
                                                      +
                                                      </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="14" align="center">Data Kosong</td>
                                        </tr>
                                        @endforelse
                                        @else
                                            <td colspan="6">kosong</td>
                                        @endif

                                    </tbody>
                                </table>
                                <div class="text-right">
                                    <h5>Total Rp. {{ $total }}</h5>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.bahans').select2();
    });

    function sum() {
              var produksi = document.getElementById('produksi').value;
              var total = document.getElementById('total').value;
              
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
            }else{
                document.getElementById('harga_jual').value = "kosong";
            }
    }
</script>
@endpush
