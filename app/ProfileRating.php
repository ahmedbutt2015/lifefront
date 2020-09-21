<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileRating extends Model
{

    protected $guarded = [];
    protected $primaryKey = 'id';

    protected $casts = [
        'created_at' => 'date:d/m/Y'
    ];

    public static function addRating ($ch_id, $rating) {
        $rated_by = auth()->user()->character;
        if ($rated_by) {
            $rated = self::where('character_id', $ch_id)->where('rated_by', $rated_by->id)->first();
            if ( !$rated) {
                self::create([
                    'character_id' => $ch_id,
                    'rated_by'     => $rated_by->id,
                    'rating'       => $rating,
                ]);
                return self::getRating($ch_id);
            }
        }
        return false;
    }

    public static function getRating ($ch_id) {
        return self::selectRaw('ROUND(IFNULL(SUM(rating),0)) AS rating')->where('character_id', $ch_id)->value('rating');
    }


}
