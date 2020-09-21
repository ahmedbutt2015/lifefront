<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DustManStock extends Model
{
    protected $guarded = [];


    public static function getStock ($id) {
        return self::select('dust_man_stocks.*', 'pre_manufactured_objects.object_name', 'pre_manufactured_objects.icon')
                   ->leftJoin('pre_manufactured_objects', 'pre_manufactured_objects.id', 'dust_man_stocks.product_id')
                   ->where('dust_man_stocks.keeper_id', $id)
                   ->get();
    }
}
