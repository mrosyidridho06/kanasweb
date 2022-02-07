@include('layouts.partials.head')
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
</body>
