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

        //function API that is using for insert in contact table from the front-end
        public function insertAPI(Request $request)
        {
            //validate
            $this->validate($request, [
                "name"=>"required",
                "email"=>"required|email",
                "message"=>"required",
                "phone"=>"required|string|min:11|max:11"
            ]);

                //insert into contact table the resquest data
                $contact=new Contact([
                    "name"=>$request->input('name'),
                    "email"=>$request->input('email'),
                    "message"=>$request->input('message'),
                    "phone"=>$request->input('phone'),
                ]);
                $contact->save();  
                return response()->json(['message'=>"Create contact successfully"],201);
        }
}
