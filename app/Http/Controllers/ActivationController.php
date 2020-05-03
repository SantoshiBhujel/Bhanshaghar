<?php

namespace App\Http\Controllers;

use App\User;

use App\ActivationCode;
use Illuminate\Http\Request;

use App\Mail\ActivationEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Events\ActivationEmailEvent;
 
class ActivationController extends Controller
{
    //
    public function activation(ActivationCode $code)
    {
        //dd($code);
        $code->delete();
        $code->User()->update(['active'=>true]);
        Auth::login($code->user);
        return redirect('/');
    }


    
    public function coderesend(Request $request){
        //dd($request);
        $user = User::whereEmail($request->email)->firstOrFail();

        if($user->userIsActivated()){
            return redirect('/');
        }

        event(new ActivationEmailEvent($user));
        //Mail::to($user)->queue(new ActivationEmail($user->ActivationCode) );

        return redirect('/login')->with('Success','Your code has been sent. Please check your mail');
    }
}
 