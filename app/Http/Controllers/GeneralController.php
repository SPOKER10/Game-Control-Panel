<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\House;
use App\Business;
use App\User;
use App\Car;
use App\Ban;
use App\Bug;
use App\Clan;
use App\Option;
use App\Gang;
use App\Motd;
use App\LNew;
use App\Cnn;
use App\Bll;
use App\Indx;
use App\Infinity\General;
use DB;
use Auth;
use HTMLPurifier_Config;
use HTMLPurifier;
use Carbon\Carbon;

class GeneralController extends Controller
{
	
    public function __construct()
    {

    }
	public function postLeader() {
		$min = Option::where('option_name','factionLevel'.Auth::user()->Member)->first();
		if($min) { $min->option_value = (int)$_POST['minlevel']; $min->save(); $min->push(); }
		else { Option::create(['option_name' => 'factionLevel'.Auth::user()->Member, 'option_value' => (int)$_POST['minlevel'], ]); }
		return redirect()->back();
	}
    public function showLeader() {
    	$user = Auth::user();
		$s = Option::where('option_name','factionAppStatus'.$user->Member)->first();
		$q = Option::where('option_name','factionQuestions'.$user->Member)->first();
		if(!$q) $q = Option::where('option_name', 'factionQuestions')->first();
		if($s) $status = $s->option_value; else $status = 1;
		return view('leader/index',[
			'members' => User::where('Member',$user->Member)->orderBy('Rank','desc')->get(),
			'status' => $status,
			'questions' => json_decode($q->option_value),
			'minlevel'=>Option::where('option_name','factionLevel'.$user->Member)->first(),
			'acs'=>$user->Member,
			'fm'=>Motd::find($user->Member)->Text,
			'lm'=>Motd::find(99)->Text
		]);
    }
    public function showcLeader() {
		$v = Clan::find(Auth::user()->Clan + 1);
		$questions = Option::where('option_name', 'clanAppQuestions' . (Auth::user()->Clan + 1))->first();
		if(!$questions) $questions = Option::where('option_name', 'clanAppQuestions')->first();
    	return view('leader/cindex',[
			'members' => User::where('Clan',Auth::user()->Clan)->orderBy('CRank','desc')->get(),
			'clan' => $v,
			'status' => Option::where('option_name', 'clanAppStatus' . (Auth::user()->Clan + 1))->first(),
			'questions' => json_decode($questions->option_value, true),
			'level' => Option::where('option_name', 'clanAppLevel' . (Auth::user()->Clan + 1))->first()
		]);
	}
	public function postcLeader(Request $request) {
		if($request->_appLevel) {
			Option::updateOrCreate(['option_name' => 'clanAppLevel'.(Auth::user()->Clan + 1)],['option_value' => (int)$_POST['minlevel']]);
		}
		if($request->_appStatus) {
			Option::updateOrCreate(['option_name' => 'clanAppStatus'.(Auth::user()->Clan + 1)],['option_value' => !$_POST['appstatus']]);
		}
		$questions = Option::where('option_name', 'clanAppQuestions' . (Auth::user()->Clan + 1))->first();
		if(!$questions) $questions = Option::where('option_name', 'clanAppQuestions')->first();
		$questions = json_decode($questions->option_value, true);
		if($request->_questionsAdd) {
			$questions[$request->_questionsType][] = '';
			Option::updateOrCreate(['option_name' => 'clanAppQuestions'.(Auth::user()->Clan + 1)],['option_value' => json_encode($questions)]);
		}
		if($request->_questionsRemove) {
			unset($questions[$request->_questionsType][$request->_questionsRemove]);
			Option::updateOrCreate(['option_name' => 'clanAppQuestions'.(Auth::user()->Clan + 1)],['option_value' => json_encode($questions)]);
		}
		if($request->_questionsSave) {
			$_questions = [];
			foreach($_POST as $k=>$po) {
				if($k[0] !== 'a' || !strlen($po)) continue;
				$co = HTMLPurifier_Config::createDefault();
				$p = new HTMLPurifier($co);
				$po = $p->purify($po);
				$_questions[] = $po;
			}
			$questions[$request->_questionsType] = $_questions;
			Option::updateOrCreate(['option_name' => 'clanAppQuestions'.(Auth::user()->Clan + 1)],['option_value' => json_encode($questions)]);
		}
		return redirect()->back();
	}
    public function showIndex() { return view('index'); }
	public function showFaq() { return view('faq'); }
	public function showG() { return view('graffiti'); }
	public function showSVC() { return view('scon'); }
	public function showTurfs() { return view('turfs',['turfs' => \Cache::remember('updcat',10,function (){return DB::table('alliances')->get();})]); }
	public function youtube() { return view('youtube'); }
	public function discord() { return view('discord'); }
	public function showwls() { return view('walls'); }
	public function mpss() { return view('mps'); }
	public function cIMG() { return view('changeimg'); }
	public function lG1() { return view('lG1',['kbsc' => \Cache::remember('cc1',10,function (){return LNew::where('FacID','=','1')->get();})]); }
	public function lG2() { return view('lG2',['kbsc2' => \Cache::remember('cc2',10,function (){return LNew::where('FacID','=','2')->get();})]); }
	public function lG3() { return view('lG3',['kbsc3' => \Cache::remember('cc3',10,function (){return LNew::where('FacID','=','3')->get();})]); }
	public function lG4() { return view('lG4',['kbsc4' => \Cache::remember('cc4',10,function (){return LNew::where('FacID','=','4')->get();})]); }
	public function lG5() { return view('lG5',['kbsc5' => \Cache::remember('cc5',10,function (){return LNew::where('FacID','=','5')->get();})]); }
	public function lG6() { return view('lG6',['kbsc6' => \Cache::remember('cc6',10,function (){return LNew::where('FacID','=','6')->get();})]); }
	public function lG7() { return view('lG7',['kbsc7' => \Cache::remember('cc7',10,function (){return LNew::where('FacID','=','7')->get();})]); }
	public function lG8() { return view('lG8',['kbsc8' => \Cache::remember('cc8',10,function (){return LNew::where('FacID','=','8')->get();})]); }
	public function lG9() { return view('lG9',['kbsc9' => \Cache::remember('cc9',10,function (){return LNew::where('FacID','=','9')->get();})]); }
	public function lG10() { return view('lG10',['kbsc10' => \Cache::remember('cc10',10,function (){return LNew::where('FacID','=','10')->get();})]); }
	public function lG11() { return view('lG11',['kbsc11' => \Cache::remember('cc11',0.1,function (){return LNew::where('FacID','=','11')->get();})]); }
	public function lG12() { return view('lG12',['kbsc12' => \Cache::remember('cc12',10,function (){return LNew::where('FacID','=','12')->get();})]); }
	public function lG14() { return view('lG14',['kbsc14' => \Cache::remember('cc14',10,function (){return LNew::where('FacID','=','14')->get();})]); }
	public function lG15() { return view('lG15',['kbsc15' => \Cache::remember('cc15',10,function (){return LNew::where('FacID','=','15')->get();})]); }
	public function lG16() { return view('lG16',['kbsc16' => \Cache::remember('cc16',10,function (){return LNew::where('FacID','=','16')->get();})]); }
	public function lG17() { return view('lG17',['kbsc17' => \Cache::remember('cc17',10,function (){return LNew::where('FacID','=','17')->get();})]); }
	public function lG18() { return view('lG18',['kbsc18' => \Cache::remember('cc18',10,function (){return LNew::where('FacID','=','18')->get();})]); }
	public function lG19() { return view('lG19',['kbsc19' => \Cache::remember('cc19',10,function (){return LNew::where('FacID','=','19')->get();})]); }
	public function Bid() { return view('bids',['kb' => House::where('BidMoneyN','>','0')->paginate(10), 'kbs' => Business::where('BidMoneyN','>','0')->paginate(10)]); }
	public function showFactions() { return view('factions',['factions' => General::factions()]); }
	public function showClans() { return view('clans',['clans' => \Cache::remember('ccah',20,function (){return Clan::orderBy('MaxMembers','desc')->where('Owner','!=','-1')->get();})]); }
	public function showTopp() { return view('top',['top' => \Cache::remember('uttt',60,function (){return User::orderBy('HoursPlayed','desc')->LIMIT('50')->get();})]); }
	public function showVIP() { return view('vip',['vip' => \Cache::remember('utttvi',60,function (){return User::where('VIP','!=','0')->get();})]); }
	public function showrc() { return view('toprc',['toprc' => \Cache::remember('utttsd',60,function (){return User::orderBy('BankMoney','desc')->LIMIT('50')->get();})]); }
	public function showWs() { return view('topw',['topw' => \Cache::remember('usddwq',60,function (){return User::orderBy('HWKE','desc')->LIMIT('50')->get();})]); }
	public function showPETS() { return view('pet',['pet' => \Cache::remember('usddwqp',60,function (){return User::orderBy('pPetLevel','desc')->LIMIT('50')->get();})]); }
	public function showStunts() { return view('stunt',['stunt' => \Cache::remember('usddwqps',60,function (){return User::orderBy('pWonStunts','desc')->LIMIT('50')->get();})]); }
	public function showPR() { return view('paintball',['paintball' => \Cache::remember('usddwqr',60,function (){return User::orderBy('PRank','desc')->LIMIT('50')->get();})]); }
	public function showWR() { return view('war',['war' => \Cache::remember('usddwqw',60,function (){return User::orderBy('WRank','desc')->LIMIT('50')->get();})]); }
	public function showP() { return view('topp',['topp' => \Cache::remember('usddwqp',60,function (){return User::orderBy('Pool','desc')->LIMIT('50')->get();})]); }
	public function showGang() { return view('wars',['wars' => \Cache::remember('asds' .(isset($_GET['page']) ? (int)$_GET['page'] : 1),15,function (){return Gang::orderBy('ID','desc')->paginate(15);})]); }
	public function showOnline() { return view('online',['online' => \Cache::remember('oncs',10,function (){return User::where('Status','=','1')->orderBy('Member','asc')->get();})]); }
	public function showStaff() { return view('staff',['admins' => \Cache::remember('adss',10,function (){return User::where('Admin','>','0')->where('Admin','<','7')->orderBy('Admin','desc')->get();}), 'helpers' => \Cache::remember('hds',10,function (){return User::where('Helper','!=','0')->orderBy('Helper','desc')->get();}),'leaders' => \Cache::remember('lds',10,function (){return User::where('Rank','=','10')->get();})]); }
	public function showPremium() { return view('premium'); }
	public function showtodayjob() { return view('todayjob'); }
	public function showCAR() { return view('carquest'); }
	public function showLMAP() { $players = \DB::table('livemap')->get();
		return view('livemap', compact('players')); }
	public function showBL() { return view('billboards',['billboards' => \Cache::remember('akol',5,function (){return Bll::get();})]); }
	public function showAn() { return view('cnn',['cnn' => \Cache::remember('cnan',1,function (){return Cnn::orderBy('Date','desc')->LIMIT('50')->get();})]); }
	public function sPAuto() { return view('parkauto',['parkauto' => \Cache::remember('soncar' .(isset($_GET['page']) ? (int)$_GET['page'] : 1),2,function (){return Car::where('SON','=','1')->get();})]); }
	public function ds() { return view('dealership',['dealership' => \Cache::remember('soncard',5,function (){return DB::table('dstock')->orderBy('Price','desc')->get();})]); }
	public function sUpdates() { return view('updates',['updates' => \Cache::remember('updca',1,function (){return DB::table('updates')->orderBy('created_at','desc')->get();})]); }
	public function showHouses() { return view('houses',['houses' => \Cache::remember('hpp' .(isset($_GET['page']) ? (int)$_GET['page'] : 1),500,function (){return House::paginate(15);})]); }
	public function showBusinesses() { return view('businesses',['businesses' => \Cache::remember('ws' .(isset($_GET['page']) ? (int)$_GET['page'] : 1),60,function (){return Business::paginate(15);})]); }
	public function showCars() { return view('cars',['cars' => \Cache::remember('ccar' .(isset($_GET['page']) ? (int)$_GET['page'] : 1),60,function (){return Car::where('ID','>','0')->orderBy('ID','desc')->paginate(15);})]); }
	public function showBanlist() { return view('banlist',['bans' => \Cache::remember('po' .(isset($_GET['page']) ? (int)$_GET['page'] : 1),10,function (){return Ban::orderBy('Banid','desc')->paginate(15);})]); }
	public function showSearch() { return view('search'); }
	public function showAdmin() { return view('admin/index',['hlp' => \Cache::remember('users',10,function (){return User::where('Helper','!=','0')->get();}), 'qhd' => Option::where('option_name','helperQuestions')->first(), 'qld' => Option::where('option_name','leaderQuestions')->first(), 'lh' => Option::where('option_name','helperAppStatus')->first(), 'ls' => Option::where('option_name','leaderAppStatus')->first(),
		'inano' => Indx::where('ID','!=','0')->get()]); }
	public function bidh(Request $request)
	{
		$us = \Auth::user();
		$cr = House::find($request->id);
		//if($us->LastBidH != $cr->ID) return redirect()->back()->with(['type' => 'error','message' => trans("Nu poti licita pentru alta casa deoarece ai o licitatie activa.")]);
		if($us->Score < 10) return redirect()->back()->with(['type' => 'error','message' => trans("Nu ai minim nivel 10.")]);
		if($cr->Owner == $us->user) return redirect()->back()->with(['type' => 'error','message' => trans("Nu poti licita pentru aceasta casa.")]);
		if($cr->BidMoneyN < 1) return redirect()->back()->with(['type' => 'error','message' => trans("Aceasta casa nu mai este disponibila la licitatie.")]);
		if($us->BankMoney < $cr->BidMoney+$cr->BidMoneyN) return redirect()->back()->with(['type' => 'error','message' => trans("You don't have enough money. (".General::format($cr->BidMoney+$cr->BidMoneyN)."$)")]);
		$cr->BidMoney += $cr->BidMoneyN;
		$cr->BidLastPlayer = $us->user; $cr->save();
		$us->LastBidH = $cr; $us->save();
		return redirect()->back()->with(['type' => 'success','message' => trans('Ai licitat suma de '.General::format($cr->BidMoney).'$ pentru casa ID #'.$cr->ID.'.')]);
	}
	public function bidb(Request $request)
	{
		$us = \Auth::user();
		$cr = Business::find($request->id);
		//if($us->LastBidB != $cr) return redirect()->back()->with(['type' => 'error','message' => trans("Nu poti licita pentru alt biz deoarece ai o licitatie activa.")]);
		if($us->Score < 10) return redirect()->back()->with(['type' => 'error','message' => trans("Nu ai minim nivel 10.")]);
		if($cr->Owner == $us->user) return redirect()->back()->with(['type' => 'error','message' => trans("Nu poti licita pentru acest business.")]);
		if($cr->BidMoneyN < 1) return redirect()->back()->with(['type' => 'error','message' => trans("Acest business nu mai este disponibila la licitatie.")]);
		if($us->BankMoney < $cr->BidMoney+$cr->BidMoneyN) return redirect()->back()->with(['type' => 'error','message' => trans("You don't have enough money. (".General::format($cr->BidMoney+$cr->BidMoneyN)."$)")]);
		$cr->BidMoney += $cr->BidMoneyN;
		$cr->BidLastPlayer = $us->user; $cr->save();
		$us->LastBidB = $cr; $us->save();
		return redirect()->back()->with(['type' => 'success','message' => trans('Ai licitat suma de '.General::format($cr->BidMoney).'$ pentru business ID #'.$cr->ID.'.')]);
	}
	
