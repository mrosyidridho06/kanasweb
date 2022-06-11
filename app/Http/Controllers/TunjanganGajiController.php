<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Models\TunjanganGaji;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TunjanganGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tungaji = Karyawan::get();

        return view('tunjangangaji.index', compact('tungaji'));
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
        Karyawan::updateOrCreate([
            'tunjangan' => $request->tunjangan,
            'bpjs' => $request->bpjs
        ]);

        return response()->json(['success'=>'Tunjangan saved successfully!']);
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
        $tunjangan = TunjanganGaji::find($id);

        return $tunjangan;
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
        $request->validate([
            // 'id_karyawan' => 'required',
            'tunjangan' => 'required',
            'bpjs' => 'required',
        ]);

        $tunga = TunjanganGaji::findOrFail($id);

        $tunga->tunjangan = $request->tunjangan;
        $tunga->bpjs = $request->bpjs;
        // $tunga->id_karyawan = $request->id_karyawan;
        $tunga->save();

        Alert::toast('Data Berhasil Diupdate', 'success');
        return redirect()->route('tunjangangaji.index');
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
