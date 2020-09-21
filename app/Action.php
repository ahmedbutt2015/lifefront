<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{

    public static function getActions () {
        return self::all();
    }
}
