<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CLeader
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->CRank == 7)  return $next($request);
        else {
            if($request->ajax()) { return response('Unauthorized.', 401); }
            else { return redirect()->intended('/')->with(['title' => 'Failed','type' => 'danger','message' => trans('messages.unauthorized')]); }
        }
       
    }
}
