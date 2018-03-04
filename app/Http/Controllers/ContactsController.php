<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
class ContactsController extends Controller
{
    //
     //index page
     public function index(Request $request)
     {
         $data = Contact::orderBy('id', 'DESC')->paginate(5);
         return view('contacts.index', compact('data'))
             ->with('i', ($request->input('page', 1) - 1) * 5);
     }

      //to display all the contacts
	public function show($id)
	{
		$contact = Contact::find($id);
		return view('contacts.show', compact('contact'));
    }
    
    //for delete the company
	public function destroy($id) {
        Contact::find($id)->delete();
        return redirect()->route('contacts.index')->with('success', 'Deleted Successfully');
        
        }
}
