@include('layouts.partials.head')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/styleinvoice.css') }}" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <button class="btn btn-sm" onclick="window.print()">Print</button>
    <header class="clearfix">
        <div id="logo">
            <img src="{{ asset('kanas.png') }}">
        </div>
        @foreach ($daftar as $item )
        <h1>Resep {{ $item->nama_resep }}</h1>
        <div id="company" class="clearfix">

        </div>
        <div id="project">
            <div>Kana's Kitchen</div>
            <div>Wika<br /> Gunung Samarinda</div>
            <div>0542-111111</div>
            <div><a href="mailto:kanaskitchen@gmail.com">kanaskitchen@gmail.com</a></div>
            <div>{{ $item->created_at->format('l, d F Y') }}</div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Nama Bahan</th>
                    <th>Satuan</th>
                    <th>Qty</th>
                    <th class="">Subtotal</th>
                    <th class="">B</th>
                    <th class="">Bonus</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td >{{ $item->kehadiran->karyawan->nama_karyawan }}</td>
                    <td >{{ $item->kehadiran->masuk }}</td>
                    <td >{{ $item->kehadiran->lembur }}</td>
                    <td>@currency($item->gaji_harian)</td>
                    <td>@currency($item->bpjs)</td>
                    <td>@currency($item->bonus)</td>
                </tr>
                <tr>
                    <td colspan="5">Potongan</td>
                    <td>@currency($item->potongan)</td>
                </tr>
                <tr>
                    <td colspan="5">Total Gaji</td>
                    <td>@currency($item->total_gaji)</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>
</html>
