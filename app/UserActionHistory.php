<?php

namespace App;

use App\Http\Helpers\Crud;
use Illuminate\Database\Eloquent\Model;

class UserActionHistory extends Model
{

    use Crud;

    protected $guarded = [];
    protected $insert = ['created_by', 'action_to', 'status', 'action', 'description', 'callback'];
    protected $casts = [
        'created_at' => 'date:d-m-Y h:i A'
    ];

    public static function getUserHistory () {
        $character = auth()->user()->character->id;

        return self::select('user_action_histories.*')
                   ->selectRaw('CONCAT(ch1.first_name," ",ch1.last_name) AS from_name')
                   ->selectRaw('CONCAT(ch2.first_name," ",ch2.last_name) AS to_name')
                   ->selectRaw('CONCAT("/city/",ch1.prefix,"/",ch1.address) AS from_profile')
                   ->selectRaw('CONCAT("/city/",ch2.prefix,"/",ch2.address) AS to_profile')
                   ->where('created_by', $character)
                   ->orWhere('action_to', $character)
                   ->leftJoin('characters as ch1', 'ch1.id', 'user_action_histories.created_by')
                   ->leftJoin('characters as ch2', 'ch2.id', 'user_action_histories.action_to')
                   ->latest()->get();
    }


    public static function addMarriageRequest ($to) {
        $character = auth()->user()->character;
        if ($character) {
            return self::create([
                'created_by'  => $character->id,
                'action_to'   => $to,
                'action'      => 'Marriage Request',
                'callback'    => 'marriageAction',
                'description' => '',
            ]);
        }
        return false;
    }

    public static function existPendingMarriageRequest ($to) {
        $character = auth()->user()->character;
        $exist = self::where('action_to', $to)->where('created_by', $character->id)->where('callback', 'marriageAction')->where('status', 'pending')->get();
        if ($exist->count()) {
            return true;
        }
        return false;
    }

    public static function steal ($input) {
        $ar = ['yes', 'no'];
        $do = $ar[array_rand($ar)];
        if ($do === 'yes') {
            $thief = Character::find($input['created_by']);
            $victim = Character::find($input['action_to']);

            $total = $victim->cash * .8;

            $victim->cash -= $total;
            $thief->cash += $total;
            $victim->save();
            $thief->save();
            $input['action'] = "Stool $total MO";
            self::addUpdate($input);
            return true;
        }
        return false;
    }
}
