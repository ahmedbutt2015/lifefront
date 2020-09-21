<?php

namespace App;

use App\Http\Helpers\Crud;
use Illuminate\Database\Eloquent\Model;

class Intimate extends Model
{
    use Crud;
    protected $insert = ['status'];
    protected $table = 'character_intercourse_requests';
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'date:d/m/Y'
    ];

    public static function getUserRequests () {
        $id = auth()->user()->character->id;
        return self::where('requested_to', $id)
                   ->orWhere('requested_by', $id)
                   ->select('character_intercourse_requests.*')
                   ->selectRaw('(SELECT CONCAT(ch.first_name," ",ch.last_name) FROM characters AS ch WHERE ch.id = character_intercourse_requests.requested_by)AS sender')
                   ->selectRaw('(SELECT CONCAT("/city/",ch.prefix,"/",ch.address) FROM characters AS ch WHERE ch.id = character_intercourse_requests.requested_by)AS sender_link')
                   ->selectRaw('(SELECT CONCAT(ch.first_name," ",ch.last_name) FROM characters AS ch WHERE ch.id = character_intercourse_requests.requested_to)AS receiver')
                   ->selectRaw('(SELECT CONCAT("/city/",ch.prefix,"/",ch.address) FROM characters AS ch WHERE ch.id = character_intercourse_requests.requested_to)AS receiver_link')
                   ->get();
    }


}
