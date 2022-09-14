<?php

namespace App\Http\Controllers;

use URL;
use DB;
use App\User;
use App\Infinity\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Complaint;
use App\Car;
use App\Business;
use App\House;
use App\Clan;
use App\FLog;
use App\Option;
use App\Ban;
use Carbon\Carbon;
use HTMLPurifier_Config;
use HTMLPurifier;

class ActionController extends Controller
{

    public function __construct()
    {

    }
	
    public function search() {
		$users = \App\User::where('user','like',$_POST['term']['term'].'%')->take(10)->get();
		$results = [];
		foreach($users as $user) { $results[] = ['id' => $user->ID, 'text' => $user->user, 'level' => $user->Level,]; }
		return json_encode(['results' => $results]);
    }

	public function recentB()
	{
		$b = \Cache::remember('indexBans',5,function()
		{
			$html = '';
			$actions = Ban::latest('BanTime')->where('Player','!=','')->take(5)->get();
			if($actions->isEmpty()) $html .= '<div class="feed-element">No recent bans.</div>';
			foreach($actions as $row)
			{
				$user = @User::where('user',$row->Player)->first();
				$admin = @User::where('user',$row->Admin)->first();
				$html .= '<div class="feed-element"><img src="'.URL::to('/').'/assets/a/'.$user->Skin.'.png" class="pull-left img-circle mt" data-toggle="tooltip" data-placement="top" data-html="true" title="<img src='.URL::to('/').'/assets/s/Skin_'.$user->Skin.'.png style=height:84px;vertical-align:middle; /><div style=bottom:33px;float:right;><font style=color:red;text-decoration: line-through;><strike>'.$user->user.'</strike></font></br>Level: '.$user->Score.'</br>RP: '.$user->RPoints.'/'.($user->Score*3).'</br>Hours Played: '.number_format($user->HoursPlayed/3600).'</br>Job: '.General::job($user->Job).'</div>" style="height:38px;"> <div class="media-body ">'.(isset($row->user) ? $row->user->url : $row->Player).' was banned by '.$row->admin->url.'. Reason: '.$row->Reason.' <br><small class="text-muted green"><i class="fa fa-clock-o"></i> '.Carbon::createFromFormat('Y-m-d H:i:s',$row->BanTime)->diffForHumans().' ('.$row->BanTime.')</small></div></div>';
			}
			return $html;
		});
		return $b;
	}

