<?php

namespace App\Http\Controllers\Api;

use App\Artist;
use App\Manager;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use App\Category;
use App\Type;
use App\Workout;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $name = $request->input("name");
        $password = $request->input("password");
        $email = $request->input("email");
        if($name == null or $password == null or $email == null ){
            return response([
                'message'=> "Plz Fill the Field Correctly",
                'error'=> true
            ],200);
        }else{
            $check_email = User::where("email",$email)->first();
            if ($check_email) {
                return response([
                    'message'=> "Email is already taken",
                    'error'=> true
                ],200);
            }
        }
        $validatedData = $request->all();
        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'user'=> $user,
            'access_token'=> $accessToken,
            'error'=> false
        ],200);

    }

    public function registerArtist(Request $request)
    {
        $name = $request->input("name");
        $password = $request->input("password");
        $email = $request->input("email");
        if($name == null or $password == null or $email == null ){
            return response([
                'message'=> "Plz Fill the Field Correctly",
                'error'=> true
            ],200);
        }else{
            $check_email = Artist::where("email",$email)->first();
            if ($check_email) {
                return response([
                    'message'=> "Email is already taken",
                    'error'=> true
                ],200);
            }
        }
        $validatedData = $request->all();
        $validatedData['password'] = bcrypt($request->password);

        $user = Artist::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'artist'=> $user,
            'access_token'=> $accessToken,
            'error'=> false
        ],200);

    }


    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($loginData)) {
            return response([
                'message'=>'Invalid credentials',
                'error' => true
            ],200);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response([
            'user' => auth()->user(),
            'access_token' => $accessToken,
            'error' => false
        ],200);

    }
    public function artistLogin(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $user = Artist::where("email", request('email'))->first();
        if(!isset($user)){
            return response()->json([
                "message" => "Artist Not found",
                "error" => true
            ],200);
        }
        if (!Hash::check(request('password'), $user->password)) {
            return response()->json([
                "message" => "Incorrect Password",
                "error" => true
            ],200);
        }
        $tokenResult = $user->createToken('Artist');
        $user->access_token = $tokenResult->accessToken;
        $user->token_type = 'Bearer';
        return response()->json([
            "message" => "Login Successfully",
            "data" => $user,
            "error" => false
        ],200);
//        return response(['user' => auth("manager")->user(), 'access_token' => $accessToken]);

    }

    
}
