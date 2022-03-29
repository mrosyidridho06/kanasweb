@extends('layouts.app')
@section('title', 'Supplier')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Supplier</h1>
        <div align="right" class="pt-1">
            <a href="" class="btn btn-success btn-xs"><i class="fa fa-sync"></i></a>
            <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary"><i class="fa fa-plus"> Tambah Supplier</i></button>
        </div>
    </div>
    <div class="my-2 row">
        <div class="col-md-4">
            {{-- <a href="{{ route('supplierexport') }}" class="btn btn-primary">Export</a> --}}
            {{-- <button class="btn btn-success" name="import" id="importbut" data-toggle="modal" data-target="#import" type="submit">Import</button>
            <div id="import" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Import Data Supplier</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                            <div class="modal-body">
                                <form action="{{ route('supplierimport') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="supplier" class="form-control" required>
                                    <br>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </form>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-hover" id="myTable">
                <thead>
                    <th>No.</th>
                    <th>Nama Supplier</th>
                    <th>Alamat</th>
                    <th>Hp</th>
                    <th class="text-center">Aksi</th>
                </thead>
                <tbody>
                    @foreach ($supplier as $item )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_supplier }}</td>
                            <td>{{ $item->alamat_supplier }}</td>
                            <td>{{ $item->hp_supplier }}</td>
                            <td align="center">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fa fa-cog"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{route('supplier.edit',$item->id)}}"><i class="fa fa-edit"></i> Edit</a>
                                        <form action="{{route('supplier.destroy', $item->id)}}" method="POST">
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
    <!-- Modals Tambah data -->
    <div id="add_data_Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input Supplier</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                    <div class="modal-body">
                        <form method="POST" id="insert_form" action="{{ route('supplier.store') }}">
                            {{ csrf_field() }}
                            <label>Nama Supplier</label>
                            <input type="text" name="nama_supplier" id="nama_supplier" class="form-control @error('nama_supplier') is-invalid @enderror" name="nama_supplier" value="{{ old('nama_supplier') }}" />
                            @error('nama_supplier')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <br />
                            <label>Alamat Supplier</label>
                            <textarea name="alamat_supplier" id="alamat_supplier" class="form-control">{{ old('alamat_supplier') }}</textarea>
                            @error('alamat_supplier')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <br />
                            <br />
                            <label>Nomor Handphone</label>
                            <input type="text" name="hp_supplier" id="hp_supplier" class="form-control @error('hp_supplier') is-invalid @enderror" name="hp_supplier" value="{{ old('hp_supplier') }}" />
                            @error('hp_supplier')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <br />
                            <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
                        </form>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                lengthMenu: [
                    [ 10, 25, 50, 100, 1000, -1 ],
                    [ '10', '25', '50', '100', '1000', 'All' ]
                ],
                columnDefs: [
                    {
                        "searchable": false,
                        "orderable": false,
                        "targets": 4,
                    },
                ],
                buttons: [
                    {
                        extend: 'csv',
                        text: 'Export',
                        exportOptions: {
                            modifier: {
                                page: 'all',
                                search: 'none'
                            },
                            columns: [ 0, 1, 2, 3 ]
                        }
                    },
                    {
                        extend: 'pdf',
                        text: 'Pdf',
                        exportOptions: {
                            modifier: {
                                page: 'all',
                                search: 'none'
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
                    "searchPlaceholder": "Cari nama supplier",
                    "zeroRecords": "Tidak ditemukan data yang sesuai",
                    "emptyTable": "Tidak terdapat data di tabel"
                }
            });
        } );
    </script>
@endpush

