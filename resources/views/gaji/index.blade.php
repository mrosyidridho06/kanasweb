@extends('layouts.app')
@section('title', 'Gaji')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Penggajian</h1>
        <div align="right" class="pt-1">
            <a href="" class="btn btn-success btn-xs"><i class="fa fa-sync"></i></a>
            <a href="{{ route('gaji.create') }}" class="btn btn-primary btn-xs"><i class="fa fa-plus"> Tambah Gaji</i></a>
            {{-- <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary"><i class="fa fa-plus"> Tambah Gaji</i></button> --}}
        </div>
    </div>
    <div class="card mt-2">
        <div class="card-body">
            <form action="{{route('gaji.index')}}" method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Bulan</label>
                            <select name="bulan" class="form-control" id="bulan">
                                <option value="" selected disabled>Pilih Bulan</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                            <script>document.getElementById('bulan').value = "<?php if (isset($_GET['bulan']) && $_GET['bulan']) echo $_GET['bulan'];?>";</script>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tahun</label>
                            <select name="tahun" id="tahun" class="form-control">
                                <option value="" selected disabled>Pilih Tahun</option>
                                @foreach ($dataTahun as $tahun)
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                @endforeach
                            </select>
                            <script>document.getElementById('tahun').value = "<?php if (isset($_GET['tahun']) && $_GET['tahun']) echo $_GET['tahun'];?>";</script>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Click to Filter</label> <br>
                        <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card shadow mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover display" id="tb_gaji">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th scope="row">Nama</th>
                        <th scope="row">Masuk</th>
                        <th scope="row">Lembur</th>
                        <th scope="row">Uang Lembur</th>
                        <th scope="row">BPJS</th>
                        <th scope="row">Bonus</th>
                        <th scope="row">Tunjangan</th>
                        <th scope="row">Gaji Harian</th>
                        <th scope="row">Potongan</th>
                        <th scope="row">Total Gaji</th>
                        <th colspan="2" class="text-center">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($filter as $gaji)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $gaji->nama_karyawan }}</td>
                        <td>{{ $gaji->masuk }}</td>
                        <td>{{ $gaji->lembur }}</td>
                        <td>@currency($gaji->uang_lembur)</td>
                        <td>@currency($gaji->bpjs)</td>
                        <td>@currency($gaji->bonus)</td>
                        <td>@currency($gaji->tunjangan)</td>
                        <td>@currency($gaji->gaji_harian)</td>
                        <td>@currency($gaji->potongan)</td>
                        <td>@currency($gaji->total_gaji)</td>
                        <td align="center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fa fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{route('gaji.edit', $gaji->id)}}"><i class="fa fa-edit"></i> Edit</a>
                                    {{-- <a class="dropdown-item" target="_blank" href="{{route('gaji.show', $gaji->id)}}"><i class="fa fa-eye"></i> Lihat</a> --}}
                                    <button class="dropdown-item" data-toggle="modal" data-target="#details-modal-{{ $gaji->id }}"><i class="fa fa-eye"></i> Lihat</button>
                                    <a class="dropdown-item" href="{{ route('gaji.show', $gaji->id) }}" type="button" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
                                    {{-- <a class="dropdown-item" href="{{route('gajiexport', $gaji->id)}}"><i class="fa fa-download"></i> Download</a> --}}
                                    <form action="{{route('gaji.destroy', $gaji->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="dropdown-item btn"><i class="fa fa-trash"></i> Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="14" align="center">Data Kosong</td>
                        </tr>
                    @endforelse
                </tbody>
                </table>
            </div>
        </div>
    </div>
    @foreach ($filter as $subitem)
    <div id="details-modal-{{ $subitem->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="details-modal-{{ $subitem->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Slip Gaji {{ $subitem->nama_karyawan }}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless table-responsive-sm"  border="0" cellpadding="3" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Masuk</th>
                            <th scope="col" class="text-center">Lembur</th>
                            <th class="text-right">Uang Lembur</th>
                            <th class="text-right">BPJS</th>
                            <th class="text-right">Bonus</th>
                            <th class="text-right">Tunjangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="center">{{ $subitem->masuk }}</td>
                            <td align="center">{{ $subitem->lembur }}</td>
                            <td align="right">@currency($subitem->uang_lembur)</td>
                            <td align="right">@currency($subitem->bpjs)</td>
                            <td align="right">@currency($subitem->bonus)</td>
                            <td align="right">@currency($subitem->tunjangan)</td>
                        </tr>
                        <td colspan="5">
                            <hr>
                        </td>
                        <tr>
                            <td class="h6 text-uppercase font-weight-bold" align="right" colspan="5">Gaji Harian</td>
                            <td align="right">@currency($subitem->gaji_harian)</td>
                        </tr>
                        <tr>
                            <td class="h6 text-uppercase font-weight-bold" align="right" colspan="5">Potongan</td>
                            <td align="right">@currency($subitem->potongan)</td>
                        </tr>
                        <tr>
                            <td class="h6 text-uppercase font-weight-bold" align="right" colspan="5">Total Gaji</td>
                            <td align="right">@currency($subitem->total_gaji)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="{{ route('gaji.show', $subitem->id) }}" type="button" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </div>
        </div>
    </div>
    @endforeach
@endsection
