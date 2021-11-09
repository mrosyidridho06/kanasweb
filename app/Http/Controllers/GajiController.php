<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\Kehadiran;
use App\Models\MasterGaji;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $month = $request->get('bulan');
        $year = $request->get('tahun');

        $filter = Gaji::with('karyawan')
                ->whereMonth('created_at', '=', $month)
                ->whereYear('created_at', '=', $year)
                ->get();

        return view('gaji.index', compact('filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $mgaji = MasterGaji::get();


        $karyawan = $request->get('nama_karyawan');


        $karya = Kehadiran::with('karyawan')
        ->where('id', '=', $karyawan)
        ->get();

        // dd($karya);

        $month = $request->get('bulan');
        $year = $request->get('tahun');

        $filter = Kehadiran::with('karyawan')
                ->whereMonth('from_date', '=', $month)
                ->whereYear('from_date', '=', $year)
                ->get();

        return view('gaji.create', compact('filter', 'mgaji', 'karya'));
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
            'id_karyawan' => 'required|numeric',
            'masuk' => 'required|numeric',
            'lembur' => 'required|numeric',
            'uang_lembur' => 'required|numeric',
            'uang_harian' => 'required|numeric',
            'bpjs' => 'required|numeric',
            'bonus' => 'required|numeric',
            'tunjangan' => 'required|numeric',
            'potongan' => 'required|numeric',
        ]);

        $upah_harian = $request['uang_harian']*$request['masuk'];
        $lembur = $request['lembur']*$request['uang_lembur'];

        $total_gaji = $lembur+$upah_harian+$request['bonus']+$request['tunjangan']+$request['bpjs']-$request['potongan'];

        // dd($total_gaji);

        $gaji = Gaji::create([
            'karyawan_id' => $request->id_karyawan,
            'uang_lembur' => $lembur,
            'bonus' => $request->bonus,
            'potongan' => $request->potongan,
            'gaji_harian' => $upah_harian,
            'total_gaji' => $total_gaji,
        ]);

        // dd($bah);

        // Bahan::create($bah);
        if($gaji){
            //redirect dengan pesan sukses
            Alert::toast('Data Berhasil Ditambahkan', 'success');
            return redirect()->route('gaji.index');
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
