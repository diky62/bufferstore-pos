<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    protected $table = "kategori_barang";
    protected $guarded = ["id"];

    public function stok_barang(){
    	return $this->hasMany("App\StokBarang");
    }
}
