<?php

namespace App\Http\Controllers;

use App\Company;
use App\Place;
use App\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TripsController extends Controller
{
	public function index()
	{
		$data = Trip::all();
		return view('trips.index', compact('data'));
	}
	
	public function show($id)
	{
		$trip = Trip::find($id);
		return view('trips.show', compact('trip'));
	}
	
	public function create()
	{
		$companies = Company::pluck('name', 'id')->toArray();
		$place_from = Place::pluck('city', 'id')->toArray();
		$place_to = Place::pluck('city', 'id')->toArray();
		
		return view('trips.create', compact(['place_from', 'place_to', 'companies']));
	}
	
	public function store(Request $request)
	{
		
		$this->validate($request, [
			'company_id' => 'required',
			'start_date' => 'required',
			'start_time' => 'required',
			'from_place_id' => 'required',
			'to_place_id' => 'required',
			'end_date' => 'required',
			'economyprice' => 'required',
			'standardprice' => 'required',
			'firstclassprice' => 'required',
			'economy' => 'required',
			'standard' => 'required',
			'firstclass' => 'required'
		
		]);
		//$request['company_id'] = Input::get('company_id');
		//$request['place_to_id'] = Input::get('place_to_id');
		//$request['place_from_id'] = Input::get('place_from_id');
		$trip_data = $request->all();
		$trip = Trip::create($trip_data);
		
		$trip->seatlevels()->attach(1, ['price' => $trip_data['economyprice'], 'available_count' => $trip_data['economy']]);
		$trip->seatlevels()->attach(2, ['price' => $trip_data['standardprice'], 'available_count' => $trip_data['standard']]);
		$trip->seatlevels()->attach(3, ['price' => $trip_data['firstclassprice'], 'available_count' => $trip_data['firstclass']]);
		
		
		return redirect()->route('trips.index')->with('success', 'Trip Created Successfully');
	}
	
	public function destroy($id)
	{
		Trip::find($id)->delete();
		return redirect()->route('trips.index')->with('success', 'Trip deleted Successfully');
		
	}
	
	public function edit($id)
	{
		$trip = Trip::find($id);//->with('company');
		$companies = Company::pluck('name', 'id')->toArray();
		$place_from = Place::pluck('city', 'id')->toArray();
		$place_to = Place::pluck('city', 'id')->toArray();
		
		return view('trips.edit', compact(['trip', 'companies', 'place_from', 'place_to']));
		
	}
	
	public function update($id, Request $request)
	{
		$this->validate($request, [
			'company_id' => 'required',
			'start_date' => 'required',
			'start_time' => 'required',
			'from_place_id' => 'required',
			'to_place_id' => 'required',
			'end_date' => 'required',
			'economyprice' => 'required',
			'standardprice' => 'required',
			'firstclassprice' => 'required',
			'economy' => 'required',
			'standard' => 'required',
			'firstclass' => 'required'
		]);
		
		$trip_data = $request->all();
		$trip = Trip::findMany($id)[0]->update($trip_data);
		
		//update prices and seats count
		$trip_pivots = Trip::findMany($id)[0];
		$trip_pivots->seatlevels()->updateExistingPivot(1, ['price' => $trip_data['economyprice'], 'available_count' => $trip_data['economy']]);
		$trip_pivots->seatlevels()->updateExistingPivot(2, ['price' => $trip_data['standardprice'], 'available_count' => $trip_data['standard']]);
		$trip_pivots->seatlevels()->updateExistingPivot(3, ['price' => $trip_data['firstclassprice'], 'available_count' => $trip_data['firstclass']]);
		
		
		return redirect()->route('trips.index')->with('success', 'Trip Successfully Updated');
	}
	
	
	public function getapiTrips()
	{
		$response = Trip::all();
		//change id values for (company_id, place_id from and to ) to be understandable
		//output: if company_id for trip is 1 -> output will be 'Company 1' and the same for places
		foreach ($response as $res) {
			$res['company_id'] = Company::findMany($res['company_id'])[0]['name'];
			$res['from_place_id'] = Place::findMany($res['from_place_id'])[0]['city'];
			$res['to_place_id'] = Place::findMany($res['to_place_id'])[0]['city'];
			$res = array_except($res, ['created_at', 'id', 'updated_at']);
		}
		return response()->json(['trips' => $response]);
	}
}
