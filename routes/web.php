<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get("run-age-query", function () {
    dd(\App\FarmAnimal::getAll(1));
    $characters = \App\Character::where('status', 'live')->get();
    $setting = \Illuminate\Support\Facades\DB::table('settings')->where('id', 1)->first();
    $timeForYear = $setting->no_of_days_for_one_year;
    foreach ($characters as $character) {
        $days = $character->created_at->diffInDays(Carbon::now());
        $character->age = floor($days / $timeForYear) + 18;
        $character->save();
    }
    print "done";
});

Route::get("testCommand", function () {
    \Artisan::call('age-handle');
});

Route::get("testing", function () {
    return dd('testing');

});

Route::get('/', 'SinglePageController@landing');
Route::post('ajax/getRecaptchaKey', 'AjaxController@getRecaptchaKey');


Route::middleware('guest')->group(function () {
    Route::get('/login', 'SinglePageController@loginlayout')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('/register', 'SinglePageController@loginlayout');
    Route::post('register', 'Auth\RegisterController@register');
    Route::get('verifythisemail', 'Auth\LoginController@verify');

    Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider');
    Route::get('login/{driver}/callback', 'Auth\LoginController@handleProviderCallback');

});
Route::middleware('auth')->group(function () {
    Route::get('/account', 'SinglePageController@index');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('logout', 'Auth\LoginController@logout');
    Route::post('ajax/{method}', 'AjaxController@index');
    Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');
});
