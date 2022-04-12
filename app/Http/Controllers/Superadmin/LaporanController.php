<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BarangKeluar;
use App\StokBarang;
use App\Invoice;
use App\Ekspedisi;
use App\Marketplace;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ekspedisis = Ekspedisi::get();
        $marketplaces = Marketplace::get();
        return view('super_admin/laporan.index', compact(['ekspedisis', 'marketplaces']));
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
    public function show(Request $request)
    {   
        $awal = $request['tgl_awal'];
        $akhir = $request['tgl_akhir'];
        $marketplace = $request['marketplace'];
        $ekspedisi = $request['ekspedisi'];
        // dd($ekspedisi);
        $data['barang_keluars']=Invoice::with('barang_keluar','marketplace','ekspedisi')->whereBetween('tanggal',[$awal, $akhir])->orWhere('ekspedisi_id',$ekspedisi)->orWhere('marketplace_id',$marketplace) ->get();
        // dd($data);

        return view('super_admin/laporan.show',$data);
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
