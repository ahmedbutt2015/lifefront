<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneKeeperStock extends Model
{
    protected $guarded = [];

    public static function getStock ($id) {
        return self::select('phone_keeper_stocks.*', 'pre_manufactured_objects.object_name', 'pre_manufactured_objects.icon')
                   ->selectRaw('"1" as put')
                   ->leftJoin('pre_manufactured_objects', 'pre_manufactured_objects.id', 'phone_keeper_stocks.product_id')
                   ->where('phone_keeper_stocks.keeper_id', $id)
                   ->get();
    }
}
