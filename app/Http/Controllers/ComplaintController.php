<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Infinity\General;
use App\Complaint;
use App\User;
use Auth;
use HTMLPurifier_Config;
use HTMLPurifier;
use DB;
use Redirect;

class ComplaintController extends Controller
{
	
    public function __construct()
    {

    }

	public function complaintList() {
		$user = [];
		if(Auth::check()) $user = Complaint::where('complaint_userid',Auth::user()->ID)->get();
		return view('complaints.list',['complaints' => Complaint::where('complaint_faction',0)->orderBy('complaint_status','asc')->orderBy('created_at','desc')->paginate(15),'user' => $user]);
	}

	public function factionList($id) {
		$user = [];
		if(Auth::check()) $user = Complaint::where('complaint_userid',Auth::user()->ID)->type('faction',$id)->get();
		$complaints = Complaint::type('faction',$id)->orderBy('complaint_status','asc')->orderBy('created_at','desc')->paginate(15);
		return view('complaints.list',['type' => General::faction($id,'name'),'complaints' => $complaints,'user' => $user]);
	}

	public function complaintCreate($userid = null) {
		if($userid == Auth::user()->ID) return redirect()->to('/')->with(['type' => 'danger','message' => 'Nu te poti reclama singur.']);
		return view('complaints.create',['user' => User::find($userid)]);
	}

	public function complaintCreatePost(Request $request,$userid = null) {
		$request->flash();
		$user = Auth::user();
		if($user->HoursPlayed/3600 < 1) return view('complaints.create',['user' => User::find($userid)])->withErrors(['Nu ai minim o ora jucata.']);
		if($comp = Complaint::where('complaint_userid',$user->ID)->where('complaint_status',0)->count() > 8) return view('complaints.create',['user' => User::find($userid)])->withErrors(['Ai deja 8 reclamatii active, asteatpa sa fie inchise acestea.']);
		if(!$request->input('_selected') || $request->input('_type') > 4 || $request->input('_type') < 0 || $request->input('_reason') == -1 || !$request->input('description') || !$request->input('link')) return view('complaints.create',['user' => User::find($userid)])->withErrors([trans('messages.complete')]);
		if($request->input('_selected') == Auth::user()->ID) return view('complaints.create',['user' => User::find($userid)])->withErrors(['Nu te poti reclama singur.']);
		if(!User::find($request->input('_selected'))) return view('complaints.create',['user' => User::find($userid)])->withErrors(['Acest utilizator nu exista.']);
		if($comp = Complaint::where('complaint_userid',$user->ID)->where('complaint_foruserid',$request->input('_selected'))->where('complaint_status',0)->first()) return view('complaints.create',['user' => User::find($userid)])->withErrors([trans('messages.already_comp',['link' => $comp->url])]);
		$user->COM++;
  		$user->save();
		$code = General::getUnique();
		$config = HTMLPurifier_Config::createDefault();
		$purifier = new HTMLPurifier($config);
		Complaint::create([
			'complaint_userid' => $user->ID, 'complaint_foruserid' => $request->input('_selected'), 'complaint_code' => $code, 'complaint_type' => $request->input('_type'),
			'complaint_reason' => $request->input('_reason'), 'complaint_faction' => $request->input('_type') == 4 ? User::find($request->input('_selected'))->faction_id : 0,'complaint_description' => $purifier->purify($request->input('description')), 'complaint_proof' => $purifier->purify($request->input('link')), 'complaint_comments' => '[]',]);
		DB::table('emails')->insert(['playerid' => $request->input('_selected'), 'Message' => $user->name.' a creat o reclamatie impotriva ta.', 'LinkPanel' => 'complaints/view/' . $code, 'Skin' => $user->SkinID, 'OI' => 3]);

		if(User::find($request->input('_selected'))->Status == 1)
		{		 
		    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		    if(@socket_connect($socket, '193.203.39.215', '7778'))
	    	{
				$coad = "1|".User::find($request->input('_selected'))->Pid."|".'* '.$user->name.' a creat o reclamatie impotriva ta pe panel.'."";
				socket_write($socket, $coad, strlen($coad));
		    }
		    socket_close($socket);
	    }
		return redirect('complaints/view/' . $code);
	}

