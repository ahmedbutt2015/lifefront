<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PractitionerEquipment extends Model
{

    protected $table = 'practitioner_equipments';
    protected $guarded = [];

    public static function getEquipments ($id) {
        return self::select('practitioner_equipments.*', 'pre_manufactured_objects.icon', 'pre_manufactured_objects.object_name')
                   ->leftJoin('pre_manufactured_objects', 'pre_manufactured_objects.id', 'practitioner_equipments.product_id')
                   ->where('practitioner_id', $id)->get();
    }


}
