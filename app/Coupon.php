<?php

namespace App;

use App\Coupon;
use Illuminate\Database\Eloquent\Model;

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
            return $this->value* Coupon::count();
        }

        elseif($this->type == 'percent')
        {
            return round(($this->percent_off) / 100* $total);
        }
        
        else
        {
            return 0;
        }
    }
}
