<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    protected $table = 'gifts';

    public static function getGift () {
        return \DB::table('gifts')->get();
    }
}