	public function buy(Request $request)
	{
		$us = \Auth::user();
		$cr = Car::find($request->id);
		$crs = User::find($cr->Owner);
		if($cr->SONP < 1 || $cr->SON != 1 || $cr->Owner == $us->ID) return redirect()->back()->with(['type' => 'error','message' => trans("Acest vehicul nu mai este disponibil pentru cumparare.")]);
		if($us->TotVeh+1 >= $us->SlotVeh) return redirect()->back()->with(['type' => 'error','message' => trans("You don't have enough vehicles slot. (/shop -> Vehicle Slot)")]);
		if($us->BankMoney < $cr->SONP) return redirect()->back()->with(['type' => 'error','message' => trans("You don't have enough money. (Money in bank)")]);
		if($us->Status == 0 && $crs->Status == 0)
		{
			$cr->VW = 0; $cr->SON = 0; $cr->Owner = $us->ID; $cr->save(); $cr->push();
			$us->TotVeh += 1; $us->save(); $us->push();
			$crs->BankMoney += $cr->SONP; $crs->save(); $crs->push();
			$us->BankMoney -= $cr->SONP; $us->save(); $us->push();
			DB::table('logs')->insert([['pName' => $us->user, 'Text' => 'Buying vehicle '.General::vehicle($cr->Model).' for '.General::format($cr->SONP).'$ from '.$crs->user.'. ('.number_format($cr->KM, 0).' KM and '.number_format((Carbon::now()->timestamp-$cr->Days)/86400).' Days)', 'Tip' => 6, 'Date' => time()]]);
			DB::table('logs')->insert([['pName' => $crs->user, 'Text' => 'Selling vehicle '.General::vehicle($cr->Model).' for '.General::format($cr->SONP).'$ to '.$us->user.'. ('.number_format($cr->KM, 0).' KM and '.number_format((Carbon::now()->timestamp-$cr->Days)/86400).' Days)', 'Tip' => 6, 'Date' => time()]]);
			return redirect()->back()->with(['type' => 'success','message' => trans('You bought vehicle '.General::vehicle($cr->Model).' for '.General::format($cr->SONP).'$ from '.$crs->user.'. ('.number_format($cr->KM, 0).' KM / '.number_format((Carbon::now()->timestamp-$cr->Days)/86400).' Days)')]);
		}
		if($us->Status == 1 && $crs->Status == 0)
		{
			$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		    if(@socket_connect($socket, '193.203.39.215', '7778'))
	    	{
				$cr->SON = 0; $cr->Owner = $us->ID; $cr->save(); $cr->push();
				$crs->BankMoney += $cr->SONP; $crs->save(); $crs->push();
				$coad = "a|".$cr->ID."|".$us->Pid."|".$crs->user."|".$cr->SONP."";
				socket_write($socket, $coad, strlen($coad));
		    }
		    socket_close($socket);
		    DB::table('logs')->insert([['pName' => $us->user, 'Text' => 'Buying vehicle '.General::vehicle($cr->Model).' for '.General::format($cr->SONP).'$ from '.$crs->user.'. ('.number_format($cr->KM, 0).' KM and '.number_format((Carbon::now()->timestamp-$cr->Days)/86400).' Days)', 'Tip' => 6, 'Date' => time()]]);
			DB::table('logs')->insert([['pName' => $crs->user, 'Text' => 'Selling vehicle '.General::vehicle($cr->Model).' for '.General::format($cr->SONP).'$ to '.$us->user.'. ('.number_format($cr->KM, 0).' KM and '.number_format((Carbon::now()->timestamp-$cr->Days)/86400).' Days)', 'Tip' => 6, 'Date' => time()]]);
			return redirect()->back()->with(['type' => 'success','message' => trans('You bought vehicle '.General::vehicle($cr->Model).' for '.General::format($cr->SONP).'$ from '.$crs->user.'. ('.number_format($cr->KM, 0).' KM / '.number_format((Carbon::now()->timestamp-$cr->Days)/86400).' Days)')]);
		}
		if($us->Status == 0 && $crs->Status == 1)
		{
			$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		    if(@socket_connect($socket, '193.203.39.215', '7778'))
	    	{
	    		$cr->SON = 0; $cr->save(); $cr->push();
				$us->TotVeh += 1; $us->save(); $us->push();
				$us->BankMoney -= $cr->SONP; $us->save(); $us->push();
				$coad = "s|".$cr->ID."|".$crs->Pid."|".$us->user."|".$us->ID."";
				socket_write($socket, $coad, strlen($coad));
		    }
		    socket_close($socket);
		    DB::table('logs')->insert([['pName' => $us->user, 'Text' => 'Buying vehicle '.General::vehicle($cr->Model).' for '.General::format($cr->SONP).'$ from '.$crs->user.'. ('.number_format($cr->KM, 0).' KM and '.number_format((Carbon::now()->timestamp-$cr->Days)/86400).' Days)', 'Tip' => 6, 'Date' => time()]]);
		    DB::table('logs')->insert([['pName' => $crs->user, 'Text' => 'Selling vehicle '.General::vehicle($cr->Model).' for '.General::format($cr->SONP).'$ to '.$us->user.'. ('.number_format($cr->KM, 0).' KM and '.number_format((Carbon::now()->timestamp-$cr->Days)/86400).' Days)', 'Tip' => 6, 'Date' => time()]]);
			return redirect()->back()->with(['type' => 'success','message' => trans('You bought vehicle '.General::vehicle($cr->Model).' for '.General::format($cr->SONP).'$ from '.$crs->user.'. ('.number_format($cr->KM, 0).' KM / '.number_format((Carbon::now()->timestamp-$cr->Days)/86400).' Days)')]);
		}
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	    if(@socket_connect($socket, '193.203.39.215', '7778'))
    	{
			$coad = "d|".$cr->ID."|".$us->Pid."|".$crs->Pid."";
			socket_write($socket, $coad, strlen($coad));
	    }
	    socket_close($socket);
	    DB::table('logs')->insert([['pName' => $us->user, 'Text' => 'Buying vehicle '.General::vehicle($cr->Model).' for '.General::format($cr->SONP).'$ from '.$crs->user.'. ('.number_format($cr->KM, 0).' KM and '.number_format((Carbon::now()->timestamp-$cr->Days)/86400).' Days)', 'Tip' => 6, 'Date' => time()]]);
		DB::table('logs')->insert([['pName' => $crs->user, 'Text' => 'Selling vehicle '.General::vehicle($cr->Model).' for '.General::format($cr->SONP).'$ to '.$us->user.'. ('.number_format($cr->KM, 0).' KM and '.number_format((Carbon::now()->timestamp-$cr->Days)/86400).' Days)', 'Tip' => 6, 'Date' => time()]]);
		return redirect()->back()->with(['type' => 'success','message' => trans('You bought vehicle '.General::vehicle($cr->Model).' for '.General::format($cr->SONP).'$ from '.$crs->user.'. ('.number_format($cr->KM, 0).' KM / '.number_format((Carbon::now()->timestamp-$cr->Days)/86400).' Days)')]);
	}
	public function buyDS(Request $request)
	{
		$us = \Auth::user();
		if($us->ID > 1 || $us->Status != 0) return redirect()->back()->with(['type' => 'error','message' => trans("Trebuie sa fii offline pe server. (in lucru)")]);
		$cr = DB::table('dstock')->where('Model','=',$request->id)->first();
		if($cr->Stock < 1) return redirect()->back()->with(['type' => 'error','message' => trans("Nu mai sunt stocuri pentru acest vehicul.")]);
		if($us->TotVeh+1 >= $us->SlotVeh) return redirect()->back()->with(['type' => 'error','message' => trans("You don't have enough vehicles slot. (/shop -> Vehicle Slot)")]);
		if($us->BankMoney < $cr->Price) return redirect()->back()->with(['type' => 'error','message' => trans("You don't have enough money. (Money in bank)")]);

		DB::table('dstock')->where('Model', $request->id)->update(['TotB' => $cr->TotB+1, 'Stock' => $cr->Stock-1]);

		$us->TotVeh += 1;
		$us->BankMoney -= $cr->Price;
		$us->save(); $us->push();

		DB::table('logs')->insert([['pName' => $us->user, 'Text' => 'Buying vehicle '.General::vehicle($cr->Model).' for '.General::format($cr->Price).'$ from Dealership. (Panel)', 'Tip' => 6, 'Date' => time()]]);
		DB::table('vehicles')->insert([['Owner' => $us->ID, 'Class' => General::clv($cr->Model), 'Paintjob' => 3, 'Value' => $cr->Price, 'Model' => $cr->Model, 'PosX' => 880.2360, 'PosY' => -1217.4213, 'PosZ' => 16.9971, 'VAngle' => 268.4327, 'Plate' => $us->user, 'Lock' => 1, 'Days' => time()]]);
        return redirect()->back()->with(['type' => 'success','message' => trans('You bought vehicle '.General::vehicle($cr->Model).' for '.General::format($cr->Price).'$ from Dealership.')]);
	}
	public function buyDSS(Request $request)
	{
		$us = \Auth::user();
		if($us->ID > 1 || $us->Status != 0) return redirect()->back()->with(['type' => 'error','message' => trans("Trebuie sa fii offline pe server.")]);
		$cr = DB::table('dstock')->where('Model','=',$request->id)->first();
		if($us->TotVeh+1 >= $us->SlotVeh) return redirect()->back()->with(['type' => 'error','message' => trans("You don't have enough vehicles slot. (/shop -> Vehicle Slot)")]);
		if($us->Diamonds < $cr->Price) return redirect()->back()->with(['type' => 'error','message' => trans("You don't have enough diamonds.")]);

		DB::table('dstock')->where('Model', $request->id)->update(['TotB' => $cr->TotB+1]);

		$us->TotVeh += 1;
		$us->Diamonds -= $cr->Price;
		$us->save(); $us->push();

		DB::table('logs')->insert([['pName' => $us->user, 'Text' => 'Buying vehicle '.General::vehicle($cr->Model).' for '.General::format($cr->Price).'$ from Dealership. (Panel)', 'Tip' => 6, 'Date' => time()]]);
		DB::table('vehicles')->insert([['Owner' => $us->ID, 'Class' => 'Specials', 'Paintjob' => 3, 'Value' => $cr->Price, 'Model' => $cr->Model, 'PosX' => 880.2360, 'PosY' => -1217.4213, 'PosZ' => 16.9971, 'VAngle' => 268.4327, 'Plate' => $us->user, 'Lock' => 1, 'Days' => time()]]);
        return redirect()->back()->with(['type' => 'success','message' => trans('You bought vehicle '.General::vehicle($cr->Model).' for '.General::format($cr->Price).'$ from Dealership.')]);
	}
	public function SaveTh() {
		$us = \Auth::user();
		$us->T = $_POST['id'];
		$us->save(); $us->push();
	}
	public function postAdminA() {
		$status = Option::where('option_name',$_POST['type'] === 'h' ? 'helperAppStatus' : 'leaderAppStatus')->first();
		if($status) {
			$status->option_value = $_POST['value'];
			$status->save(); $status->push();
		}
		else { Option::create(['option_name' => $_POST['type'] === 'h' ? 'helperAppStatus' : 'leaderAppStatus', 'option_value' => $_POST['value'],]); }
	}
	public function postAdminQ()
	{
		$data = []; $new = [];
		parse_str($_POST['data'],$data);
		$config = HTMLPurifier_Config::createDefault();
		$purifier = new HTMLPurifier($config);
		foreach($data as $d) { $new[] = $purifier->purify($d); }
		$q = Option::where('option_name',$_POST['type'] === 'h' ? 'helperQuestions' : 'leaderQuestions')->first();
		if($q) {
			$q->option_value = json_encode(array_values($new));
			$q->save(); $q->push();
		}
		else { Option::create(['option_name' => $_POST['type'] === 'h' ? 'helperQuestions' : 'leaderQuestions', 'option_value' => json_encode(array_values($new))]); }
	}

