<?php

namespace App;

use App\Http\Helpers\Crud;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    use Crud;

    protected $guarded = [];
    protected $insert = ['character_id', 'title', 'body'];

    public static function getAll ($id) {
        return self::where('character_id', $id)->get();
    }


}
