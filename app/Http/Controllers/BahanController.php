<?php

namespace App\Http\Controllers;

use App\DataTables\BahanDataTable;
use App\Models\Bahan;
use App\Models\Supplier;
use Illuminate\Http\Request;
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
        $supp = Supplier::with('bahan')->get();

        $bah = Bahan::get();

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
        $bah = $request->validate([
            'nama_bahan' => 'required',
            'supplier_id' => 'required|numeric',
            'jumlah_bahan' => 'required|numeric',
            'satuan_bahan' => 'required',
            'harga_bahan' => 'required|numeric',
        ]);

        // $bah = Supplier::create([
        //     'nama_bahan' => $request->nama_bahan,
        //     'supplier_id' => Supplier::findOrFail($request['nama_supplier']),
        //     'jumlah_bahan' => $request->jumlah_bahan,
        //     'satuan' => $request->satuan,
        //     'harga_bahan' => $request->harga_bahan,
        // ]);

        // dd($bah);

        Bahan::create($bah);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bahan  $bahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bahan $bahan)
    {
        //
    }
}
