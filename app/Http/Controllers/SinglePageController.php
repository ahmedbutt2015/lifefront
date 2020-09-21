<?php

namespace App\Http\Controllers;

use App\User;
use App\LoginTime;
use Illuminate\Http\Request;
use App\GiftNotification;
use App\Gift;
use App\LoginHour;
class SinglePageController extends Controller
{

    public function __construct () {
        $this->middleware('auth')->only('index');
    }

    public function landing () {
        if (auth()->check()){
            return  redirect('/account');
        }
        return view('landing');
    }

    public function index () {
        $user = User::getUser();
        $EntranceLog = LoginTime::where('user_id', '=', $user->id)->first();
     
        if(empty ( $EntranceLog )) {
        $EntranceLog = new LoginTime();
        $EntranceLog->user_id = $user->id;
        $EntranceLog->loged_in_at = date('Y-m-d H:i:s');
        $EntranceLog->save();
        }

        $gifts = Gift::getGift();
        $LoginHour = LoginHour::where('user_id', '=', $user->id)->first();
        if ( !empty ( $LoginHour ) ) {
            
            foreach($gifts as $g){
                if($g->days==$LoginHour->login_hours && $LoginHour->status =="panding"){
                    GiftNotification::sendGift($user->id,$g);
                    $LoginHour->status="send";
                    $LoginHour->save();                 
                }
            }      
        }
     
        return view('app',compact('user'));
    }

    public function loginlayout () {
        return view('login');
    }


}
