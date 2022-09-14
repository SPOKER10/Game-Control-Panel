<?php
namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Infinity\General;
use App\Donation;
use App\User;
use Auth;
use HTMLPurifier_Config;
use HTMLPurifier;
use Redirect;
use DB;

class DonationController extends Controller
{
	
    public function __construct()
    {

    }

	public function donationList() { return view('donations.list',['donations' => Donation::orderBy('donateTime','desc')->paginate(15)]); }
	
	public function donationView($id)
	{
		$t = Donation::where('donateID',$id)->first();
		if(!$t) return view('errors.404');
		return view('donations.view',['donation' => $t]);
	}
	
	public function donationViewPost($id,Request $request)
	{
		$t = Donation::where('donateID',$id)->first();
		if(!$t) return view('errors.404');
		$user = Auth::user();
		
		if(isset($_POST['donation_respond'])) {
			if($t->donateStatus != 0) return Redirect::back();
			if($user->AdminLevel >= 6) {

					$t->donateStatus = $request->input('_action');
					$t->donateAdminAction = date('Y-m-d H:i:s');
					$t->save(); $t->push();
				}
		}
		
		return Redirect::back();
	}
	
	public function donationCreate() { return view('donations.create'); }	
	public function donationCreatePost(Request $request)
	{
		$this->validate($request,['_pin' => 'required', '_sum' => 'required',]);
		$d = Donation::create([
			'donateName' => Auth::user()->name,
			'donateSUM' => $request->input('_sum'),
			'donatePIN' => $request->input('_pin'),
			'donateTime' => date('Y-m-d H:i:s'),
			'donateStatus' => 0,
			'donateAdminAction' => '',
		]);
		return redirect('donation/view/' . $d->donateID);
	}
	
	public function epayouts()
	{
		$epayouts_ip = '137.74.17.102';
		if($_SERVER["REMOTE_ADDR"]==$epayouts_ip)
		{
			$type = isset($_GET['type']) ? $_GET['type'] : null;
			
			$price = isset($_GET['price']) ? $_GET['price'] : null;
			$currency = isset($_GET['currency']) ? $_GET['currency'] : null;
			$result = isset($_GET['result']) ? $_GET['result'] : null;
				
			$ucode = isset($_GET['ucode']) ? $_GET['ucode'] : null;
				
			$code = isset($_GET['code']) ? $_GET['code'] : '';
			$email = isset($_GET['email']) ? $_GET['email'] : '';
				
			if($currency && $price && strtolower($currency)=='eur' && strtolower($result)=='ok')
			{
				$diamonds = intval($price) * 20;
				DB::table('players')->where('ID', $ucode)->increment('Diamonds', $diamonds);
				Donation::create([
					'donateName' => $ucode,
					'donateSUM' => intval($price),
					'Method' => 'E-Payouts',
					'Code' => $code,
					'Email' => $email
				]);
				$ce = User::where('ID', '=', $ucode)->first();
				if($ce->Status == 1)
				{
					$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
				    if(@socket_connect($socket, '193.203.39.215', '7778'))
			    	{
						$coad = "p|".$ce->Pid."|".$diamonds."|".'* Felicitari, ai cumparat '.$diamonds.' Diamonds, multumim frumos!'."";
						socket_write($socket, $coad, strlen($coad));
				    }
				    socket_close($socket);
				}
			}
		}
		die();
	}

	public function paypal()
	{
		$paypal_email = "razvynodiemetin2@gmail.com";
		if (isset($_POST["txn_id"]) && isset($_POST["txn_type"]) && isset($_POST["item_number"]) && isset($_POST["payment_status"]) && isset($_POST["mc_gross"])&& isset($_POST["mc_currency"])&& isset($_POST["receiver_email"])&& isset($_POST["custom"]) && strtolower($_POST['receiver_email']) == strtolower($paypal_email) && strtolower($_POST["mc_currency"]) == "eur")
		{
			$req = 'cmd=_notify-validate';
			foreach ($_POST as $key => $value) {
				$value = urlencode(stripslashes($value));
				$value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}',$value);// IPN fix
				$req .= "&$key=$value";
			}
			
			$curl_result='';
			$ch = curl_init();
			//curl_setopt($ch, CURLOPT_URL,'https://www.sandbox.paypal.com/cgi-bin/webscr');
			curl_setopt($ch, CURLOPT_URL,'https://www.paypal.com/cgi-bin/webscr');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
			curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded", "Content-Length: " . strlen($req)));
			curl_setopt($ch, CURLOPT_HEADER , 1);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);

			$curl_result = curl_exec($ch);

			curl_close($ch);
			
			if (strpos($curl_result, "VERIFIED")!==false) {
				$diamonds = intval($_POST['mc_gross']) * 20;
				DB::table('players')->where('ID', $_POST['custom'])->increment('Diamonds', $diamonds);
				Donation::create([
					'donateName' => $_POST['custom'],
					'donateSUM' => intval($_POST['mc_gross']),
					'Method' => 'PayPal',
					'Code' => $_POST["txn_id"],
					'Email' => $_POST["payer_email"]
				]);
				$ce = User::where('ID', '=', $_POST['custom'])->first();
				if($ce->Status == 1)
				{
					$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
				    if(@socket_connect($socket, '193.203.39.215', '7778'))
			    	{
						$coad = "p|".$ce->Pid."|".$diamonds."|".'* Felicitari, ai cumparat '.$diamonds.' Diamonds, multumim frumos!'."";
						socket_write($socket, $coad, strlen($coad));
				    }
				    socket_close($socket);
				}
			}
		}
		die();
	}
}
