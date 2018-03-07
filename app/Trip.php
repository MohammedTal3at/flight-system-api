<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Trip extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $fillable = [ 'company_id', 'start_date', 'start_time', 'end_date', 'from_place_id', 'to_place_id' ];
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
    	return $this->belongsToMany('App\SeatLevel','seats_levels_trips','trip_id','seats_levels_id')->withPivot('price','available_count');
    }
    public function bookings()
    {
    	return $this->hasMany('App\Booking','trip_id');
    }
}
