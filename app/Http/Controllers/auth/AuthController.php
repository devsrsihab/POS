<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //login
    public function login(){
        return view('auth.login');
    }

    //login action
    public function loginAction(Request $request){

        // dd('this is login action');

        // validation
        $validator = Validator::make($request->all(),[
            'email'    => 'required|email',
            'password' => 'required|min: 8|max:50'

            
        ]);

        // valid or not
        if ($validator->fails()) {
            // returning
            // return response()->json([
            //     'status' => 400,
            //     'errors' => $validator->messages()
            // ]);
            return redirect()->back()->with('errors', $validator->errors());

        }
        else
        {


            // check login data
            $data = [
                'email' =>$request->email,
                'password' =>$request->password,
            ];
    
            if (Auth::guard('admin')->attempt($data,$request->remember)) {
               return redirect()->route('dashboard');
            } else {
                return redirect()->back();
            }
        }
        




        
    }

    // logout
    public function logOut(){
        Auth::logout();
        return redirect()->route('login');
    }

    // user make
    public function makeUser(){
        // $user = new User;
        // $user->name = 'sohanur Rohman';
        // $user->email = 'admin@gmail.com';
        // $user->password = Hash::make('12345678');
        User::insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
        ]);

        
        
    }
}
