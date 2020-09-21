<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndicationBar extends Model
{

    protected $table = 'indication_bars';

    public static function getBar ($name, $type) {
        return self::where('apply_to',$type)->whereRaw("LOWER(english_name) = ?",[$name])->first();
    }

}
