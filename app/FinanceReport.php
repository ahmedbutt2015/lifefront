<?php

namespace App;

use DB;
use App\Http\Helpers\Crud;
use Illuminate\Database\Eloquent\Model;

class FinanceReport extends Model
{

    use Crud;

    protected $table = 'finance_reports';
    protected $guarded = [];
    protected $insert = ['character_id', 'client_id', 'revenue', 'expense', 'commission', 'bonus', 'job_id'];
    protected $casts = [
        'created_at' => 'date:d/m/Y'
    ];

    public static function getReportData ($ch_id) {
        return self::select('finance_reports.id', 'finance_reports.created_at')
                   ->selectRaw('IFNULL(SUM(revenue),0) AS revenue')
                   ->selectRaw('IFNULL(SUM(expense),0) AS expense')
                   ->selectRaw('IFNULL(SUM(commission),0) AS commission')
                   ->selectRaw('IFNULL(SUM(bonus),0) AS bonus')
                   ->selectRaw('CONCAT(characters.first_name," ",characters.last_name) AS client_name')
                   ->selectRaw('CONCAT("/city/",characters.prefix,"/",characters.address) AS client_link')
                   ->leftJoin('characters', 'characters.id', 'finance_reports.client_id')
                   ->where('finance_reports.character_id', $ch_id)
                   ->whereRaw('finance_reports.job_id = (select job from characters where id = ? limit 1)', [$ch_id])
                   ->groupBy(DB::raw('date(finance_reports.created_at)'))
                   ->get();
    }


}
