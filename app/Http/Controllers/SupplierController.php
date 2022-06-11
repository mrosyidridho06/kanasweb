<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Exports\SupplierExport;
use App\Imports\SupplierImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::get();
        return view('supplier.supplier', compact('supplier'));
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
            'nama_supplier' => 'required',
            'alamat_supplier' => 'required',
            'hp_supplier' => 'required|min:10',
        ]);

        $supli = Supplier::create([
            'nama_supplier' => $request->nama_supplier,
            'alamat_supplier' => $request->alamat_supplier,
            'hp_supplier' => $request->hp_supplier,
        ]);


        if($supli){
            //redirect dengan pesan sukses
            Riwayat::create([
                'user_id' => Auth::user()->id,
                'aktivitas' => ('Menambah Supplier '.$supli->nama_supplier.''),
            ]);
            Alert::toast('Data Berhasil Ditambahkan', 'success');
            return redirect()->back();
        }else{
            //redirect dengan pesan error
            Alert::toast('Gagal', 'Data Gagal Ditambahkan');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $Supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $Supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $Supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nama_supplier' => 'required',
            'alamat_supplier' => 'required',
            'hp_supplier' => 'required|min:10',
        ]);

        $supplier->update([
            'nama_supplier' => $request->nama_supplier,
            'alamat_supplier' => $request->alamat_supplier,
            'hp_supplier' => $request->hp_supplier,

        ]);


        if($supplier){
            //redirect dengan pesan sukses
            Riwayat::create([
                'user_id' => Auth::user()->id,
                'aktivitas' => ('Mengubah Supplier '.$supplier->nama_supplier.''),
            ]);
            Alert::toast('Data Berhasil Diupdate', 'success');
            return redirect()->route('supplier.index');
        }else{
            //redirect dengan pesan error
            Alert::error('Gagal', 'Data Gagal Ditambahkan');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $Supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        Riwayat::create([
            'user_id' => Auth::user()->id,
            'aktivitas' => 'Menghapus Data Supplier '.$supplier->nama_supplier.''
        ]);
        Alert::toast('Data Berhasil Dihapus', 'success');
        return redirect()->back();
    }

    public function export()
    {
        return Excel::download(new SupplierExport, 'supplier.xlsx');
    }

    public function import(Request $request)
    {
        $file = $request->file('supplier');
        $namaFile = $file->getClientOriginalName();
        $file->move('DataSupplier', $namaFile);

        Excel::import(new SupplierImport, public_path('/DataSupplier/'.$namaFile));

        Alert::toast('Data Berhasil Ditambah', 'success');
        return redirect()->back();
    }
}
