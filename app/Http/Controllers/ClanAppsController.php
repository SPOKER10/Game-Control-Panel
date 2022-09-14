<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Infinity\General;
use App\Clan;
use App\ClanApp;
use App\Option;
use App\User;
// use App\{Clan, ClanApp, Option, User};
use Auth;
use HTMLPurifier_Config;
use HTMLPurifier;

class ClanAppsController extends Controller
{

    protected $type;

    function __construct(Request $request) {
        $this->type = $request->route()->parameter('type') !== 'applications';
    }

    public function create($clan) {

	$s = Option::where('option_name', 'clanAppStatus' . $clan)->first();
        if($s && !$s->option_value) return redirect()->back()->withErrors(['Applications are closed']);
 	$l = Option::where('option_name', 'clanAppLevel' . $clan)->first();
        if($l && $l->option_value > Auth::user()->Level) return redirect()->back()->withErrors(['Nu ai nivelul minim de a aplica.']);


        // prone to error if questions don't exist in database (they should always be there, the default at least)
        $questions = json_decode(Option::where('option_name','clanAppQuestions' . $clan)
            ->orWhere('option_name', 'clanAppQuestions')->orderBy('updated_at','desc')->limit(1)->first()->option_value, true);
        return view('clanapps.create', ['questions' => $questions[(int) $this->type],'type' => $this->type]);
    }

    public function createPost(Request $request, $clan) {
        $user = Auth::user();
        if($user->HoursPlayed/3600 < 1) return view('complaints.create',['user' => User::find($userid)])->withErrors(['Nu ai minim o ora jucata.']);
        if($user->Clan !== -1 && !$this->type) return redirect()->back()->withErrors(['You are already in a clan!']);
        if($this->type && $user->Clan != $clan) return redirect()->back()->withErrors(['You cannot make a resignation here.']);
        if($app = ClanApp::where('userid',$user->ID)->where('type', (int) $this->type)->whereIn('status',[0,1])->first()) return redirect()->back()->withErrors([trans('messages.already_applied',['link' => $app->url])]);
        $s = Option::where('option_name', 'clanAppStatus' . $clan)->first();
        if($s && !$s->option_value) return redirect()->back()->withErrors(['Applications are closed']);
 	$l = Option::where('option_name', 'clanAppLevel' . $clan)->first();
        if($l && $l->option_value > Auth::user()->Level) return redirect()->back()->withErrors(['Nu ai nivelul minim de a aplica.']);

        $questions = json_decode(Option::where('option_name','clanAppQuestions' . $clan)
            ->orWhere('option_name', 'clanAppQuestions')->orderBy('updated_at','desc')->limit(1)->first()->option_value, true);
        
        $count = 0;
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);

        foreach($questions[(int) $this->type] as $i=>$q) {
            $ans[$q] = $purifier->purify($request->input('a'.$i));
            if($request->input('a'.$i)) $count++;
        }
        if(count($questions[(int) $this->type]) != $count) return redirect()->back()->withErrors([trans('messages.complete')]);
        else {
            $code = General::getUnique();
            $user->PAO++;
            $user->save();
            ClanApp::create([
                'userid' => $user->ID,
                'clan' => $clan,
                'code' => $code,
                'type' => (int) $this->type,
                'questions' => json_encode($ans)
            ]);

            $users = User::where('Clan', $clan)->where('CRank', '>=', 6)->get();

            foreach ($users as $u) {
                \DB::table('emails')->insert([
                    'playerid' => $u->ID,
                    'Time' => date('Y-m-d H:i:s'),
                    'Message' => $user->name.' a creat o noua ' . (!$this->type ? 'aplicatie' : 'demisie'),
                    'LinkPanel' => 'clans/' . $clan . '/' . (!$this->type ? 'applications' : 'resignations') . '/view/' . $code,
                    'Skin' => $user->SkinID,
                    'OI' => 3
                ]);
            }
			return redirect()->route('clanViewApp', [
                'clan' => $clan,
                'type' => !$this->type ? 'applications' : 'resignations',
                'app' => $code
            ]);
        }
    }

    // Apparently you cannot name this "list" as it is a function name in lower PHP versions (only works on 7.2+)
    public function listApp($clan) {
        if($this->type && Auth::user()->Clan != $clan) return abort(404);
        return view('clanapps.list', [
            'apps' => ClanApp::with(['user', 'ans'])->where([
                'type' => (int) $this->type,
                'clan' => $clan
            ])->latest()->paginate(50),
            'type' => $this->type
        ]);
    }


    public function view($clan, $type, $app) {
        return view('clanapps.view', ['app' => ClanApp::where('code', $app)->firstOrFail() ]);
    }

    public function viewPost($clan, $type, $app) {
        $a = ClanApp::where('code', $app)->first();
		$user = Auth::user();
		if(isset($_POST['app_cancel']) && in_array($a->status,[1,2,3,4])) return redirect()->back();
		if(isset($_POST['app_cancel']) && $a->userid == $user->ID) { $a->status = 4; $a->answerer = $user->ID; $a->save(); $a->push(); return redirect()->back()->with('message','Ai anulat aplicatia cu succes.'); }
		if(($user->AdminLevel >= 5) || ($user->Clan+1 == $a->clan && $user->CRank > 5)) {

			if(isset($_POST['app_tests']) && $a->status != 0) return redirect()->back();
			if(isset($_POST['app_accept']) && $a->status != 1) return redirect()->back();
			if(isset($_POST['app_reject']) && in_array($a->status,[2,3,4])) return redirect()->back();

			$text = '';
			if(isset($_POST['app_tests'])) { $a->status = 1; $text = 'acceptat pentru teste'; }
			else if(isset($_POST['app_accept'])) { $a->status = 2; $text = 'acceptat'; }
			else if(isset($_POST['app_reject'])) { $a->status = 3; $text = 'respins'; }
			if(!isset($_POST['appc']) || trim($_POST['appc'])=== '' ? ($a->specifications = 'No') : ($a->specifications = $_POST['appc']))
            $a->answerer = $user->ID;

			\DB::table('emails')->insert([
                'playerid' => $a->user->ID,
                'Time' => date('Y-m-d H:i:s'),
                'Message' => $user->name.' a '. $text . ' ' . (!$a->type ? 'aplicatia' : 'demisia') . ' ta ',
                'LinkPanel' => 'clans/' . $clan . '/' . (!$a->type ? 'applications' : 'resignations') . '/view/' . $a->code,
                'Skin' => $user->SkinID,
                'OI' => 1
            ]);

			$a->save(); $a->push();

			return redirect()->back()->with('message','Ai ' . $text . ' aplicatia.');
		}
    }

}