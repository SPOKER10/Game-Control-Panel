@extends('layouts.master')

@section('breadcrumb','V.I.P Players')

@section('content')

	<div class="table-responsive">
		<table class="table">
			<thead><tr><th>#</th><th>Username</th><th>Status</th><th>Faction</th><th>Level</th><th>Respect Points</th><th>Hours Played On Month</th></tr></thead>
			<tbody>
				@foreach ($vip as $key=>$o)
					<tr>
						<td>{{ ++$key }}</td>
						<td><img src="{{ URL::to('/') }}/assets/a/{{ $o->Skin }}.png" class="img-circle" style="height:33px;"> {!! $o->url !!} {!! $o->roles !!}</td>
						<td>{!! $o->status_text !!}</td>
						<td>{{ $o->faction }}</td>
						<td>{{ $o->Level }}</td>
						<td>RP ({{ $o->RPoints }}/{{ $o->Score*3 }})</br><div class="progress" style="background-color: #EDEDED"><div class="progress-bar" role="progressbar" style="width:{{ ($o->RPoints)*100/($o->Score*3) }}%; background-color: #ff296d;"></div></div></td>
						<td>{{ number_format($o->Hom/3600) }} @if($key < 4) <span class="badge badge-danger">best activity</span> @endif</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

@endsection