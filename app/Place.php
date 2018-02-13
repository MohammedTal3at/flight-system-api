<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Place
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Trip[] $tripsAsFrom
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Trip[] $tripsAsTo
 * @mixin \Eloquent
 */
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
    	return $this->haszzMany('App\Trip','to_place_id');
    }
}
