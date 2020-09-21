<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildrenIndication extends Model
{

    public static function getBar ($child_id, $indication_id) {
        return self::where('child_id', $child_id)->where('indication_id', $indication_id)->first();
    }


}
