<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;// auth::logout() use garne vaye extension chaincha
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivationEmail;
use Illuminate\Support\Str;
// use App\Http\Controllers\Auth\Request;
use Illuminate\Http\Request;
use App\Events\ActivationEmailEvent;

class RegisterController extends Controller
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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address'=>['required','string'],
            'phone'=>['required', 'digits:10', 'integer'],
            'profile_image'=>['nullable','string','image','max:2048'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address'=>$data['address'],
            'phone'=>$data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }





    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    
    protected function registered(Request $request, $user)
    {
        //Insert code into table
        // $email_data = array(
        //     'name' => $user['name'],
        //     'email' => $user['email'],
        // );
        $code= $user->ActivationCode()->create([
            'code'=> str::random(128)
        ]);
        //print_r($code);
        //Logout user
        //$this->guard()->logout();
        Auth::logout();
        
        event(new ActivationEmailEvent($user));
        //Mail the user
        
        //Mail::to($user->email)->queue(new ActivationEmail($code));
        
        //Redirect
        return redirect('/login')->with('Success','We sent you an email, Please check within a couple of minutes to activate!');
    }

}
