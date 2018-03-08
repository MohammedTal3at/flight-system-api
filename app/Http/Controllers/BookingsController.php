<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Booking;
use \App\User;
use DB;

class BookingsController extends Controller
{
    //Task 3

    public function index()
    {
        $bookings= Booking::with('user')->with('admin')->with('seatLevels')->get();
        return view('bookings.index')->with(compact('bookings'));
    }

    public function create()
    {
        $users_id = DB::table('users')->pluck('name','id')->toArray();
        $trip_id  = DB::table('trips')->pluck('id','id')->toArray();
        $seats_levels  = DB::table('seats_levels')->pluck('name','id')->toArray();
        $booking_status  = ['waiting'=>'waiting' , 'accepted'=>'accepted' , 'rejected'=>'rejected'];

        return view('bookings.create',['users_id'=>$users_id,'trip_id'=>$trip_id ,'seats_levels_id'=>$seats_levels,'booking_status'=>$booking_status]);
    }
    public function store(Request $request)
    {
        $booking = new Booking();
        $booking->create($request->all());
        return redirect()->route('bookings.index')
            ->with('success', 'Booking created successfully');
    }
    public function show($id)
    {
        $booking = Booking::find($id);
        return view('bookings.show', compact('booking'));
    }
    public function edit($id)
    {
        $booking = Booking::find($id);
        $users_id = DB::table('users')->pluck('name','id')->toArray();
        $trip_id  = DB::table('trips')->pluck('id','id')->toArray();
        $seats_levels  = DB::table('seats_levels')->pluck('name','id')->toArray();
        $booking_status  = ['waiting'=>'waiting','confirmed'=>'confirmed' ,'rejected'=>'rejected'];

        return view('bookings.edit',['booking'=>$booking,'users_id'=>$users_id,'trip_id'=>$trip_id ,'seats_levels_id'=>$seats_levels,'booking_status'=>$booking_status]);
    }
    public function update(Request $request , $id)
    {
        $booking_data = $request->all();
        if (empty($booking_data['user_id'])) {
            $booking_data = array_except($booking_data, 'user_id');
        }
        if (empty($booking_data['trip_id'])) {
            $booking_data = array_except($booking_data, 'trip_id');
        }
        if (empty($booking_data['price'])) {
            $booking_data = array_except($booking_data, 'price');
        }
        if (empty($booking_data['status'])) {
            $booking_data = array_except($booking_data, 'status');
        }
        if (empty($booking_data['seat_level_id'])) {
            $booking_data = array_except($booking_data, 'seat_level_id');
        }


        $booking = Booking::find($id);
        $booking->update($booking_data);
        return redirect()->route('bookings.index')->with('success', 'Successfully Updated');

    }
    public function destroy($id) {
        Booking::find($id)->delete();
        return redirect()->route('bookings.index')->with('success', 'Deleted Successfully');

    }


}