	public function skin(Request $request) {header('Content-Type: image/png');$image = imagecreatefrompng('assets/s/Skin_' . $request->route('id') . '.png');$thumb_width = 300;$thumb_height = 300;$width = imagesx($image);$height = imagesy($image);$original_aspect = $width / $height;$thumb_aspect = $thumb_width / $thumb_height;if ( $original_aspect >= $thumb_aspect ){$new_height = $thumb_height;$new_width = $width / ($height / $thumb_height);}else{$new_width = $thumb_width;$new_height = $height / ($width / $thumb_width);}$thumb = imagecreatetruecolor( $thumb_width, $thumb_height );$transparency = imagecolorallocatealpha($thumb, 0, 0, 0, 127);imagefill($thumb, 0, 0, $transparency);imagesavealpha($thumb, true);imagecopyresampled($thumb,$image,0 - ($new_width - $thumb_width),0,0, 0,$new_width, $new_height,$width, $height);return imagepng($thumb);}
	public function getTypes() { return Complaint::getTypes(User::find($_POST['user'])); }
	public function getReasons() { return Complaint::getReasons($_POST['type']); }
	public function setApp(Request $request) {
		if((\Auth::user()->Member == $_POST['id'] && \Auth::user()->Rank > 5) || \Auth::user()->AdminLevel > 0) {
			$status = Option::where('option_name','factionAppStatus'.$_POST['id'])->first();
			if($status) { $status->option_value = $_POST['type']; $status->save(); $status->push(); }
			else { Option::create(['option_name' => 'factionAppStatus'.$_POST['id'], 'option_value' => $_POST['type'],]); }
		}
	}
	public function foodStar(Request $request)
	{
		$user = \Auth::user();
		$user->RateUP = $request->input('star');
		$user->save(); $user->push();
        DB::table('rateupdate')->increment('Total');
        DB::table('rateupdate')->increment(''.$request->input('star').'Star');
  		return redirect()->back();
    }
	public function locate() {
		$im = imagecreatefromjpeg('assets/images/map_full.jpg');
		switch($_POST['type']) {
			case 'vehicle':
				$v = Car::find($_POST['id']);
				break;
			case 'clan':
				$v = Clan::find($_POST['id']);
				break;
			case 'house':
				$h = House::find($_POST['id']);
				break;
			case 'business':
				$b = Business::find($_POST['id']);
				break;
		}
		switch($_POST['type']) {
			case 'vehicle':
				$x = $v->PosX/3.9;
				$y = $v->PosY/3.9;
				$x = $x + 768;
				$y = -($y - 768);
				$icon = imagecreatefromgif('assets/images/vehicle.gif');
				imagecopyresized($im,$icon,$x,$y,0,0,50,50,16,16);
				break;
			case 'clan':
				$x = $v->ExtX/3.9;
				$y = $v->ExtY/3.9;
				$x = $x + 768;
				$y = -($y - 768);
				$icon = imagecreatefromgif('assets/images/chq.gif');
				imagecopyresized($im,$icon,$x,$y,0,0,50,50,16,16);
				break;
			case 'house':
				$x = $h->EnterX/3.9;
				$y = $h->EnterY/3.9;
				$x = $x + 768;
				$y = -($y - 768);
				$icon = imagecreatefromgif('assets/images/house_owned.gif');
				imagecopyresized($im,$icon,$x,$y,0,0,50,50,16,16);
				break;
			case 'business':
				$x = $b->EnterX/3.9;
				$y = $b->EnterY/3.9;
				$x = $x + 768;
				$y = -($y - 768);
				$icon = imagecreatefromgif('assets/images/business.gif');
				imagecopyresized($im,$icon,$x,$y,0,0,50,50,16,16);
				break;
		}
		$x = $x + 768;
		$y = -($y - 768);
		ob_start();
		$im = imagejpeg($im);
		$outputBuffer = ob_get_clean();
		$base64 = base64_encode($outputBuffer);
		return json_encode(array('image'=>$base64));
	}
	public function setRank() {
		$user = \Auth::user();
		$player = User::find($_POST['id']);
		if($player && $user->Member == $player->Member && $user->Rank == 10)
		{
			if($player->Rank > 5 && $_POST['action'] === 'up') return json_encode(['type' => 'danger','title' => 'Leader Panel','text' => 'Rank maxim: 6.']);
			if($player->Rank < 2 && $_POST['action'] === 'down') return json_encode(['type' => 'danger','title' => 'Leader Panel','text' => 'Rank minim: 1.']);
			switch($_POST['action'])
			{
				case 'up':
				{
					if($player->Status == 0)
					{
						$oldrank = $player->Rank+1;
						DB::table('logfactionsnew')->insert([['pID' => -1, 'FacID' => $player->Member, 'Text' => $player->user.' promoted to rank ' .$oldrank. ' by ' .$user->user. '. (Old Rank: ' .$player->Rank. ')']]);
						DB::table('logfactions')->insert([['pID' => -1, 'FacID' => $player->Member, 'Text' => $player->user.' promoted to rank ' .$oldrank. ' by ' .$user->user. '. (Old Rank: ' .$player->Rank. ')']]);
						$player->Rank = $oldrank;
						$player->save(); $player->push();
					}
					else
					{
						$oldrank = $player->Rank+1;
						$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
					    if(@socket_connect($socket, '193.203.39.215', '7778'))
				    	{
				    		DB::table('logfactionsnew')->insert([['pID' => -1, 'FacID' => $player->Member, 'Text' => $player->user.' promoted to rank ' .$oldrank. ' by ' .$user->user. '. (Old Rank: ' .$player->Rank. ')']]);
							DB::table('logfactions')->insert([['pID' => -1, 'FacID' => $player->Member, 'Text' => $player->user.' promoted to rank ' .$oldrank. ' by ' .$user->user. '. (Old Rank: ' .$player->Rank. ')']]);
							$coad = "w|".$player->Pid."|".$player->Rank."|".$user->user."";
							socket_write($socket, $coad, strlen($coad));
					    }
					    socket_close($socket);
					    $player->Rank = $oldrank;
						$player->save(); $player->push();
					}
				}
				case 'down':
				{
					if($player->Status == 0)
					{
						$oldrank = $player->Rank-1;
						DB::table('logfactionsnew')->insert([['pID' => -1, 'FacID' => $player->Member, 'Text' => $player->user.' promoted to rank ' .$oldrank. ' by ' .$user->user. '. (Old Rank: ' .$player->Rank. ')']]);
						DB::table('logfactions')->insert([['pID' => -1, 'FacID' => $player->Member, 'Text' => $player->user.' promoted to rank ' .$oldrank. ' by ' .$user->user. '. (Old Rank: ' .$player->Rank. ')']]);
						$player->Rank = $oldrank;
						$player->save(); $player->push();
					}
					else
					{
						$oldrank = $player->Rank-1;
						$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
					    if(@socket_connect($socket, '193.203.39.215', '7778'))
				    	{
				    		DB::table('logfactionsnew')->insert([['pID' => -1, 'FacID' => $player->Member, 'Text' => $player->user.' promoted to rank ' .$oldrank. ' by ' .$user->user. '. (Old Rank: ' .$player->Rank. ')']]);
							DB::table('logfactions')->insert([['pID' => -1, 'FacID' => $player->Member, 'Text' => $player->user.' promoted to rank ' .$oldrank. ' by ' .$user->user. '. (Old Rank: ' .$player->Rank. ')']]);
							$coad = "q|".$player->Pid."|".$player->Rank."|".$user->user."";
							socket_write($socket, $coad, strlen($coad));
					    }
					    socket_close($socket);
					    $player->Rank = $oldrank;
						$player->save(); $player->push();
					}
				}
			}
			return json_encode(['type' => 'success','title' => 'Leader Panel','text' => 'Ai setat rank-ul lui ' .$player->user. ' la ' .$player->Rank. '.']);
		}
	}

