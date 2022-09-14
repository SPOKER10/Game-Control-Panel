@extends('layouts.master')

@section('breadcrumb','PaintBall Ranks')

@section('content')

	<div class="table-responsive">
		<table class="table">
			<thead><tr><th>#</th><th>Username</th><th>Status</th><th>Faction</th><th>Level</th><th>Kills</th><th>Rank</th></tr></thead>
			<tbody>
				@foreach ($paintball as $key=>$o)
					<tr>
						<td>{{ ++$key }}</td>
						<td><img src="{{ URL::to('/') }}/assets/a/{{ $o->Skin }}.png" class="img-circle" style="height:33px;"> {!! $o->url !!} {!! $o->roles !!}</td>
						<td>{!! $o->status_text !!}</td>
						<td>{{ $o->faction }}</td>
						<td>{{ $o->Level }}</td>
						<td>{{ $o->PaintKills }}</td>
						<td>{{ $o->PRank }} ({{ General::pra($o->PRank) }})</br><div class="progress" style="background-color: #EDEDED">
                                    <div class="progress-bar" role="progressbar" style="width:{{ ($o->PRank)*100/12 }}%; background-color: #ff296d;"></div>
                                </div> </td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

@endsection