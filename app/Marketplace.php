<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marketplace extends Model
{
    protected $table = "marketplace";
    protected $guarded = ["id"];

    public function invoice(){
    	return $this->hasMany("App\Invoice");
    }
}
