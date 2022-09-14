<?php



namespace App\Http\Middleware;



use Closure;

use Illuminate\Support\Facades\Auth;
use App\Clan;
use App\ClanApp;



class ClanApps

{

    public function handle($request, Closure $next)

    {

        Clan::findOrFail($request->route()->parameter('clan'));

        if(!in_array($request->route()->parameter('type'), ['applications', 'resignations']))

            return abort(404);

        return $next($request);

    }

}