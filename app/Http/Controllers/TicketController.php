<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Infinity\General;
use App\Ticket;
use App\User;
use Auth;
use HTMLPurifier_Config;
use HTMLPurifier;
use Redirect;
use DB;

class TicketController extends Controller
{
	
    public function __construct()
    {

    }

	public function ticketList()
	{
		$user = [];
		if(Auth::check()) $user = Ticket::where('ticket_userid',Auth::user()->ID)->get();
		return view('tickets.list',['tickets' => Ticket::orderBy('ticket_status','asc')->orderBy('created_at','desc')->paginate(15),'user' => $user]);
	}
	public function ticketView($code)
	{
		$t = Ticket::where('ticket_code',$code)->first();
		if(!$t) return view('errors.404');
		return view('tickets.view',['ticket' => $t]);
	}
	public function ticketViewPost($code,Request $request)
	{
		$t = Ticket::where('ticket_code',$code)->first();
		if(!$t) return view('errors.404');
		$user = Auth::user();
		
		if(isset($_POST['_comment_submit']) && strlen($_POST['_comment']))
		{
			$config = HTMLPurifier_Config::createDefault();
			$purifier = new HTMLPurifier($config);
			$comms = json_decode($t->comments);
			$comms[] = ['name' => $user->name, 'time' => time(), 'skin' => $user->Skin, 'ip' => \Request::ip(), 'text' => $purifier->purify($_POST['_comment'])];
			$t->ticket_comments = json_encode($comms);
			$t->save(); $t->push();
			$user->PCO++;
      		$user->save();
      		DB::table('emails')->insert([
				[
					'playerid' => $t->ticket_userid,
					'Message' => $user->name.' a adaugat un comentariu la ticket-ul tau.',
					'LinkPanel' => 'tickets/view/' . $t->ticket_code,
					'Skin' => $user->SkinID,
					'OI' => 1
				]
			]);
		}
		
		if(isset($_POST['ticket_respond'])) {
			if($t->ticket_status != 0) return Redirect::back();
			if($user->AdminLevel >= 1) {

					DB::table('emails')->insert([
						[
							'playerid' => $t->ticket_userid,
							'Message' => $user->name.' a modificat statusul ticket-ului tau.',
							'LinkPanel' => 'tickets/view/' . $t->ticket_code,
							'Skin' => $user->SkinID,
							'OI' => 1
						]
					]);

					$t->ticket_status = $request->input('_action');
					$t->save(); $t->push();
				}
		}
		if(isset($_POST['ticket_open'])) {
			if($t->ticket_status != 1) return Redirect::back();
			if($user->AdminLevel >= 1) {

					DB::table('emails')->insert([
						[
							'playerid' => $t->ticket_userid,
							'Message' => $user->name.' a redeschis ticket-ul tau.',
							'LinkPanel' => 'tickets/view/' . $t->ticket_code,
							'Skin' => $user->SkinID,
							'OI' => 1
						]
					]);

					$t->ticket_status = 0;
					$t->save(); $t->push();
				}
		}
		if(isset($_POST['ticket_delete'])) {
			if($user->AdminLevel >= 4) {
				DB::table('emails')->insert([
						[
							'playerid' => $t->ticket_userid,
							'Message' => $user->name.' a sters ticket-ul tau.',
							'LinkPanel' => 'tickets/view/' . $t->ticket_code,
							'Skin' => $user->SkinID
						]
					]);
				$tick = DB::table('inf_tickets')->where('ticket_code',$t->ticket_code)->delete();
				return redirect()->to('tickets/list');
			}

		}
		
		return Redirect::back();
	}
	public function ticketCreate()
	{
		$tick = Ticket::where('ticket_userid',Auth::user()->ID)->whereIn('ticket_status',[0,1])->first();
		if($tick && !$tick->ticket_status)
			return Redirect::back()->withErrors([trans('dsadas',['link' => $tick->url])]);
		return view('tickets.create');
	}	
	public function ticketCreatePost(Request $request)
	{
		if($request->input('_type') < 0 || $request->input('_type') > 3) return 1;
		$acc = Auth::user();
		$acc->PTO++;
      	$acc->save();
		$this->validate($request,['description' => 'required']);
		$dss = General::getUnique();
		Ticket::create(['ticket_userid' => Auth::user()->ID, 'ticket_type' => $request->input('_type'), 'ticket_description' => $request->input('description'), 'IP' => \Request::ip(), 'ticket_code' => $code = $dss, 'ticket_comments' => '[]',]);
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	    if(@socket_connect($socket, '193.203.39.215', '7778'))
	    {
			$coad = "2".'AdmInfo: '.Auth::user()->user.' a creat un nou ticket pe panel. (rpg.linkmania.ro/tickets/view/' .$dss. ')'."";
			socket_write($socket, $coad, strlen($coad));
	    }
	    socket_close($socket);
		return redirect('tickets/view/' . $code);
	}
}
