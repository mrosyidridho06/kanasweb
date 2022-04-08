@include('layouts.partials.head')
{{--
<body>
    <div class="text-center">
        <img src="{{ asset('kanas.png') }}" style="height: 60px;">
    </div>
    <h5 class="text-center">Kana's Kitchen</h5>
    <hr>
    <table class="table table-borderless table-responsive-sm" style="max-width: 80%;" align="center">
        <tr>
            <th class="text-center">Penggajian</th>
        </tr>
        <tr>
            @foreach ($gajis as $item )

            <td align="left">Kode: {{ $item->id }}</td>
        </tr>
        <tr>
            <td align="left">Tanggal: {{ $item->created_at->format('d-m-Y') }}</td>
        </tr>
    </table>
    <hr>
    <table class="table table-borderless table-responsive-sm" style="max-width: 80%;" align="center" width="50%" border="0" cellpadding="3" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">Nama Pegawai</th>
                <th scope="col" >Jumlah Masuk</th>
                <th scope="col" >Lembur</th>
                <th scope="col" class="text-right">Gaji Harian</th>
                <th scope="col" class="text-right">BPJS</th>
                <th scope="col" class="text-right">Bonus</th>
                <th scope="col" class="text-right">Potongan</th>
                <th scope="col" class="text-right">Total Gaji</th>
            </tr>
        </thead>
            <tr>
                <td >{{ $item->kehadiran->karyawan->nama_karyawan }}</td>
                <td >{{ $item->kehadiran->masuk }}</td>
                <td >{{ $item->kehadiran->lembur }}</td>
                <td align="right">@currency($item->gaji_harian)</td>
                <td align="right">@currency($item->bpjs)</td>
                <td align="right">@currency($item->bonus)</td>
                <td align="right">@currency($item->potongan)</td>
                <td align="right">@currency($item->total_gaji)</td>
                @endforeach
            </tr>
    </table>
    <script type="text/javascript">
        window.print()
    </script>
</body> --}}

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
        @foreach ($gajis as $item )
        <h1>INVOICE GAJI {{ $item->id }}</h1>
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
                    <th>Nama Karyawan</th>
                    <th>Jumlah Masuk</th>
                    <th>Lembur</th>
                    <th class="">Gaji Harian</th>
                    <th class="">BPJS</th>
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
