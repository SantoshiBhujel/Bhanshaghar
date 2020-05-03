<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected $maxAttempts = 2; // Default is 5
    protected $decayMinutes = 1; // Default is 1
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    
    protected function authenticated(Request $request, $user)//AuthenticatesUsers bata impoert garera overwrite gareko
    {
        //
        if(!($user->userIsActivated()))
        {
            Auth::logout();
            //return redirect('/login')->with('Error','You are not active !!! Need the Code? Click Here! <a href="'.route('code.resend').'?email='.$user->email.'">Resend Code</a>');
            return redirect('/login')->with('Email',$user->email);

        }
    }
}
