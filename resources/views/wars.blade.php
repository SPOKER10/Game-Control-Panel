@extends('layouts.master')

@section('breadcrumb','Wars')

@section('content')
	<div class="table-responsive">
		<table class="table table-bordered table-hover table-bordered">
			<thead><tr><th>#</th><th>Attacker - Defender</th><th>Score</th><th>Best Killer</th><th>Date <i class="fa fa-clock-o"></i></th><th>Gangsters</th><th>Result</th></tr></thead>
			<tbody>
				@foreach ($wars as $o)
					<tr>
						<td>{{ $o->ID }}</td>
						<td>@if($o->Attack == "The Ballas Family") <img src="http://wiki.sa-mp.com/wroot/images2/3/32/Icon_59.gif" title="Describe Image Link Destination" />
							@elseif ($o->Attack == "Grove Street") <img src="http://wiki.sa-mp.com/wroot/images2/1/11/Icon_62.gif" title="Describe Image Link Destination" />
							@elseif ($o->Attack == "La Cosa Nostra") <img style="filter: brightness(170%);" src="http://wiki.sa-mp.com/wroot/images2/8/8c/Icon_60.gif" title="Describe Image Link Destination" />
							@elseif ($o->Attack == "Varrios Los Aztecas") <img src="https://wiki.sa-mp.com/wroot/images2/b/bc/Icon_58.gif" title="Describe Image Link Destination" />@endif
							{{ $o->Attack }} - @if($o->Defend == "The Ballas Family") <img src="http://wiki.sa-mp.com/wroot/images2/3/32/Icon_59.gif" title="Describe Image Link Destination" />
							@elseif ($o->Defend == "Grove Street") <img src="http://wiki.sa-mp.com/wroot/images2/1/11/Icon_62.gif" title="Describe Image Link Destination" />
							@elseif ($o->Defend == "La Cosa Nostra") <img style="filter: brightness(170%);" src="http://wiki.sa-mp.com/wroot/images2/8/8c/Icon_60.gif" title="Describe Image Link Destination" />
							@elseif ($o->Defend == "Varrios Los Aztecas") <img src="https://wiki.sa-mp.com/wroot/images2/b/bc/Icon_58.gif" title="Describe Image Link Destination" />@endif {{ $o->Defend }}</td>
						<td>{{ $o->aS }} - {{ $o->dS }}</td>
						<td>@if($o->tKiller != 0) <img src="{{ URL::to('/') }}/assets/a/{{ $o->user->Skin }}.png" class="img-circle mt" data-toggle="tooltip" data-placement="top" data-html="true" title="<img src='{{ URL::to('/') }}/assets/s/Skin_{{ $o->user->Skin }}.png' style='height:84px;vertical-align:middle;' /><div style='bottom:33px;float:right;'>Name: {{ $o->user->user }}</br>Level: {{ $o->user->Score }}</br>RP: {{ $o->user->RPoints }}/{{ $o->user->Score*3 }}</br>Hours Played: {{ number_format($o->user->HoursPlayed/3600) }}</br>Job: {{ General::job($o->user->Job) }}</div>" style="height:33px;"> {!! ($o->user ? $o->user->url : $o->tKiller) !!} ({{ $o->Kills }} kills) @else No-one @endif</td>
						<td>{{ $o->Date }}</td>
						<td>{{ $o->Gs }}</td>
						<td>{{ $o->Text }}</td>
					</tr>
				@endforeach	
			</tbody>
		</table>
	</div>
{!! $wars->render() !!}
<center><div class="alert alert-success" style="margin-bottom:0;font-size:13px;"><b>WAR INTERVAL</b></br>In cursul saptamanii: <b>19:00 - 22:00</b></br>In weekend: <b>20:00 - 22:00</b></br>Aliantele pot juca impreuna doar in weekend-uri, in cursul saptamanii sunt pe cont propriu!</div></center>
@section('js')<script>$(function () {$('.mt').tooltip({template: '<div class="tooltip md-tooltip-main"><div class="tooltip-arrow md-arrow"></div><div class="tooltip-inner md-inner-main"></div></div>'});})</script>@endsection
@endsection