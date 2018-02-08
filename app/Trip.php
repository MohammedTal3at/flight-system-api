<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    //
    public function company()
    {
    	return $this->belongsTo('App\Company','company_id');
    }

    public function place_from()
    {
    	return $this->belongsTo('App\Place','from_place_id');
    }

    public function place_to()
    {
    	return $this->belongsTo('App\Place','to_place_id');
    }

    public function seatlevels()
    {
    	return $this->belongsToMany('App\SeatLevel','seats_levels_trips','seats_levels_id','trip_id')->withPivot('price','available_count');
    }
    public function bookings()
    {
    	return $this->hasMany('App\Booking','trip_id');
    }
}
