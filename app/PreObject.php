<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreObject extends Model
{

    protected $table = 'pre_manufactured_objects';

    public function parts () {
        return $this->belongsToMany(PostObject::class, 'post_to_pre_manufactured_object_relations', 'pre_id', 'post_id')
                    ->withPivot(['quantity']);
    }


    public static function getObjects ($job_id) {
        $objects = self::where('job_id', $job_id)->with('parts')->get();
        foreach ($objects as $object) {
            $part = $object->parts->first();
            unset($object->parts);
            if ($part) {
                $object->part = ['name' => $part->object_name, 'quantity' => $part->pivot->quantity];
            } else {
                $object->part = ['name' => "", 'quantity' => ""];
            }
        }
        return $objects;
    }

    public static function getObjectsForList ($job_id) {
        return self::select('object_name as text', 'id as value')->where('job_id', $job_id)->get();
    }


}
