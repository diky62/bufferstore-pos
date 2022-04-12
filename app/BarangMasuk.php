<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = "barang_masuk";
    protected $guarded = ["id"];

    public function stok_barang(){
    	return $this->belongsTo('App\StokBarang');
    }
}
