<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FactoryAnimal extends Model
{
    protected $table = "factory_animals";

    public static function getAll ($id) {
        return self::select('factory_animals.animal_id', 'pre_manufactured_objects.object_name as name', 'pre_manufactured_objects.icon')
                   ->selectRaw('round(sum(factory_animals.quantity)) as quantity')
                   ->leftJoin('pre_manufactured_objects', 'pre_manufactured_objects.id', 'factory_animals.animal_id')
                   ->where('factory_id', $id)
                   ->groupBy('animal_id')->get();
    }
}
