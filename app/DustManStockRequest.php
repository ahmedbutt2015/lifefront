<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DustManStockRequest extends Model
{
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'date:d/m/Y'
    ];

    public static function getRequestsForManager ($id) {
        return self::select('dust_man_stock_requests.*', 'pre_manufactured_objects.object_name', 'pre_manufactured_objects.icon', 'characters.address', 'characters.prefix')
                   ->selectRaw('CONCAT(characters.first_name," ",characters.last_name) as employee_name')
                   ->leftJoin('characters', 'characters.id', 'dust_man_stock_requests.keeper_id')
                   ->leftJoin('pre_manufactured_objects', 'pre_manufactured_objects.id', 'dust_man_stock_requests.product_id')
                   ->where('dust_man_stock_requests.manager_id', $id)
                   ->where('dust_man_stock_requests.status', 'pending')
                   ->get();
    }

    public static function getRequestsForKeeper ($id) {
        return self::select('dust_man_stock_requests.*', 'pre_manufactured_objects.object_name', 'pre_manufactured_objects.icon')
                   ->leftJoin('pre_manufactured_objects', 'pre_manufactured_objects.id', 'dust_man_stock_requests.product_id')
                   ->where('dust_man_stock_requests.keeper_id', $id)
                   ->get();
    }

}
