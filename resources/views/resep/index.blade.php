@extends('layouts.app')
@section('title', 'Tambah Resep')
@section('content')
    <div class="container col-md-12">
        <h3 class="mb-2 text-gray-800">Resep</h3>
         <div class="row">
             <div class="col-md-12">
                 <div class="card card-primary">
                     <form method="post" action="{{ route('resep.store') }}">
                         <div class="card-header font-weight-bold text-primary">Pilih Bahan</div>
                             <div class="card-body">
                                 <label>Nama Bahan</label>
                                 <select class="form-control @error('bahan') is-invalid @enderror" name="bahan" value="{{ old('bahan') }}" name="bahan">
                                    <option value="" selected disabled>Pilih Bahan</option>
                                    @foreach ($bahan as $bahans )
                                        @if (old('bahan') == $bahans->id)
                                            <option value="{{ $bahans->id }}" selected> {{ $bahans->nama_bahan }}, {{ $bahans->satuan_bahan }} </option>
                                        @else
                                            <option value="{{ $bahans->id }}">{{ $bahans->nama_bahan }}, {{ $bahans->satuan_bahan }}</option>
                                        @endif
                                    @endforeach
                                </select>
                             </div>
                             <div class="card-body d-flex">
                                 <div class="row">
                                     <div class="col-11">
                                         <input type="number" name="qty" class="form-control" placeholder="Jumlah" required>
                                     </div>
                                 </div>
                                 <button class="btn btn-primary" type="submit">Tambah</button>
                             </div>
                     </form>
                 </div>
             </div>
         </div>
         <div class="row pt-4">
             <div class="col-12 col-md-4">
                 <div class="card card-primary">
                     <form method="post" action="tambah_resep.php">
                         <div class="card-header font-weight-bold text-primary">Input Harga</div>
                             <div class="card-body">
                                 <div class="input-group mb-2">
                                     <div class="input-group-prepend">
                                         <span class="input-group-text" id="basic-addon1">Nama Resep</span>
                                      </div>
                                     <input type="text" name="namaresep" placeholder="Nama Resep" class="form-control" required>
                                     <input type="hidden" name="total" value="">
                                 </div>
                                 <div class="input-group mb-2">
                                     <div class="input-group-prepend">
                                         <span class="input-group-text" id="basic-addon1">Jumlah Produksi</span>
                                      </div>
                                     <input type="number" name="jumlah_produksi" placeholder="Jumlah Produksi" id="produksi" onkeyup="sum();" class="form-control" required>
                                 </div>
                                 <div class="input-group mb-2">
                                     <div class="input-group-prepend">
                                         <span class="input-group-text" id="basic-addon1">Jual</span>
                                      </div>
                                     <input type="number" name="jual" placeholder="Jual" class="form-control" id="jual" onkeyup="hargajual();" required>
                                 </div>
                                 <div class="input-group mb-2">
                                     <div class="input-group-prepend">
                                         <span class="input-group-text" id="basic-addon1">HPP</span>
                                      </div>
                                      <input type="hidden" class="form-control" id="total" value=""  onkeyup="sum();" readonly>
                                     <input type="number" name="hpp" class="form-control" id="hpp" onkeyup="hargajual();" aria-describedby="basic-addon3" readonly>
                                 </div>
                                 <div class="input-group mb-2">
                                     <div class="input-group-prepend">
                                         <span class="input-group-text" id="basic-addon1">Harga Jual</span>
                                     </div>
                                     <input type="number" name="harga_jual" class="form-control" id="harga_jual" aria-describedby="basic-addon3" readonly>
                                 </div>
                                 <div class="justify-align-center pt-2 text-right">
                                     <button class="btn btn-primary" type="submit">Submit</button>
                                 </div>
                             </div>
                 </div>
             </div>
             <div class="col-12 col-md-8">
                 <div class="card card-primary">
                         <div class="card-header font-weight-bold text-primary">Daftar Bahan</div>
                         <div class="card-body">
                             <div class="table-responsive">
                                 <table class="table table-striped">
                                     <tr>
                                         <th>Nama Bahan</th>
                                         <!-- <th>Jumlah</th> -->
                                         <th>Satuan</th>
                                         <th>Quantity</th>
                                         <th align="right">Harga</th>
                                         <th align="center">Aksi</th>
                                         <th>Sub Total</th>
                                     </tr>
                                 </table>
                                 <div class="text-right">
                                     <h5>Total Rp.</h5>
                                 </div>
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
    </div>
@endsection