	public function complaintView($comp) {
		$c = Complaint::code($comp)->first();
		if(!$c) return view('errors.404');
		$c->View++;
		$c->save();
		return view('complaints.view',['comp' => $c]);
	}

	public function complaintViewPost($comp) {
		$c = Complaint::code($comp)->first();
		if(!$c) return view('errors.404'); // errors.404
		$user = Auth::user();
		if(isset($_POST['_comment_submit']) && strlen($_POST['_comment'])) {
			if($c->complaint_status) return view('complaints.view',['comp' => $c]);
			$config = HTMLPurifier_Config::createDefault();
			$purifier = new HTMLPurifier($config);
			$comms = json_decode($c->comments);
			$role = 0;
			$user->PCO++;
      		$user->save();
			if($user->Rank == 10) $role = 5;
			if($user->Helper != 0) $role = 4;
			if($user->Admin != 0) $role = 3;
			if($c->complaint_userid == $user->ID) $role = 1;
			if($c->complaint_foruserid == $user->ID) $role = 2;
			$comms[] = ['name' => $user->name, 'time' => time(), 'skin' => $user->Skin, 'ip' => \Request::ip(), 'text' => $purifier->purify($_POST['_comment']), 'role' => $role,];
			$c->complaint_comments = json_encode($comms);
			$c->save(); $c->push();
		}

		if(isset($_POST['comp_respond'])) {
			if($c->complaint_status) return view('complaints.view',['comp' => $c]);
			switch($c->complaint_type) {
				case 0: { $lv = 1; break; }
				case 1: { $lv = 3; break; }
				case 2: { $lv = 5; break; }
				case 3: { $lv = 6; break; }
				case 4: { $lv = 6; break; }
			}
			if(($user->AdminLevel >= $lv) || $c->complaint_type == 4 && ($user->Member == $c->complaint_faction && $user->Rank == 10))
			{
				if(in_array($_POST['_action'],['nothing','mute15','jail','warn','ban1','ban3','fpunish','fwarn','uninvite']))
				{
					if($_POST['_action'] == "mute15")
					{
						if(strlen($_POST['compr']) == 0 || intval($_POST['compr']) < 1 || intval($_POST['compr']) > 999) return Redirect::back()->with(['type' => 'error','message' => trans('Invalid mute minutes. (Max mute minutes: 999)')]);
						$usr = User::find($c->againstId);
						if($usr->Status == 0)
						{
							$usr->Mute = $usr->Mute+($_POST['compr']*60);
							$usr->save(); $usr->push();
							DB::table('logs')->insert([['pName' => $usr->user, 'Text' => Auth::user()->user.' has muted player ' .$usr->user. ' for ' .$_POST['compr']. ' minutes, reason: complaint ' .$c->complaint_id. '. (offline)', 'Tip' => 11, 'Date' => time()]]);
							DB::table('emails')->insert([
								['playerid' => $c->againstId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta impotriva ta de catre ' .User::find($c->userId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2],
								['playerid' => $c->userId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta de tine impotriva lui ' .User::find($c->againstId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2]
							]);
							$c->complaint_status = 1;
							$c->complaint_action = $_POST['_action'];
							$c->save(); $c->push();
							return Redirect::back()->with(['type' => 'error','message' => trans(Auth::user()->user.' has muted player ' .$usr->user. ' for ' .$_POST['compr']. ' minutes, reason: complaint ' .$c->complaint_id. '. (offline)')]);
						}
						else
						{
							DB::table('emails')->insert([
								['playerid' => $c->againstId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta impotriva ta de catre ' .User::find($c->userId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2],
								['playerid' => $c->userId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta de tine impotriva lui ' .User::find($c->againstId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2]
							]);
							$c->complaint_status = 1;
							$c->complaint_action = $_POST['_action'];
							$c->save(); $c->push();
							$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
						    if(@socket_connect($socket, '193.203.39.215', '7778'))
					    	{
								$coad = "5|".$usr->Pid."|".$_POST['compr']."|". Auth::user()->user.' has muted player ' .$usr->user. ' for ' .$_POST['compr']. ' minutes, reason: complaint ' .$c->complaint_id. '.'."";
								socket_write($socket, $coad, strlen($coad));
						    }
						    socket_close($socket);
						    return Redirect::back()->with(['type' => 'error','message' => trans(Auth::user()->user.' has muted player ' .$usr->user. ' for ' .$_POST['compr']. ' minutes, reason: complaint ' .$c->complaint_id. '.')]);
						}
					}
					if($_POST['_action'] == "jail")
					{
						if(strlen($_POST['compr']) == 0 || intval($_POST['compr']) < 1 || intval($_POST['compr']) > 999) return Redirect::back()->with(['type' => 'error','message' => trans('Invalid jail minutes. (Max jail minutes: 999)')]);
						$usr = User::find($c->againstId);
						if($usr->Status == 0)
						{
							$usr->Jailed = $usr->Jailed == -1 ? ($_POST['compr']*60) : ($usr->Jailed+($_POST['compr']*60));
							$usr->Bail = -1;
							$usr->save(); $usr->push();
							DB::table('logs')->insert([['pName' => $usr->user, 'Text' => Auth::user()->user.' has jailed player ' .$usr->user. ' for ' .$_POST['compr']. ' minutes, reason: complaint ' .$c->complaint_id. '. (offline)', 'Tip' => 11, 'Date' => time()]]);
							$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
						    if(@socket_connect($socket, '193.203.39.215', '7778'))
						    {
								$coad = "2".'AdmInfo: '.Auth::user()->user.' has jailed player ' .$usr->user. ' for ' .$_POST['compr']. ' minutes, reason: complaint ' .$c->complaint_id. '. (offline)'."";
								socket_write($socket, $coad, strlen($coad));
						    }
						    socket_close($socket);
						    DB::table('emails')->insert([
								['playerid' => $c->againstId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta impotriva ta de catre ' .User::find($c->userId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2],
								['playerid' => $c->userId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta de tine impotriva lui ' .User::find($c->againstId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2]
							]);
						    $c->complaint_status = 1;
							$c->complaint_action = $_POST['_action'];
							$c->save(); $c->push();
							return Redirect::back()->with(['type' => 'error','message' => trans(Auth::user()->user.' has jailed player ' .$usr->user. ' for ' .$_POST['compr']. ' minutes, reason: complaint ' .$c->complaint_id. '. (offline)')]);
						}
						else
						{
							DB::table('emails')->insert([
								['playerid' => $c->againstId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta impotriva ta de catre ' .User::find($c->userId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2],
								['playerid' => $c->userId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta de tine impotriva lui ' .User::find($c->againstId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2]
							]);
							$c->complaint_status = 1;
							$c->complaint_action = $_POST['_action'];
							$c->save(); $c->push();
							$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
						    if(@socket_connect($socket, '193.203.39.215', '7778'))
					    	{
								$coad = "6|".$usr->Pid."|".$_POST['compr']."|". Auth::user()->user.' has jailed player ' .$usr->user. ' for ' .$_POST['compr']. ' minutes, reason: complaint ' .$c->complaint_id. '.'."";
								socket_write($socket, $coad, strlen($coad));
						    }
						    socket_close($socket);
						    return Redirect::back()->with(['type' => 'error','message' => trans(Auth::user()->user.' has jailed player ' .$usr->user. ' for ' .$_POST['compr']. ' minutes, reason: complaint ' .$c->complaint_id. '.')]);
						}
					}
					if($_POST['_action'] == "warn")
					{
						$usr = User::find($c->againstId);
						if($usr->Status == 0)
						{
							if($usr->Warns < 2)
							{
								$usr->Warns = $usr->Warn+1;
								$usr->save(); $usr->push();
								DB::table('logs')->insert([['pName' => $usr->user, 'Text' => Auth::user()->user.' was warned player ' .$usr->user. ', reason: complaint ' .$c->complaint_id. '. (offline)', 'Tip' => 11, 'Date' => time()]]);
								DB::table('emails')->insert([
									['playerid' => $c->againstId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta impotriva ta de catre ' .User::find($c->userId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2],
									['playerid' => $c->userId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta de tine impotriva lui ' .User::find($c->againstId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2]
								]);
								$c->complaint_status = 1;
								$c->complaint_action = $_POST['_action'];
								$c->save(); $c->push();
								return Redirect::back()->with(['type' => 'error','message' => trans(Auth::user()->user.' was warned player ' .$usr->user. ', reason: complaint ' .$c->complaint_id. '. (offline)')]);
							}
							else
							{
								$usr->Warns = 0;
								$usr->save(); $usr->push();
								DB::table('logs')->insert([['pName' => $usr->user, 'Text' => Auth::user()->user.' was warned player ' .$usr->user. ', reason: complaint ' .$c->complaint_id. '. (offline)', 'Tip' => 11, 'Date' => time()]]);
								DB::table('logs')->insert([['pName' => $usr->user, 'Text' => $usr->user. ' was banned from the server by AdmBot for 3 days, reason: 3/3 Warns. (offline)', 'Tip' => 11, 'Date' => time()]]);
								DB::table('emails')->insert([
									['playerid' => $c->againstId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta impotriva ta de catre ' .User::find($c->userId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2],
									['playerid' => $c->userId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta de tine impotriva lui ' .User::find($c->againstId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2]
								]);
								$c->complaint_status = 1;
								$c->complaint_action = $_POST['_action'];
								$c->save(); $c->push();
								return Redirect::back()->with(['type' => 'error','message' => trans(Auth::user()->user.' was warned player ' .$usr->user. ', reason: complaint ' .$c->complaint_id. '. (offline)')]);
							}
						}
						else
						{
							if($usr->Warns < 2)
							{
								DB::table('emails')->insert([
									['playerid' => $c->againstId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta impotriva ta de catre ' .User::find($c->userId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2],
									['playerid' => $c->userId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta de tine impotriva lui ' .User::find($c->againstId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2]
								]);
								$c->complaint_status = 1;
								$c->complaint_action = $_POST['_action'];
								$c->save(); $c->push();
								$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
							    if(@socket_connect($socket, '193.203.39.215', '7778'))
						    	{
									$coad = "7|".$usr->Pid."|".$_POST['compr']."|". Auth::user()->user.' was warned player ' .$usr->user. ', reason: complaint ' .$c->complaint_id. '.'."";
									socket_write($socket, $coad, strlen($coad));
							    }
							    socket_close($socket);
							    return Redirect::back()->with(['type' => 'error','message' => trans(Auth::user()->user.' was warned player ' .$usr->user. ', reason: complaint ' .$c->complaint_id. '.')]);
							}
							else
							{
								DB::table('emails')->insert([
									['playerid' => $c->againstId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta impotriva ta de catre ' .User::find($c->userId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2],
									['playerid' => $c->userId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta de tine impotriva lui ' .User::find($c->againstId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2]
								]);
								$c->complaint_status = 1;
								$c->complaint_action = $_POST['_action'];
								$c->save(); $c->push();
								$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
							    if(@socket_connect($socket, '193.203.39.215', '7778'))
						    	{
									$coad = "7|".$usr->Pid."|".$_POST['compr']."|". Auth::user()->user.' was warned player ' .$usr->user. ', reason: complaint ' .$c->complaint_id. '.'."";
									socket_write($socket, $coad, strlen($coad));
							    }
							    socket_close($socket);
							    return Redirect::back()->with(['type' => 'error','message' => trans(Auth::user()->user.' was warned player ' .$usr->user. ', reason: complaint ' .$c->complaint_id. '.')]);
							}
						}
					}
					if($_POST['_action'] == "ban1")
					{
						if(strlen($_POST['compr']) == 0 || intval($_POST['compr']) < 1 || intval($_POST['compr']) > 999) return Redirect::back()->with(['type' => 'error','message' => trans('Invalid ban days. (Max ban days: 999)')]);
						$usr = User::find($c->againstId);
						if($usr->Status == 0)
						{
							DB::table('logs')->insert([['pName' => $usr->user, 'Text' => $usr->user. ' was banned from the server by Admin ' .Auth::user()->user. ' for ' .$_POST['compr']. ' days, reason: complaint ' .$c->complaint_id. '. (offline)', 'Tip' => 11, 'Date' => time()]]);
							DB::table('bans')->insert([['Player' => $usr->user, 'IP' => '0', 'Admin' => Auth::user()->user, 'Reason' => 'complaint ' .$c->complaint_id. ' (offline)', 'BanTime' => date('Y-m-d H:i:s'), 'UnbanTime' => time()+($_POST['compr']*86400), 'Sil' => 0, 'BanDays' => intval($_POST['compr'])]]);
							DB::table('emails')->insert([
								['playerid' => $c->againstId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta impotriva ta de catre ' .User::find($c->userId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2],
								['playerid' => $c->userId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta de tine impotriva lui ' .User::find($c->againstId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2]
							]);
							$c->complaint_status = 1;
							$c->complaint_action = $_POST['_action'];
							$c->save(); $c->push();
							return Redirect::back()->with(['type' => 'error','message' => trans($usr->user. ' was banned from the server by Admin ' .Auth::user()->user. ' for ' .$_POST['compr']. ' days, reason: complaint ' .$c->complaint_id. '. (offline)')]);
						}
						else
						{
							DB::table('logs')->insert([['pName' => $usr->user, 'Text' => $usr->user. ' was banned from the server by Admin ' .Auth::user()->user. ' for ' .$_POST['compr']. ' days, reason: complaint ' .$c->complaint_id. '.', 'Tip' => 11, 'Date' => time()]]);
							DB::table('bans')->insert([['Player' => $usr->user, 'IP' => '0', 'Admin' => Auth::user()->user, 'Reason' => 'complaint ' .$c->complaint_id. ' (offline)', 'BanTime' => date('Y-m-d H:i:s'), 'UnbanTime' => time()+($_POST['compr']*86400), 'Sil' => 0, 'BanDays' => intval($_POST['compr'])]]);
							DB::table('emails')->insert([
								['playerid' => $c->againstId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta impotriva ta de catre ' .User::find($c->userId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2],
								['playerid' => $c->userId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta de tine impotriva lui ' .User::find($c->againstId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2]
							]);
							$c->complaint_status = 1;
							$c->complaint_action = $_POST['_action'];
							$c->save(); $c->push();
							$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
						    if(@socket_connect($socket, '193.203.39.215', '7778'))
					    	{
								$coad = "8|".$usr->Pid."|".$_POST['compr']."|". $usr->user. ' was banned from the server by Admin ' .Auth::user()->user. ' for ' .$_POST['compr']. ' days, reason: complaint ' .$c->complaint_id. '.'."";
								socket_write($socket, $coad, strlen($coad));
						    }
						    socket_close($socket);
						    return Redirect::back()->with(['type' => 'error','message' => trans($usr->user. ' was banned from the server by Admin ' .Auth::user()->user. ' for ' .$_POST['compr']. ' days, reason: complaint ' .$c->complaint_id. '.')]);
						}
					}
					if($_POST['_action'] == "ban3")
					{
						$usr = User::find($c->againstId);
						if($usr->Status == 0)
						{
							DB::table('logs')->insert([['pName' => $usr->user, 'Text' => $usr->user. ' was banned from the server by Admin ' .Auth::user()->user. ', reason: complaint ' .$c->complaint_id. '. (offline)', 'Tip' => 11, 'Date' => time()]]);
							DB::table('bans')->insert([['Player' => $usr->user, 'IP' => $usr->IP, 'Admin' => Auth::user()->user, 'Reason' => 'complaint ' .$c->complaint_id. ' (offline)', 'BanTime' => date('Y-m-d H:i:s'), 'UnbanTime' => -1, 'Sil' => 0]]);
							DB::table('emails')->insert([
								['playerid' => $c->againstId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta impotriva ta de catre ' .User::find($c->userId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2],
								['playerid' => $c->userId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta de tine impotriva lui ' .User::find($c->againstId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2]
							]);
							$c->complaint_status = 1;
							$c->complaint_action = $_POST['_action'];
							$c->save(); $c->push();
							return Redirect::back()->with(['type' => 'error','message' => trans($usr->user. ' was banned from the server by Admin ' .Auth::user()->user. ', reason: complaint ' .$c->complaint_id. '. (offline)')]);
						}
						else
						{
							DB::table('logs')->insert([['pName' => $usr->user, 'Text' => $usr->user. ' was banned from the server by Admin ' .Auth::user()->user. ', reason: complaint ' .$c->complaint_id. '.', 'Tip' => 11, 'Date' => time()]]);
							DB::table('bans')->insert([['Player' => $usr->user, 'IP' => $usr->IP, 'Admin' => Auth::user()->user, 'Reason' => 'complaint ' .$c->complaint_id. ' (offline)', 'BanTime' => date('Y-m-d H:i:s'), 'UnbanTime' => -1, 'Sil' => 0]]);
							DB::table('emails')->insert([
								['playerid' => $c->againstId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta impotriva ta de catre ' .User::find($c->userId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2],
								['playerid' => $c->userId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta de tine impotriva lui ' .User::find($c->againstId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2]
							]);
							$c->complaint_status = 1;
							$c->complaint_action = $_POST['_action'];
							$c->save(); $c->push();
							$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
						    if(@socket_connect($socket, '193.203.39.215', '7778'))
					    	{
								$coad = "9|".$usr->Pid."|".$_POST['compr']."|". $usr->user. ' was banned from the server by Admin ' .Auth::user()->user. ', reason: complaint ' .$c->complaint_id. '.'."";
								socket_write($socket, $coad, strlen($coad));
						    }
						    socket_close($socket);
						    return Redirect::back()->with(['type' => 'error','message' => trans($usr->user. ' was banned from the server by Admin ' .Auth::user()->user. ', reason: complaint ' .$c->complaint_id. '.')]);
						}
					}
					DB::table('emails')->insert([
						['playerid' => $c->againstId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta impotriva ta de catre ' .User::find($c->userId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2],
						['playerid' => $c->userId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a inchis reclamatia facuta de tine impotriva lui ' .User::find($c->againstId)->user. '.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2]
					]);
					if(User::find($c->againstId)->Status == 1)
					{
					    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
					    if(@socket_connect($socket, '193.203.39.215', '7778'))
				    	{
							$coad = "1|".User::find($c->againstId)->Pid."|".'* '.$user->name.' a inchis reclamatia facuta impotriva ta de catre ' .User::find($c->userId)->user. '.'."";
							socket_write($socket, $coad, strlen($coad));
					    }
					    socket_close($socket);
				    }
				    if(User::find($c->userId)->Status == 1)
					{
					    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
					    if(@socket_connect($socket, '193.203.39.215', '7778'))
				    	{
							$coad = "1|".User::find($c->userId)->Pid."|".'* '.$user->name.' a inchis reclamatia facuta de tine impotriva lui ' .User::find($c->againstId)->user. '.'."";
							socket_write($socket, $coad, strlen($coad));
					    }
					    socket_close($socket);
				    }
					$c->complaint_status = 1;
					$c->complaint_action = $_POST['_action'];
					$c->save(); $c->push();
				}
			}
		}
		if(isset($_POST['comp_open']) && $user->AdminLevel >= 1)
		{
			if($c->complaint_status != 1) return Redirect::back();
			DB::table('emails')->insert([
				['playerid' => $c->againstId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a redeschis reclamatia facuta impotriva ta.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2],
				['playerid' => $c->userId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a redeschis reclamatia facuta de tine.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID, 'OI' => 2]
			]);
			if(User::find($c->againstId)->Status == 1)
			{ 
			    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
			    if(@socket_connect($socket, '193.203.39.215', '7778'))
		    	{
					$coad = "1|".User::find($c->againstId)->Pid."|".'* '.$user->name.' a redeschis reclamatia facuta impotriva ta de catre ' .User::find($c->userId)->user. '.'."";
					socket_write($socket, $coad, strlen($coad));
			    }
			    socket_close($socket);
		    }
		    if(User::find($c->userId)->Status == 1)
			{
			    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
			    if(@socket_connect($socket, '193.203.39.215', '7778'))
	    		{
					$coad = "1|".User::find($c->userId)->Pid."|".'* '.$user->name.' a redeschis reclamatia facuta de tine impotriva lui ' .User::find($c->againstId)->user. '.'."";
					socket_write($socket, $coad, strlen($coad));
			    }
			    socket_close($socket);
		    }
			$c->complaint_status = 0;
			$c->save(); $c->push();
		}
		if(isset($_POST['comp_delete']) && $user->AdminLevel > 4)
		{
			DB::table('emails')->insert([['playerid' => $c->userId, 'Time' => date('Y-m-d H:i:s'), 'Message' => $user->name.' a sters reclamatia facuta de tine.', 'LinkPanel' => 'complaints/view/' . $c->complaint_code, 'Skin' => $user->SkinID]]);
			$comp = DB::table('inf_complaints')->where('complaint_code',$c->complaint_code)->delete();
			return redirect()->to('complaints/list');
		}
		return Redirect::back();
	}
}
