<?php

namespace App;

use App\Http\Helpers\Crud;
use Illuminate\Database\Eloquent\Model;

class CharacterHabitation extends Model
{

    use Crud;

    protected $guarded = [];
    protected $insert = ['character_id'];


}
