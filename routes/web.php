<?php
use App\Mail\WelcomeMail;// email ko class import  gareko
use Illuminate\Support\Facades\Mail;  // mail pathauna import gareko
use App\User;

use Gloudemans\Shoppingcart\Facades\Cart;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/welcome', function () {
    return view('welcome');
});

// Route::get('/', function () {  returning json string back
//     return ['name'=>'veg pizzas','base'=>'classic'];
// });

//passing array datas to view

// Route::get('/', function () {
//     $pizza=[
//              'type'=>'hawaiian',
//              'base'=> 'cheesy crust',
//              'price' =>'10'
//             ];
//     return view('view ko nam',$pizza); $pizza vanne variable pass gareko
// });

//passing array within array datas to view

// Route::get('/', function () {
//     $pizza=[
//              ['type'=>'hawaiian', 'base'=> 'cheesy crust', 'price' =>'10'],
//              ['type'=>'volcano', 'base'=> 'garlic crust', 'price' =>'10'],
//              ['type'=>'veg', 'base'=> 'thin and crispy crust', 'price' =>'10']
//             ];
//     return view('welcome',['pizza'=>$pizza] ); //$pizza vanne variable pass gareko
// });

// access garda : in blade.php : 
//@ for($i=0; $i< count($pizza); $i++)
//      {{$pizza[$i]['type']}}   {{$pizza[$i]['base']}}  {{$pizza[$i]['price']}}
//@endfor

//arko tarika
//@foreach ($pizza as $pi)
//  {{$pi['type]}}- {{$pi['base']}}- {{$pi['price']}}
//@endforeach


Route::get('/', function () {
    return view('main');
});

// Route::get('/email', function ()
// {

//     Mail::to('santoshibhujel35@gmail.com')->send(new WelcomeMail());
//     return "Email was sent";
//     //return new WelcomeMail(); // WelcomeMail ko model banako
// });


//  --------------------------
//  ROUTE FOR ACTIVATION CODE
//  --------------------------
 
Route::get('/activate/{code}','ActivationController@activation')->name('user.activation');

Route::get('/resend/code','ActivationController@coderesend')->name('code.resend');


Route::get('/mail', function () {

    Mail::send(new WelcomeMail());
    return "successful";
    
});
//Route::get('/food',view('food'));

//  ------------------------
//  ROUTE FOR FOOD
//  ------------------------


Route::get('/food', function () {
    return view('food');
})->name('food');



//  ------------------------
//  ROUTE FOR POST
//  ------------------------
Route::resource('posts','PostController');

Route::post('/posts/store','PostController@store')->name('post.store');
Route::get('/personalpost','PostController@personal')->name('posts.personal');

//  ------------------------
//  ROUTE FOR USER INFO
//  ------------------------

//Route::get('profile/edit','UserController@edit');
Route::get('profile/edit','UserController@edit')->name('userinfo.edit');

Route::post('profile/edit','UserController@userinfoupdate')->name('userinfo.edit');

Route::get('password/edit','UserController@passwordedit')->name('password.edit');

Route::post('password/edit','UserController@password_edit')->name('password.edit');

Route::get('/profile/picture/update','UserController@imageupload')->name('propicupdate');

Route::post('/profile/picture/update','UserController@imageupdate')->name('propicupdate');

Route::get('/profile','UserController@profile')->name('profile');

//  ------------------------
//  ROUTE FOR MENUS
//  ------------------------


Route::resource('menu','MenuController');


//  ------------------------
//  ROUTE FOR ITEMS
//  ------------------------


Route::resource('item','ItemController');

Route::get('/search','ItemController@search')->name('item.search');
//Route::get('/cart','ItemController@addToCart')->name('addToCart');


//  ------------------------
//  ROUTE FOR CART
//  ------------------------

Route::resource('cart','CartController');

Route::post('/cart/switchToSaveForLater/{id}','CartController@switchToSaveForLater')->name('cart.To.saveForLater');