	public function editTIT()
	{
		$eid = Indx::find($_POST['id']);
		DB::table('indexanolog')->insert([['Text' => ''.Auth::user()->user.' a editat titlul din "'.$eid->Title.'" in "'.$_POST['title'].'".', 'ID' => $_POST['id']]]);
		$eid->Title = $_POST['title'];
		$eid->save();
		return 1;
	}
	public function editSecTIT()
	{
		$eid = Indx::find($_POST['id']);
		DB::table('indexanolog')->insert([['Text' => ''.Auth::user()->user.' a editat titlul secundar din "'.$eid->SecondTitle.'" in "'.$_POST['title'].'".', 'ID' => $_POST['id']]]);
		$eid->SecondTitle = $_POST['title'];
		$eid->save();
		return 1;
	}
	public function editIMG()
	{
		$eid = Indx::find($_POST['id']);
		DB::table('indexanolog')->insert([['Text' => ''.Auth::user()->user.' a editat linkul imaginii din "'.$eid->ImgLink.'" in "'.$_POST['title'].'".', 'ID' => $_POST['id']]]);
		$eid->ImgLink = $_POST['title'];
		$eid->save();
		return 1;
	}

	public function removeADT()
	{
		$q = Indx::where('ID', '=', $_POST['id'])->delete();
		DB::table('indexanolog')->insert([['Text' => ''.Auth::user()->user.' a sters topicul din index.', 'ID' => $_POST['id']]]);
		return 1;
	}

