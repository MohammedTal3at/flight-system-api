<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table='companies';

    public function trips()	
    {
    	return $this->hasMany('App\Trip','company_id');
    }
}
