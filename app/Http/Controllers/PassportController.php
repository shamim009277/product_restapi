<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Validator;

class PassportController extends Controller
{
    public function register(Request $request){
       
       $this->validate($request,[
           
           'name'  => 'required | min:3',
           'email' => 'required | email | unique:users',
           'password' => 'required | min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),

        ]);

        $token = $user->createToken('My Token')->accessToken;
        return response()->json([
            'data'=>'Registered Successfull',
            'token' => $token
        ],200);

    }

    public function login(Request $request){
       
       $this->validate($request,[
            'email' =>'required',
            'password' =>'required',
       ]);

       $credentials = [
            'email' => $request->email,
            'password' => $request->password,
       ];

       if (Auth()->attempt($credentials)) {
       	    $token = Auth()->user()->createToken('My Token')->accessToken;
       	    return response()->json([
                    'success' => 'User logid in success fully',
                    'token' => $token
       	    ],200);
       } else {
       	    return response()->json(['error'=>'Unauthorized User try to login'],401);
       }
       
    }
}
    