<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RestaurantPlates extends Model
{

    protected $guarded = [];

    public static function addToBack ($product_id, $keeper_id) {
        $inprocess = self::where('keeper_id', $keeper_id)
                         ->where('product_id', $product_id)
                         ->where('status', 'in_process')->first();
        $exist = self::where('keeper_id', $keeper_id)
                     ->where('product_id', $product_id)
                     ->where('status', 'back')->first();
        if ($exist) {
            $exist->quantity += $inprocess->quantity;
            $exist->save();
            $inprocess->delete();
        } else {
            $inprocess->status = 'back';
            $inprocess->save();
        }

    }

    public static function getInProcess ($id) {
        $data = self::select('restaurant_plates.*', 'post_manufactured_objects.icon', 'post_manufactured_objects.object_name', 'post_manufactured_objects.production_time')
                    ->leftJoin('post_manufactured_objects', 'post_manufactured_objects.id', 'restaurant_plates.product_id')
                    ->where('keeper_id', $id)
                    ->where('status', 'in_process')
                    ->get();
        foreach ($data as $pro) {
            $diff = Carbon::parse($pro->created_at)->diffInSeconds(Carbon::now());
            $pro->complete_in = $pro->production_time - $diff > 0 ? $pro->production_time - $diff : 0;
            $pro->complete_in =  10;
        }

        return $data;
    }

    public static function getBackShop ($id) {
        return self::select('restaurant_plates.*', 'post_manufactured_objects.icon', 'post_manufactured_objects.object_name', 'post_manufactured_objects.min_price', 'post_manufactured_objects.max_price')
                   ->selectRaw('"1" as put')
                   ->leftJoin('post_manufactured_objects', 'post_manufactured_objects.id', 'restaurant_plates.product_id')
                   ->where('keeper_id', $id)
                   ->where('status', 'back')
                   ->where('restaurant_plates.quantity', '>', '0')
                   ->groupBy('restaurant_plates.product_id')
                   ->get();
    }

    public static function getFrontShop ($id) {
        return self::select('restaurant_plates.*', 'post_manufactured_objects.icon', 'post_manufactured_objects.object_name')
                   ->selectRaw('"1" as put')
                   ->leftJoin('post_manufactured_objects', 'post_manufactured_objects.id', 'restaurant_plates.product_id')
                   ->where('keeper_id', $id)
                   ->where('status', 'front')
                   ->where('restaurant_plates.quantity', '>', '0')
                   ->groupBy('restaurant_plates.product_id')
                   ->get();
    }

    public static function savePrice ($price, $id) {
        return self::where('id', $id)->update([
            'price' => $price
        ]);
    }


    public static function putDish ($ch, $id, $current, $qty, $place = 'front') {
        $status = false;
        $msg = "Server Error";
        if ($place == 'front') {
            $back = self::where('keeper_id', $ch)->where('product_id', $id)->where('status', 'back')->first();
            $back->quantity = $current - $qty;
            $back->save();
            $front = self::where('keeper_id', $ch)->where('product_id', $id)->where('status', 'front')->first();
            if ($front) {
                $front->quantity += $qty;
                $front->save();
            } else {
                self::create([
                    'keeper_id'  => $back->keeper_id,
                    'product_id' => $back->product_id,
                    'quantity'   => $qty,
                    'price'      => $back->price,
                    'status'     => 'front',
                ]);
            }
            $msg = "Moved successfully";
        }
        if ($place == 'back') {
            $front = self::where('keeper_id', $ch)->where('product_id', $id)->where('status', 'front')->first();
            $front->quantity = $current - $qty;
            $front->save();
            $back = self::where('keeper_id', $ch)->where('product_id', $id)->where('status', 'back')->first();
            if ($back) {
                $back->quantity += $qty;
                $back->save();
            } else {
                self::create([
                    'keeper_id'  => $front->keeper_id,
                    'product_id' => $front->product_id,
                    'quantity'   => $qty,
                    'price'      => $front->price,
                    'status'     => 'back',
                ]);
            }
            $msg = "Moved successfully";
        }
        return [
            $status, $msg, self::getBackShop($ch), self::getFrontShop($ch)
        ];
    }


}
