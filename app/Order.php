<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public static function getOrdersForClient ($client_id) {
        return self::select('orders.*')
                    ->selectRaw("IF(orders.product_type = 'pre',pre_manufactured_objects.icon,post_manufactured_objects.icon) as icon")
                    ->selectRaw("IF(orders.product_type = 'pre',pre_manufactured_objects.object_name,post_manufactured_objects.object_name) as object_name")
                   ->leftJoin('post_manufactured_objects','post_manufactured_objects.id','orders.product_id')
                   ->leftJoin('pre_manufactured_objects','pre_manufactured_objects.id','orders.product_id')
                   ->where('client_id',$client_id)->where('status','pending')->get();
    }
}
