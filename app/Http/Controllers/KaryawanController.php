<?php

namespace App\Http\Controllers;

use App\DataTables\KaryawanDataTable;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KaryawanDataTable $dataTable)
    {
        return $dataTable->render('karyawan.karyawan');
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
        $this->validate($request, [
            'nama_karyawan' => 'required',
            'alamat_karyawan' => 'required',
            'jenis_kelamin' => 'required',
            'hp_karyawan' => 'required',
            'agama' => 'required',
            'jabatan' => 'required',
            'tanggal_masuk' => 'required',
            'foto' => 'required|file|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $newNameImage = time(). '-' . $request->nama_karyawan . '.' . $request->foto->extension();

        $request->file('foto')->move(public_path('images'), $newNameImage);

        $karwan = Karyawan::create([
            'nama_karyawan' => $request->nama_karyawan,
            'alamat_karyawan' => $request->alamat_karyawan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'hp_karyawan' => $request->hp_karyawan,
            'agama' => $request->agama,
            'jabatan' => $request->jabatan,
            'tanggal' => $request->tanggal_masuk,
            'foto' => $newNameImage,
        ]);

        if($karwan){
            //redirect dengan pesan sukses
            Alert::toast('Data Berhasil Ditambahkan', 'success');
            return redirect()->route('karyawan.index');
        }else{
            //redirect dengan pesan error
            return redirect()->route('karyawan.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(Karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Karyawan $karyawan)
    {
        $karya = Karyawan::find($karyawan);

        return view('karyawan.delete', compact('karyawan'));
    }
}
