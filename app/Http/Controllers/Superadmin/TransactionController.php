<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Invoice;
use App\Cart;
use App\BarangKeluar;
use App\StokBarang;

class TransactionController extends Controller
{


    public function store(Request $request)
    {
        // dd($request);
    	$invoice = new Invoice;
        $invoice->fill($request["invoice"]);
        $invoice->save();

        $input = $request->all();

        for ($i = 0; $i < count($request->stok_barang_id); $i++) {
            $answers[] = [
                'invoice_id' => $invoice->id,   
                'stok_barang_id' => $request->stok_barang_id[$i],
                'qty' => $request->qty[$i],
                'created_at' => $request->tgl[$i]
            ];
        $stok = StokBarang::findOrFail($request->stok_barang_id[$i]);
        $stok->qty -= $request->qty[$i];
        $stok->save();
        }
        BarangKeluar::insert($answers);

        // $stok = StokBarang::findOrFail($request->stok_barang_id[$i]);
        // $stok->qty -= $request->qty[$i]
        // $stok->save();

        // dd($answers);

          DB::table('carts')->delete();


        
    	return redirect()->route('barang_keluar.index');
    }
}
