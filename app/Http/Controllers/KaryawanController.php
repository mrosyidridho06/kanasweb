<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Riwayat;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Karyawan $karyawans)
    {
        $karyawans = Karyawan::get();
        return view('karyawan.index', compact('karyawans'));
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

        $newNameImage = date('Ymd'). '-' . $request->nama_karyawan . '.' . $request->foto->extension();

        $request->file('foto')->move('images/karyawan', $newNameImage);

        $karwan = Karyawan::create([
            'nama_karyawan' => $request->nama_karyawan,
            'alamat_karyawan' => $request->alamat_karyawan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'hp_karyawan' => $request->hp_karyawan,
            'agama' => $request->agama,
            'jabatan' => $request->jabatan,
            'tanggal_masuk' => $request->tanggal_masuk,
            'foto' => $newNameImage,
        ]);

        if($karwan){
            //redirect dengan pesan sukses
            Riwayat::create([
                'user_id' => Auth::user()->id,
                'aktivitas' => 'Membuat Data Karyawan '.$karwan->nama_karyawan.''
            ]);

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
        return view('karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_karyawan' => 'required',
            'alamat_karyawan' => 'required',
            'jenis_kelamin' => 'required',
            'hp_karyawan' => 'required',
            'agama' => 'required',
            'jabatan' => 'required',
            'foto' => 'file|mimes:jpg,png,jpeg,gif,svg,jfif|max:2048',
            'tanggal_masuk' => 'required',
        ]);

        $karyawan = Karyawan::find($id);
        $karya = $request->all();


        if ($foto = $request->file('foto')) {
            File::delete('images/karyawan/'.$karyawan->foto);
            $destinationPath = 'images/karyawan/';
            $profileImage = date('Ymd'). '-' . $request->nama_karyawan . '.' . $request->foto->extension();
            $foto->move($destinationPath, $profileImage);
            $karya['foto'] = "$profileImage";
        }else{
            unset($karya['foto']);
        }

        $karyawan->update($karya);

        if($karyawan){
            //redirect dengan pesan sukses
            Riwayat::create([
                'user_id' => Auth::user()->id,
                'aktivitas' => 'Mengubah Data Karyawan '.$karyawan->nama_karyawan.''
            ]);

            Alert::toast('Data Berhasil Diubah', 'success');
            return redirect()->route('karyawan.index');
        }else{
            //redirect dengan pesan error
            return redirect()->route('karyawan.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);
        try {
            $karyawan->delete();
            File::delete('images/karyawan/'.$karyawan->foto);
        } catch (Exception $e){
            Alert::toast('karyawan Terdapat Pada Kehadiran', 'error');
            return redirect()->back();
        }

        Riwayat::create([
            'user_id' => Auth::user()->id,
            'aktivitas' => 'Menghapus Data Karyawan '.$karyawan->nama_karyawan.''
        ]);
        Alert::toast('Data Berhasil Dihapus', 'success');
        return redirect()->back();
    }

}
