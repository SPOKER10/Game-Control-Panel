@extends('layouts.master')

@section('breadcrumb','Banlist')

@section('content')

	<div class="table-responsive">
		<table class="table">
			<thead><tr><th>#</th><th>Username</th><th>Banned by</th><th>Date <i class="fa fa-clock-o"></i></th><th>Ban Expire <i class="fa fa-clock-o"></i></th><th>Reason</th></tr></thead>
			<tbody>
				@foreach ($bans as $b)
					<tr>
						<td>{{ $b->Banid }}</td>
						<td>@if($b->user != "") <img src="{{ URL::to('/') }}/assets/a/{{ $b->user->Skin }}.png" class="img-circle" style="height:29px;"> {!! $b->user->url !!} @else Private @endif</td>
						<td><img src="{{ URL::to('/') }}/assets/a/{{ $b->admin->Skin }}.png" class="img-circle" style="height:29px;"> {!! $b->admin->url !!}</td>
						<td>{{ $b->BanTime }}</td>
						<td>{{ ($b->UnbanTime == -1 ? "Permanent" : (date("Y-m-d H:i:s", $b->UnbanTime))) }}</td>
						<td>{{ $b->Reason }}</td>
					</tr>
				@endforeach	
			</tbody>
		</table>
	</div>
	{!! $bans->render() !!}

@endsection