<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
	protected $fillable = [
		'city', 'country'
	];
    public function tripsAsFrom()
    {
    	return $this->hasMany('App\Trip','from_place_id');
    }

    public function tripsAsTo()
    {
    	return $this->hasMany('App\Trip','to_place_id');
    }
}
