<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cart;
use App\Invoice;
use App\BarangKeluar;

class StokBarang extends Model
{
   	protected $table = "stok_barang";
    protected $guarded = ["id"];


    public function kategori(){
    	return $this->belongsTo('App\KategoriBarang');
    }

    public function barang_masuk(){
        return $this->hasMany('App\BarnagMasuk');
    }
    public function barang_keluar(){
        return $this->hasMany('App\BarangKeluar');
    }
    public function cart() {
    	return $this->hasOne(Cart::class);
    }
    public function transactions() {
        return $this->hasManyThrough(Invoice::class, BarangKeluar::class);
    }
}


