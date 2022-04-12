<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\StokBarang;
use App\Invoice;
use App\BarangKeluar;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tgl=date('m');
        $data['users'] = User::count();
        $data['kosongs'] = StokBarang::where('qty', '<=', 10)->count();
        $data['keluars'] = BarangKeluar::with('stok_barang')->whereMonth('created_at',$tgl)->get();
        $data['transaksi'] = Invoice::whereMonth('created_at',$tgl)->count();
        // $beli = BarangKeluar::w('active', 1)->sum('gaji');
        // foreach ($keluars as $key => $keluar) {
        //        $beli = ;  
        // }   
        // dd($keluar);
        return view('super_admin/home.index',$data);
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
