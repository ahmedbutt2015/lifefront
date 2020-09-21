<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiagnoseRequest extends Model
{

    protected $table = 'diagnose_requests';
    protected $guarded = [];

    public static function getRequests ($id, $status = 'pending') {
        return self::select('diagnose_requests.*','characters.address','characters.prefix')
                   ->selectRaw("CONCAT(characters.first_name,' ',characters.last_name) as full_name")
                   ->leftJoin('characters', 'characters.id', 'diagnose_requests.client_id')
                   ->where('practitioner_id', $id)
                   ->where('diagnose_requests.status', $status)->get();
    }


}
