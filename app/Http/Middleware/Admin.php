<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle($request, Closure $next, $level = 1)
    {
        if(Auth::user()->Admin < $level) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->intended('/')->with(['title' => 'Failed','type' => 'danger','message' => trans('messages.unauthorized')]);
            }
        }
        return $next($request);
    }
}
