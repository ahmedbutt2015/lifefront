<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryCharges extends Model
{
    protected $table = 'delivery_charges';

    public static function getCharges ($id) {
        return self::where('character_id',$id)->latest()->value('price');
    }
}
