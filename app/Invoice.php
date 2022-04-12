<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Marketplace;
use App\Ekspedisi;
use App\BarangKeluar as Detail;


class Invoice extends Model
{
    protected $table = "invoice";
    protected $guarded = ["id"];

    public function marketplace() {
    	return $this->belongsTo(Marketplace::class);
    }
    public function ekspedisi() {
    	return $this->belongsTo(Ekspedisi::class);
    }
    public function barang_keluar(){
        return $this->hasMany(BarangKeluar::class);
        
    }
    public function details() {
        return $this->hasMany(Detail::class);
    }
    public function user() {
        return $this->belongsTo(Users::class);
    }

}
