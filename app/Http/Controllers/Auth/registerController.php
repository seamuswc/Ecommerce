<?php

namespace App\Http\Controllers\Auth;

use App\user;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

//use Illuminate\Foundation\Auth\RegistersUsers;

class registerController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    //use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
     protected $redirectTo = '/pending';

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User

     */

     public function registerform()
     {
         return view('admin.register');
     }


     public function register(Request $request)
     {

        user::create([
         'username' => $request->input('username'),
         'password' => Hash::make( $request->input('password') )
        ]);

        auth()->attempt( request( ['username', 'password'] ) );

        return redirect('/pending');

      }
}
