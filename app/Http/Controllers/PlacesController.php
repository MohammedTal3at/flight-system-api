<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
	public function index(Request $request)
	{
		$data = Place::orderBy('id', 'DESC')->paginate(5);
		return view('places.index', compact('data'))
			->with('i', ($request->input('page', 1) - 1) * 5);
	}
	
	public function create()
	{
		return view('places.create');
	}
	
	
	public function store(Request $request)
	{
		$this->validate($request, [
			'country' => 'required',
			'city' => 'required'
		]);
		
		
		$input = $request->all();
		
		
		$user = Place::create($input);
		
		return redirect()->route('places.index')
			->with('success', 'Place created successfully');
	}
	
	public function show($id)
	{
		$place = Place::find($id);
		return view('places.show', compact('place'));
	}
	
	
	public function edit($id)
	{
		$place = Place::find($id);
		return view('places.edit', compact('place'));
	}
	
	public function update($id, Request $request)
	{
		
		$place_data = $request->all();
		if (empty($place_data['country'])) {
			$place_data = array_except($place_data, 'country');
		}
		
		if (empty($place_data['city'])) {
			$place_data = array_except($place_data, 'city');
		}
		
		$place = Place::find($id);
		$place->update($place_data);
		return redirect()->route('places.index')->with('success', 'Successfully Updated');
		
	}
	
	public function destroy($id) {
	Place::find($id)->delete();
	return redirect()->route('places.index')->with('success', 'Deleted Successfully');
	
	}
	
}
