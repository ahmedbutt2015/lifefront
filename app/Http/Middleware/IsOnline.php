<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;


class IsOnline
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->check()){
            $expire_at = Carbon::now()->addMinutes(10);
            $user_id = auth()->id();
            Cache::put($user_id,$user_id,$expire_at);
        }

        return $next($request);
    }
}
