@extends('layouts.app')
@section('title', 'Riwayat Aktivitas')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Riwayat Aktivitas</h1>
        <div align="right" class="pt-1">
            <a href="" class="btn btn-success btn-xs"><i class="fa fa-sync"></i></a>
        </div>
    </div>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card mt-4">
            <div class="card-body">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Aktivitas</th>
                            <th>Waktu</th>
                            {{-- <th class="text-center">Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @if ((auth()->user()->role == 'admin'))
                        @forelse ($riwyatall as $item)
                        <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->aktivitas }}</td>
                                <td>{{ $item->created_at->translatedFormat('l, d F Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" align="center">Data Kosong</td>
                            </tr>
                        @endforelse
                        @else
                        @forelse ($riwayats as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->aktivitas }}</td>
                                <td>{{ $item->created_at->translatedFormat('l, d F Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" align="center">Data Kosong</td>
                            </tr>
                        @endforelse
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready( function () {
        $('#myTable').DataTable({
            dom: 'lBfrtip',
            orderable: [
                [3, "asc"]
            ],
            // buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis'],
            lengthMenu: [
                [ 10, 25, 50, 100, 1000, -1 ],
                [ '10', '25', '50', '100', '1000', 'All' ]
            ],
            buttons: [
                {
                    extend: 'csv',
                    text: 'Export',
                    exportOptions: {
                        modifier: {
                            page: 'all'
                        },
                        columns: [ 0, 1, 2, 3 ]
                    }
                },
                {
                    extend: 'pdf',
                    text: 'Pdf',
                    exportOptions: {
                        modifier: {
                            page: 'all'
                        },
                        columns: [ 0, 1, 2, 3 ]
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    exportOptions: {
                        modifier: {
                            page: 'all'
                        },
                        columns: [ 0, 1, 2, 3 ]
                    }
                },

            ],
            language: {
                "searchPlaceholder": "Cari Aktivitas",
                "zeroRecords": "Tidak ditemukan data yang sesuai",
                "emptyTable": "Tidak terdapat data di tabel"
            }
        });
    } );

    $(document).ready(function() {
        $('.suppliers').select2({
            width: '100%', dropdownCssClass: "bigdrop"
        });
    });
</script>
@endpush
