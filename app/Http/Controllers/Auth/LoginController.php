<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Illuminate\Http\Request;
use App\LoginTime;
use App\LoginHour;


class LoginController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/account";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct () {
        $this->middleware('guest')->except('logout');
        // $this->middleware('guest');
    }
    public function logout(Request $request) {
        // $EntranceLog = LoginTime::where('loged_in_at', '>=', date('Y-m-d H:i:s', time()-86400))
        // ->whereNull('loged_out_at')
        // ->where('user_id', '=', Auth::user()->id)
        // ->orderBy('loged_in_at', 'desc')->first();
        $EntranceLog = LoginTime::where('user_id', '=', Auth::user()->id)->first();
            if($EntranceLog) {
            $EntranceLog->loged_out_at = date('Y-m-d H:i:s');
            $EntranceLog->save();
            $t1 = Carbon::parse($EntranceLog->loged_in_at);
            $t2 = Carbon::parse($EntranceLog->loged_out_at);
            $hours = $t1->diffInDays($t2);
            
            $LoginHour = LoginHour::where('user_id', '=', Auth::user()->id)->first();
            if(!$LoginHour) {
            $LoginHour = new LoginHour();
            $LoginHour->user_id = Auth::user()->id;
            }
            $LoginHour->login_hours = $hours;
            $LoginHour->save();
}    $EntranceLog->delete();
      Auth::logout();
      return redirect('/');
    }

    public function redirectToProvider ($driver) {
        return Socialite::driver($driver)->redirect();
    }


    public function handleProviderCallback ($driver) {
        $provided_user = Socialite::driver($driver)->user();
        $exist = User::where('email', $provided_user->getEmail())->first();
        if ($exist) {
            Auth::loginUsingId($exist->id);
            return redirect()->to('/account');
        } else {
            $user = User::create([
                'username'          => $provided_user->getName(),
                'email'             => $provided_user->getEmail(),
                'provider'          => $driver,
                'image'             => $provided_user->getAvatar(),
                'email_verified_at' => Carbon::now()->toDateString(),
            ]);

            Auth::loginUsingId($user->id);
            return redirect()->to('/account');
        }

    }

    public function verify () {
        $token = request('_token');
        $user = User::where('verification_token', $token)->first();
        if ($user) {
            $user->verification_token = null;
            $user->email_verified_at = Carbon::now()->toDateString();
            $user->save();
            Auth::loginUsingId($user->id);
            return redirect()->to('/account');
        }
        session()->flash('msg','Link time expired.');
        return redirect('/');
    }


}
