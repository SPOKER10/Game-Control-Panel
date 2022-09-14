<?php

namespace App\Http\Controllers;

use App\User;
use App\Ban;
use App\Clan;
use App\Donation;
use App\Infinity\General;
use Auth;
use DB;
use URL;
use Carbon\Carbon;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Password;
use Redirect;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

	protected $redirectTo = '/';

    public function __construct()
    {

    }

	public function decideShow() {
		if(Auth::check()) return redirect()->intended('user/profile');
		else return redirect()->intended('user/login');
	}

	public function showLogin() { return view('user/login'); }
	public function postLogin(Request $request)
	{
		$this->validate($request, ['login_username' => 'required', 'login_password' => 'required',]);
		if(Auth::attempt(['user' => $request->input('login_username'),'password' => strtoupper(hash('whirlpool',$request->input('login_password'))),],true)) { DB::table('piplogs')->insert([['ID' => Auth::user()->ID, 'IP' => \Request::ip(), 'Type' => 1]]); return redirect()->intended('user/login')->with(['type' => 'success','message' => 'Te-ai logat cu succes.']); }
		return redirect('user/login')->with(['type' => 'danger','message' => trans('messages.login_failed'),'title' => 'Login']);
	}
	public function showProfile($user = null,$with = [])
	{
		if(!Auth::check() && !$user) return redirect()->to('user/login')->with(['title' => 'Failed','type' => 'danger','message' => trans('messages.login')]);
		$acc = (!$user ? Auth::user() : (is_numeric($user) ? User::find($user) : User::where('user',$user)->first()));
		if($acc)
		{
			$acc->PV++;
	      	$acc->save();
			$ban = Ban::where('Player',$acc->name)->first();
			$clan = Clan::find($acc->clan_id);
			return view('user/profile',['user' => $acc,'ban' => $ban,'clan' => $clan,'messages' => $with]);
		}
		return redirect()->to('/')->with(['title' => '','type' => 'danger','message' => 'Jucatorul nu exista!']);
	}

	public function Unban()
	{
		$user = Auth::user();
		$ban = Ban::where('Player',$user->name)->first();
		if($user->Diamonds < $ban->BanDays*30) return redirect()->intended('/')->with(['type' => 'error','message' => 'Nu ai suficiente diamonds pentru a cumpara unban! ('.($ban->BanDays*30).')','title' => 'Unban']);
		$user->Diamonds -= $ban->BanDays*30;
		$user->save(); $user->push();
		$ban->delete();
		return redirect()->intended('/')->with(['type' => 'success','message' => 'Contul tau a fost debanat cu succes!','title' => 'Unban']);
	}
	public function getLogout()
	{
		Auth::logout();
		return redirect()->intended('/')->with(['type' => 'success','message' => 'Te-ai delogat cu succes.','title' => 'Logout']);
	}
	public function getNotifications() {
		$notifications = false;
		$data = DB::table('emails')->where('playerid','=',Auth::user()->ID)->orderBy('Time','desc')->take(5)->get();
		$unseen = 0;
		$noth = '';
		if(count($data)) {
			foreach($data as $dt) {
				if(!$dt->EmailRead) $unseen++;
				$noth .= '
					<li>
				        <a href="'.($dt->LinkPanel ? URL::to('/') . '/' . $dt->LinkPanel : '#').'">
				            <div>
				                <img src="'.URL::to('/').'/assets/a/'.$dt->Skin.'.png" class="img-circle" style="height:26px;"> '.$dt->Message.'
				                </br><span class="pull-right text-muted small" style="color:green;"><img src="'.URL::to('/').'/assets/notif/o'.$dt->OI.'.png"> '.Carbon::createFromFormat('Y-m-d H:i:s',$dt->Time)->diffForHumans().'</span>
				            </div>
				        </a>
				    </li>
				    <li class="divider"></li>
				';
			}
			$notifications .= '
				<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
					<i class="fa fa-bell"></i>
					'.(!$unseen ? '' : '<span class="label label-warning not-count">'.$unseen.'</span>').'
				</a>
				<ul class="dropdown-menu dropdown-alerts" style="padding:0;background: linear-gradient(to left, rgba(255, 255, 255, 0.55) 0%, rgba(255, 255, 255, 1.44) 100%);">
					<li class="dropdown-header">'.trans('user.notifications').(!$unseen ? '' : ' <span class="not-count">('.$unseen.')</span>').'</li>
					'.$noth.'
					<li class="dropdown-footer text-center">
						<a href="'.URL::to('user/notifications').'">Show More</a>
					</li>
				</ul>';
		}
		return view('user/notifications',['notif' => $notifications]);
	}
	public function readNotifications() { DB::table('emails')->where('playerid',Auth::user()->ID)->update(['EmailRead' => 1]); }
	public function showNotifications() {
		$data = DB::table('emails')->where('playerid','=',Auth::user()->ID)->orderBy('Time','desc')->get();
		$unseen = 0;
		$noth = '';
		$html = '';
		if(count($data)) {
			foreach($data as $dt) {
				$noth .= '
					<tr>
						<a href="javascript:;">
							<td>'.$dt->Message.'</td>
							<td>'.Carbon::createFromFormat('Y-m-d H:i:s',$dt->Time)->diffForHumans().'</td>
							<td><a href="'.($dt->LinkPanel ? URL::to('/') . '/' . $dt->LinkPanel : '#').'"><i class="fa fa-external-link"></i> View</a></td>
						</a>
					</tr>
				';
			}
		}
		$html .= '
			<div class="table-responsive">
			<table class="table table-striped table-hover table-bordered data-table">
				<thead>
					<tr>
						<th>'.'Notification'.' <i class="fa fa-bell"></i></th>
						<th>'.'Date '.'<i class="fa fa-clock-o"></i></th>
						<th>'.'Actions'.'</th>
					</tr>
				</thead><tbody>'.$noth.'</tbody></table></div>
		';

		return view('user/full_notifications',['notifications' => $html]);
	}
	public function showForgot() { return view('user/forgot'); }
	public function postForgot(Request $request) {
		if(!isset($_POST['email']) || !isset($_POST['name'])) return redirect()->back()->withErrors(trans('messages.complete'));
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) return redirect()->back()->withErrors('Mail invalid!');

		switch($response = Password::sendResetLink(['userr' => $request->input('name'),'Email' => $request->input('email')],function($m){
			$m->subject('Reset password');
		})) {
			case Password::INVALID_USER: return redirect()->back()->withErrors(trans($response));
            case Password::RESET_LINK_SENT: return redirect()->back()->withErrors(trans($response));
		}
		return view('user/forgot');
	}
	public function showReset($token = null)
	{
	   if (is_null($token)) return view('errors.404'); //errors.404
	   return view('user/reset')->with('token', $token);
	}
	public function postReset(Request $request)
	{
		$this->validate($request, ['token' => 'required', 'email' => 'required|email', 'password' => 'required|confirmed',]);

		// $credentials = $request->only([
		//    'playerEmail' => 'email', 'playerPassword' => 'password', 'password_confirmation', 'token'
		// );

		$response = Password::reset([
			'Email' => $request->input('email'),
			'password' => $request->input('password'),
			'password_confirmation' => $request->input('password_confirmation'),
			'token' => $request->input('token')
		], function ($user, $password) {
		   $this->resetPassword($user, $password);
		});

	   	switch ($response) {
	       case Password::PASSWORD_RESET: return redirect('/');
	       default: return redirect()->back()->withErrors(['email' => trans($response)]);
	   }
	}
	function isValid($str) {
	    return !preg_match('/[^A-Za-z0-9.#\\-$]/', $str);
	}
   protected function resetPassword($user, $password)
   {
       $user->pass = strtoupper(hash('whirlpool',$password));
       $user->save();
       Auth::login($user);
   }

	public function postProfile(Request $request,$user = null) {
		$messages = [];

		if(isset($_POST['submit_dsc']))
		{
			if(Auth::user()->Status != 1) return Redirect::back()->with(['type' => 'error','message' => trans('You not connected.')]);
			$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		    if(@socket_connect($socket, '193.203.39.215', '7778'))
	    	{
	    		Auth::user()->Status = 0;
				Auth::user()->save(); Auth::user()->push();
				$coad = "4|".Auth::user()->Pid."";
				socket_write($socket, $coad, strlen($coad));
		    }
		    socket_close($socket);
			return Redirect::back()->with(['type' => 'error','message' => trans('You disconnected from the server.')]);
		}
		if(isset($_POST['submit_banp']))
		{
			if(strlen($request->input('bandays')) == 0 || intval($request->input('bandays')) < 0 || intval($request->input('bandays')) > 999) return Redirect::back()->with(['type' => 'error','message' => trans('Invalid ban days. (Max ban days: 999)')]);
			if(strlen($request->input('banrs')) == 0) return Redirect::back()->with(['type' => 'error','message' => trans('Invalid ban reason.')]);
			$acc = (!$user ? Auth::user() : (is_numeric($user) ? User::find($user) : User::where('user',$user)->first()));
			$acc->BanP = 1;
			$acc->BanPBy = Auth::user()->name;
			$acc->BanPDate = date('Y-m-d H:i:s');
			$acc->BanRS = $request->input('banrs');
			if($request->input('bandays') == 0 ? ($acc->BanDP = '0') : ($acc->BanDP = Carbon::createFromTimestamp(time()+($request->input('bandays')*86400))->toDateTimeString()))
			if($request->input('bandays') == 0 ? ($acc->BanPDays = 0) : ($acc->BanPDays = time()+($request->input('bandays')*86400)))
			$acc->save(); $acc->push();
			$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		    if(@socket_connect($socket, '193.203.39.215', '7778'))
	    	{
				$coad = "2".'AdmInfo: '.Auth::user()->user.' a banat pe panel jucatorul ' .$acc->name. '. (rpg.linkmania.ro/user/profile/' .$acc->name. ')'."";
				socket_write($socket, $coad, strlen($coad));
		    }
		    socket_close($socket);
			return Redirect::back()->with(['type' => 'error','message' => trans('The player was banned.')]);
		}
		if(isset($_POST['submit_unbanp']))
		{
			$acc = (!$user ? Auth::user() : (is_numeric($user) ? User::find($user) : User::where('user',$user)->first()));
			$acc->BanP = 0;
			$acc->save(); $acc->push();
			$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		    if(@socket_connect($socket, '193.203.39.215', '7778'))
    		{
				$coad = "2".'AdmInfo: '.Auth::user()->user.' a debanat de pe panel jucatorul ' .$acc->name. '. (rpg.linkmania.ro/user/profile/' .$acc->name. ')'."";
				socket_write($socket, $coad, strlen($coad));
		    }
		    socket_close($socket);
			return Redirect::back()->with(['type' => 'success','message' => trans('The player was unbanned.')]);
		}
		if(isset($_POST['submit_changep']))
		{
			if(Auth::user()->Admin < 5) return Redirect::back()->with(['type' => 'error','message' => trans('Nu ai minim Admin 5.')]);
			$acc = (!$user ? Auth::user() : (is_numeric($user) ? User::find($user) : User::where('user',$user)->first()));
			$acc->pass = strtoupper(hash('whirlpool',$request->input('newp')));
			$acc->save(); $acc->push();
			$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		    if(@socket_connect($socket, '193.203.39.215', '7778'))
    		{
				$coad = "2".'AdmInfo: '.Auth::user()->user.' a schimbat parola contului ' .$acc->name. ' de pe panel. (rpg.linkmania.ro/user/profile/' .$acc->name. ')'."";
				socket_write($socket, $coad, strlen($coad));
		    }
		    socket_close($socket);
			return Redirect::back()->with(['type' => 'success','message' => trans('Password was changed successfully.')]);
		}
		if($request->submit_email) {
			$this->validate($request, ['new_email' => 'required|email', 'current_password' => 'required',]);
			if(preg_match("/[^A-Za-z0-9\.\_\-\@]/", $request->password_confirmation)) return Redirect::back()->withErrors([trans('Valid characters are: A-Z, a-z, 0-9, @, ., _')]);
			$user = Auth::user();
			if($user->pass !== strtoupper(hash('whirlpool',$request->current_password))) return Redirect::back()->withErrors([trans('messages.password_match')]);

			$user->Email = $request->new_email;
			$user->save(); $user->push();
			return Redirect::back()->with(['type' => 'success','message' => trans('Email schimbat cu succes.')]);
		}

		if($request->submit_password)
		{
			$this->validate($request, ['current_password' => 'required', 'password' => 'required|confirmed', 'password_confirmation' => 'required',]);
			if(preg_match("/[^A-Za-z0-9\.\_\-\[\]]/", $request->password_confirmation)) return Redirect::back()->withErrors([trans('Valid characters are: A-Z, a-z, 0-9, ., _, -, [, ]')]);
			$user = Auth::user();
			if($user->pass !== strtoupper(hash('whirlpool',$request->current_password))) return Redirect::back()->withErrors([trans('The password confirmation does not match.')]);

			$user->pass = strtoupper(hash('whirlpool',$request->password_confirmation));
			$user->save(); $user->push();
			return Redirect::back()->with(['type' => 'success','message' => trans('Parola schimbata cu succes.')]);
		}
	}
}
