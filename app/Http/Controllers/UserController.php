<?php 

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Role;
use DB;
use Hash;
use JWTAuth;
use Auth;


class UserController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('display_name','id')->toArray();
        return view('users.create',compact('roles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $user = User::create($input);
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }


        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }


    /**
     * Show the form for editing the specified resource...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('display_name','id')->toArray();
        $userRole = $user->roles->pluck('id','id')->toArray();


        return view('users.edit',compact('user','roles','userRole'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }


        $user = User::find($id);
        $user->update($input);
        DB::table('role_user')->where('user_id',$id)->delete();

        
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }


        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }


///Here is the signup & signin for the client not for the admin
        //signup
        public function signup(Request $request)
        {
            //validate
            $this->validate($request, [
                "name"=>"required",
                "email"=>"required|email|unique:users",
                "password"=>"required"
            ]);
                //insert into users table the resquest data
            $user=new User([
                "name"=>$request->input('name'),
                "email"=>$request->input('email'),
                "password"=>bcrypt($request->input('password')),
               
            ]);

            $user->user_type='client';
            $user->save();  
            return response()->json(['message'=>"Create user successfully"],201);
        }
    
    
    
        //signin
        public function signin(Request $request)
        {
            //Validate
            $this->validate($request, [
                
                "email"=>"required|email",
                "password"=>"required"
            ]);
            $credentials=$request->only('email','password');    
           
    
            try{
                $customClaims=['role'=>'Client'];
                if(! $token = JWTAuth::attempt($credentials,$customClaims))
                {
                   // JWTAuth::fromUser($user,['role' => $user->role]);
                    return response()->json(['error'=>"Invaild credentials"],401);
                }
            }catch(JWTException $e){
                return response()->json(['error'=>"Could not create token"],500);
            }
            /*here you will have a token and role which is "Client"
                Example:
                {
                    "0": {
                        "role": "Client"
                    },
                    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQ2xpZW50Iiwic3ViIjoyLCJpc3MiOiJodHRwOi8vbG9jYWxob3N0L3Byb2plY3QvcHVibGljL2FwaS9jbGllbnQvc2lnbmluIiwiaWF0IjoxNTE4MDk1OTAxLCJleHAiOjE1MTgwOTk1MDEsIm5iZiI6MTUxODA5NTkwMSwianRpIjoiZ2pBdXE5MHhBUTNlMGl2MyJ9.tYG4U1o6bfJOOFPpE9GmZ-zp4ak8XI77qdRo36hlI8o"
                }
             */

            return response()->json(['token'=>$token,$customClaims],200);
    
   
        }







}