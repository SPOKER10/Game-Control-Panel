@extends('layouts.master')
@section('breadcrumb','Announces CNN')
@section('content')
<div id="tab-transfer" class="tab-pane"><div class="ibox-content"><table class="table table-striped table-hover table-bordered datatable"><thead><tr><th>#</th><th>By</th><th>Announce</th><th>Date <i class="fa fa-clock-o"></i></th><th>Contact</th></tr></thead>
	<tbody>
		@foreach ($cnn as $w=>$c)
		<tr>
			<td>{{ ++$w }}</td>
			<td><center><img src="{{ URL::to('/') }}/assets/a/{{ $c->user->Skin }}.png" class="img-circle mt" data-toggle="tooltip" data-placement="top" data-html="true" title="<img src='{{ URL::to('/') }}/assets/s/Skin_{{ $c->user->Skin }}.png' style='height:84px;vertical-align:middle;' /><div style='bottom:33px;float:right;'>Name: {{ $c->user->user }}</br>Level: {{ $c->user->Score }}</br>RP: {{ $c->user->RPoints }}/{{ $c->user->Score*3 }}</br>Hours Played: {{ number_format($c->user->HoursPlayed/3600) }}</br>Job: {{ General::job($c->user->Job) }}</div>" style="height:33px;"></br><i class="fa fa-certificate" style="color:{{ ($c->user->Status == 1 ? 'green' : 'red') }};"></i> {!! $c->user->url !!}</center></td>
			<td>{{ $c->Text }}</td>
			<td>{{ $c->Date }}</td>
			<td><center><span class="label label-success">Phone: {{ $c->user->PhoneNumber }}</span></center></td>
		</tr>
	@endforeach
	<center>
</tbody></table></div>@section('css')<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dt.min.css') }}"/>@endsection</div>
<center><div class="alert alert-success" style="margin-bottom:0;font-size:13px;"><i class="fa fa-bullhorn" style="font-size:22px;"></i></br><b>Announces CNN Los Santos</b>
</br>Ultimele 50 de anunturi plasate la CNN Los Santos vor fi afisate aici.</br>Anunturile sunt afisate in ordine descrescatoare dupa data la care au fost plasate.</br></br><img src="https://rpg.linkmania.ro/assets/images/biz/b_23.jpg" class="img-circle" style="width:140px;height:130px;"></br>Owner: <b><a href="user/profile/{{ \Cache::get('dxc2') }}"><img src="{{ URL::to('/') }}/assets/a/{{ \Cache::get('dxc') }}.png" class="img-circle" style="height:24px;">{{ \Cache::get('dxc2') }}</a></b></br>Co-Owner: @if(\Cache::get('dxv2') == "No") <b>No</b> @else <b><a href="user/profile/{{ \Cache::get('dxv2') }}"><img src="{{ URL::to('/') }}/assets/a/{{ \Cache::get('dxv') }}.png" class="img-circle" style="height:24px;">{{ \Cache::get('dxv2') }}</a></b> @endif </br>Fee: <b>1.000$</b></br><a class="btn btn-xs btn-outline btn-primary"><div class=" _locate business" id="23"><i class="fa fa-map-marker"></i> Show on map</div></a></div></center>@endsection
@section('js')<script>$(function () {$('.mt').tooltip({template: '<div class="tooltip md-tooltip-main"><div class="tooltip-arrow md-arrow"></div><div class="tooltip-inner md-inner-main"></div></div>'});})</script><script src="{{ asset('assets/bootbox.min.js') }}"></script></script><script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.js"></script><script>$(document).ready(function(){$('.datatable').DataTable({"order": [[ 1, "desc" ]],iDisplayLength:10,"aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]]});});</script>@endsection