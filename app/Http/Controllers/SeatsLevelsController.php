<?php

namespace App\Http\Controllers;

use App\SeatLevel;
use Illuminate\Http\Request;

class SeatsLevelsController extends Controller
{
	public function index(Request $request)
	{
		$data = SeatLevel::orderBy('id', 'DESC')->paginate(5);
		return view('seat_levels.index', compact('data'))
			->with('i', ($request->input('page', 1) - 1) * 5);
	}
	
	public function create()
	{
		return view('seat_levels.create');
	}
	
	
	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'description' => 'required'
		]);
		
		
		$input = $request->all();
		
		
		$user = SeatLevel::create($input);
		
		return redirect()->route('seats.index')
			->with('success', 'Seat created successfully');
	}
	
	public function show($id)
	{
		$seat = SeatLevel::find($id);
		return view('seat_levels.show', compact('seat'));
	}
	
	
	public function edit($id)
	{
		$seat = SeatLevel::find($id);
		return view('seat_levels.edit', compact('seat'));
	}
	
	public function update($id, Request $request)
	{
		
		$seat_data = $request->all();
		if (empty($seat_data['name'])) {
			$seat_data = array_except($seat_data, 'name');
		}
		
		if (empty($seat_data['description'])) {
			$seat_data = array_except($seat_data, 'description');
		}
		
		$seat = SeatLevel::find($id)->update($seat_data);
		return redirect()->route('seats.index')->with('success', 'Successfully Updated');
		
	}
	
	public function destroy($id) {
		SeatLevel::find($id)->delete();
		return redirect()->route('seats.index')->with('success', 'Deleted Successfully');
		
	}
}
