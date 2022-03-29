<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Resep;
use App\Models\ResepDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ResepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bahan = Bahan::get();

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
        $this->validate($request, [
            'nama_resep' => 'required'
        ]);

        $resep = Resep::create([
            'nama_resep' => $request->nama_resep
        ]);



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
                    $cart_data[$keys]["qty"] = $request->input('qty');
                    $item_data = json_encode($cart_data);
                    $minutes = 60;
                    Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    // return response()->json(['status' => '"' . $cart_data[$keys]["nama_produk"] . '" Already Added to Cart', 'status2' => '2']);
                    return back();
                }
            }
        } else {
            $produk = Bahan::find($bahan);
            $nama_bahan = $produk->nama_bahan;
            $satuan_bahan = $produk->satuan_bahan;
            $harga_satuan = $produk->harga_satuan;
            $subtotal = $harga_satuan*$request->qty;

            if ($produk) {
                $item_array = array(
                    'id' => $bahan,
                    'nama_bahan' => $nama_bahan,
                    'satuan_bahan' => $satuan_bahan,
                    'qty' => $qty,
                    'harga_satuan' => $harga_satuan,
                    'subtotal' => $subtotal
                );
                $cart_data[] = $item_array;

                $item_data = json_encode($cart_data);
                $minutes = 60;
                Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                // return response()->json(['status' => '"' . $nama_bahan . '" Added to Cart']);
                return back();
            }else{
                echo '<script>alert("Item Already Added")</script>';
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

        $bahan = $request->input('bahan');
        $qty = $request->input('qty');

        if (Cookie::get('shopping_cart')) {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);

            $data_cart = array_column($cart_data, 'item_id');
            $list_bahan = $bahan;

            if (in_array($list_bahan, $data_cart)) {
                foreach ($cart_data as $keys => $values) {
                    if ($cart_data[$keys]["item_id"] == $bahan) {
                        $cart_data[$keys]["qty"] =  $qty;
                        $item_data = json_encode($cart_data);
                        $minutes = 60;
                        Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                        return response()->json(['status' => '"' . $cart_data[$keys]["nama_produk"] . '" qty Updated']);
                    }
                }
            }
        }
    }
    

    public function deleteFromCart($id)
    {

        $bahan = $id;

        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);

        $data_cart = array_column($cart_data, 'id');
        $list_bahan = $bahan;

        if (in_array($list_bahan, $data_cart)) {
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["item_id"] == $bahan) {
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
