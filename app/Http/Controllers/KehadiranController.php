<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\DataAbsen;
use App\Models\Kehadiran;
use App\Models\MasterGaji;
use Illuminate\Http\Request;
use App\Exports\KehadiranExport;
use App\Imports\DataAbsenImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\Console\Input\Input;

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

        $tahun = DB::table('kehadirans')->selectRaw('substr(to_date,1,4) as to_date')->pluck('to_date')->unique();

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
            'dari_tanggal' => 'required|date',
            'ke_tanggal' => 'required|date|after:dari_tanggal',
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

        // $kar = Karyawan::where('id', $kehan->karyawan_id)->get();
        // foreach($kar as $itemkar){
        //     $bpjs = $itemkar->bpjs;
        //     $tun = $itemkar->tunjangan;
        // }

        // // dd($tun);

        // $mgaji = MasterGaji::get();
        // foreach($mgaji as $gj){
        //     $uangh = $gj->harian;
        //     $uangl = $gj->lembur;
        // }

        // $uanghari = $kehan->masuk*$uangh;
        // // dd($uanghari);
        // $uanglembur = $kehan->lembur*$uangl;
        // $totalgaji = $uanghari+$uanglembur+$bpjs+$tun;

        // Gaji::create([
        //     'kehadiran_id' => $kehan->id,
        //     'gaji_harian' => $uanghari,
        //     'uang_lembur' => $uanglembur,
        //     'bpjs' => $bpjs,
        //     'tunjangan' => $tun,
        //     'total_gaji' => $totalgaji
        // ]);

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
        $karyawan = Karyawan::get();
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
    public function destroy($id)
    {
        $kehadiran = Kehadiran::find($id);
        try {
            $kehadiran->delete();
        } catch (Exception $e){
            Alert::toast('Kehadiran Terdapat Pada Gaji', 'error');
            return redirect()->back();
        }

        Alert::toast('Data Berhasil Dihapus', 'success');
        return redirect()->back();
    }

    public function export(Request $request)
    {
        $bulan= $request->get('bulan');
        $tahun = $request->get('tahun');

        return Excel::download(new KehadiranExport($bulan, $tahun), 'kehadiran.csv');
    }

    public function importabsen(Request $request)
    {
        $file = $request->file('importabsen');
        $namaFile = $file->getClientOriginalName();
        $file->move('DataAbsen', $namaFile);

        Excel::import(new DataAbsenImport, public_path('/DataAbsen/'.$namaFile));

        Alert::toast('Data Berhasil Ditambah', 'success');
        return redirect()->back();
    }

    public function absengen(Request $request)
    {
        $bulan= $request->bulangen;
        $tahun = $request->tahungen;

        $datakar = Karyawan::get();

        foreach($datakar as $item){
            $idkar[$item->nama_karyawan] = $item->id;
            $nama[] = $item->nama_karyawan;
        }

        $nam = array_values($nama);

        $as = DataAbsen::whereIn("nama", $nam)
                ->whereMonth('tanggal', '=', $bulan)
                ->whereYear('tanggal', '=', $tahun)
                ->select("nama", DB::raw('min(tanggal) as tanggal_awal'), DB::raw('max(tanggal) as tanggal_akhir'), DB::raw('count(IF(absen = 0, 1, NULL)) as masuk'),DB::raw('count(IF(lembur = 1, 1, NULL)) as lembur'), DB::raw('count(IF(absen = 1, 1, NULL)) as izin'))
                ->groupBy("nama")
                ->get();

        foreach($as as $item){
            $na[] = $item->nama;
        }

        $finalArray = array();
            foreach($as as $key=>$value){
                foreach($idkar as $key => $ik){
                    if($value['nama'] == $key){
                        $idkfis = $ik;
                    }
                }
                array_push($finalArray, array(
                    'karyawan_id'=>$idkfis,
                    'masuk'=>$value['masuk'],
                    'lembur'=>$value['lembur'],
                    'izin' => $value['izin'],
                    'from_date' => $value['tanggal_awal'],
                    'to_date' => $value['tanggal_akhir'],
                    "created_at"=> Carbon::now(),
                    "updated_at"=> Carbon::now()
                )
            );
        }

        Kehadiran::insert($finalArray);

        Alert::toast('Data Berhasil Ditambah', 'success');
        return redirect()->back();
    }
}
