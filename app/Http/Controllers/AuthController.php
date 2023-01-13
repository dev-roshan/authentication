<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6|regex:/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])/'
        ],
        [
            'password.regex' => 'The password requires an uppercase, lowercase, number and special character'
        ]
        );

        if($validator->fails()){
            return response(['message' => 'Validation errors', 'errors' =>  $validator->errors(), 'status' => false], 422);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        event(new Registered($user));
      
        /**Take note of this: Your user authentication access token is generated here **/
        $data['token'] =  $user->createToken(env('APP_NAME'))->accessToken;
        $data['name'] =  $user->name;

        return response(['data' => $data, 'message' => 'Account created successfully!', 'status' => true]);
    }
    
    
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response(['message' => 'Validation errors', 'errors' =>  $validator->errors(), 'status' => false], 422);
        }

        if (auth('web')->attempt($request->all())) {
            $user = User::where('email',$request->email)->first();
            $data['token'] =  $user->createToken(env('APP_NAME'))->accessToken;
            $data['name'] =  $user->name;
            return response(['data' => $data, 'message' => 'Logged in successfully!', 'status' => true]);
        }
        else{
            return response(['message' => 'Invalid Credentials', 'status' => false], 422);
        }
    }
     
}