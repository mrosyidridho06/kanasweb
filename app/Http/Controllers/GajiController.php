<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Gaji;
use App\Models\Riwayat;
use App\Models\Kehadiran;
use App\Models\MasterGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Gaji $gaji)
    {
        $month = $request->get('bulan');
        $year = $request->get('tahun');

        // $gaji = Gaji::with('kehadiran', 'kehadiran.karyawan')->get();
        // dd($gaji);

        // $gaji = $gaji->newQuery();

        // if ($request->has('bulan') && $request->has('tahun')) {
        //     $gaji = Gaji::with('kehadiran', 'kehadiran.karyawan')
        //         ->whereMonth('to_date', '=', $month)
        //         ->whereYear('to_date', '=', $year)
        //         ->get();
        //     // dd($gaji);
        //     }
        // $filter = $gaji->get();

        // dd($filter);


        $filter = DB::table('gajis')
                ->join('kehadirans', 'gajis.kehadiran_id', '=', 'kehadirans.id')
                ->join('karyawans', 'kehadirans.karyawan_id', '=', 'karyawans.id')
                ->whereMonth('to_date', '=', $month)
                ->whereYear('to_date', '=', $year)
                ->select('gajis.*','kehadirans.from_date', 'kehadirans.masuk', 'kehadirans.lembur', 'karyawans.nama_karyawan', 'karyawans.jabatan')
                ->get();

        $dataTahun = DB::table('kehadirans')->selectRaw('substr(to_date,1,4) as to_date')->pluck('to_date')->unique();

        return view('gaji.index', compact('filter', 'dataTahun'));
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

        $dataTahun = DB::table('kehadirans')->selectRaw('substr(to_date,1,4) as to_date')->pluck('to_date')->unique();

        // dd($dataTahun);

        $month = $request->get('bulan');
        $year = $request->get('tahun');

        $filter = Kehadiran::with('karyawan')
                ->whereMonth('to_date', '=', $month)
                ->whereYear('to_date', '=', $year)
                ->get();


        return view('gaji.create', compact('filter', 'mgaji', 'karya', 'dataTahun'));
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
            'id_kehadiran' => 'required|numeric|unique:kehadirans,id',
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
            'kehadiran_id' => $request->id_kehadiran,
            'uang_lembur' => $lembur,
            'bonus' => $request->bonus,
            'bpjs' => $request->bpjs,
            'potongan' => $request->potongan,
            'gaji_harian' => $upah_harian,
            'total_gaji' => $total_gaji,
        ]);

        Riwayat::create([
            'user_id' => Auth::user()->id,
            'aktivitas' => ('Menambah data gaji'.''.$gaji->kehadiran_id),
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
        $gajis = Gaji::with('kehadiran', 'kehadiran.karyawan')->where('id', $id)->get();

        return view('gaji.show', compact('gajis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Gaji $gaji)
    {
        $mgaji = MasterGaji::get();

        $kehadiran = Kehadiran::with('karyawan')->get();

        return view('gaji.edit', compact('gaji', 'kehadiran', 'mgaji'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gaji $gaji)
    {

        $upah_harian = $request['uang_harian']*$request['masuk'];
        $uang_lembur = $request['lembur']*$request['uang_lembur'];

        $total_gaji = $uang_lembur+$upah_harian+$request['bonus']+$request['tunjangan']+$request['bpjs']-$request['potongan'];

        // dd($uang_lembur);

        $gaji->update([
            'uang_lembur' => $uang_lembur,
            'bonus' => $request->bonus,
            'bpjs' => $request->bpjs,
            'potongan' => $request->potongan,
            'gaji_harian' => $upah_harian,
            'total_gaji' => $total_gaji,
            'kehadiran_id' => $request->kehadiran_id,
        ]);

        if($gaji){
            //redirect dengan pesan sukses
            Alert::toast('Data Berhasil Diubah', 'success');
            return redirect()->route('gaji.index');
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
    public function destroy(Gaji $gaji)
    {
        $gaji->delete();

        Alert::toast('Data Berhasil Dihapus', 'success');
        return redirect()->back();
    }

    public function exportPDF($id)
    {
        $gajis = Gaji::with('kehadiran')->where('id', $id)->get();

        // $gajis = Gaji::with('kehadiran')->findOrFail($gaji);

        // $path = public_path('kanas.png');
        // $type = pathinfo($path, PATHINFO_EXTENSION);
        // $data = file_get_contents($path);
        // $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);

        // $pdf = PDF::setOptions([
        //     'defaultFont' => 'dejavu serif',
        //     ])
        //     ->setPaper('a4', 'portrait')
        //     ->loadView('gaji.gajipdf', compact('gajis'));
        // $filename = 'tes' ;
        // return $pdf->stream($filename.'.pdf');
        // $pdf = PDF::loadView('gaji.gajipdf', compact('gajis'));
        // // $pdf->loadView('gaji.gajipdf', compact('gajis'));
        // return $pdf->download('gaji.pdf');
    }
}
