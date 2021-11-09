@extends('layouts.app')
@section('title', 'Tunjangan Gaji')
@section('content')
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
                                <td>{{ $item->tunjangan }}</td>
                                <td>{{ $item->bpjs }}</td>
                                <td align="center">
                                    <a href="" id="edittunjangan" data-toggle="modal" data-target='#modal_edit' data-id="{{ $item->id }}">Edit</a>                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modals Tambah data -->
    <div class="modal fade" id="modal_edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input Tunjangan Gaji</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                    <div class="modal-body">
                        <form id="edittun">
                            {{ csrf_field() }}
                            <label>Nama Karyawan</label>
                            <input type="hidden" id="id" name="id" value="">
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
            $('#myTable').DataTable();
        } );
    </script>

    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

            $('body').on('click', '#submit', function (event) {
                event.preventDefault()
                var id = $("#id").val();
                var karyawan = $("#nama_karyawan").val();
                var tunjangan = $("#tunjangan").val();
                var bpjs = $("#bpjs").val();

                $.ajax({
                url: 'tunjangangaji/' + id,
                type: "POST",
                data: {
                    id: id,
                    nama_karyawan: nama_karyawan,
                    tunjangan: tunjangan,
                    bpjs: bpjs,
                },
                dataType: 'json',
                success: function (data) {

                    $('#edittun').trigger("reset");
                    $('#modal_edit').modal('hide');
                    window.location.reload(true);
                }
            });
            });

            $('body').on('click', '#edittunjangan', function (event) {

                event.preventDefault();
                var id = $(this).data('id');
                console.log(id)
                $.get('tunjangangaji/' + id + '/edit', function (data) {
                    $('#userCrudModal').html("Edit category");
                    $('#submit').val("Edit category");
                    $('#modal_edit').modal('show');
                    $('#karyawan_id').val(data.data.karyawan_id);
                    $('#nama_karyawan').val(data.data.nama_karyawan);
                    $('#tunjangan').val(data.data.tunjangan);
                    $('#bpjs').val(data.data.bpjs);
                })
            });

        });
    </script>
@endpush

