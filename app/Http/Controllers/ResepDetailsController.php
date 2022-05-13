<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Bahan;
use App\Models\Resep;
use App\Models\ResepDetails;
use Illuminate\Http\Request;
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

        $bahan = Bahan::with('supplier')->get();

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

        $res = ResepDetails::where('id', $id)->get();
        foreach($res as $item){
            $sub = $item->subtotal;
            // dd($sub);
        }
        Resep::where($idresep)->decrement('total', $sub);

        ResepDetails::where('id', $id)->delete();

        Alert::toast('Data Berhasil Dihapus', 'success');
        return redirect()->back();
    }

    // public function exportresep($id)
    // {
    //     $daftar = Resep::with( 'resepdetail', 'resepdetail.bahan',)->where('id', $id)->get();

    //     // $gajis = Gaji::with('kehadiran')->findOrFail($gaji);

    //     // $path = public_path('kanas.png');
    //     // $type = pathinfo($path, PATHINFO_EXTENSION);
    //     // $data = file_get_contents($path);
    //     // $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);

    //     $pdf = PDF::setOptions([
    //         'defaultFont' => 'dejavu serif',
    //         ])
    //         ->setPaper('a4', 'portrait')
    //         ->loadView('resepdetails.down', compact('daftar'));
    //     $filename = 'tes' ;
    //     return $pdf->stream($filename.'.pdf');
    //     // $pdf = PDF::loadView('gaji.gajipdf', compact('gajis'));
    //     // // $pdf->loadView('gaji.gajipdf', compact('gajis'));
    //     // return $pdf->download('gaji.pdf');
    // }

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
            Alert::toast('Data Berhasil Ditambahkan', 'success');
            return redirect()->back();
        }else{
            //redirect dengan pesan error
            Alert::error('Gagal', 'Data Gagal Ditambahkan');
            return redirect()->back();
        }
    }
}
