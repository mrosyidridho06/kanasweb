<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Bahan;
use App\Models\Resep;
use App\Models\Riwayat;
use App\Models\ResepDetails;
use Illuminate\Http\Request;
use App\Imports\ResepDetailsImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class ResepDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = Resep::with('resepdetail', 'resepdetail.bahan')->orderBy('nama_resep', 'asc')->get();

        return view('resepdetails.index', compact('details'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResepDetails  $resepDetails
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $daftar = Resep::with( 'resepdetail', 'resepdetail.bahan', 'resepdetail.bahan.supplier')->where('id', $id)->get();

        return view('resepdetails.show', compact('daftar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResepDetails  $resepDetails
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $daftar = Resep::with( 'resepdetail', 'resepdetail.bahan', 'resepdetail.bahan.supplier')->where('id', $id)->get();

        $bahan = Bahan::with('supplier')->orderBy('nama_bahan', 'asc')->get();

        return view('resepdetails.edit', compact('daftar', 'bahan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResepDetails  $resepDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $qty = $request->qtyres;
        $hrgsatuan = $request->hargasatuan;
        $idresep = $request->input('idresep');


        // dd($hrgsatuan);

        // dd($sub);
        $produk = ResepDetails::where('id',$id)->get();
        foreach($produk as $item){
            $qtydetails = $item->qty;
            // dd($qtydetails);
        }

        $tambah = $qty-$qtydetails;
        $sub = $tambah*$hrgsatuan;

        $subt = $qty*$hrgsatuan;

        $kurangin = $qtydetails-$qty;
        // dd($kurangin);
        $subtot = $kurangin*$hrgsatuan;

        if($qty>$qtydetails){
            Resep::where('id',$idresep)->increment('total', $sub);
        }else{
            Resep::where('id',$idresep)->decrement('total', $subtot);
        }

        $upres = ResepDetails::where('id',$id)->update([
            'qty' => $qty,
            'subtotal' => $subt
        ]);

        if($upres){
            //redirect dengan pesan sukses
            $res = Resep::where('id',$idresep)->get();
            Riwayat::create([
                'user_id' => Auth::user()->id,
                'aktivitas' => 'Mengubah Bahan Pada Resep '.$res->nama->resep.' QTY '.$upres->qty.' Subtotal '.$upres->subtotal.''
            ]);

            Alert::toast('Data Berhasil Ditambahkan', 'success');
            return redirect()->back();
        }else{
            //redirect dengan pesan error
            Alert::error('Gagal', 'Data Gagal Ditambahkan');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResepDetails  $resepDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $idresep = $request->input('idresep');

        $res = ResepDetails::with('bahan', 'resep')->where('id', $id)->get();
        foreach($res as $item){
            $sub = $item->subtotal;
            $bah = $item->bahan->nama_bahan;
            // dd($sub);
        }

        Resep::where($idresep)->decrement('total', $sub);

        $resp = Resep::where($idresep)->get();
        foreach($resp as $item){
            $rsb = $item->nama_resep;
            // dd($sub);
        }
        Riwayat::create([
            'user_id' => Auth::user()->id,
            'aktivitas' => 'Menghapus Bahan '.$bah.' Pada Resep '.$rsb.''
        ]);

        ResepDetails::where('id', $id)->delete();

        Alert::toast('Data Berhasil Dihapus', 'success');
        return redirect()->back();
    }

    public function tambaheditresep(Request $request)
    {
        // $daftar = Resep::with( 'resepdetail', 'resepdetail.bahan', 'resepdetail.bahan.supplier')->where('id', $id)->get();

        $this->validate($request, [
            'bahan' => 'required|unique:resep_details,resep_id,bahan_id,id',
            'qty' => 'required',
            'idresep' => 'required'
        ]);

        $bahan = $request->input('bahan');
        $qty = $request->input('qty');
        $idresep = $request->input('idresep');


        $produk = Bahan::find($bahan);
        $harga_satuan = $produk->harga_satuan;

        $harga = $qty*$harga_satuan;

        $resep = ResepDetails::create([
            'bahan_id' => $bahan,
            'qty' => $qty,
            'resep_id' => $idresep,
            'harga' => $harga_satuan,
            'subtotal' => $harga,
        ]);

        Resep::where('id',$idresep)->increment('total', $harga);

        if($resep){
            //redirect dengan pesan sukses
            $res = Resep::where('id', $idresep)->get();
            foreach($res as $item){
                $rsb = $item->nama_resep;
            }

            Riwayat::create([
                'user_id' => Auth::user()->id,
                'aktivitas' => 'Menambahkan Bahan '.$resep->bahan->nama_bahan.' Pada Resep '.$rsb.' QTY '.$resep->qty.' Subtotal '.$resep->subtotal.''
            ]);

            Alert::toast('Data Berhasil Ditambahkan', 'success');
            return redirect()->back();
        }else{
            //redirect dengan pesan error
            Alert::error('Gagal', 'Data Gagal Ditambahkan');
            return redirect()->back();
        }
    }

    public function import(Request $request)
    {
        $file = $request->file('resepdetail');
        $namaFile = $file->getClientOriginalName();
        $file->move('DataResepDetails', $namaFile);

        Excel::import(new ResepDetailsImport, public_path('/DataResepDetails/'.$namaFile));

        Alert::toast('Data Berhasil Ditambah', 'success');
        return redirect()->back();
    }
}
