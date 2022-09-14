@extends('layouts.master')

@section('breadcrumb','Premium')

@section('content')

<center>
</br>Aici poti efectua o donatie comunitatii pentru a cumpara <b>Diamonds</b>.
</br>Cu <b>Diamonds</b> poti cumpara produse din shop si vehicule speciale din Dealership.

<br><br><img src="https://www.e-payouts.com/img/logo-header.png" /></br></br>
<?php
	$us = \Auth::user();
	$epayouts_uid = 172;
	$epayouts_mid = 1930;
	$ucode = $us->ID;
	
	$paypal_email = "razvynodiemetin2@gmail.com";
	$return_url   = 'https://rpg.linkmania.ro/';
	$cancel_url   = 'https://rpg.linkmania.ro/premium';
	$notify_url   = 'https://rpg.linkmania.ro/paypal';
	$item_name    = 'LinkMania Diamonds - '.$us->name;

	$querystring = [
		'business'      => $paypal_email,
		'cmd'           => '_xclick',
		'item_name'     => $item_name,
		'return'        => $return_url,
		'cancel_return' => $cancel_url,
		'notify_url'    => $notify_url,
		'custom'    => $ucode,
		'no_note'    => "1",
		'currency_code'    => "EUR",
		'bn'    => "PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest",
		'first_name'    => $us->name,
	];
?>
<div class="panel panel-success">
            <div class="panel-heading clearfix">
                <h2 class="pull-left panel-title"><i class="fa fa-briefcase"></i> Plăți automate - E-Payouts</h2></div>
            
			<div class="panel-body updatesb">
				<form class="form-control" style="height: 100%" method="get" action="https://paymentbox.e-payouts.com/" enctype="multipart/form-data" target="_blank">
					<input type="hidden" name="ucode" value="<?php print $ucode; ?>" />
					<input type="hidden" name="uid" value="<?php print $epayouts_uid; ?>" />
					<input type="hidden" name="mid" value="<?php print $epayouts_mid; ?>" />
					<input type="hidden" name="title" value="LinkMania" /><!-- Titlul ce apare pe e-payouts -->
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="form-group">
								<label for="inputPassword6">Metodă de plată</label>
								<select name="dm" class="form-control" required>
									<option value="paysafecard" style="color:black;" selected> PaySafeCard </option>
									<option value="ccard" style="color:black;"> Credit Card </option>
									<option value="giropay" style="color:black;"> Giropay </option>
									<option value="sofort" style="color:black;"> Sofort </option>
									<option value="ideal" style="color:black;"> iDEAL </option>
								</select>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
						  <div class="form-group">
							<label for="inputPassword6">Euro</label>
							<input type="number" class="form-control mx-sm-3" name="price" id="price" placeholder="Euro" oninput="checkPrice()" value="1" min="1" required>
							<b id="passwordHelpInline" class="text-muted" style="color:white;">(1 Euro = 20 Diamonds)</b>
						  </div>
						</div>
					</div>
					<button type="submit" class="btn btn-success">Donează</button>
				</form>
			</div>
        </div>
<hr>
@if(Auth::check() && !(Auth::user()->ID == 2 || Auth::user()->ID == 3 || Auth::user()->ID == 12 || Auth::user()->ID == 14))
<img src="https://i.imgur.com/RuYl3nJ.png" style="widht:140px;height:38px;" /></br></br>
Trimite banii la <b style="color:white;">nipergabi@yahoo.com</b> prin metoda <b>"SEND TO FRIENDS/FAMILY"</b>
</br>Deschide un ticket dupa ce ai efecutat donatia pentru a primi diamantele! <b style="color:orange;">(Vei primi un bonus de 20% la aceasta metoda)</b>
<hr>
<img src="https://i.imgur.com/MmjY0aA.png" style="widht:240px;height:76px;" /></br></br>
In cazul in care poti trimite banii prin Transfer Bancar, o poti face la urmatoarea adresa:
</br><b style="color:white;">IBAN: RO48BRDE140SV52644641400 | Nume cont: Mihai Gabriel | Banca: BRD</b>
</br>Deschide un ticket dupa ce ai efecutat donatia pentru a primi diamantele! <b style="color:orange;">(Vei primi un bonus de 20% la aceasta metoda)</b>
<hr>
@else
<img src="https://i.imgur.com/RuYl3nJ.png" style="widht:140px;height:38px;" /></br></br>
<div class="panel panel-success">
            <div class="panel-heading clearfix">
                <h2 class="pull-left panel-title"><i class="fa fa-paypal"></i> Plăți automate - PayPal</h2></div>
            
			<div class="panel-body updatesb">
				<form class="form-control" style="height: 100%" method="get" action="https://www.paypal.com/cgi-bin/webscr" target="_blank">
					<?php
						foreach ($querystring as $a => $b)
							print "<input type='hidden' name='".htmlentities($a)."' value='".htmlentities($b)."' />";
					?>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="form-group">
								<label for="inputPassword6">Metodă de plată</label>
								<select class="form-control" required>
									<option value="paypal" style="color:black;" selected> PayPal </option>
								</select>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
						  <div class="form-group">
							<label for="inputPassword6">Euro</label>
							<input type="number" class="form-control mx-sm-3" name="amount" id="amount" placeholder="Euro" oninput="checkPrice2()" value="1" min="1" required>
							<b id="passwordHelpInline2" class="text-muted" style="color:white;">(1 Euro = 20 Diamonds)</b>
						  </div>
						</div>
					</div>
					<button type="submit" class="btn btn-success">Donează</button>
				</form>
			</div>
        </div>
<hr>
@endif
<div class="alert alert-success" style="margin-bottom:0;font-size:13px;"><b>ATENTIE!!!</b>
</br>In cazul in care doresti sa donezi pentru acest server prin metodele disponibile o faci din propria initiativa nefiind obligat de nimeni.
</br>Nu obligam si nu "presam" jucatorii sa faca o donatie pentru acest server.
</br>Odata ce donatia a fost efectuata suma este nerambursabila.
</br>Banii stransi vor fi folositi pentru buna dezvoltare a serverului de joc pe toate segmentele.
</br>In cazul in care ai ales sa faci o donatie iti multumim pentru acest lucru si iti uram un joc cat mai placut alaturi de <b>SAMP.LINKMANIA.RO</b>.</div>
</center>
@endsection

@section('js')
<script> 
function checkPrice()
{
	var a = document.getElementById("price").value;
	document.getElementById("passwordHelpInline").innerHTML = "(" +(a.length < 1 ? (0) : (a))+ " Euro = "+a*20+" Diamonds)";
}
function checkPrice2()
{
	var a = document.getElementById("amount").value;
	document.getElementById("passwordHelpInline2").innerHTML = "(" +(a.length < 1 ? (0) : (a))+ " Euro = "+a*20+" Diamonds)";
}
</script>
@endsection