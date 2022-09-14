<?php 

namespace App\Http\Middleware;

use Closure;
use App\Infinity\General;


class LoadData {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        General::loadData();

        return $next($request);
    }

}