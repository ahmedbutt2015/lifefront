<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuySubscriptionPlan extends Model
{
    protected $guarded = [];
    protected $table = 'buy_subscription_plans';
    public static function getBuyerSub ($ch_id,$id) {
        return self::select('buy_subscription_plans.*', 'characters.first_name','characters.last_name',)
        ->leftJoin('characters', 'characters.id', 'buy_subscription_plans.keeper_id')
                   ->where('job_id', $id)
                   ->where("character_id",$ch_id)
                   ->get();
    }
}
