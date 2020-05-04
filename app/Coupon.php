<?php

namespace App;

use App\Coupon;
use Illuminate\Database\Eloquent\Model;
use Gloudemans\Shoppingcart\Facades\Cart;

class Coupon extends Model
{

    
    public static function findByCode($code)
    {
        return self::where('code', $code)->first();
    }

    

    public function discount($total)
    {

        if($this->type =='fixed')
        {
            return $this->value*Cart::count();
        }

        elseif($this->type == 'percent')
        {
            return round(($this->percent_off/ 100)* $total);
        }
        
        else
        {
            return 0;
        }
    }
}
