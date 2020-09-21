<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Neighbourhood extends Model
{

    public function places () {
        return $this->belongsToMany(Place::class);
    }


    public function indications () {
        return $this->hasMany(NeighbourhoodIndication::class)
                    ->select('neighbourhood_indications.*', 'indication_bars.english_name', 'indication_bars.french_name', 'indication_bars.daily_points', 'indication_bars.min', 'indication_bars.max')
                    ->join('indication_bars', 'indication_bars.id', 'neighbourhood_indications.indication_id');
    }
}
