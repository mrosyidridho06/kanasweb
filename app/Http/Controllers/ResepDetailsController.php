<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Resep;
use App\Models\ResepDetails;
use Illuminate\Http\Request;

class ResepDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = Resep::with('resepdetail', 'resepdetail.bahan')->orderBy('nama_resep', 'asc')->get();

        return view('resepdetails.index', compact('details'));

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResepDetails  $resepDetails
     * @return \Illuminate\Http\Response
     */
    public function show(ResepDetails $resepDetails)
    {
        $daftar = Resep::with('resepdetail')->where('id', $resepDetails)->get();
        $bahan = ResepDetails::with('bahan')->where('bahan_id', $resepDetails)->get();

        dd($daftar);

        return view('resepdetails.show', compact('daftar', 'bahan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResepDetails  $resepDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(ResepDetails $resepDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResepDetails  $resepDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $itemdetail = ResepDetails::findOrFail($id);
        $param = $request->param;

        if ($param == 'tambah') {
            // update detail cart
            $qty = 1;
            $itemdetail->updatedetail($itemdetail, $qty, $itemdetail->harga);
            // update total cart
            $itemdetail->cart->updatetotal($itemdetail->cart, $itemdetail->harga);
            return back()->with('success', 'Item berhasil diupdate');
        }
        if ($param == 'kurang') {
            // update detail cart
            $qty = 1;
            $itemdetail->updatedetail($itemdetail, '-'.$qty, $itemdetail->harga);
            // update total cart
            $itemdetail->cart->updatetotal($itemdetail->cart, '-'.($itemdetail->harga));
            return back()->with('success', 'Item berhasil diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResepDetails  $resepDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResepDetails $resepDetails, $id)
    {
        $itemdetail = ResepDetails::findOrFail($id);
        // update total cart dulu
        $itemdetail->cart->updatetotal($itemdetail->cart, '-'.$itemdetail->subtotal);
        if ($itemdetail->delete()) {
            return back()->with('success', 'Item berhasil dihapus');
        } else {
            return back()->with('error', 'Item gagal dihapus');
        }
    }
}
