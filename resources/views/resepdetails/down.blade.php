<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    @foreach ($daftar as $item )
    <title>Kana's Kitchen - Resep {{ $item->nama_resep }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style type="text/css" media="all">
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
          }

          a {
            color: #5D6975;
            text-decoration: underline;
          }

          body {
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: sans-serif;
            font-size: 12px;
          }

          header {
            padding: 10px 0;
            margin-bottom: 30px;
          }

          #logo {
            text-align: center;
            margin-bottom: 10px;
          }

          #logo img {
            width: 90px;
          }

          h1 {
            border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
          }

          #project {
            float: left;
          }

          #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
          }

          #company {
            float: right;
            text-align: right;
          }

          #project div,
          #company div {
            white-space: nowrap;
          }

          table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
          }

          table tr:nth-child(2n-1) td {
            background: #F5F5F5;
          }

          table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
          }

          table .service,
          table .desc {
            text-align: left;
          }

          table td {
            padding: 20px;
            text-align: right;
          }

          table td.service,
          table td.desc {
            vertical-align: top;
          }

          table td.unit,
          table td.qty,
          table td.total {
            font-size: 1.2em;
          }

          table td.grand {
            border-top: 1px solid #5D6975;;
          }

          #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
          }

          footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
          }
    </style>
</head>

<body>
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
                    <td align="center">{{ $detail->bahan->satuan_bahan }}</td>
                    <td align="center">{{ $detail->qty }}</td>
                    <td align="right">@currency($detail->bahan->harga_satuan)</td>
                    <td align="right">@currency($detail->subtotal)</td>
                </tr>
                @endforeach

                <tr>
                    <td class="h6 text-uppercase font-weight-bold" align="right" colspan="4">Total</td>
                    <td align="right">@currency($item->total)</td>
                </tr>
                <tr>
                    <td class="h6 text-uppercase font-weight-bold" align="right" colspan="4">HPP</td>
                    <td align="right">@currency($item->hpp)</td>
                </tr>
                <tr>
                    <td class="h6 text-uppercase font-weight-bold" align="right" colspan="4">Harga Jual</td>
                    <td align="right">@currency($item->harga_jual)</td>
                </tr>
        @endforeach
            </tbody>
        </table>
    </main>
</body>
</html>
