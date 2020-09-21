<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    //
    protected $guarded = [];

 
    public static function getOpenJobs () {
        return self::select('job_offers.*','job_and_diplomas_jobs.job_name','companies.name as company','companies.logo as company_logo','characters.first_name as firstname'
        ,'characters.last_name as lastname')
            ->leftJoin('job_and_diplomas_jobs','job_and_diplomas_jobs.id','job_offers.job_id')
            ->leftJoin('companies','companies.id','job_offers.company_id')
            ->leftJoin('characters','characters.id','job_offers.posted_by')
            ->where('job_offers.status','open')
            ->get();
    }
}
