<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use App\Newuser; //model use gareko
use App\passport;

class usernewController extends Controller
{
    //
    // public function index()
    // {
    //     $newuser= new Newuser();    //'Newuser' vanne model ko object banako 
        
    //     $newuser->name="Santoshi";
    //     $newuser->email="santoshi@gmail.com";
    //     $newuser->password="12345";
    //     $newuser->save();
    //     return "data inserted";
    // }
 
    function insert(Request $req)
    {
        //print_r($req->input());
        $user= new Newuser;
        $user->name= $req->name;
        $user->email= $req->email;
        $user->password= $req->password;
        $user->save();
        return "Successfully inserted";
    }

    // public function show($customerId){

    // }
    public function delete()
    {
        $newuser=Newuser::find(5);
        $newuser->delete();
        return "successfully deleted";
    }

    public function userpassport() 
    {
       $user= Newuser::find(1)->passport;  //userid 1 vako ko passport detail access gareko
       echo $user;
    }

    //yo part vaneko inverse one to one ho
    //ra yeslai ya rn garnu cha vane namespace define garnu parcha
    //use App\passport;

    // public function passport(){
    // $user=Passport::find(2)->Newuser;
    //     echo $user;
    // }

    
    public function datainsert()//$userId vayeko user ko passport detail halna lageko
    {
        $user= Newuser::findorFail(4/*userId*/); //dynamic userId banauna milcha

        $passport= new Passport(['number'=>'12345678']); //instantiate garne i.e. Passport model ko object banaune

        $user->passport()->save($passport);// passport() chai Newuser model bhitra vako passport function ho ,, passport sanga connect garna ko lagi
        return "successful";
    }
}
