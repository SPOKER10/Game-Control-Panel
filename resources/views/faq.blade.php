@extends('layouts.master')

@section('breadcrumb','F.A.Q')

@section('content')

	<div class="row">
		<div class="col-xs-12">
			<div class="tabs-container">
				<ul class="nav nav-tabs">
					<li class="active">
						<a data-toggle="tab" href="#faq-tab-1">
							<i class="blue fa fa-question-circle bigger-120"></i>
							General
						</a>
					</li>

					<li>
						<a data-toggle="tab" href="#faq-tab-2">
							<i class="green fa fa-user bigger-120"></i>
							Account / Cont
						</a>
					</li>

					<li>
						<a data-toggle="tab" href="#faq-tab-3">
							<i class="orange fa fa-credit-card bigger-120"></i>
							Payments / Plati
						</a>
					</li>
				</ul>

				<div class="tab-content">
					<div id="faq-tab-1" class="tab-pane fade in active">
						<div id="faq-list-1" class="panel-body">
							<div class="panel panel-default">
								<div class="panel-heading">
									<a href="#faq-1-1" data-parent="#faq-list-1" data-toggle="collapse">
										<i class="fa fa-chevron-right"></i>&nbsp;
										Cum pot deveni lider/helper/admin pe server?
									</a>
								</div>

								<div class="panel-collapse collapse" id="faq-1-1">
									<div class="panel-body">
										Pentru a detine o functie pe server trebuie sa indepliniti niste conditii, pe care le gasiti pe forum. Puteti aplica atunci cand cererile sunt deschise.
										<b>NU</b> se poate dona sub niciun fel pentru o functie pe server indiferent de suma, aici toti jucatorii au drepturi egale.
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<a href="#faq-1-2" data-parent="#faq-list-1" data-toggle="collapse">
										<i class="fa fa-chevron-right"></i>&nbsp;
										Cand si de cine a fost deschis serverul?
									</a>
								</div>

								<div class="panel-collapse collapse" id="faq-1-2">
									<div class="panel-body">
										Serverul <b>RPG.LINKMANIA.RO</b> a fost deschis in anul 2008.
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<a href="#faq-1-3" data-parent="#faq-list-1" data-toggle="collapse">
										<i class="fa fa-chevron-right middle"></i>&nbsp;
										Am o sugestie pentru server. Ce trebuie sa fac sa se implementeze?
									</a>
								</div>
								<div class="panel-collapse collapse" id="faq-1-3">
									<div class="panel-body">
										Se vor tine cont de toate sugestiile facute de jucatori, din pacate nu putem estima o data exacta cand aceste sugestii vor fi implemenate, insa putem garanta
										ca daca sunt acceptate, vor fi si adaugate pe server.
									</div>
								</div>
							</div>
						</div>
					</div>

					<div id="faq-tab-2" class="tab-pane fade">
						<div id="faq-list-2" class="panel-body">
							<div class="panel panel-default">
								<div class="panel-heading">
									<a href="#faq-2-1" data-parent="#faq-list-2" data-toggle="collapse">
										<i class="fa fa-chevron-right"></i>&nbsp;
										Ce fac in cazul in care nu-mi mai stiu parola la cont?
									</a>
								</div>

								<div class="panel-collapse collapse" id="faq-2-1">
									<div class="panel-body">
										Nu te ingrijora. Noi te putem ajuta in cazul in care ai uitat parola contului, deschide un ticket in care sa precizezi acest lucru si in cel mai scurt timp
										vei primi noua parola a contului. (Pentru aceasta optiune trebuie sa ai acces la mail-ul setat pe contul tau)
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<a href="#faq-2-3" data-parent="#faq-list-2" data-toggle="collapse">
										<i class="fa fa-chevron-right middle"></i>&nbsp;
										Ce fac in cazul in care mi s-a spart contul?
									</a>
								</div>

								<div class="panel-collapse collapse" id="faq-2-3">
									<div class="panel-body">
										In primul rand nu te panica. In al doilea rand, incearca sa-ti dai recuperare la parola (Forgot Password). Daca cel care ti-a spart contul a avut acces si la emailul tau si ti l-a schimbat, ne pare rau dar in acest caz nu te mai putem ajuta.
									</div>
								</div>
							</div>
						</div>
					</div>

					<div id="faq-tab-3" class="tab-pane fade">
						<div id="faq-list-3" class="panel-body">
							<div class="panel panel-default">
								<div class="panel-heading">
									<a href="#faq-3-1" data-parent="#faq-list-3" data-toggle="collapse">
										<i class="fa fa-plus"></i>&nbsp;
										Ce primesc daca fac o donatie serverului?
									</a>
								</div>

								<div class="panel-collapse collapse" id="faq-3-1">
									<div class="panel-body">
										In schimbul unei donatii puteti obine <b>doar</b> Diamonds. Cu aceste Diamante primite poti cumpara diferite lucruri din shop si unele vehicule speciale din Dealership. (/shop)
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<a href="#faq-3-2" data-parent="#faq-list-3" data-toggle="collapse">
										<i class="fa fa-plus"></i>&nbsp;
										Prin ce modalitati se pot efectua platile?
									</a>
								</div>

								<div class="panel-collapse collapse" id="faq-3-2">
									<div class="panel-body">
									Se pot efectua donatii prin PayPal, PaySafeCard, Skrill si Transfer/Depunere numerar in cont bancar (BRD).
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<a href="#faq-3-3" data-parent="#faq-list-3" data-toggle="collapse">
										<i class="fa fa-plus"></i>&nbsp;
										Ce fac daca nu locuiesc in Romania si doresc sa donez?
									</a>
								</div>

								<div class="panel-collapse collapse" id="faq-3-3">
									<div class="panel-body">
										Nu poti plati cu PaySafeCard din alte tari (decat in cazul in care incarci banii pe Skrill si apoi ii trimiti comunitatii). Daca doresti sa efectuezi o donatie prin
										alte metode din afara Romaniei deschide un ticket.
									</div>
								</div>
							</div>

							
						</div>
					</div>
				
				</div>
			</div>
		</div>
	</div>	
@endsection		