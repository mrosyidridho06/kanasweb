<?php

namespace App\Http\Controllers;

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

        // $tahun = Kehadiran::select('to_date')
        //         ->groupBy('to_date')
        //         ->get();

        $tahun = DB::table('kehadirans')->selectRaw('substr(to_date,1,4) as to_date')->pluck('to_date')->unique();

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
        $bulan= $request->get('bulangen');
        $tahun = $request->get('tahungen');

        $datakar = Karyawan::get();

        foreach($datakar as $item){
            $idkar[] = $item->id;
            $nama[] = $item->nama_karyawan;
        }

        // $nam = array_values($nama);

        // where(function($query) use($nam){
        //     foreach($nam as $keyword) {
        //         $query->orWhere('nama', 'LIKE', "%$keyword%");
        //     }
        // })
        $abs = DataAbsen::whereIn("nama", $nama)
                ->whereMonth('tanggal', '=', $bulan)
                ->whereYear('tanggal', '=', $tahun)
                ->select("nama", DB::raw('count(IF(absen = 0, 1, NULL)) as masuk'),DB::raw('count(IF(lembur = 1, 1, NULL)) as lembur'), DB::raw('count(IF(absen = 1, 1, NULL)) as izin'))
                ->groupBy("nama")
                ->get();

        // dd($abs);

        foreach($abs as $item){
            $na[] = $item->nama;
            $ma[] = $item->lembur;
            $ab[] = $item->izin;
        }
        // dd($ma);

        $namakar = Karyawan::whereIn('nama_karyawan', $na)
                    ->select('id')
                    ->groupBy('id')
                    ->get();


        foreach($namakar as $key => $item){
            $idka[] = $item['id'];
            // $kk = array_push($idka);
        }
        $ch = array_filter($idka, function($v) { return strpos($v, 'hidden') === false; });
        // $ch = explode(" ", $idka);

        // foreach($idka as $keid){
        //     array_push
        // }
        dd($ch);

        $finalArray = array();
            foreach($abs as $key=>$value){
                array_push($finalArray, array(
            'karyawan_id'=>$idka,
            'masuk'=>$value['masuk'],
            'lembur'=>$value['lembur'],
            'izin' => $value['izin'],
            ));
        }

        dd($finalArray);

        // $merged = $namakar->merge($finalArray);

        // dd($merged);
        // Kehadiran::insert($finalArray);


    }
}
