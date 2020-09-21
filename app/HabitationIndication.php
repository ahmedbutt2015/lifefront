<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HabitationIndication extends Model
{

    public static function  getBar ($id, $indication_id) {
        return self::where('habitation_id', $id)->where('indication_id', $indication_id)->first();
    }


    public static function getAllBars ($id = '') {
        if ($id == '') {
            $id = auth()->user()->character->id;
        }

        $habitation = \DB::table('character_habitations')->where('character_id', $id)->latest()->first();
        return self::select('habitation_indications.*', 'indication_bars.english_name', 'indication_bars.french_name')
                   ->leftJoin('indication_bars', 'indication_bars.id', 'habitation_indications.indication_id')
                   ->where('habitation_id', $habitation->id)->get();
    }


}
