@extends('layouts.master')

@section('breadcrumb','Top Pool Players')

@section('content')
	<center><img src="https://rpg.linkmania.ro/pg.jpg" width="550" height="125" /></center></br>
	<div class="table-responsive">
		<table class="table">
			<thead><tr><th>#</th><th>Username</th><th>Status</th><th>Faction</th><th>Level</th><th>Respect Points</th><th>Win Matches</th></tr></thead>
			<tbody>
				@foreach ($topp as $key=>$o)
					<tr>
						<td>{{ ++$key }}</td>
						<td><img src="{{ URL::to('/') }}/assets/a/{{ $o->Skin }}.png" class="img-circle" style="height:33px;"> {!! $o->url !!} {!! $o->roles !!}</td>
						<td>{!! $o->status_text !!}</td>
						<td>{{ $o->faction }}</td>
						<td>{{ $o->Level }}</td>
						<td>RP ({{ $o->RPoints }}/{{ $o->Score*3 }})</td>
						<td>{{ $o->Pool }} @if($key < 4) <span class="badge badge-danger">best player</span> @endif</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

@endsection