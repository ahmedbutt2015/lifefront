<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostObject extends Model
{

    protected $table = 'post_manufactured_objects';

    public function parts () {
        if ($this->relation == 'post')
            return $this->belongsToMany(PostObject::class, 'post_to_post_manufactured_object_relations', 'post_id', 'pre_id')
                        ->withPivot(['quantity']);
        else
            return $this->belongsToMany(PreObject::class, 'post_to_pre_manufactured_object_relations', 'post_id', 'pre_id')
                        ->withPivot(['quantity']);
    }

    public static function getAll ($name, $value, $with = false) {
        return self::where($name, $value)
                   ->when($with, function ($q) {
                       return $q->with('parts');
                   })->get();
    }
 
    public static function getAllWithStockForRestroKeeper ($job_id, $keeper_id) {
        return self::where('sold_by', $job_id)
                   ->select('post_manufactured_objects.*')
                   ->selectRaw("(SELECT IFNULL(SUM(quantity),0) FROM restaurant_ingredients_stocks WHERE product_id = post_manufactured_objects.id AND keeper_id = ?)AS stock", [$keeper_id])
                   ->get();
    }
    public static function getAllWithStockForShopKeeper ($job_id, $keeper_id) {
        return self::select('post_manufactured_objects.*')
                   ->selectRaw("(SELECT IFNULL(SUM(quantity),0) FROM shopkeeper_ingredients_stocks WHERE product_id = post_manufactured_objects.id AND keeper_id = ?)AS stock", [$keeper_id])
                   ->having('stock','>',0)->get();
    }
    public static function getAllWithStockPhoneSeller ($job_id, $keeper_id) {
        return self::select('post_manufactured_objects.*')
                   ->selectRaw("(SELECT IFNULL(SUM(quantity),0) FROM phone_seller_ingredients_stocks WHERE product_id = post_manufactured_objects.id AND keeper_id = ?)AS stock", [$keeper_id])
                   ->having('stock','>',0)->get();
    }

    public static function getWithStock ($id, $keeper) {
        return self::select('post_manufactured_objects.*')
                   ->selectRaw("(SELECT IFNULL(SUM(quantity),0) FROM restaurant_ingredients_stocks WHERE product_id = post_manufactured_objects.id AND keeper_id = ?)AS stock", [$keeper])
                   ->where('id', $id)
                   ->first();
    }

    public static function getWithStockForFarmer ($id, $farmer) {
        return self::select('post_manufactured_objects.*')
                   ->selectRaw("(SELECT IFNULL(SUM(quantity),0) FROM farm_stock WHERE product_id = post_manufactured_objects.id AND farmer_id = ?)AS stock", [$farmer])
                   ->where('id', $id)
                   ->first();
    }

    public static function findOne ($id, $farmer) {

        return self::where('post_manufactured_objects.id', $id)
                   ->select('post_manufactured_objects.*', 'post_to_pre_manufactured_object_relations.quantity', 'post_to_pre_manufactured_object_relations.pre_id as animal')
                   ->selectRaw('(select sum(farm_animals.quantity) from farm_animals
                     where farm_animals.animal_id = post_to_pre_manufactured_object_relations.pre_id
                     and farm_animals.farmer_id = ? )as stock', [$farmer])
                   ->leftJoin('post_to_pre_manufactured_object_relations', 'post_to_pre_manufactured_object_relations.post_id', 'post_manufactured_objects.id')
                   ->first();
    }
    public static function findOneFactory ($id, $farmer) {

        return self::where('post_manufactured_objects.id', $id)
                   ->select('post_manufactured_objects.*', 'post_to_pre_manufactured_object_relations.quantity', 'post_to_pre_manufactured_object_relations.pre_id as animal')
                   ->selectRaw('(select sum(factory_animals.quantity) from factory_animals
                     where factory_animals.animal_id = post_to_pre_manufactured_object_relations.pre_id
                     and factory_animals.factory_id = ? )as stock', [$farmer])
                   ->leftJoin('post_to_pre_manufactured_object_relations', 'post_to_pre_manufactured_object_relations.post_id', 'post_manufactured_objects.id')
                   ->first();
    }
    public static function getWithStockForFactory ($id, $farmer) {
        return self::select('post_manufactured_objects.*')
                   ->selectRaw("(SELECT IFNULL(SUM(quantity),0) FROM factory_stock WHERE product_id = post_manufactured_objects.id AND factory_id = ?)AS stock", [$farmer])
                   ->where('id', $id)
                   ->first();
    }
    
}
