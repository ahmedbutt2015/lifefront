<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Helpers\Crud;
use Illuminate\Support\Facades\DB;


class FactoryOrders extends Model
{
    //factory_orders
    use Crud;

    protected $guarded = [];
    protected $table = 'factory_orders';
    protected $insert = ['factory_id', 'client_id', 'product_id', 'delivery_id', 'price', 'charges', 'quantity', 'status'];

    public static function getOffers ($id) {
        return self::select('factory_orders.*', 'post_manufactured_objects.object_name', 'post_manufactured_objects.icon')
                   ->leftJoin('post_manufactured_objects', 'post_manufactured_objects.id', 'factory_orders.product_id')
                   ->where('client_id', $id)
                   ->where('status', 'pending')
                   ->get();
    }

    public static function getRequests ($id, $inprocess = false) {
        return self::select('factory_orders.*', 'post_manufactured_objects.object_name', 'post_manufactured_objects.icon')
                   ->selectRaw('(SELECT CONCAT(first_name," ",last_name) FROM characters WHERE characters.id = factory_orders.factory_id) AS sender_name')
                   ->selectRaw('(SELECT CONCAT(first_name," ",last_name) FROM characters WHERE characters.id = factory_orders.client_id) AS receiver_name')
                   ->leftJoin('post_manufactured_objects', 'post_manufactured_objects.id', 'factory_orders.product_id')
                   ->where('delivery_id', $id)
                   ->when(!$inprocess, function ($q) {
                       return $q->where('status', 'accepted');
                   })
                   ->when($inprocess, function ($q) {
                       return $q->where('status', 'inprocess')
                                ->selectRaw('"30" AS complete_in');
                   })
                   ->get();
    }

    public static function action ($action, $id) {
        $offer = self::find($id);
        $msg = '';
        $total = $offer->price * $offer->quantity;
        $keeper = Character::find($offer->client_id);
        $farmer = Character::find($offer->factory_id);
        if ($action == 'accept') {
            if ($keeper->cash >= $total) {
                $keeper->cash -= $total;
                $keeper->save();

                $farmer->cash += $total;
                $farmer->save();


                $offer->status = 'accepted';
                $offer->save();

                RestaurantIngredientsStock::insert([
                    'keeper_id'  => $offer->client_id,
                    'product_id' => $offer->product_id,
                    'quantity'   => $offer->quantity,
                ]);

                FinanceReport::addUpdate([
                    'character_id' => $offer->client_id,
                    'job_id'       => $keeper->job,
                    'client_id'    => $offer->factory_id,
                    'expense'      => $offer->quantity * $offer->price,
                    'revenue'      => 0,
                ]);

                FinanceReport::addUpdate([
                    'character_id' => $offer->factory_id,
                    'job_id'       => $farmer->job,
                    'client_id'    => $offer->client_id,
                    'revenue'      => $offer->quantity * $offer->price,
                    'expense'      => 0,
                ]);

                FactoryProduct::create([
                    'factory_id'  => $offer->factory_id,
                    'product_id' => $offer->product_id,
                    'quantity'   => -$offer->quantity,
                ]);


                $msg = "You cash cut and product delivered to your inventory";
            } else {
                $msg = "You dont have enough cash to accept offer right now";
            }
        } else {
            $offer->status = 'rejected';
            $offer->save();
            $msg = "Offer rejected successfully";
        }

        return [$keeper->id, $msg];
    }
    public static function actionShopKeeper ($action, $id) {
        $offer = self::find($id);
        $msg = '';
        $total = $offer->price * $offer->quantity;
        $keeper = Character::find($offer->client_id);
        $farmer = Character::find($offer->factory_id);
        if ($action == 'accept') {
            if ($keeper->cash >= $total) {
                $keeper->cash -= $total;
                $keeper->save();

                $farmer->cash += $total;
                $farmer->save();


                $offer->status = 'accepted';
                $offer->save();
                ShopkeeperIngredientsStock::insert([
                    'keeper_id'  => $offer->client_id,
                    'product_id' => $offer->product_id,
                    'quantity'   => $offer->quantity,
                ]);

                FinanceReport::addUpdate([
                    'character_id' => $offer->client_id,
                    'job_id'       => $keeper->job,
                    'client_id'    => $offer->factory_id,
                    'expense'      => $offer->quantity * $offer->price,
                    'revenue'      => 0,
                ]);

                FinanceReport::addUpdate([
                    'character_id' => $offer->factory_id,
                    'job_id'       => $farmer->job,
                    'client_id'    => $offer->client_id,
                    'revenue'      => $offer->quantity * $offer->price,
                    'expense'      => 0,
                ]);

                FactoryProduct::create([
                    'factory_id'  => $offer->factory_id,
                    'product_id' => $offer->product_id,
                    'quantity'   => -$offer->quantity,
                    
                ]);


                $msg = "You cash cut and product delivered to your inventory";
            } else {
                $msg = "You dont have enough cash to accept offer right now";
            }
        } else {
            $offer->status = 'rejected';
            $offer->save();
            $msg = "Offer rejected successfully";
        }

        return [$keeper->id, $msg];
    }
    public static function actionPhoneSeller ($action, $id) {
        $offer = self::find($id);
        $msg = ''; 
        $total = $offer->price * $offer->quantity;
        $keeper = Character::find($offer->client_id);
        $farmer = Character::find($offer->factory_id);
        if ($action == 'accept') {
            if ($keeper->cash >= $total) {
                $keeper->cash -= $total;
                $keeper->save();
                $farmer->cash += $total;
                $farmer->save();


                $offer->status = 'accepted';
                $offer->save();
                PhoneSellerIngredientsStock::insert([
                    'keeper_id'  => $offer->client_id,
                    'product_id' => $offer->product_id,
                    'quantity'   => $offer->quantity,
                ]);

                FinanceReport::addUpdate([
                    'character_id' => $offer->client_id,
                    'job_id'       => $keeper->job,
                    'client_id'    => $offer->factory_id,
                    'expense'      => $offer->quantity * $offer->price,
                    'revenue'      => 0,
                ]);

                 FinanceReport::addUpdate([
                    'character_id' => $offer->factory_id,
                    'job_id'       => $farmer->job,
                    'client_id'    => $offer->client_id,
                    'revenue'      => $offer->quantity * $offer->price,
                    'expense'      => 0,
                ]);
                
                
                FactoryProduct::create([
                    'factory_id'  => $offer->factory_id,
                    'product_id' => $offer->product_id,
                    'quantity'   => -$offer->quantity,
                    
                ]);


                $msg = "You cash cut and product delivered to your inventory";
            } else {
                $msg = "You dont have enough cash to accept offer right now";
            }
        } else {
            $offer->status = 'rejected';
            $offer->save();
            $msg = "Offer rejected successfully";
        }

        return [$keeper->id, $msg];
    }

}
