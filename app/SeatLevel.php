<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeatLevel extends Model
{
    protected $fillable = ['name', 'description'];
    protected $table = 'seats_levels';

    public function trips()	
    {
    	return $this->belongsToMany('App\Trip','seats_levels_trips','seats_levels_id','trip_id')->withPivot('price','available_count');
    }
}
