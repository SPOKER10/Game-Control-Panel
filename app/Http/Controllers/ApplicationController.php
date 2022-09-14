<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Infinity\General;
use App\Application;
use Auth;
use DB;
use App\User;
use App\Option;
use HTMLPurifier_Config;
use HTMLPurifier;
use Redirect;

class ApplicationController extends Controller
{
	
    public function __construct()
    {

    }
	
	public function appList(Request $request)
	{
		return view('applications.list',['apps' => Application::type($request->segment(2),$request->route('faction') ?: $request->route('faction'))->orderBy('created_at','desc')->paginate(15),'type' => ucfirst($request->segment(2))]); 
	}

	public function appCreate(Request $request)
	{
		if($request->segment(2) === 'faction') $q = Option::where('option_name',$request->segment(2).'Questions'.$request->route('faction'))->first();
		if(!isset($q)) $q = Option::where('option_name',$request->segment(2).'Questions'.$request->route('faction'))->orWhere('option_name',$request->segment(2).'Questions')->first();
		if(!$q) return Redirect::back()->with(['type' => 'danger','message' => trans('messages.error')]);
		return view('applications.create',['questions' => json_decode($q->option_value)]);
	}
	
	public function appCreatePost(Request $request)
	{
		if($request->segment(2) === 'faction') $qq = Option::where('option_name',$request->segment(2).'Questions'.$request->route('faction'))->first();
		if(!isset($qq)) $qq = Option::where('option_name',$request->segment(2).'Questions'.$request->route('faction'))->orWhere('option_name',$request->segment(2).'Questions')->first();
		if(!$qq) return Redirect::back()->with(['type' => 'danger','message' => trans('messages.error')]);
		$s = Option::where('option_name',($request->segment(2) !== 'faction' ? $request->segment(2).'AppStatus' : $request->segment(2).'AppStatus'.$request->route('faction')))->first();
		$m = Option::where('option_name',($request->segment(2) !== 'faction' ? $request->segment(2).'Level' : $request->segment(2).'Level'.$request->route('faction')))->first();
		
		$request->flash();
		$user = Auth::user();
		if($request->segment(2) === 'faction' && $m && $m->option_value > $user->Score) return Redirect::back()->withErrors(['Nu ai nivelul necesar pentru a aplica. (Minim: '.$m->option_value.')']);
		if($app = Application::type($request->segment(2))->where('application_userid',$user->ID)->whereIn('application_status',[0,1])->first()) return Redirect::back()->withErrors([trans('messages.already_applied',['link' => $app->url])]);
		if($s && !$s->option_value) return Redirect::back()->withErrors([trans('messages.applications_closed')]);
		if($user->Member != 0 && $request->segment(2) === 'faction') return Redirect::back()->withErrors([trans('You are already in a faction.')]);
		if($user->FPunish != 0 && $request->segment(2) === 'faction') return Redirect::back()->withErrors([trans('You are fpunish.')]);
		$user->PAO++;
      	$user->save();
		$qq = json_decode($qq->option_value);
		$count = 0;
		$config = HTMLPurifier_Config::createDefault();
		$purifier = new HTMLPurifier($config);

		foreach($qq as $i=>$q) {
			$ans[$q] = $purifier->purify($request->input('a'.$i));
			if($request->input('a'.$i)) $count++;
		}
		if(count($qq) != $count) return Redirect::back()->withErrors([trans('messages.complete')]);
		else {
			$code = General::getUnique();
			switch($request->segment(2)) {
				case 'faction':
				{
					if($user->Status == 1)
					{
					    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
					    if(@socket_connect($socket, '193.203.39.215', '7778'))
				    	{
							$coad = "l|".Auth::user()->Pid."|".$request->route('faction')."";
							socket_write($socket, $coad, strlen($coad));
					    }
					    socket_close($socket);
				    }
					$type = 0; $text = 'la factiunea ta.'; $user->pAPPID = $request->route('faction'); $user->save(); break;
				}
				case 'leader': $type = 1; $text = 'de leader.'; break;
				case 'helper': $type = 2; $text = 'de helper.'; break;
			}
			Application::create(['application_userid' => $user->ID, 'application_code' => $code, 'application_type' => $type,'application_questions' => json_encode($ans), 'application_faction' => $request->route('faction') ? $request->route('faction') : 0]);

			if(!$type)
				$users = User::where('Member',$request->route('faction'))->where('Rank',10)->get();
			else
				$users = User::where('Admin','>=',5)->get();
			foreach($users as $u) {
				DB::table('emails')->insert([
					'playerid' => $u->ID,
					'Time' => date('Y-m-d H:i:s'),
					'Message' => $user->name.' a creat o noua aplicatie '.$text,
					'LinkPanel' => 'applications/view/' . $code,
					'Skin' => $user->SkinID,
					'OI' => 3
				]);
			}
			return redirect('applications/view/' . $code);
		}
		return view('applications.create',['questions' => $qq]);
	}
	
