<?php

namespace App;

use App\Http\Helpers\Crud;
use Illuminate\Database\Eloquent\Model;

class Children extends Model
{

    use Crud;

    protected $table = 'children';
    protected $insert = ['first_name', 'last_name', 'age', 'gender', 'parent1', 'parent2', 'image'];
    protected $guarded = [];

    public function parent () {
        return $this->belongsTo(Character::class,'parent1');
    }

    public function indications () {
        return $this->hasMany(ChildrenIndication::class,'child_id')
            ->select('children_indications.*', 'indication_bars.english_name', 'indication_bars.french_name', 'indication_bars.daily_points', 'indication_bars.min', 'indication_bars.max')
            ->join('indication_bars', 'indication_bars.id', 'children_indications.indication_id');
    }


    public function addIndications () {
        $all = \DB::table('indication_bars')->where('apply_to', 'children')->get();
        $insert = [];
        foreach ($all as $row) {
            $insert[] = [
                'child_id'      => $this->id,
                'indication_id' => $row->id,
                'points'        => $row->points,
            ];
        }

        CharacterIndication::insert($insert);
    }


}
