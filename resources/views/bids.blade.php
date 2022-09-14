@extends('layouts.master')
@section('breadcrumb','Bids')
@section('content')
<center><img src="bd.png" width="85" height="85" /></center>
<b>HOUSES</b><div class="table-responsive"><table class="table table-bordered table-hover table-bordered"><thead><tr><th>#</th><th>Owner</th><th>Discription</th><th>Level</th><th>Status</th><th>Money From Bid</th><th>Bid Money</th><th>Bid Last Player</th><th>Bid Start Date</th><th>Bid Update Date</th><th>Actions</th></tr></thead>
<tbody>
	@foreach ($kb as $h)
		<tr>
			<td>{{ $h->ID }}</td>
			<td><center><img src="{{ URL::to('/') }}/assets/a/{{ $h->user->Skin }}.png" class="img-circle mt" data-toggle="tooltip" data-placement="top" data-html="true" title="<img src='{{ URL::to('/') }}/assets/s/Skin_{{ $h->user->Skin }}.png' style='height:84px;vertical-align:middle;' /><div style='bottom:33px;float:right;'>Name: {{ $h->user->user }}</br>Level: {{ $h->user->Score }}</br>RP: {{ $h->user->RPoints }}/{{ $h->user->Score*3 }}</br>Hours Played: {{ number_format($h->user->HoursPlayed/3600) }}</br>Job: {{ General::job($h->user->Job) }}</div>" style="height:33px;"></br><i class="fa fa-certificate" style="color:{{ ($h->user->Status == 1 ? 'green' : 'red') }};"></i> {!! ($h->user ? $h->user->url : $h->Owner) !!}</center></td>
			<td><center>{{ $h->Discription }}<br><img style="height:50px;" src="{{ URL::to('/') }}/assets/images/h/h{{ $h->ID }}.png"/></br></center></td>
			<td>{{ $h->Level }}</td>
			<td><span style="color:{{ (!$h->Lock ? '#00ba19' : '#c90000') }};">{{ (!$h->Lock ? "Unlocked" : "Locked") }}</span></td>
			<td>{{ General::format($h->BidMoney) }}$</td>
			<td>+{{ General::format($h->BidMoneyN) }}$</td>
			<td><center><img src="{{ URL::to('/') }}/assets/a/{{ $h->userr->Skin }}.png" class="img-circle mt" data-toggle="tooltip" data-placement="top" title="{{ $h->userr->user }} / Level: {{ $h->userr->Score }}" style="height:23px;"></br><i class="fa fa-certificate" style="color:{{ ($h->userr->Status == 1 ? 'green' : 'red') }};"></i> {!! ($h->userr ? $h->userr->url : $h->BidLastPlayer) !!}</center></td>
			<td>{{ $h->BidDate }}</td>
			<td>{{ $h->updated_at }}</td>
			<td><a class="btn btn-xs btn-outline btn-primary"><div class=" _locate house" id="{{ $h->ID }}"><i class="fa fa-map-marker"></i> show on map</div></a></br></br><a class="btn btn-xs btn-outline btn-primary mt" data-toggle="tooltip" data-placement="top" title="+{{ General::format($h->BidMoneyN) }}$" href="{{ URL::to('bidH',['id' => $h->ID]) }}"><i class="fa fa-plus"></i> bid</a></td>
		</tr>
	@endforeach	
