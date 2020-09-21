<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneMangerStock extends Model
{
    protected $guarded = [];

    public static function getStock ($id) {
        return self::select('phone_manger_stocks.*','pre_manufactured_objects.object_name','pre_manufactured_objects.icon')
                   ->where('manager_id', $id)
                   ->leftJoin('pre_manufactured_objects', 'pre_manufactured_objects.id', 'phone_manger_stocks.product_id')
                   ->get();
    }
}
