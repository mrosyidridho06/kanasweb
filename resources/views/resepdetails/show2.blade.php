<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    @foreach ($daftar as $item )
    <title>Kana's Kitchen - Resep {{ $item->nama_resep }}</title>
    <link rel="stylesheet" href="{{ asset('css/styleinvoice.css') }}" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body onload="window.print()">
    <header class="clearfix">
        <div id="logo">
            <img src="{{ asset('kanas.png') }}">
        </div>
        <h1>Resep {{ $item->nama_resep }}</h1>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Nama Bahan</th>
                    <th>Supplier</th>
                    <th>Satuan</th>
                    <th>Qty</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($item->resepdetail as $detail)
                <tr>
                    <td>{{ $detail->bahan->nama_bahan }}</td>
                    <td>{{ $detail->bahan->supplier->nama_supplier }}</td>
                    <td>{{ $detail->bahan->satuan_bahan }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td>@currency($detail->bahan->harga_satuan)</td>
                    <td>@currency($detail->subtotal)</td>
                </tr>
                @endforeach

                <tr>
                    <td class="h6 text-uppercase font-weight-bold" align="right" colspan="5">Total</td>
                    <td align="right">@currency($item->total)</td>
                </tr>
                <tr>
                    <td class="h6 text-uppercase font-weight-bold" align="right" colspan="5">HPP</td>
                    <td align="right">@currency($item->hpp)</td>
                </tr>
                <tr>
                    <td class="h6 text-uppercase font-weight-bold" align="right" colspan="5">Harga Jual</td>
                    <td align="right">@currency($item->harga_jual)</td>
                </tr>
        @endforeach
            </tbody>
        </table>
    </main>
</body>
</html>
