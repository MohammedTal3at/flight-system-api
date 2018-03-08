<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [ 'status', 'price', 'user_id', 'trip_id', 'seat_level_id', 'confirmed_by' ];

    public function user()	
    {
    	return $this->belongsTo('App\User','user_id');
    }

    public function admin()	
    {
    	return $this->belongsTo('App\User','confirmed_by');
    }
    public function trip()
    {
    	return $this->belongsTo('App\Trip','trip_id');
    }
    public function seatLevels()
    {
        return $this->belongsTo('App\SeatLevel','seat_level_id');
    }
}
