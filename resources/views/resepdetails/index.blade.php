@extends('layouts.app')
@section('title', 'Daftar Resep')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Resep</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover display" id="myTable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th scope="row">Nama Resep</th>
                        <th class="text-center">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_resep }}</td>
                        <td align="center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fa fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{route('resepdetails.edit', $item->id)}}"><i class="fa fa-edit"></i> Edit</a>
                                    <button class="dropdown-item" data-toggle="modal" data-target="#details-modal-{{ $item->id }}"><i class="fa fa-eye"></i> Lihat</button>
                                    {{-- <a class="dropdown-item" href="{{route('exportresep', $item->id)}}"><i class="fa fa-download"></i> Download</a> --}}
                                    <form action="{{route('resep.destroy', $item->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="dropdown-item btn"><i class="fa fa-trash"></i> Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
    @foreach ($details as $subitem)
    <div id="details-modal-{{ $subitem->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="details-modal-{{ $subitem->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">{{ $subitem->nama_resep }}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless table-responsive-sm"  border="0" cellpadding="3" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">Nama Bahan</th>
                            <th scope="col" class="text-center">Satuan</th>
                            <th scope="col" class="text-center">Quantity</th>
                            <th class="text-right">Harga Satuan</th>
                            <th class="text-right">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subitem->resepdetail as $item)
                        <tr>
                            <td>{{ $item->bahan->nama_bahan }}</td>
                            <td align="center">{{ $item->bahan->satuan_bahan }}</td>
                            <td align="center">{{ $item->qty }}</td>
                            <td align="right">@currency($item->bahan->harga_satuan)</td>
                            <td align="right">@currency($item->subtotal)</td>
                        </tr>
                        @endforeach
                        <td colspan="5">
                            <hr>
                        </td>
                        <tr>
                            <td class="h6 text-uppercase font-weight-bold" align="right" colspan="4">Total</td>
                            <td align="right">@currency($subitem->total)</td>
                        </tr>
                        <tr>
                            <td class="h6 text-uppercase font-weight-bold" align="right" colspan="4">HPP</td>
                            <td align="right">@currency($subitem->hpp)</td>
                        </tr>
                        <tr>
                            <td class="h6 text-uppercase font-weight-bold" align="right" colspan="4">Harga Jual</td>
                            <td align="right">@currency($subitem->harga_jual)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="{{ route('resepdetails.show', $subitem->id) }}" type="button" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </div>
        </div>
    </div>
    @endforeach
@endsection
@push('scripts')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
                lengthMenu: [
                    [ 10, 25, 50, 100, 1000, -1 ],
                    [ '10', '25', '50', '100', '500', 'All' ]
                ],
                columnDefs: [
                    {
                        "searchable": false,
                        "orderable": false,
                        "targets": 2,
                    },
                ],
                language: {
                    "searchPlaceholder": "Cari Nama Resep",
                    "zeroRecords": "Tidak ditemukan data yang sesuai",
                    "emptyTable": "Tidak terdapat data di tabel"
                }
            });
        } );
    </script>
@endpush
