<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FarmAnimal extends Model
{

    protected $table = "farm_animals";

    public static function getAll ($id) {
        return self::select('farm_animals.animal_id', 'pre_manufactured_objects.object_name as name', 'pre_manufactured_objects.icon')
                   ->selectRaw('round(sum(farm_animals.quantity)) as quantity')
                   ->leftJoin('pre_manufactured_objects', 'pre_manufactured_objects.id', 'farm_animals.animal_id')
                   ->where('farmer_id', $id)
                   ->groupBy('animal_id')->get();
    }


}