Route::get('/empty/saveforlater',function(){
    Cart::instance('saveForLater')->destroy();
})->name('empty.saveForLater');


//  ------------------------
//  ROUTE FOR SAVE FOR LATER
//  ------------------------

Route::resource('saveForLater','SaveForLaterController');

Route::post('/wishlist/switchToCart/{id}','SaveForLaterController@switchToCart')->name('wishlist.To.cart');

Route::get('/empty/saveforlater',function(){
    Cart::instance('saveForLater')->destroy();
})->name('empty.saveForLater');


//  ------------------------
//  ROUTE FOR CHECKOUT
//  ------------------------

Route::resource('checkout','CheckoutController');
Route::get('/thankyou', 'CheckoutController@thankyou')->name('thankyou');



//  ------------------------
//  ROUTE FOR COUPOUNS
//  ------------------------

Route::resource('coupons','CouponsController');
Route::post('/coupons/delete','CouponsController@delete')->name('coupons.delete');


//  ------------------------
//  ROUTE FOR CHECKING MAIL
//  ------------------------

Route::get('/mailable', function () 
{
    $order= App\Order::findOrFail(6);
    print_r($order);
    // return (new App\Mail\OrderPlaced($order));
});


//  ------------------------
//  ROUTE FOR MY-ORDERS
//  ------------------------

Route::get('/my-orders','OrderController@index')->name('orders.index');


//  ------------------------
//  DELETE FROM DATABASE
//  ------------------------

Route::get('/delete5', function () {
    User::destroy(5); //trash nagari delete garne
});




//-------------------------
//SOFT DELETE
//-------------------------

Route::get('/softdelete', function () {  
    User::find(4)->delete();
    return "id 4 deleted successfully" ;
});


//------------------------------------------
//RETRIEVING SOFT DELETE(TRASHED ITEM HERNE)
//------------------------------------------

Route::get('/readsoftdelete', function () {  
    $usernew=User::withTrashed()->where('id',3)->get();
    return $usernew;
});

//------------------------------------
//RETRIEVING ONLY TRASHED SOFT DELETE
//------------------------------------

Route::get('/readonlytrashedsoftdelete', function () {  
    $usernew=User::onlyTrashed()->get();
    return $usernew;
});

//----------------------
//RESTORING SOFT DELETE
//----------------------

Route::get('/restoresoftdelete', function (){

    $usernew=User::withTrashed()->restore();  //paila deleted item find garne withTrashed ley ani restore garne
    // $usernew=NewUser::withTrashed()->where('id',3)->restore();  //where condition ni rakhna milcha

    return "Restored";

    //yesko result chai deleted_at ko value time stamp bata feri null ma jancha

});

//----------------------------------------------
//DELETING FROM DB PERMANENTLY (FORCED DELETE)
//----------------------------------------------

Route::get('/forcedelete', function () {  
    $usernew=User::withTrashed()->where('id',3)->forceDelete(); //trashed item navaye pani delete garcha
    //$usernew=User::onlyTrashed()->where('id',3)->forceDelete(); //trashed item ho vane matrai delete garcha
    if($usernew)
    {
        return "Deleted Successfully";
    }
    return "no record with id 4";
});


//------------------------
//ONE TO ONE RELATIONSHIP
//------------------------

//passport table ma data insert gareko
Route::get('/passport','passportController@index');


//Newuser ra passport models cha
//$id user ko passport number(details) access garna lageko

Route::get('/onetoone','usernewController@userpassport');

//$id passport kun chai user ko ho, detail access garna lageko usernewController ko through 
Route::get('/inverseonetooneinusernew','usernewController@passport');

//$id passport kun chai user ko ho, detail access garna lageko passportController ko through 
Route::get('/inverseonetooneinpassport','passportController@passport');

//$user_id ko passport info halna lageko 

Route::get('/insertinonetoone','usernewController@datainsert');






