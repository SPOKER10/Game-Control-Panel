<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Ban;
use App\Unban;
use App\Infinity\General;
use Auth;
use DB;
use Redirect;
use Illuminate\Http\Request;
use HTMLPurifier_Config;
use HTMLPurifier;
use Carbon\Carbon;

class UnbanController extends Controller {
	
	public function __construct()
	{

	}
	
	public function showUnban() {
		
	}
	
	
	public function listUnban() {
		
		$unban = Unban::orderBy('unban_status','asc')->orderBy('created_at','desc')->paginate(15);
		return view('unban.list',['unban' => $unban]);
	}
	public function viewUnban($code) {
		$unban = Unban::where('unban_code',$code)->first();
		$unban->View++;
		$unban->save(); $unban->push();
		return view('unban.view',['unban' => $unban]);
	}
	public function viewUnbanPost($code,Request $request) {
		$u = Unban::where('unban_code',$code)->first();
		if(!$u) return view('errors.404');
		
		$user = Auth::user();
		if(isset($_POST['_comment_submit']) && strlen($_POST['_comment'])) {
			if($u->unban_status) return view('unban.view',['unban' => $u]);
			$config = HTMLPurifier_Config::createDefault();
			$purifier = new HTMLPurifier($config);
			$comms = json_decode($u->comments);
			$role = 0;
			$user->PCO++;
      		$user->save();
			if($user->Rank == 10) $role = 5;
			if($user->Helper != 0) $role = 4;
			if($user->Admin != 0) $role = 3;
			if($u->unban_userid == $user->ID) $role = 2;
			$comms[] = ['name' => $user->name, 'time' => time(), 'skin' => $user->Skin, 'ip' => \Request::ip(), 'text' => $purifier->purify($_POST['_comment']), 'role' => $role,];
			$u->unban_comments = json_encode($comms);
			$u->save(); $u->push();
			DB::table('emails')->insert([
						[
							'playerid' => $u->unban_userid,
							'Time' => date('Y-m-d H:i:s'),
							'Message' => $user->name.' a adaugat un comentariu la cererea ta de unban.',
							'LinkPanel' => 'unban/view/' . $u->unban_code,
							'Skin' => $user->SkinID,
							'OI' => 1
						]
					]);
		}

		if(isset($_POST['unban_respond'])) {
			if($u->unban_status != 0) return Redirect::back();
			if($user->AdminLevel >= 1) {

					DB::table('emails')->insert([
						[
							'playerid' => $u->unban_userid,
							'Time' => date('Y-m-d H:i:s'),
							'Message' => $user->name.' ti-a raspuns la cererea ta de unban.',
							'LinkPanel' => 'unban/view/' . $u->unban_code,
							'Skin' => $user->SkinID,
							'OI' => 1
						]
					]);

					$u->unban_status = $request->input('_action');
					$u->save(); $u->push();
					
					if($request->input('_action') == 2) $ban = Ban::where('Player',$u->user->name)->delete();
				}
		}
		if(isset($_POST['unban_open'])) {
			if($u->unban_status != 1) return Redirect::back();
			if($user->AdminLevel >= 1) {

					DB::table('emails')->insert([
						[
							'playerid' => $u->unban_userid,
							'Time' => date('Y-m-d H:i:s'),
							'Message' => $user->name.' a redeschis cererea ta de unban.',
							'LinkPanel' => 'unban/view/' . $u->unban_code,
							'Skin' => $user->SkinID,
							'OI' => 1
						]
					]);

					$u->unban_status = 0;
					$u->save(); $u->push();
				}
		}
		if(isset($_POST['unban_delete'])) {
			if($user->AdminLevel > 4) {

					DB::table('emails')->insert([
						[
							'playerid' => $u->unban_userid,
							'Time' => date('Y-m-d H:i:s'),
							'Message' => $user->name.' a sters cererea ta de unban.',
							'LinkPanel' => 'unban/view/' . $u->unban_code,
							'Skin' => $user->SkinID
						]
					]);
					$ban = DB::table('inf_unban')->where('unban_code',$u->unban_code)->delete();
					return redirect()->to('unban');
				}
		}
		
		return Redirect::back();
	}
	public function createUnban() {
		$ban = Ban::where('Player',Auth::user()->name)->first();
		if(!$ban) return Redirect::to('/');
		$unban = Unban::where('unban_userid',Auth::user()->ID)->whereIn('unban_status',[0,1])->first();
		if($unban && !$unban->unban_status) return Redirect::back()->withErrors([trans('messages.already_unban',['link' => $unban->url])]);
		return view('unban.create', ['ban' => $ban]);
	}
	public function createUnbanPost(Request $request) {
		$this->validate($request, ['_reason' => 'required', '_img' => 'required', '_p' => 'required',]);
		
		$config = HTMLPurifier_Config::createDefault();
		$purifier = new HTMLPurifier($config);
		
		Unban::create(['unban_userid' => Auth::user()->ID, 'unban_reason' => $purifier->purify($request->input('_reason')), 'IP' => \Request::ip(), 'unban_img' => $purifier->purify($request->input('_img')),
			'unban_description' => $purifier->purify($request->input('_p')), 'unban_code' => $code = General::getUnique(), 'unban_comments' => '[]',]);
		
	    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	    if(@socket_connect($socket, '127.0.0.1', '7778'))
		{
			$coad = "2".'AdmInfo: '.Auth::user()->user.' a creat o cerere de unban pe panel. (rpg.bottles.ro/unban/view/' .$code. ')'."";
			socket_write($socket, $coad, strlen($coad));
	    }
	    socket_close($socket);
		return redirect('unban/view/' . $code);
		
	}
}

?>