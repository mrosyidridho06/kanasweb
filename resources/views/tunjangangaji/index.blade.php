@extends('layouts.app')
@section('title', 'Tunjangan Gaji')
@section('content')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tunjangan Gaji</h1>
        <div align="right" class="pt-1">
            <a href="" class="btn btn-success btn-xs"><i class="fa fa-sync"></i></a>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <th>No.</th>
                        <th>Nama Karyawan</th>
                        <th>Tunjangan</th>
                        <th>BPJS</th>
                        <th class="text-center">Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($tungaji as $item )
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_karyawan }}</td>
                                <td>@currency($item->tunjangan)</td>
                                <td>@currency($item->bpjs)</td>
                                <td align="center">
                                    <button
                                        style="border-radius: 15px"
                                        value="{{ $item->id}}"
                                        class="btn waves-effect waves-light btn-outline-primary pt-1 pb-1 edittunjanganButton"
                                        data-toggle="modal"
                                        data-target="#editModal">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modals Tambah data -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input Tunjangan Gaji</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                    <form method="post" id="editModalForm" action="{{route('tunjangangaji.store')}}">
                    @csrf
                    @method("PUT")
                    <div class="modal-body">
                            <label>Nama Karyawan</label>
                            <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control" name="nama_karyawan" readonly />
                            <br />
                            <label>Tunjangan</label>
                            <input type="number" name="tunjangan" id="tunjangan" class="form-control @error('tunjangan') is-invalid @enderror" name="tunjangan" value="{{ old('tunjangan') }}" />
                            @error('tunjangan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <br />
                            <label>BPJS</label>
                            <input type="number" name="bpjs" id="bpjs" class="form-control @error('bpjs') is-invalid @enderror" name="bpjs" value="{{ old('bpjs') }}" />
                            @error('bpjs')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <br />
                            <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-success" />
                        </div>
                    </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> {{-- modal --}}
@endsection

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
        $(document).on("click", ".edittunjanganButton", function()
            {
                let id = $(this).val();
                $.ajax({
                    method: "get",
                    url :  "tunjangangaji/"+id+"/edit",
                }).done(function(response)
                {
                    $("#nama_karyawan").val(response.nama_karyawan);
                    $("#tunjangan").val(response.tunjangan);
                    $("#bpjs").val(response.bpjs);
                    $("#editModalForm").attr("action", "tunjangangaji/" + id)
                });
            });
    </script>
@endpush

