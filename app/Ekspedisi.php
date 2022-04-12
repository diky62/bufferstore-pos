<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ekspedisi extends Model
{
    //
    protected $table = "ekspedisi";
    protected $guarded = ["id"];

    public function invoice(){
    	return $this->hasMany("App\Invoice");
    }

}
