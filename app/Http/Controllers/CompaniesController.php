<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
class CompaniesController extends Controller
{
    //index page
    public function index(Request $request)
	{
		$data = Company::orderBy('id', 'DESC')->paginate(5);
		return view('companies.index', compact('data'))
			->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    //for create company
    public function create()
	{
		return view('companies.create');
	}
	
	//for insert the new company in database
	public function store(Request $request)
	{
		$this->validate($request, [
            'email'=>'required|email|unique:companies,email',
            'name'=>'required',
            'address'=>'required',
            'city' => 'required',
			'country' => 'required',
			
		]);
		
		
		$input = $request->all();
		
		
		$user = Company::create($input);
		
		return redirect()->route('companies.index')
			->with('success', 'Company created successfully');
	}
    
    //to display all the companies
	public function show($id)
	{
		$company = Company::find($id);
		return view('companies.show', compact('company'));
	}
	
	//for edit company
	public function edit($id)
	{
		$company = Company::find($id);
		return view('companies.edit', compact('company'));
	}
	//doing update
	public function update($id, Request $request)
	{
		
        $Company_data = $request->all();
        if (empty($Company_data['email'])) {
			$Company_data = array_except($Company_data, 'email');
        }
        if (empty($Company_data['name'])) {
			$Company_data = array_except($Company_data, 'name');
        }
        if (empty($Company_data['address'])) {
			$Company_data = array_except($Company_data, 'address');
		}
        if (empty($Company_data['country'])) {
			$Company_data = array_except($Company_data, 'country');
		}
		if (empty($Company_data['country'])) {
			$Company_data = array_except($Company_data, 'country');
		}
		
		if (empty($Company_data['city'])) {
			$Company_data = array_except($Company_data, 'city');
		}
		
		$company = Company::find($id);
		$company->update($Company_data);
		return redirect()->route('companies.index')->with('success', 'Successfully Updated');
		
	}
    
    
    //for delete the company
	public function destroy($id) {
	Company::find($id)->delete();
	return redirect()->route('companies.index')->with('success', 'Deleted Successfully');
	
	}




}
