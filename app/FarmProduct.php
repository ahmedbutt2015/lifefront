<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class FarmProduct extends Model
{

    protected $table = 'farm_stock';
    protected $guarded = [];

    public static function InProcess ($farmer = null) {
        $inProduction = self::select('farm_stock.*', 'post_manufactured_objects.production_time', 'post_manufactured_objects.object_name as name', 'post_manufactured_objects.icon')
                            ->leftJoin('post_manufactured_objects', 'post_manufactured_objects.id', 'farm_stock.product_id')
                            ->where('in_production', true)
                            ->when($farmer, function ($q) use ($farmer) {
                                return $q->where('farmer_id', $farmer);
                            })
                            ->get();
        if ($inProduction) {
            foreach ($inProduction as $pro) {
                $diff = Carbon::parse($pro->created_at)->diffInSeconds(Carbon::now());
                $pro->complete_in = $pro->production_time - $diff > 0 ? $pro->production_time - $diff : 0;
            }
        }
        return $inProduction;
    }

    public static function stock ($farmer) {
        return self::select('farm_stock.*', 'post_manufactured_objects.production_time', 'post_manufactured_objects.object_name as name', 'post_manufactured_objects.icon')
                   ->selectRaw('round(SUM(farm_stock.quantity)) as quantity')
                   ->leftJoin('post_manufactured_objects', 'post_manufactured_objects.id', 'farm_stock.product_id')
                   ->where('in_production', false)
                   ->where('farmer_id', $farmer)
                   ->groupBy('farm_stock.product_id')
                   ->get();

    }


}
