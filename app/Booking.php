<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function user()	
    {
    	return $this->belongsTo('App\User','user_id');
    }

    public function admin()	
    {
    	return $this->belongsTo('App\User','confirmed_by');
    }
}
