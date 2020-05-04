<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Events\ActivationEmailEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //

    public function profile()
    {
        return view('profile.profile',array('user'=> Auth::user(), 'posts'=>Auth::user()->Posts));
    }

    
    public function edit()
    {
        $user= User::find(auth()->user()->id);
        return view('profile.userinfoupdate');
    }


    public function userinfoupdate(Request $request)
    {
        $user= User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->email= $request->email;
        $user->address= $request->address;
        $user->phone= $request->phone;
        //$user->active= $request->active;
        //$user->password= Hash::make($request['password']);
        $user->save();
        return redirect('/profile')->with('success','Profile info successfully changed.');
        // $code= $user->ActivationCode()->create([
        //     'code'=> str::random(128)
        // ]);
     
        // Auth::logout();
        
        // event(new ActivationEmailEvent($user));
   
        // return redirect('/login')->with('Success','Password successfully changed . We sent you an email, Please check within a couple of minutes to activate!');
    }


    protected function imageupdate(Request $request)
    {
        $user=User::find(auth()->user()->id);
        
        if($request->hasFile('profile_image'))
        {
            $extension=$request->file('profile_image')->getClientOriginalExtension();
            $fileName= 'profile'.'-'.time().'.'.$extension;
            $path=$request->file('profile_image')->storeAs('public/profile_images',$fileName);
            $user->profile_image = $fileName;
            $user->save();
            return redirect('/profile')->with('success','DP successfully changed.');
        }

    }

    protected function imageupload()
    {
        return view('profile.imageupload');
    }
    
}
