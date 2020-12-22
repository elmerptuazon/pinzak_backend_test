<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:55',
                'email' => 'email|required|unique:users',
                'password' => 'required|confirmed'
            ]);
            
            $encryptPwd = bcrypt($request->password);
    
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$encryptPwd
            ]);
    
            return response([ 'status'=>'success', 'message'=>'User created.']);
        }catch(\Exception $err) {
            return response([ 'status'=>'failed', 'message'=>$err]);
        }
        
    }

    public function login(Request $request)
    {
        try {
            $loginData = $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);
    
            if (!auth()->attempt($loginData)) {
                return response(['message' => 'Invalid Credentials']);
            }
    
            $accessToken = auth()->user()->createToken('authToken')->accessToken;
    
            return response(['status'=>'success', 'access_token' => $accessToken]);

        }catch(\Exception $err) {
            return response([ 'status'=>'failed', 'message'=>$err]);
        }
        

    }
}
