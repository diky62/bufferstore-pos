<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StokBarang;
use App\KategoriBarang;


class StokBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['stok_barangs']=StokBarang::with('kategori')->orderBy('qty','asc')->get();
        // dd($data);
        return view('super_admin/stok_barang.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['kode'] = StokBarang::max('id');
        // $kode_baru = $kode;
        $data['kategoris']=KategoriBarang::get();
        // dd($kode_baru);
        
        return view('super_admin/stok_barang.create',$data);
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
         $data['stok_barang']=StokBarang::create([
            'kategori_id' => $request['kategori'],
            'kode_barang' => $request['kode_barang'],
            'nama_barang' => $request['nama_barang'],
            'harga_beli' => $request['harga_beli'],
            'harga_jual' => $request['harga_jual'],
            'qty' => $request['qty'],
            
        ]);
        // dd($data);


        return redirect()-> route('stok_barang.index')->with(['success' => 'Data Berhasil Ditambahkan!']);
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
        $data['stok_barang'] = StokBarang::find($id);
        $data['kategoris'] = KategoriBarang::get();
        // dd($data);
        return view('super_admin/stok_barang.edit',$data);
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
        $data = StokBarang::find($id);
        $data->fill($request->all());
        $data->update();

       return redirect('stok_barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = StokBarang::find($id)->delete();
        return response()->json($data);
    }
}
