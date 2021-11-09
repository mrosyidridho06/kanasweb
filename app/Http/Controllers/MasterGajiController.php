<?php

namespace App\Http\Controllers;

use App\Models\MasterGaji;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MasterGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mgaji = MasterGaji::get();

        return view('mastergaji.index', compact('mgaji'));
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
        // dd($request);
        $request->validate([
            'harian' => 'required|numeric',
            'lembur' => 'required|numeric',
        ]);

        $mj = MasterGaji::create([
            'harian' => $request->harian,
            'lembur' => $request->lembur,
        ]);

        // dd($bah);

        // Bahan::create($bah);
        if($mj){
            //redirect dengan pesan sukses
            Alert::toast('Data Berhasil Ditambahkan', 'success');
            return redirect()->route('mastergaji.index');
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
    public function edit(MasterGaji  $mastergaji)
    {
        return view('mastergaji.edit', compact('mastergaji'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterGaji $mastergaji)
    {
        $request->validate([
            'harian' => 'required',
            'lembur' => 'required',
        ]);

        // dd($request);

        $mastergaji->update($request->all());

        if($mastergaji){
            //redirect dengan pesan sukses
            Alert::toast('Data Berhasil Diupdate', 'success');
            return redirect()->route('mastergaji.index');
        }else{
            //redirect dengan pesan error
            Alert::error('Gagal', 'Data Gagal Ditambahkan');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterGaji $mastergaji)
    {
        $mastergaji->delete();

        Alert::toast('Data Berhasil Dihapus', 'success');
        return redirect()->back();
    }
}