<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckExpire
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
        $user = Auth::user();
        if ($user['role'] == 'member') {
            $expireDate = $user['trial_expired'];
            if ($user['type'] == 'paid') {
                $expireDate = $user['package_expired'];
            }

            if ($expireDate > date('Y-m-d')) {
                return redirect('backend/payment');
            }
        }

        return $next($request);
    }
}
