<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadImage ($field_name) {
        $imageName = time() . '.' . request()->{$field_name}->getClientOriginalExtension();
        request()->{$field_name}->move(public_path('storage/images'), $imageName);
        return "storage/images/" . $imageName;
    }
}
