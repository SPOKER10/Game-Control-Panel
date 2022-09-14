<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Donation;

class Donate
{
    public function handle($request, Closure $next)
    {
		$app = Donation::where('donateID',$request->route('donation'))->first();
        $user = Auth::user();
		if($user->AdminLevel < 6) {
			if($user->name == $app->donateName) return $next($request);
		} else return $next($request);
        return redirect('/')->with(['title' => 'Failed','type' => 'danger','message' => trans('messages.unauthorized')]);;
    }
}
