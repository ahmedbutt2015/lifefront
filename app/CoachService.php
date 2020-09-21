<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoachService extends Model
{

    protected $table = 'coach_services';
    protected $guarded = [];

    public static function getServices ($ch_id) {
        return self::select('coach_services.*', 'post_manufactured_objects.icon', 'post_manufactured_objects.object_name', 'post_manufactured_objects.production_time as time',
            'post_manufactured_objects.min_price', 'post_manufactured_objects.max_price')
                   ->leftJoin('post_manufactured_objects', 'post_manufactured_objects.id', 'coach_services.product_id')
                   ->where('character_id', $ch_id)->get();
    }


}
