@extends('layouts.master')

@section('breadcrumb','Top Richest Players')

@section('content')

	<div class="table-responsive">
		<table class="table">
			<thead><tr><th>#</th><th>Username</th><th>Status</th><th>Level</th><th>Respect Points</th><th>Vehicles</th><th>Money</th></tr></thead>
			<tbody>
				@foreach ($toprc as $key=>$o)
					<tr>
						<td>{{ ++$key }}</td>
						<td><img src="{{ URL::to('/') }}/assets/a/{{ $o->Skin }}.png" class="img-circle" style="height:33px;"> {!! $o->url !!} {!! $o->roles !!}</td>
						<td>{!! $o->status_text !!}</td>
						<td>{{ $o->Level }}</td>
						<td>RP ({{ $o->RPoints }}/{{ $o->Score*3 }})</br><div class="progress" style="background-color: #EDEDED"><div class="progress-bar" role="progressbar" style="width:{{ ($o->RPoints)*100/($o->Score*3) }}%; background-color: #ff296d;"></div></div></td>
						<td>{{ $o->TotVeh+1 }}/{{ $o->SlotVeh }}</td>
						<td>{{ General::format($o->Money) }}$ / {{ General::format($o->BankMoney) }}$ @if($key < 4) <span class="badge badge-success">the richest</span> @endif</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

@endsection