<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyEmployee extends Model
{

    protected $guarded = [];

    protected $casts = [
        'joining_date' => 'date:d/m/Y',
    ];

    public static function getEmployees ($c_id) {
        return self::select('company_employees.*', 'characters.address', 'characters.prefix')
                   ->selectRaw('CONCAT(characters.first_name," ",characters.last_name) as employee_name')
                   ->leftJoin('characters', 'characters.id', 'company_employees.employee_id')
                   ->where('company_employees.company_id', $c_id)
                   ->get();
    }


}
