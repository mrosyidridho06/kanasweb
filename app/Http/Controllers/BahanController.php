<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Resep;
use App\Models\ResepDetails;
use App\Models\Riwayat;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class BahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {

    //     $supp = Supplier::with('bahan')->get();
    //     return view('bahan.index', compact('supp'));

    // }

    public function index()
    {
        $supp = Supplier::get();

        $bah = Bahan::with('supplier')->orderBy('nama_bahan', 'asc')->get();

        return view('bahan.index', compact('supp', 'bah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $supp = Supplier::with('bahan')->get();
        // return view('bahan.create', compact('supp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);
        $request->validate([
            'nama_bahan' => 'required',
            'supplier_id' => 'required|numeric',
            'jumlah_bahan' => 'required|numeric',
            'satuan_bahan' => 'required',
            'harga_bahan' => 'required|numeric',
        ]);

        $jumlah = $request['jumlah_bahan'];
        $harga = $request['harga_bahan'];

        $harga_satuan = $harga/$jumlah;

        // dd($harga_satuan);

        $bah = Bahan::create([
            'nama_bahan' => $request->nama_bahan,
            'supplier_id' => $request->supplier_id,
            'jumlah_bahan' => $request->jumlah_bahan,
            'satuan_bahan' => $request->satuan_bahan,
            'harga_bahan' => $request->harga_bahan,
            'harga_satuan' => $harga_satuan,
        ]);

        Riwayat::create([
            'user_id' => Auth::user()->id,
            'aktivitas' => ('Tambah Bahan'. $request->nama_bahan),
        ]);

        // dd($bah);

        // Bahan::create($bah);
        if($bah){
            //redirect dengan pesan sukses
            Alert::toast('Data Berhasil Ditambahkan', 'success');
            return redirect()->route('bahan.index');
        }else{
            //redirect dengan pesan error
            Alert::error('Gagal', 'Data Gagal Ditambahkan');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bahan  $bahan
     * @return \Illuminate\Http\Response
     */
    public function show(Bahan $bahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bahan  $bahan
     * @return \Illuminate\Http\Response
     */
    public function edit(Bahan $bahan)
    {
        $supp = Supplier::with('bahan')->get();

        return view('bahan.edit', compact('bahan', 'supp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bahan  $bahan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bahan $bahan)
    {
        $jumlah = $_POST['jumlah_bahan'];
        $harga = $_POST['harga_bahan'];

        $harga_satuan = $harga/$jumlah;

        $bahan->update([
            'nama_bahan' => $request->nama_bahan,
            'supplier_id' => $request->supplier_id,
            'jumlah_bahan' => $request->jumlah_bahan,
            'satuan_bahan' => $request->satuan_bahan,
            'harga_bahan' => $request->harga_bahan,
            'harga_satuan' => $harga_satuan,
        ]);

        $id = $bahan->id;

        $resdetail = ResepDetails::with('resep', 'bahan')->where('bahan_id', $id)->get();

        // $ct = count($resdetail);
        // dd($ct);

        // foreach($resdetail as $item){
        //     $idb = $item->bahan_id;
        // }

        if(count($resdetail) == 1 ){
            foreach($resdetail as $item){
                $idres = $item->resep_id;
                $qty = $item->qty;
            }

            $hrgsub = $harga_satuan*$qty;

            ResepDetails::with('resep', 'bahan')->where('bahan_id', $id)->update([
                'harga' => $harga_satuan,
                'subtotal' => $hrgsub,
            ]);

            $sumtotal = ResepDetails::with('resep', 'bahan')->where('resep_id', $idres)->select('subtotal')->sum('subtotal');

            $resep = Resep::where('id', $idres)->get();

            foreach($resep as $item){
                $jmlhproduksi = $item->jumlah_produksi;
                $jual = $item->jual;
            }

            $hpp =$sumtotal/$jmlhproduksi;
            $hargajual = $hpp*$jual;

            // dd($hpp);

            Resep::where('id', $idres)->update([
                'total' => $sumtotal,
                'hpp' => $hpp,
                'harga_jual' => $hargajual,

            ]);

            Riwayat::create([
                'user_id' => Auth::user()->id,
                'aktivitas' => 'Mengubah bahan '.$bahan->nama_bahan.''
            ]);
        }else{
            Riwayat::create([
                'user_id' => Auth::user()->id,
                'aktivitas' => 'Mengubah bahan '.$bahan->nama_bahan.''
            ]);
        };


        if($bahan){
            //redirect dengan pesan sukses
            Alert::toast('Data Berhasil Diubah', 'success');
            return redirect()->route('bahan.index');
        }else{
            //redirect dengan pesan error
            Alert::error('Gagal', 'Data Gagal Ditambahkan');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bahan  $bahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bahan $bahan)
    {

        $bahan->delete();

        Riwayat::create([
            'user_id' => Auth::user()->id,
            'aktivitas' => ('Menghapus Bahan'.''.$bahan->nama_bahan),
        ]);

        Alert::toast('Data Berhasil Dihapus', 'success');
        return redirect()->back();
    }
}
