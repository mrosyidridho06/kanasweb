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
