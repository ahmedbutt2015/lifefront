<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharacterIndication extends Model
{

    public static function getBar ($ch_id, $indication_id) {
        return self::where('character_id',$ch_id)->where('indication_id',$indication_id)->first();
    }

}
