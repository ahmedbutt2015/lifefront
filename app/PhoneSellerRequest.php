<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 
class PhoneSellerRequest extends Model
{ 
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'date:d/m/Y'
    ];

    public static function getRequestsForManager ($id) {
        return self::select('phone_seller_requests.*', 'pre_manufactured_objects.object_name', 'pre_manufactured_objects.icon', 'characters.address', 'characters.prefix')
                   ->selectRaw('CONCAT(characters.first_name," ",characters.last_name) as employee_name')
                   ->leftJoin('characters', 'characters.id', 'phone_seller_requests.keeper_id')
                   ->leftJoin('pre_manufactured_objects', 'pre_manufactured_objects.id', 'phone_seller_requests.product_id')
                   ->where('phone_seller_requests.manager_id', $id)
                   ->where('phone_seller_requests.status', 'pending')
                   ->get();
    }

    public static function getRequestsForKeeper ($id) {
        return self::select('phone_seller_requests.*', 'pre_manufactured_objects.object_name', 'pre_manufactured_objects.icon')
                   ->leftJoin('pre_manufactured_objects', 'pre_manufactured_objects.id', 'phone_seller_requests.product_id')
                   ->where('phone_seller_requests.keeper_id', $id)
                   ->get();
    }
}