	public function appView($app)
	{
		$a = Application::where('application_code',$app)->first();
		return view('applications.view',['app' => $a]);
	}
	
	public function appViewPost($app)
	{
		$a = Application::where('application_code',$app)->first();
		$user = Auth::user();
		if(isset($_POST['app_cancel']) && in_array($a->application_status,[1,2,3,4])) return Redirect::back();
		if(isset($_POST['app_cancel']) && $a->application_userid == $user->ID) { $a->application_status = 4; $a->Accby = $user->ID; $a->save(); $a->push(); return Redirect::back()->with('message','Ai anulat aplicatia cu succes.'); }
		if(($user->AdminLevel >= 5) || $a->application_type == 0 && ($user->Member == $a->faction && ($user->Rank > 5 || ($user->pTester == 1 && isset($_POST['app_accept']))))) {

			if(isset($_POST['app_tests']) && $a->application_status != 0) return Redirect::back();
			if(isset($_POST['app_accept']) && $a->application_status != 1) return Redirect::back();
			if(isset($_POST['app_accept']) && $a->application_type == 0 && User::find($a->application_userid)->Member != $user->Member) return Redirect::back()->with('message','Jucatorul trebuie sa fie in factiunea ta pentru ai accepta aplicatia pe deplin.');
			if(isset($_POST['app_reject']) && in_array($a->application_status,[2,3,4])) return Redirect::back();

			$text = '';
			if(isset($_POST['app_tests'])) { $a->application_status = 1; $a->Accby = $user->ID; $text = 'acceptat pentru teste'; }
			else if(isset($_POST['app_accept'])) { $a->application_status = 2; $a->Accby = $user->ID; $text = 'acceptat'; }
			else if(isset($_POST['app_reject'])) { $a->application_status = 3; $a->Accby = $user->ID; $text = 'respins'; }
			if(!isset($_POST['appc']) || trim($_POST['appc'])==='' ? ($a->OPrec = 'No') : ($a->OPrec = $_POST['appc']))
			switch($a->application_type) {
				case 0: $textt = 'la factiune'; break;
				case 1: $textt = 'de leader'; break;
				case 2: $textt = 'de helper'; break;
			}

			DB::table('emails')->insert(['playerid' => $a->user->ID, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a '.$text.' aplicatia ta ' .$textt. '.', 'LinkPanel' => 'applications/view/' . $a->application_code, 'Skin' => $user->SkinID, 'OI' => 1]);
			$a->save(); $a->push();
			if(User::find($a->application_userid)->Status == 1)
			{
			    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
			    if(@socket_connect($socket, '193.203.39.215', '7778'))
		    	{
					$coad = "1|".User::find($a->application_userid)->Pid."|".'* '.$user->name.' a '.$text.' aplicatia ta ' .$textt. '.'."";
					socket_write($socket, $coad, strlen($coad));
			    }
			    socket_close($socket);
		    }
			return Redirect::back()->with('message','Ai ' . $text . ' aplicatia.');
		}
		return view('applications.view',['app' => $a]);
	}
}