	public function setcRank() {
		$user = \Auth::user();
		$player = User::find($_POST['id']);
		if($player && $user->Clan == $player->Clan && $user->CRank == 7)
		{
			if($player->CRank > 5 && $_POST['action'] === 'up') return json_encode(['type' => 'danger','title' => 'Clan Panel','text' => 'Rank maxim: 6.']);
			if($player->CRank < 2 && $_POST['action'] === 'down') return json_encode(['type' => 'danger','title' => 'Clan Panel','text' => 'Rank minim: 1.']);
			switch($_POST['action'])
			{
				case 'up':
				{
					if($player->Status == 0)
					{
						$oldrank = $player->CRank+1;
						DB::table('clanlogs')->insert([['clanID' => $player->Clan, 'Text' => $player->user.' promoted to rank ' .$oldrank. ' by ' .$user->user. '. (Old Rank: ' .$player->CRank. ')']]);
						$player->CRank = $oldrank;
						$player->save(); $player->push();
						break;
					}
					$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
				    if(@socket_connect($socket, '193.203.39.215', '7778'))
			    	{
						$coad = "3|".$player->Pid."|".$player->CRank."|".$user->user."";
						socket_write($socket, $coad, strlen($coad));
				    }
				    socket_close($socket);
				    break;
				}
				case 'down':
				{
					if($player->Status == 0)
					{
						$oldrank = $player->CRank-1;
						DB::table('clanlogs')->insert([['clanID' => $player->Clan, 'Text' => $player->user.' promoted to rank ' .$oldrank. ' by ' .$user->user. '. (Old Rank: ' .$player->CRank. ')']]);
						$player->CRank = $oldrank;
						$player->save(); $player->push();
						break;
					}
					$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
				    if(@socket_connect($socket, '193.203.39.215', '7778'))
			    	{
						$coad = "0|".$player->Pid."|".$player->CRank."|".$user->user."";
						socket_write($socket, $coad, strlen($coad));
				    }
				    socket_close($socket);
				    break;
				}
			}
			return json_encode(['type' => 'success','title' => 'Clan Panel','text' => 'Ai setat rank-ul lui ' .$player->user. ' la ' .$player->CRank. '.']);
		}
	}

	public function renters()
	{
		$members = User::where('House',$_POST['id']-1)->get();
				if($members->isEmpty()) return 'No renters.';
				$html = '
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Username</th>
								<th>Level</th>
								<th>Hours</th>
								<th>Last Login</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>';
				foreach($members as $m) {
					$html .=
						'<tr>
							<td><img src="'.URL::to('/').'/assets/a/'.$m->Skin.'.png" class="img-circle" style="height:30px;">'.$m->url.'</br>'.$m->roles.'</td>
							<td>'.$m->Score.'</td>
							<td>'.number_format($m->HoursPlayed/3600).'</td>
							<td>'.$m->LastLogin.'</td>
							<td><a href="'.url('complaints/create') .'/'.$m->id.'" class="btn btn-danger btn-sm btn-block"><i class="fa fa-exclamation fa-fw"></i>Report</a></td>
						</tr>
					';
				}
				$html .= '</tbody></table></div>';
				return $html;
				break;
	}

