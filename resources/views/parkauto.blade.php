@extends('layouts.master')
@section('breadcrumb','Park Auto')
@section('content')
<div id="tab-transfer" class="tab-pane"><div class="ibox-content"><table class="table table-bordered table-hover table-bordered datatable">
	<thead><tr><th>#</th><th>Model</th><th>Owner</th><th>Price</th><th>Plate</th><th>Odometer <i class="fa fa-road"></i></th><th>Age</th><th>Fuel</th><th>Colors</th><th>Max Speed</th><th>Class</th><th>Actions</th></tr></thead>
	<tbody>
		@foreach ($parkauto as $c)
		<tr>
			<td>{{ $c->ID }}</td>
			<td><center>{{ General::vehicle($c->Model) }}<br><img style="height:60px;" src="{{ URL::to('/') }}/assets/images/vehicles/Vehicle_{{ $c->Model }}.jpg"/></br></center></td>
			<td><center><img src="{{ URL::to('/') }}/assets/a/{{ $c->user->Skin }}.png" class="img-circle mt" data-toggle="tooltip" data-placement="top" data-html="true" title="<img src='{{ URL::to('/') }}/assets/s/Skin_{{ $c->user->Skin }}.png' style='height:84px;vertical-align:middle;' /><div style='bottom:33px;float:right;'>Name: {{ $c->user->user }}</br>Level: {{ $c->user->Score }}</br>RP: {{ $c->user->RPoints }}/{{ $c->user->Score*3 }}</br>Hours Played: {{ number_format($c->user->HoursPlayed/3600) }}</br>Job: {{ General::job($c->user->Job) }}</div>" style="height:33px;"></br><i class="fa fa-certificate" style="color:{{ ($c->user->Status == 1 ? 'green' : 'red') }};"></i> {!! $c->user->url !!}</center></td>
			<td>{{ General::format($c->SONP) . '$' }}</td>
			<td>{{ $c->Plate }}</td>
			<td>{{ number_format($c->KM, 0) }} KM</td>
			<td>{{ number_format((Carbon\Carbon::now()->timestamp-$c->Days)/86400) }} Days</td>
			<td>{{ $c->Fuel }}%</td>
			<td>{{ $c->Color1 }}/{{ $c->Color2 }}</br><span class="car-color" style="background-color:{{ General::vehicleColor($c->Color1) }}"></span> <span class="car-color" style="background-color:{{ General::vehicleColor($c->Color2) }}"></span></td>
			<td>{{ General::vsp($c->Model) }} KM/h</td>
			<td>{{ $c->Class }}</td>
			<td><a href="{{ URL::to('buy',['id' => $c->ID]) }}" class="btn btn-success btn-sm mt" data-toggle="tooltip" data-placement="top" title="{{ General::format($c->SONP) }}$"><i class="fa fa-shopping-cart"></i> buy</a></br></br><a class="btn btn-success btn-sm _locate vehicle" id="{{ $c->ID }}"><i class="fa fa-map-marker"></i> map</a></td>
		</tr>
	@endforeach	
</tbody></table></div>@section('css')<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dt.min.css') }}"/>@endsection</div>@endsection
@section('js')<script src="{{ asset('assets/bootbox.min.js') }}"></script><script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.js"></script><script>$(function () {$('.mt').tooltip({template: '<div class="tooltip md-tooltip-main"><div class="tooltip-arrow md-arrow"></div><div class="tooltip-inner md-inner-main"></div></div>'});})</script><script>$(document).ready(function(){$('.datatable').DataTable({"order": [[ 1, "desc" ]],iDisplayLength:10,"aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]]});});</script>@endsection