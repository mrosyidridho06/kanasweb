@extends('layouts.app')

@section('title', 'Bahan')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Bahan Baku</h1>
    <div align="right" class="pt-1">
        <a href="" class="btn btn-success btn-xs"><i class="fa fa-sync"></i></a>
        {{-- <a href="{{route('bahan.create')}}" class="btn btn-primary">Tambah bahan</a> --}}
        <button type="button" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary"><i class="fa fa-plus"> Tambah Bahan</i></button>
    </div>
    {{-- <button class="btn btn-success" name="import" id="importbut" data-toggle="modal" data-target="#import" type="submit">Import</button>
    <div id="import" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Import Bahan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                    <div class="modal-body">
                        <form action="{{ route('bahanimport') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="bahan" class="form-control" required>
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
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="myTable">
                <thead>
                    <th>No.</th>
                    <th>Nama Bahan</th>
                    <th>Nama Supplier</th>
                    <th>Jumlah Bahan</th>
                    <th>Satuan</th>
                    <th>Harga Satuan</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach ($bah as $item )
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->nama_bahan}}</td>
                            <td>{{$item->supplier->nama_supplier}}</td>
                            <td>{{$item->jumlah_bahan}}</td>
                            <td>{{$item->satuan_bahan}}</td>
                            <td>Rp{{ number_format($item->harga_satuan,0,',','.') }}</td>
                            <td>Rp{{ number_format($item->harga_bahan,0,',','.') }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fa fa-cog"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-primary">
                                        <a class="dropdown-item" href="{{route('bahan.edit',$item->id)}}"><i class="fa fa-edit"></i> Edit</a>
                                        <form action="{{route('bahan.destroy', $item->id)}}" method="POST">
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
<!-- Modals Tambah data -->
<div id="add_data_Modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Bahan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                <div class="modal-body">
                    <form method="POST" id="insert_form" action="{{ route('bahan.store') }}">
                        {{ csrf_field() }}
                        <label>Nama Bahan</label>
                            <input type="text" name="nama_bahan" id="nama_bahan" class="form-control @error('nama_bahan') is-invalid @enderror" name="nama_bahan" value="{{ old('nama_bahan') }}" />
                            @error('nama_bahan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        <br />
                        <label>Supplier</label>
                            <select class="form-control suppliers @error('supplier_id') is-invalid @enderror" height="100%" name="supplier_id" value="{{ old('supplier_id') }}" name="supplier_id">
                                <option value="" selected disabled>Pilih Supplier</option>
                                @foreach ($supp as $supplier )
                                    @if (old('supplier_id') == $supplier->id)
                                        <option value="{{ $supplier->id }}" selected> {{ $supplier->nama_supplier }} </option>
                                    @else
                                        <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        <br/>
                        <br>
                        <label>Jumlah bahan</label>
                            <input type="number" name="jumlah_bahan" id="jumlah_bahan" class="form-control @error('jumlah_bahan') is-invalid @enderror" name="jumlah_bahan" value="{{ old('jumlah_bahan') }}"></input>
                            @error('jumlah_bahan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        <br />
                        <label>Satuan</label>
                            <select class="form-control" name="satuan_bahan">
                                <option value="" selected="">Pilih Satuan</option>
                                <option value="Gram" {{ old('satuan_bahan') == 'Gram' ? 'selected' : '' }}>Gram</option>
                                <option value="Pcs" {{ old('satuan_bahan') == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                                <option value="mL" {{ old('satuan_bahan') == 'mL' ? 'selected' : '' }}>mL</option>
                            </select>
                            @error('satuan_bahan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        <br />
                        <label>Harga</label>
                            <input type="number" name="harga_bahan" id="harga_bahan" class="form-control @error('harga_bahan') is-invalid @enderror" name="harga_bahan" value="{{ old('harga_bahan') }}" />
                            @error('harga_bahan')
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
                    [6, "asc"]
                ],
                // buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis'],
                lengthMenu: [
                    [ 10, 25, 50, 100, 1000, -1 ],
                    [ '10', '25', '50', '100', '1000', 'All' ]
                ],
                columnDefs: [
                    {
                        "searchable": false,
                        "orderable": false,
                        "targets": 7,
                    },
                ],
                buttons: [
                    {
                        extend: 'csv',
                        text: 'Export',
                        exportOptions: {
                            modifier: {
                                page: 'all'
                            },
                            columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                        }
                    },
                    {
                        extend: 'pdf',
                        text: 'Pdf',
                        exportOptions: {
                            modifier: {
                                page: 'all'
                            },
                            columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                        }
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        exportOptions: {
                            modifier: {
                                page: 'all'
                            },
                            columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                        }
                    },

                ],
                language: {
                    "searchPlaceholder": "Cari nama bahan/supplier",
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
