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
        //
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
        $this->validate($request, [
            'bahan_id' => 'required',
        ]);
        $itemuser = $request->user();
        $itemproduk = Bahan::findOrFail($request->produk_id);
        // cek dulu apakah sudah ada shopping cart untuk user yang sedang login
        $cart = Resep::where('user_id', $itemuser->id)
                    ->where('status_cart', 'cart')
                    ->first();

        if ($cart) {
            $itemcart = $cart;
        } else {
            //nyari jumlah cart berdasarkan user yang sedang login untuk dibuat no invoice
            $inputancart['user_id'] = $itemuser->id;
            $inputancart['status_cart'] = 'cart';
            $itemcart = Resep::create($inputancart);
        }
        // cek dulu apakah sudah ada produk di shopping cart
        $cekdetail = ResepDetails::where('cart_id', $itemcart->id)
                                ->where('produk_id', $itemproduk->id)
                                ->first();
        $qty = 1;// diisi 1, karena kita set ordernya 1
        $harga = $itemproduk->harga;//ambil harga produk
        $subtotal = ($qty * $harga);
        // diskon diambil kalo produk itu ada promo, cek materi sebelumnya
        if ($cekdetail) {
            // update detail di table cart_detail
            $cekdetail->updatedetail($cekdetail, $qty, $harga);
            // update subtotal dan total di table cart
            $cekdetail->cart->updatetotal($cekdetail->cart, $subtotal);
        } else {
            $inputan = $request->all();
            $inputan['resep_id'] = $itemcart->id;
            $inputan['bahan_id'] = $itemproduk->id;
            $inputan['qty'] = $qty;
            $inputan['harga'] = $harga;
            $inputan['subtotal'] = ($harga * $qty);
            $itemdetail = ResepDetails::create($inputan);
            // update subtotal dan total di table cart
            $itemdetail->cart->updatetotal($itemdetail->cart, $subtotal);
        }
        return redirect()->route('resep.index')->with('success', 'Produk berhasil ditambahkan ke cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResepDetails  $resepDetails
     * @return \Illuminate\Http\Response
     */
    public function show(ResepDetails $resepDetails)
    {
        //
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
