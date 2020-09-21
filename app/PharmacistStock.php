<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PharmacistStock extends Model
{

    protected $guarded = [];

    public static function getStock ($id, $type = 'back') {
        return self::select('pharmacist_stocks.*', 'medications.name', 'medications.min_price', 'medications.max_price','medications.cures')
                   ->selectRaw('"1" as put')
                   ->leftJoin('medications', 'medications.id', 'pharmacist_stocks.medication_id')
                   ->where('character_id', $id)
                   ->where('status', $type)
                   ->get();
    }


}
