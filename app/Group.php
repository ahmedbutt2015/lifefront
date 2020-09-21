<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    protected $guarded = [];

    public function companies () {
        return $this->hasMany(Company::class);
    }

    public static function addGroup ($data, $character_id) {
        $group = self::create([
            'name'         => $data['group_name'],
            'character_id' => $character_id,
        ]);

        if ($group) {
            $path = self::UploadFile('company_logo', '/company_logo/');
            $company = Company::create([
                'name'         => $data['company_name'],
                'group_id'     => $group->id,
                'character_id' => $character_id,
                'logo'         => $path,
                'job_id'       => $data['company_job'],
                'capital'      => $data['company_capital']
            ]);
            if ($company)
                return true;
        }
        return false;
    }


    private static function UploadFile ($field_name, $storagePath) {
        $imageName = time() . '.' . request()->{$field_name}->getClientOriginalExtension();
        request()->{$field_name}->move(public_path($storagePath), $imageName);
        return url($storagePath . '/' . $imageName);
    }


}
