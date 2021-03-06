<?php

namespace App\Http\Controllers;

use App\User;

use App\ActivationCode;
use Illuminate\Http\Request;

use App\Mail\ActivationEmail;
use App\Mail\AccountActivation;
use App\Events\ActivationEmailEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
 
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


    
    public function coderesend(Request $request)
    {
       
        $user = User::whereEmail($request->email)->firstOrFail();

        if($user->userIsActivated())
        {
            return redirect('/');
        }
    
        event(new ActivationEmailEvent($user));
        //Mail::to($user)->queue(new AccountActivation($user->ActivationCode->code) );

        return redirect('/login');
    }
}
 