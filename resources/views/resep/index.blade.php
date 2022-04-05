@extends('layouts.app')
@section('title', 'Tambah Resep')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                        {{-- <button type="button" class="btn btn-sm btn-outline-secondary add-to-cart" data-id="{{$bahans->id}}" data-nama_bahan="{{$bahans->nama_bahan}}" data-harga_satuan="{{$bahans->harga_satuan}}">Add to Cart</button> --}}
                        <button class="btn btn-primary" type="submit">Tambah</button>
                        {{-- <a href="{{ url('add-to-cart/'.$bahans->id) }}" class="btn btn-warning btn-block text-center" role="button">Tambah</a> --}}
                        {{-- <p>{{ $bahans->nama_bahan }}</p> --}}
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 pt-3">
                <div class="card card-primary">
                    <div class="card-header font-weight-bold text-primary">Daftar Bahan</div>
                    <div class="card-body">
                        {{-- @if (isset($cart_data))
                            @if (Cookie::get('shopping_cart'))
                                @php $total="0" @endphp --}}
                        <div class="table-responsive">
                            @if (Cookie::get('shopping_cart'))
                            <div class="col-md-12 text-right mb-3">
                                <a href="/clearcart" class="font-weight-bold">Clear Cart</a>
                            </div>
                            @endif
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Bahan</th>
                                            <th>Satuan</th>
                                            <th>Quantity</th>
                                            <th align="right">Harga</th>
                                            <th>Sub Total</th>
                                            <th class="text-center">Aksi</th>
                                            <th class="text-center">Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total="0" @endphp
                                        @if ($cart_data  != null)
                                        @forelse ($cart_data as $key => $detail)
                                            <?php $total += $detail['harga_satuan'] * $detail['qty']; ?>
                                            <tr class="cartpage">
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
                                                    @currency($detail['harga_satuan'])
                                                </td>
                                                @php $subtotal = ($detail["qty"] * $detail["harga_satuan"])
                                                @endphp
                                                <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                                <td>
                                                    @currency($subtotal)
                                                </td>
                                                <td>
                                                    <div class="btn-group quantity" role="group">
                                                        <div class="btn btn-primary btn-sm kurang-btn changeQuantity">
                                                            -
                                                        </div>
                                                        <input type="hidden" class="bahan"value="{{ $detail['id'] }}">
                                                        <input type="text" readonly class="qty-input form-control"
                                                            maxlength="2" max="10" value="{{ $detail['qty'] }}">
                                                        <div class="btn btn-primary btn-sm tambah-btn changeQuantity">
                                                            +
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="font-size: 20px;" class="text-center">
                                                    <input type="hidden" class="bahan" name="bahan"
                                                        value="{{ $detail['id'] }}">
                                                    <button class="btn btn-sm delete_cart_data">
                                                        <li class="fa fa-trash"></li>
                                                    </button>
                                                </td>
                                                {{-- <td class="cart-product-quantity" width="130px">
                                                                <div class="input-group quantity">
                                                                    <div class="input-group-prepend decrement-btn changeQuantity"
                                                                        style="cursor: pointer">
                                                                        <span class="input-group-text">-</span>
                                                                    </div>
                                                                    <input type="text" class="qty-input form-control" maxlength="2"
                                                                        max="10" value="{{ $detail['qty'] }}">
                                                                    <div class="input-group-append increment-btn changeQuantity"
                                                                        style="cursor: pointer">
                                                                        <span class="input-group-text">+</span>
                                                                    </div>
                                                                </div>
                                                            </td> --}}
                                            </tr>
                                        @empty
                                                <tr>
                                                    <td colspan="7" align="center">Data Kosong</td>
                                                </tr>
                                        @endforelse
                                        @else
                                            <td class="text-center" colspan="7">kosong</td>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="text-right">
                                    <h5>Total Rp{{ $total }}</h5>
                                </div>
                            {{-- @endif
                        @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <th colspan="7" class="text-center"> Kosong</th>
                            </table>
                        </div>
                        @endif --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 pt-3">
                <div class="card card-primary">
                    <div class="card-header font-weight-bold text-primary">Input Harga</div>
                    <form method="post" action="{{ route('resep.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="input-group mb-2">
                                <input type="number" name="total" id="total" value="<?= $total ?>">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Nama Resep</span>
                                </div>
                                <input type="text" name="namaresep" placeholder="Nama Resep" class="form-control"
                                    required>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Jumlah Produksi</span>
                                </div>
                                <input type="number" name="jumlah_produksi" placeholder="Jumlah Produksi" id="produksi"
                                    onkeyup="sum();" class="form-control" required>
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Jual</span>
                                </div>
                                <input type="number" name="jual" placeholder="Jual" class="form-control" id="jual"
                                    onkeyup="hargajual();" required>
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">HPP</span>
                                </div>
                                <input type="hidden" class="form-control" id="total" value="" onkeyup="sum();" readonly>
                                <input type="number" name="hpp" class="form-control" id="hpp" onkeyup="hargajual();"
                                    aria-describedby="basic-addon3" readonly>
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Harga Jual</span>
                                </div>
                                <input type="number" name="harga_jual" class="form-control" id="harga_jual"
                                aria-describedby="basic-addon3" readonly>
                            </div>
                            <div class="justify-align-center pt-2 text-right">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
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


        $(document).ready(function() {

            $('.delete_cart_data').click(function(e) {
                e.preventDefault();

                var product_id = $(this).closest(".cartpage").find('.bahan').val();

                var data = {
                    '_token': $('input[name=_token]').val(),
                    "bahan": product_id,

                };

                // $(this).closest(".cartpage").remove();

                $.ajax({
                    url: '/hapusresep',
                    type: 'DELETE',
                    data: data,
                    success: function(response) {
                        window.location.reload();
                        alertify.set('notifier','position','top-right');
                        alertify.success(response.status);
                    }
                });
            });

        });

        $(document).ready(function() {
            $('.tambah-btn').click(function(e) {
                e.preventDefault();
                var incre_value = $(this).parents('.quantity').find('.qty-input').val();
                var value = parseInt(incre_value, 10);
                value = isNaN(value) ? 0 : value;
                if (value) {
                    value++;
                    $(this).parents('.quantity').find('.qty-input').val(value);
                }
            });

            $('.kurang-btn').click(function(e) {
                e.preventDefault();
                var decre_value = $(this).parents('.quantity').find('.qty-input').val();
                var value = parseInt(decre_value, 10);
                value = isNaN(value) ? 0 : value;
                if (value > 1) {
                    value--;
                    $(this).parents('.quantity').find('.qty-input').val(value);
                }
            });

        });

        $(document).ready(function() {
            $('.changeQuantity').click(function(e) {
                e.preventDefault();

                var quantity = $(this).closest(".cartpage").find('.qty-input').val();
                var product_id = $(this).closest(".cartpage").find('.bahan').val();

                var data = {
                    '_token': $('input[name=_token]').val(),
                    'qty': quantity,
                    'bahan': product_id,
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/updateresep',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        window.location.reload();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(response.status);
                    }
                });
            });

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
            } else {
                document.getElementById('harga_jual').value = "kosong";
            }
        }
    </script>
@endpush
