<?php

namespace App;

use App\Http\Helpers\Crud;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{

    use Crud;
    protected $table = "messages";
    protected $guarded = [];
    protected $insert = ['message', 'from', 'to'];

    public function char(){
        return $this->belongsTo('app\Character');
    }
    public static function getChatDetails ($character,$contact) {
        return self::whereIn('from',[$character,$contact])->whereIn('to',[$character,$contact])->get();
    }
    public static function getChatDetailsAll ($id) {
            return self::selectRaw('IF(messages.from!=?,c1.first_name,c2.first_name) as first_name',[$id])
            ->selectRaw('IF(messages.from!=?,c1.last_name,c2.last_name) as last_name',[$id])
            ->selectRaw('IF(messages.from!=?,c1.id,c2.id) as id',[$id])
            ->where(function($q) use($id){
                $q->whereIn('from',[$id])
                ->orWhereIn('to',[$id]);
            })
        ->leftJoin("characters as c1",'c1.id','=','messages.from')
        ->leftJoin("characters as c2",'c2.id','=','messages.to')
        ->groupBy('id')->get();
    }
    
    


}
