<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopKeeperStock extends Model
{

    protected $guarded = [];


    public static function getStock ($id, $status='back') {
        return self::select('shop_keeper_stocks.*', 'pre_manufactured_objects.object_name', 'pre_manufactured_objects.icon')
                   ->selectRaw('"1" as put')
                   ->leftJoin('pre_manufactured_objects', 'pre_manufactured_objects.id', 'shop_keeper_stocks.product_id')
                   ->where('shop_keeper_stocks.keeper_id', $id)
                   ->where('shop_keeper_stocks.status', $status)
                   ->get();
    }


}
