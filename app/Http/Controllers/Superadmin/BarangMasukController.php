<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BarangMasuk;
use App\StokBarang;


class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['barang_masuks']=BarangMasuk::with('stok_barang')->get();
        // dd($data);
        return view('super_admin/barang_masuk.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['barangs']=StokBarang::get();
        // dd($data);
        return view('super_admin/barang_masuk.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['barang_masuk']=BarangMasuk::create([
            'stok_barang_id' => $request['nama_barang'],
            'tanggal' => $request['tanggal'],
            'qty' => $request['qty'],
            
        ]);
        $stok = StokBarang::findOrFail($request->nama_barang);
        $stok->qty += $request->qty;
        $stok->save();
        // dd($stok);


        return redirect()-> route('barang_masuk.index')->with(['success' => 'Data Berhasil Ditambahkan!']);
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
        $data['barang_masuk'] = BarangMasuk::find($id);
        $data['barangs'] = StokBarang::get();
        // dd($data);
        return view('super_admin/barang_masuk.edit',$data);
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
        $data = BarangMasuk::find($id);
        $data->fill($request->all());
        $data->update();

       return redirect('barang_masuk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = BarangMasuk::find($id)->delete();
        return response()->json($data);
    }
}
