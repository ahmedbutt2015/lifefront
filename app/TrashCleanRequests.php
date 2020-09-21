<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrashCleanRequests extends Model
{

    protected $casts = [
        'created_at' => 'date:d/m/Y'
    ];

    protected $guarded = [];

    public static function getRequestsForDustMan ($requested_by, $company_id) {
        return self::select('trash_clean_requests.*')
                   ->selectRaw("concat(characters.first_name,' ',characters.last_name) as full_name")
                   ->selectRaw("'VILLA' as habitation")//todo  replace with real habitation name
                   ->leftJoin('characters', 'characters.id', 'trash_clean_requests.requested_by')
//                    ->leftJoin('characters','characters.id','trash_clean_requests.dust_man') todo add habitation name and then get it from there
                   ->where('dust_man', $requested_by)
                   ->where('trash_clean_requests.status', 'pending')
                   ->where('company_id', $company_id)
                   ->get();
    }

    public static function getRequestsForVisitor ($requested_by, $company_id) {
        return self::select('trash_clean_requests.*')
                   ->selectRaw("concat(characters.first_name,' ',characters.last_name) as dustman_name")
                   ->selectRaw("'VILLA' as habitation")//todo  replace with real habitation name
                   ->leftJoin('characters', 'characters.id', 'trash_clean_requests.dust_man')
//                    ->leftJoin('characters','characters.id','trash_clean_requests.dust_man') todo add habitation name and then get it from there
                   ->where('requested_by', $requested_by)
                   ->where('trash_clean_requests.status', 'close')
                   ->where('company_id', $company_id)
                   ->get();
    }


}