	public function getMembers() {
		switch($_POST['type']) {
			case 'f': {
				$members = User::group($_POST['id'])->orderBy('Rank','desc')->get();
				if($members->isEmpty()) return 'This faction does not have any members.';
				$html = '
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Username</th>
								<th>Rank</th>
								<th>FW</th>
								<th>Last Login</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>';
				foreach($members as $m) {
					$html .=
						'<tr>
							<td><img src="'.URL::to('/').'/assets/a/'.$m->Skin.'.png" class="img-circle" style="height:30px;">'.$m->url.'</br>'.$m->roles.'</td>
							<td>'.($m->Rank == 10 ? 'Leader' : $m->Rank).'</td>
							<td>'.$m->FWarns.'/3</td>
							<td>'.$m->LastLogin.'</td>
							<td><a href="'.url('complaints/create') .'/'.$m->id.'" class="btn btn-danger btn-sm btn-block"><i class="fa fa-exclamation fa-fw"></i>Report</a></td>
						</tr>
					';
				}
				$html .= '</tbody></table></div>';
				return $html;
				break;
			}
			case 'c': {
                $members = User::where('Clan',$_POST['id']-1)->orderBy('CRank','desc')->get();
				if(!$members) return 'This clan does not have any members.';
				$html = '
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Username</th>
								<th>Rank</th>
								<th>Last Login</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>';
				foreach($members as $m) {
					$html .=
						'<tr>
							<td><img src="'.URL::to('/').'/assets/a/'.$m->Skin.'.png" class="img-circle" style="height:30px;">'.$m->url.'</br>'.$m->roles.'</td>
							<td>'.($m->CRank == 7 ? 'Leader' : $m->CRank).'</td>
							<td>'.$m->LastLogin.'</td>
							<td><a href="'.url('complaints/create') .'/'.$m->ID.'" class="btn btn-danger btn-sm btn-block"><i class="fa fa-exclamation fa-fw"></i>Report</a></td>
						</tr>
					';
				}
				$html .= '</tbody></table></div>';
				return $html;
				break;
			}
		}
	}

	public function factionLogs()
	{
		$html = '';
		$v = Clan::find($_POST['id']);
			$html = '
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Rank</th>
								<th>Name</th>
								<th>Members</th>
							</tr>
						</thead>
						<tbody>';
					$html .= '<tr>
							<td>1</td>
							<td>'.$v->Rank1.'</td>
							<td>'.User::where('CRank','=','1')->where('Clan','=',$v->ID-1)->count().'</td>
						</tr>
						<tr>
							<td>2</td>
							<td>'.$v->Rank2.'</td>
							<td>'.User::where('CRank','=','2')->where('Clan','=',$v->ID-1)->count().'</td>
						</tr>
						<tr>
							<td>3</td>
							<td>'.$v->Rank3.'</td>
							<td>'.User::where('CRank','=','3')->where('Clan','=',$v->ID-1)->count().'</td>
						</tr>
						<tr>
							<td>4</td>
							<td>'.$v->Rank4.'</td>
							<td>'.User::where('CRank','=','4')->where('Clan','=',$v->ID-1)->count().'</td>
						</tr>
						<tr>
							<td>5</td>
							<td>'.$v->Rank5.'</td>
							<td>'.User::where('CRank','=','5')->where('Clan','=',$v->ID-1)->count().'</td>
						</tr>
						<tr>
							<td>6</td>
							<td>'.$v->Rank6.'</td>
							<td>'.User::where('CRank','=','6')->where('Clan','=',$v->ID-1)->count().'</td>
						</tr>
						<tr>
							<td>Leader</td>
							<td>'.$v->Rank7.'</td>
							<td>'.User::where('CRank','=','7')->where('Clan','=',$v->ID-1)->count().'</td>
						</tr>
					';
				$html .= '</tbody></table></div>';

		return $html;
	}

	public function clanLogs()
	{
		$html = '';
		$logs = DB::table('clanlogs')->where('clanID',$_POST['id']-1)->orderBy('Date','desc')->get();
		if($logs->isEmpty()) return 'This clan does not have any logs.';
		$html = '
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Text</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>';
			foreach($logs as $l)
			{
				$html .= '<tr>
						<td>'.$l->Text.'</td>
						<td>'.$l->Date.'</td>
					</tr>
				';
			}
			$html .= '</tbody></table></div>';
		return $html;
	}

	public function setQuestions()
	{
		$data = []; $new = [];
		parse_str($_POST['data'],$data);
		$config = HTMLPurifier_Config::createDefault();
		$purifier = new HTMLPurifier($config);
		foreach($data as $d) { $new[] = $purifier->purify($d); }
		$q = Option::where('option_name','factionQuestions'.$_POST['id'])->first();
		if($q) { $q->option_value = json_encode(array_values($new)); $q->save(); $q->push(); }
		else { Option::create(['option_name' => 'factionQuestions'.$_POST['id'], 'option_value' => json_encode(array_values($new))]); }
	}
}
