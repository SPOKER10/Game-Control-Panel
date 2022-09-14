<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Application;

class App
{
    public function handle($request, Closure $next)
    {
		$app = Application::where('application_code',$request->route('app'))->first();
        $user = Auth::user();
		if($user->AdminLevel < 5) {
			if($user->ID == $app->application_userid || ($app->application_type == 0 && ($user->Member == $app->application_faction && $user->Rank > 5))) return $next($request);
		} else return $next($request);
        return redirect('/')->with(['title' => 'Failed','type' => 'danger','message' => trans('messages.unauthorized')]);;
    }
}