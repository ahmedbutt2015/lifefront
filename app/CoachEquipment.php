<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoachEquipment extends Model
{

    protected $table = 'coach_equipments';
    protected $guarded = [];

    public static function getEquipments ($ch_id, $status) {
        return self::select('coach_equipments.*', 'pre_manufactured_objects.icon', 'pre_manufactured_objects.object_name','post_manufactured_objects.object_name as service_name')
                   ->selectRaw('"1" as put')
                   ->leftJoin('pre_manufactured_objects', 'pre_manufactured_objects.id', 'coach_equipments.product_id')
                   ->leftJoin('post_to_pre_manufactured_object_relations', 'post_to_pre_manufactured_object_relations.pre_id', 'coach_equipments.product_id')
                   ->leftJoin('post_manufactured_objects', 'post_manufactured_objects.id', 'post_to_pre_manufactured_object_relations.post_id')
                   ->where('character_id', $ch_id)
                   ->where('status', $status)
                   ->groupBy('coach_equipments.product_id')
                   ->get();
    }


}
