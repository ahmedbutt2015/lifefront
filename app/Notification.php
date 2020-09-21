<?php

namespace App;

use App\Http\Helpers\Crud;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    use Crud;
    protected $guarded = [];

    protected $primaryKey = 'id';
    protected $insert = ['user_id', 'message'];
    protected $update = ['user_id', 'message', 'read'];


    public static function notRead () {
        return self::where('user_id', auth()->id())->where('read', 0)->get();
    }


}
