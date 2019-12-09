<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\IndexController;


class loginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/pending';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function loginform()
    {
        return view('admin.login');
    }

    public function login()
    {
      if( !auth()->attempt( request( ['username', 'password'] ) ) ) {
        return back();
      }
        return redirect('/pending');
    }

    public function logout()
    {
      Auth::logout();
      $new = new IndexController;
      return $new->index();
    }



}