	public function postIndex(Request $request)
	{
		$request->flash();
		$user = Auth::user();
		if(!$request->input('title') || !$request->input('description') || !$request->input('link')) return \Redirect::back()->withErrors([trans('messages.complete')]);
		$config = HTMLPurifier_Config::createDefault();
		$purifier = new HTMLPurifier($config);
		$tes = Indx::create([
			'Title' => $purifier->purify($request->input('title')),
			'SecondTitle' => $purifier->purify($request->input('stitle')),
			'PostedBy' => $user->user,
			'PostedByID' => $user->ID,
			'Text' => $purifier->purify($request->input('description')), 'ImgLink' => $purifier->purify($request->input('link')),'Skin' => $user->SkinID]);
		DB::table('indexanolog')->insert([['Text' => ''.$user->user.' a creat un nou topic. (Titlu: "'.$purifier->purify($request->input('title')).'", Titlu secundar: "'.$purifier->purify($request->input('stitle')).'")', 'ID' => $tes->ID]]);
		return \Redirect::back()->with(['type' => 'success', 'title' => 'INDEX ANNOUNCES', 'message' => trans('Topicul a fost publicat cu succes!')]);
	}

	public function postUpdate(Request $request)
	{
		$request->flash();
		$user = Auth::user();
		if($user->ID != 4) return redirect()->back()->with(['type' => 'danger','message' => 'Doar Spoker (scripterul) poate posta update-uri!']);
		if(!$request->input('title') || !$request->input('description')) return redirect()->back()->with(['type' => 'danger','message' => 'Completeaza toata box-urile!']);
		$config = HTMLPurifier_Config::createDefault();
		$purifier = new HTMLPurifier($config);
		$id = DB::table('updates')-> insertGetId(array('Text' => $purifier->purify($request->input('description')), 'Version' => $purifier->purify($request->input('title')), 'Rate' => 0, 'TotalV' => 0));
		DB::table('rateupdate')->update(['Total' => 0, '1Star' => 0, '2Star' => 0, '3Star' => 0, '4Star' => 0, '5Star' => 0]);
		DB::table('players')->update(['RateUP' => 0]);
		return redirect()->back()->with(['type' => 'success','message' => 'Update-ul a fost postat cu succes pe panel!']);
	}

	public function postSearch() {
		$data = User::where('user','like',$_POST['search'].'%')->take(50)->get();
		return view('search', ['searched' => $data]);
	}

	public function changeLanguage($language)
	{
		\Session::set('locale', $language);
		return \Redirect::back()->with(['type' => 'success','message' => trans('messages.language_changed')]);
	}
}
