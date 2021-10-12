<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karya = Karyawan::with('kehadiran')->get();

        $keha = Kehadiran::get();

        return view('kehadiran.index', compact('karya', 'keha'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'karyawan_id' => 'required|numeric',
            'tanggal' => 'required',
            'masuk' => 'required|numeric',
            'izin' => 'required|numeric',
            'lembur' => 'required|numeric',
        ]);

        // $bah = Supplier::create([
        //     'nama_bahan' => $request->nama_bahan,
        //     'supplier_id' => Supplier::findOrFail($request['nama_supplier']),
        //     'jumlah_bahan' => $request->jumlah_bahan,
        //     'satuan' => $request->satuan,
        //     'harga_bahan' => $request->harga_bahan,
        // ]);

        // dd($bah);

        Kehadiran::create($bah);
        if($bah){
            //redirect dengan pesan sukses
            Alert::toast('Data Berhasil Ditambahkan', 'success');
            return redirect()->route('kehadiran.index');
        }else{
            //redirect dengan pesan error
            Alert::error('Gagal', 'Data Gagal Ditambahkan');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
