<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Auth;
use DB;

class ClientsController extends Controller
{
    //


        //register
        public function register(Request $request)
        {
            //validate
            $this->validate($request, [
                "name"=>"required",
                "email"=>"required|email|unique:clients",
                "password"=>"required",
                "city"=>"required",
                "country"=>"required",
                "address"=>"required",
                "phone"=>"required",

            ]);

     
    
          //insert in the db
            $client=new Client([
                "name"=>$request->input('name'),
                "email"=>$request->input('email'),
                "password"=>bcrypt($request->input('password')),
                "city"=>$request->input('city'),
                "country"=>$request->input('country'),
                "address"=>$request->input('address'),
                "phone"=>$request->input('phone'),

                
            ]);
            foreach ($request->input('permission') as $key => $value) {
                $client->attachPermission($value);
            }
            $client->save();  
            return response()->json(['message'=>"Create Client successfully"],201);
        }
    
    
    
        //login
        public function login(Request $request)
        {
            //The login 
            $this->validate($request, [
                
                "email"=>"required|email",
                "password"=>"required"
            ]);
            $credentials=$request->only('email','password');    
           
            try{
                $customClaims=['role'=>'client'];
                if(! $token = JWTAuth::attempt($credentials,$customClaims))
                {
                   // JWTAuth::fromUser($user,['role' => $user->role]);
                    return response()->json(['error'=>"Invaild credentials"],401);
                }
            }catch(JWTException $e){
                return response()->json(['error'=>"Could not create token"],500);
            }
    
            return response()->json(['token'=>$token,$customClaims],200);
    
   
        }
    
    
}
