<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $guarded = [];

    public function owner () {
        return $this->belongsTo(Character::class,'character_id');
    }

}
