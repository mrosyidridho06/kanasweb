<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <link rel="stylesheet" href="{{ asset('css/styleinvoice.css') }}" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <header class="clearfix">
        <div id="logo">

            {{-- <img src="{{ $src }}"> --}}
        </div>
        @foreach ($gajis as $item )
        <h1>INVOICE 3-2-1</h1>
        <div id="company" class="clearfix">

        </div>
        <div id="project">
            <div>Kana's Kitchen</div>
            <div>455 Foggy Heights,<br /> AZ 85004, US</div>
            <div>(602) 519-0450</div>
            <div><a href="mailto:company@example.com">company@example.com</a></div>
            <div>August 17, 2015</div>
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
                    <td>@currency($item->potongan)</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4">Potongan</td>
                    <td class="total">@currency($item->potongan)</td>
                </tr>
                <tr>
                    <td colspan="4" class="grand total">Total Gaji</td>
                    <td class="grand total">@currency($item->total_gaji)</td>
                </tr>
            </tbody>
        </table>
        @endforeach
    </main>
</body>
</html>
