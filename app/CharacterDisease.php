<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharacterDisease extends Model
{

    protected $table = 'character_diseases';
    protected $guarded = [];

    public static function getCharacterDiseases ($ch_id) {
        return self::select('diseases.name')
                   ->leftJoin('diseases', 'diseases.id', 'character_diseases.disease_id')
                   ->where('status', 'active')
                   ->where('type', 'adult')
                   ->where('character_id', $ch_id)
                   ->get();
    }

    public static function getChildrenDiseases ($ch_id) {
        $children_ids = Children::where('parent1',$ch_id)->orWhere('parent2',$ch_id)->pluck('id')->toArray();

        return self::select('diseases.name')
                    ->selectRaw('CONCAT(children.first_name," ",children.last_name) AS full_name')
                   ->leftJoin('diseases', 'diseases.id', 'character_diseases.disease_id')
                   ->leftJoin('children','children.id','character_diseases.character_id')
                   ->where('status', 'active')
                   ->where('type', 'adult')
                   ->whereIn('character_id',$children_ids)
                   ->get();
    }


}
