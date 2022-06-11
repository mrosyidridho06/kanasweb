<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Resep;
use App\Models\Riwayat;
use App\Models\ResepDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use RealRashid\SweetAlert\Facades\Alert;

class ResepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bahan = Bahan::orderBy('nama_bahan', 'asc')->get();

        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);
        // dd($cart_data);
        return view('resep.index', compact('bahan','cart_data'));
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
        $resep = new Resep();
        $resep->nama_resep = $request->input('namaresep');
        $resep->jumlah_produksi = $request->input('jumlah_produksi');
        $resep->total = $request->input('total');
        $resep->hpp = $request->input('hpp');
        $resep->jual = $request->input('jual');
        $resep->harga_jual = $request->input('harga_jual');
        $resep->save();

        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);

        // dd($cart_data);

        foreach($cart_data as $key => $item)
        {
            $subtotal = $item['qty']*$item['harga_satuan'];

            ResepDetails::create([
                'resep_id' => $resep->id,
                'bahan_id' => $item['id'],
                'qty' => $item['qty'],
                'harga' => $item['harga_satuan'],
                'subtotal' => $subtotal
            ]);
        }
        Cookie::queue(Cookie::forget('shopping_cart'));

        Riwayat::create([
            'user_id' => Auth::user()->id,
            'aktivitas' => 'Menambahkan Data Resep '.$resep->nama_resep.''
        ]);
        Alert::toast('Data Berhasil Ditambahkan', 'success');
        return redirect()->back();



        // $penjualan = new Resep();
        // $penjualan->user_id = null;
        // $penjualan->total_i = 0;
        // $penjualan->total_harga = 0;
        // $penjualan->diskon = 0;
        // $penjualan->bayar = 0;
        // $penjualan->diterima = 0;
        // $penjualan->id_user = auth()->id();
        // $penjualan->save();

        // session(['id_penjualan' => $penjualan->id_penjualan]);
        // return redirect()->route('transaksi.index');
        // // dd($request);
        // $itemuser = $request->user();
        // $itemproduk = Bahan::findOrFail($request->bahan);


        // // cek dulu apakah sudah ada shopping cart untuk user yang sedang login
        // $cart = Resep::where('user_id', $itemuser->id)
        //             ->where('nama_resep', $request->nama_resep)
        //             ->first();
        // // dd($cart);

        // if ($cart) {
        //     $itemcart = $cart;
        // } else {
        //     //nyari jumlah cart berdasarkan user yang sedang login untuk dibuat no invoice
        //     $inputancart['user_id'] = $itemuser->id;
        //     $inputancart['nama_resep'] = 'cart';
        //     $inputancart['qtysi'] = 'cart';
        //     $inputancart['na'] = 'cart';
        //     $itemcart = Resep::create($inputancart);
        // }
        // // cek dulu apakah sudah ada produk di shopping cart
        // $cekdetail = ResepDetails::where('resep_id', $itemcart->id)
        //                         ->where('bahan', $itemproduk->id)
        //                         ->first();
        // $qty = $request->qty;// diisi 1, karena kita set ordernya 1
        // $harga = $itemproduk->harga;//ambil harga produk
        // $subtotal = ($qty * $harga);
        // // diskon diambil kalo produk itu ada promo, cek materi sebelumnya
        // $inputan = $request->all();
        // $inputan['resep_id'] = $itemcart->id;
        // $inputan['bahan_id'] = $itemproduk->id;
        // $inputan['qty'] = $qty;
        // $inputan['harga'] = $harga;
        // $inputan['subtotal'] = ($harga * $qty);
        // $itemdetail = ResepDetails::create($inputan);
        // // update subtotal dan total di table cart
        // $itemdetail->cart->updatetotal($itemdetail->cart, $subtotal);
        // return redirect()->back();
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
    public function update(Request $request, Resep $resep)
    {
        $this->validate($request, [
            'nama_resep' => 'required',
            'jumlah_produksi' => 'required',
            'total' => 'required',
            'hpp' => 'required',
            'jual' => 'required',
        ]);

        $resedit = $request->all();

        // dd($resedit);

        $resep->update($resedit);

        Riwayat::create([
            'user_id' => Auth::user()->id,
            'aktivitas' => 'Mengubah Data Resep '.$resep->nama_resep.''
        ]);

        Alert::toast('Data Berhasil Diubah', 'success');
        return redirect('resepdetails');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Resep::where('id', $id)->get();
        foreach($res as $item){
            $rsb = $item->nama_resep;
        }

        Riwayat::create([
            'user_id' => Auth::user()->id,
            'aktivitas' => 'Menghapus Data Resep '.$rsb.''
        ]);

        Resep::where('id', $id)->delete();


        Alert::toast('Data Berhasil Dihapus', 'success');
        return redirect()->back();
    }

    public function cartSession(Request $request)
    {

        $bahan = $request->input('bahan');
        $qty = $request->input('qty');

        if (Cookie::get('shopping_cart')) {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
        } else {
            $cart_data = array();
        }

        $data_cart = array_column($cart_data, 'id');
        $list_bahan = $bahan;

        if (in_array($list_bahan, $data_cart)) {
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["id"] == $bahan) {
                    Alert::toast('Bahan Sudah ada ditambahkan', 'error');
                    return back();
                    // $minutes = 60;
                    // $cart_data[$keys]["qty"] = $request->input('qty');
                    // $item_data = json_encode($cart_data);
                    // return response()->json(['status' => '"' . $cart_data[$keys]["nama_bahan"] . '" Already Added to Cart', 'status2' => '2']);
                    // Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                }
            }
        } else {
            $produk = Bahan::find($bahan);
            $nama_bahan = $produk->nama_bahan;
            $satuan_bahan = $produk->satuan_bahan;
            $harga_satuan = $produk->harga_satuan;
            // $subtotal = $harga_satuan*$request->qty;

            if ($produk) {
                $item_array = array(
                    'id' => $bahan,
                    'nama_bahan' => $nama_bahan,
                    'satuan_bahan' => $satuan_bahan,
                    'qty' => $qty,
                    'harga_satuan' => $harga_satuan,
                );
                $cart_data[] = $item_array;
                $item_data = json_encode($cart_data);
                $minutes = 60;
                Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                // return response()->json(['status' => '"' . $nama_bahan . '" Added to Cart']);
                Alert::toast('Bahan ditambahkan', 'success');
                return back();
            }
        }
    }
    public function Cart()
    {
        if (Cookie::get('shopping_cart')) {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $totalcart = count($cart_data);
            return response()->json($cart_data);
        } else {
            $totalcart = "0";
            return response()->json($totalcart);
        }
    }
    public function updateToCart(Request $request)
    {

        $prod_id = $request->input('bahan');
        $quantity = $request->input('qty');

        if(Cookie::get('shopping_cart'))
        {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);

            $item_id_list = array_column($cart_data, 'id');
            $prod_id_is_there = $prod_id;

            if(in_array($prod_id_is_there, $item_id_list))
            {
                foreach($cart_data as $keys => $values)
                {
                    if($cart_data[$keys]["id"] == $prod_id)
                    {
                        $cart_data[$keys]["qty"] =  $quantity;
                        $item_data = json_encode($cart_data);
                        $minutes = 60;
                        Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                        return response()->json(['status'=>'"'.$cart_data[$keys]["nama_bahan"].'" Quantity Updated']);
                    }
                }
            }
        }
    }


    public function deleteFromCart(Request $request)
    {

        $bahan = $request->input('bahan');

        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);

        $data_cart = array_column($cart_data, 'id');
        $list_bahan = $bahan;

        if (in_array($list_bahan, $data_cart)) {
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["id"] == $bahan) {
                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
                    $minutes = 60;
                    Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    return response()->json(['status' => 'Item Removed from Cart']);
                }
            }
        }
    }

    public function clearCart()
    {
        Cookie::queue(Cookie::forget('shopping_cart'));
        return redirect()->back();
    }
}