</tbody></table></div>
{!! $kb->render() !!}
</br>
<b>BUSINESSES</b><div class="table-responsive"><table class="table table-bordered table-hover table-bordered">
<thead><tr><th>#</th><th>Owner</th><th>Name</th><th>Level</th><th>Status</th><th>Money From Bid</th><th>Bid Money</th><th>Bid Last Player</th><th>Bid Start Date</th><th>Bid Update Date</th><th>Actions</th></tr></thead>
<tbody>
	@foreach ($kbs as $b)
		<tr>
			<td>{{ $b->ID }}</td>
			<td><center><img src="{{ URL::to('/') }}/assets/a/{{ $b->user->Skin }}.png" class="img-circle mt" data-toggle="tooltip" data-placement="top" data-html="true" title="<img src='{{ URL::to('/') }}/assets/s/Skin_{{ $b->user->Skin }}.png' style='height:84px;vertical-align:middle;' /><div style='bottom:33px;float:right;'>Name: {{ $b->user->user }}</br>Level: {{ $b->user->Score }}</br>RP: {{ $b->user->RPoints }}/{{ $b->user->Score*3 }}</br>Hours Played: {{ number_format($b->user->HoursPlayed/3600) }}</br>Job: {{ General::job($b->user->Job) }}</div>" style="height:33px;"></br><i class="fa fa-certificate" style="color:{{ ($b->user->Status == 1 ? 'green' : 'red') }};"></i> {!! ($b->user ? $b->user->url : $b->Owner) !!}</center></td>
			<td><center>{{ $b->Discription }}<br><img style="height:50px;" src="{{ URL::to('/') }}/assets/images/biz/b_{{ $b->ID }}.jpg"/></br></center></td>
			<td>{{ $b->Level }}</td>
			<td><span style="color:{{ (!$b->Lock ? '#00ba19' : '#c90000') }};">{{ (!$b->Lock ? "Unlocked" : "Locked") }}</span></td>
			<td>{{ General::format($b->BidMoney) }}$</td>
			<td>+{{ General::format($b->BidMoneyN) }}$</td>
			<td><center><img src="{{ URL::to('/') }}/assets/a/{{ $b->userr->Skin }}.png" class="img-circle mt" data-toggle="tooltip" data-placement="top" title="{{ $b->userr->user }} / Level: {{ $b->userr->Score }}" style="height:23px;"></br><i class="fa fa-certificate" style="color:{{ ($b->userr->Status == 1 ? 'green' : 'red') }};"></i> {!! ($b->userr ? $b->userr->url : $b->BidLastPlayer) !!}</center></td>
			<td>{{ $b->BidDate }}</td>
			<td>{{ $b->updated_at }}</td>
			<td><a class="btn btn-xs btn-outline btn-primary"><div class=" _locate business" id="{{ $b->ID }}"><i class="fa fa-map-marker"></i> show on map</div></a></br></br><a class="btn btn-xs btn-outline btn-primary mt" data-toggle="tooltip" data-placement="top" title="+{{ General::format($b->BidMoneyN) }}$" href="{{ URL::to('bidB',['id' => $b->ID]) }}"><i class="fa fa-plus"></i> bid</a></td>
		</tr>
	@endforeach
</tbody></table></div>
{!! $kbs->render() !!}
<div class="alert alert-success" style="margin-bottom:0;font-size:13px;">
	<center>Toate casele si biz-urile scoase de un admin la licitatie se vor afisa aici.
	</br>Licitatiile vor fi deschise atata timp cat un admin permite asta.
	</br>Dupa ce adminul a oprit licitatia jucatorul care a castigat-o va primi bunul (casa/biz) direct in joc automat.
	</br>Acest lucru functioneaza chiar daca jucatorul este offline sau online.
</br>Pentru a licita apasa pe "<b>+bid</b>". Trebuie sa ai in banca banii stransi din licitatie + suma cu care se liciteaza.
</br><b>Bid Money</b> = Suma cu care se liciteaza atunci cand este apasat butonul "<b>+bid</b>".
</br>Daca la sfarsitul licitatiei nu mai ai banii necesari in cont vei pierde actiunea.
</br>Proprietatile care sunt scoase la licitatie de jucatori se inchid automat peste 24h de la startul licitatiei. (n.r. <b>Bid Start Date</b>)
<hr>Case licitate: <b>{{ \Cache::get('bSONs') }}</b></br>Biz-uri licitate: <b>{{ \Cache::get('bSONb') }}</b></center></div>
@section('js')<script src="{{ asset('assets/bootbox.min.js') }}"></script><script>$(function () {$('.mt').tooltip({template: '<div class="tooltip md-tooltip-main"><div class="tooltip-arrow md-arrow"></div><div class="tooltip-inner md-inner-main"></div></div>'});})</script>@endsection	
@endsection