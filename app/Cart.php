<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StokBarang;

class Cart extends Model
{
    protected $table = "carts";
    protected $guarded = ["id"];

    public function item() {
    	return $this->belongsTo(StokBarang::class);
    }
}
