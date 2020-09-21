<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiftNotification extends Model
{
    protected $guarded = [];

    public static function myGift () {
        $character = auth()->user()->character->id;

        return self::select('gift_notifications.*')
                   ->selectRaw('CONCAT(ch1.first_name," ",ch1.last_name) AS from_name')
                   ->selectRaw('CONCAT(ch2.first_name," ",ch2.last_name) AS to_name')
                   ->selectRaw('CONCAT("/city/",ch1.prefix,"/",ch1.address) AS from_profile')
                   ->selectRaw('CONCAT("/city/",ch2.prefix,"/",ch2.address) AS to_profile')
                   ->where('created_by', $character)
                   ->orWhere('action_to', $character)
                   ->leftJoin('characters as ch1', 'ch1.id', 'gift_notifications.created_by')
                   ->leftJoin('characters as ch2', 'ch2.id', 'gift_notifications.action_to')
                   ->latest()->get();
    }


    public static function sendGift ($id,$gift) {
        GiftNotification::create([ 
            'description'=>'Mo : '.$gift->currency.' And  Diamonds : '.$gift->dimonds,
            'created_by'=>$id,
            'action_to'=>1,
            'status'=>'gift',
            
        ]);
    }
}
