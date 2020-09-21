<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function character () {
        return $this->hasOne(Character::class, 'user_id', 'id')
                    ->select('characters.*', 'job_and_diplomas_jobs.job_name')
                    ->leftJoin('job_and_diplomas_jobs', 'job_and_diplomas_jobs.id', 'characters.job')
                    ->with('indications');
    }

    public static function getUser ($id = '') {
        if ($id == '') {
            $id = auth()->id();
        }

        return self::where('id', $id)->with('character')->first();
    }


}
