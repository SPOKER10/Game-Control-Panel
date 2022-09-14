<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Infinity\General;
use App\Demis;
use Auth;
use DB;
use App\User;
use App\Option;
use HTMLPurifier_Config;
use HTMLPurifier;
use Redirect;

class DemisController extends Controller
{
	
    public function __construct()
    {

    }
	
	public function appList(Request $request)
	{
		return view('demis.list',['apps' => Demis::type($request->segment(2),$request->route('faction') ?: $request->route('faction'))->orderBy('created_at','desc')->paginate(15),'type' => ucfirst($request->segment(2))]); 
	}

	public function appCreate(Request $request)
	{
		if($request->segment(2) === 'faction') $q = Option::where('option_name',$request->segment(2).'Questions'.$request->route('faction'))->first();
		if(!isset($q)) $q = Option::where('option_name',$request->segment(2).'Questions'.$request->route('faction'))->orWhere('option_name',$request->segment(2).'Questions')->first();
		if(!$q) return Redirect::back()->with(['type' => 'danger','message' => trans('messages.error')]);
		return view('demis.create',['questions' => json_decode($q->option_value)]);
	}
	
	public function appCreatePost(Request $request)
	{
		if($request->segment(2) === 'faction') $qq = Option::where('option_name',$request->segment(2).'Questions'.$request->route('faction'))->first();
		if(!isset($qq)) $qq = Option::where('option_name',$request->segment(2).'Questions'.$request->route('faction'))->orWhere('option_name',$request->segment(2).'Questions')->first();
		if(!$qq) return Redirect::back()->with(['type' => 'danger','message' => trans('messages.error')]);
		
		$request->flash();
		$user = Auth::user();

		if($request->route('faction') != $user->Member)
            return Redirect::back()->withErrors(['Nu faci parte din aceasta factiune.']);
		$unban = Demis::where('demis_userid',Auth::user()->ID)->whereIn('demis_status',[0])->first();
		if($unban && !$unban->unban_status)
			return Redirect::back()->withErrors([trans('Ai deja o cerere de demisie activa.')]);
		
		$qq = json_decode($qq->option_value);
		$config = HTMLPurifier_Config::createDefault();
		$purifier = new HTMLPurifier($config);

		$code = General::getUnique();

		Demis::create(['demis_userid' => $user->ID, 'demis_code' => $code, 'demis_type' => 0,'Motiv' => $purifier->purify($request->input('a1')),'Prec' => $purifier->purify($request->input('a2')), 'demis_faction' => $request->route('faction') ? $request->route('faction') : 0]);
		$users = User::where('Member',$user->Member)->where('Rank',10)->get();
		foreach($users as $u) { DB::table('emails')->insert(['playerid' => $u->ID,'Time' => date('Y-m-d H:i:s'),'Message' => $user->name.' a creat o cerere de demisie.','LinkPanel' => 'applications/view/' . $code, 'Skin' => $user->SkinID, 'OI' => 3]); }
		return redirect('demis/view/' . $code);
	}
	
	public function appView($app)
	{
		$a = Demis::where('demis_code',$app)->first();
		if(!$a) return view('errors.404'); // errors.404
		return view('demis.view',['app' => $a]);
	}
	
	public function appViewPost($app)
	{
		$a = Demis::where('demis_code',$app)->first();
		if(!$a) return view('errors.404'); // errors.404
		$user = Auth::user();
		if($user->AdminLevel >= 5 || ($user->Member == $a->faction && $user->Rank > 5))
		{
			if((isset($_POST['app_accept']) || isset($_POST['app_reject'])) && $a->demis_status != 0) return Redirect::back();
			$text = '';
			if(isset($_POST['app_accept'])) { $a->demis_status = 1; $a->Accby = $user->ID; $text = 'acceptat'; }
			else if(isset($_POST['app_reject'])) { $a->demis_status = 2; $a->Accby = $user->ID; $text = 'respins'; }
			if(!isset($_POST['demisc']) || trim($_POST['demisc'])==='' ? ($a->OPrec = 'No') : ($a->OPrec = $_POST['demisc']))
			DB::table('emails')->insert(['playerid' => $a->user->ID, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a '.$text.' demisia ta.', 'LinkPanel' => 'demis/view/' . $a->demis_code, 'Skin' => $user->SkinID, 'OI' => 1]);
			if(User::find($a->demis_userid)->Status == 1)
			{
			    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
			    if(@socket_connect($socket, '193.203.39.215', '7778'))
		    	{
					$coad = "1|".User::find($a->demis_userid)->Pid."|".'* '.$user->name.' a '.$text.' demisia ta.'."";
					socket_write($socket, $coad, strlen($coad));
			    }
			    socket_close($socket);
		    }
			$a->save(); $a->push();
			return Redirect::back()->with('message','Ai ' . $text . ' demisia.');
		}
		return view('demis.view',['app' => $a]);
	}
}
