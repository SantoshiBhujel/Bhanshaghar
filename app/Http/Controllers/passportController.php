<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\passport;

class passportController extends Controller
{
    //
    public function index()
    {
        $pass= new passport();
        $pass->number="8323400";
        $pass->newusers_id='1';
        $pass->save();
        return "successfully added";
    }

    public function passport()
    {
        $user = passport::find(2)->Newuser;  //passport_id 2 vako user detail access garna lageko
        echo $user;
    }
}
