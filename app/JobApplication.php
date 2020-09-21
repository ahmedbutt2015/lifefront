<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{

    protected $guarded = [];
    //
    protected $casts = [
        'created_at' => 'date:d/m/Y',
    ];

    public function offer () {
        return $this->belongsTo(JobOffer::class);
    }

    public static function getApplications ($ch_id,$job_id) {
        return self::select('job_applications.*', 'characters.address', 'characters.prefix')
                   ->selectRaw('CONCAT(characters.first_name," ",characters.last_name) as candidate')
                   ->leftJoin('characters', 'characters.id', 'job_applications.applied_by')
                   ->leftJoin('job_offers', 'job_offers.id', 'job_applications.offer_id')
                   ->where('job_offers.posted_by', $ch_id)
                   ->where('job_applications.job_id', $job_id)
                   ->where('job_applications.status', 'applied')
                   ->get();
    }


}
