<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use App\Exports\KehadiranExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $karyawan = Karyawan::get();

        $tahun = Kehadiran::select('to_date')
                ->groupBy('to_date')
                ->get();

        // dd($tahun);
        // $tes = Kehadiran::addSelect(['ke' => Kehadiran::select('to_date')])->get();

        // dd($tes);

        $month = $request->get('bulan');
        $year = $request->get('tahun');

        $filter = Kehadiran::with('karyawan')
                ->whereMonth('to_date', '=', $month)
                ->whereYear('to_date', '=', $year)
                ->get();

        return view('kehadiran.index', compact('karyawan', 'filter', 'tahun'));
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
            'dari_tanggal' => 'required',
            'ke_tanggal' => 'required',
            'masuk' => 'required',
            'izin' => 'required',
            'lembur' => 'required',
        ]);

        $kehan = Kehadiran::create([
            'karyawan_id' => $request->nama_karyawan,
            'from_date' => $request->dari_tanggal,
            'to_date' => $request->ke_tanggal,
            'masuk' => $request->masuk,
            'izin' => $request->izin,
            'lembur' => $request->lembur,
        ]);

        if($kehan){
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
    public function edit(Kehadiran $kehadiran)
    {
        // $gaji = Kehadiran::with('karyawan')->get();

        // dd($gaji);
        $karyawan = Karyawan::get();

        // dd($karyawan);

        return view('kehadiran.edit', compact('kehadiran', 'karyawan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kehadiran $kehadiran)
    {
        $request->validate([
            'karyawan_id' => 'required',
            'masuk' => 'required',
            'izin' => 'required',
            'lembur' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
        ]);

        $kehadiran->update($request->all());

        // dd($request);

        if($kehadiran){
            //redirect dengan pesan sukses
            Alert::toast('Data Berhasil Diupdate', 'success');
            return redirect()->route('kehadiran.index');
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
    public function destroy(Kehadiran $kehadiran)
    {
        $kehadiran->delete();

        Alert::toast('Data Berhasil Dihapus', 'success');
        return redirect()->back();
    }

    public function export(Request $request)
    {
        $bulan= $request->get('bulan');
        $tahun = $request->get('tahun');

        return Excel::download(new KehadiranExport($bulan, $tahun), 'kehadiran.csv');
    }
}
