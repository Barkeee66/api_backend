<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }
    public function register(Request $request) {
    
     
        $validate = Validator::make($request->all(), [
            'name' =>'required|string', 
            'email' =>'required|string|unique:users,email',
            'password' =>'required|string|confirmed'
        ]);
        if($validate->fails()){
            return(['status'=>0]);
        
           }
           $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);
        $token= $user->createToken('myapptoken')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token
        ]; 
            return response()->json([$response,'status'=>1]);


    }

   
    public function login(Request $request) {
    
        
        $credentials = $request->only('email', 'password');
 
        if (Auth::attempt($credentials)) {
            
    
            $user = User::where('email', $credentials['email'])->first();
         
            if(!$user ||!Hash::check($credentials['password'],$user->password)){
             
             } 
             $token = $user->createToken('myapptoken')->plainTextToken;
             $response = [
                 'user' => $user,
                 'token' => $token,
                 
             ];
            
             return response()->json([$response,'status'=>1]);
         }
             return response()->json(['status'=>0]);
         }

    // public function loginUser(Request $request)
    //      {
    // $request->validate([
    //     'email'=>'required|email',
    //     'password'=>'required|min:5|max:12'
    // ]);
    // $user = User::where('email','=',$request->email)->first();
    // if ($user) {
    //     if (Hash::check($request->password,$user->password)) {
    //         $request->session()->put('loginId', $user->id);
    //         return redirect('dashboard');
    //     }else{
    //         return back()->with('fail','Password not matches.');
    //     }
    //     }else{
    //         return back()->with('fail','This email is not registered.');
    //     }
    // }
    
    
    public function show($id)
    {
        return User::find($id);
    }
    public function logout (Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' =>'Logged out'
        ];
        
    }
}
