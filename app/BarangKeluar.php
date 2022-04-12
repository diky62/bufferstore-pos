<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Invoice;
use App\StokBarang;

class BarangKeluar extends Model
{
    protected $table = "barang_keluar";
    protected $guarded = ["id"];

    public function stok_barang() {
    	return $this->belongsTo(StokBarang::class);
    }
    public function invoice() {
    	return $this->belongsTo(Invoice::class);
    }
}
