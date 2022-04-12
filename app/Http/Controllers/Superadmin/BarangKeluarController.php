<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\BarangKeluar;
use App\StokBarang;
use App\Invoice;
use App\Ekspedisi;
use App\Marketplace;
use App\Cart;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['barang_keluars']=Invoice::with('barang_keluar','marketplace','ekspedisi')->orderBy('created_at','desc')->get();
        // dd($data);

        return view('super_admin/barang_keluar.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = StokBarang::doesntHave('cart')->where('qty', '>', 0)->get()->sortBy('nama_barang');
        $itemCarts = StokBarang::has('cart')->get()->sortByDesc('cart.created_at');
        $ekspedisi = Ekspedisi::get();
        $ekspedisis = Ekspedisi::get();
        $marketplaces = Marketplace::get();
        // dd($items);
        return view('super_admin/barang_keluar.create', compact(['items', 'itemCarts','ekspedisis', 'marketplaces']));
        // return view('super_admin/barang_keluar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        $invoice = new Invoice;
        $invoice->fill($request["invoice"]);
        $invoice->save();

        
        $barang_keluar = new BarangKeluar;
        // $barang_keluar->invoice_id = $invoice->id;
        $carts = Cart::get();
        foreach($carts as $a => $cart){
            $barang_keluar = new BarangKeluar;
            $barang_keluar->fill(["$cart"]);
            $barang_keluar->invoice_id = $invoice->id;
            // 'created_at' => $calendar->freshTimestamp(),
            $barang_keluar->save();
        }
        // dd($qty);

        return redirect()->route('barang_keluar.index');
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

    public function getProduct($id)
    {
        $products = StokBarang::findOrFail($id);
        return response()->json($products, 200);
    }
}
