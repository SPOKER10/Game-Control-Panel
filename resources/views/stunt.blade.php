@extends('layouts.master')

@section('breadcrumb','Top Stunts')

@section('content')
	<center><img src="https://rpg.linkmania.ro/stu.png"/></center></br>
	<div class="table-responsive">
		<table class="table">
			<thead><tr><th>#</th><th>Username</th><th>Status</th><th>Faction</th><th>Level</th><th>Respect Points</th><th>Stunts</th></tr></thead>
			<tbody>
				@foreach ($stunt as $key=>$o)
					<tr>
						<td>{{ ++$key }}</td>
						<td><img src="{{ URL::to('/') }}/assets/a/{{ $o->Skin }}.png" class="img-circle" style="height:33px;"> {!! $o->url !!} {!! $o->roles !!}</td>
						<td>{!! $o->status_text !!}</td>
						<td>{{ $o->faction }}</td>
						<td>{{ $o->Level }}</td>
						<td>RP ({{ $o->RPoints }}/{{ $o->Score*3 }})</td>
						<td>{{ $o->pWonStunts }} @if($key < 4) <span class="badge badge-danger">best stunter</span> @endif</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

@endsection