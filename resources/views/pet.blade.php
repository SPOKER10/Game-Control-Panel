@extends('layouts.master')
@section('breadcrumb','Top Pets')
@section('content')
	<div class="table-responsive">
		<table class="table">
			<thead><tr><th>#</th><th>Username</th><th>Status</th><th>Faction</th><th>Level</th><th><i class="fa fa-paw"></i> Pet</th></tr></thead>
			<tbody>
				@foreach ($pet as $key=>$o)
					<tr>
						<td>{{ ++$key }}</td>
						<td><img src="{{ URL::to('/') }}/assets/a/{{ $o->Skin }}.png" class="img-circle" style="height:33px;"> {!! $o->url !!} {!! $o->roles !!}</td>
						<td>{!! $o->status_text !!}</td>
						<td>{{ $o->faction }}</td>
						<td>{{ $o->Level }}</td>
						<td>@if($o->pPetStatus)<img id="i{{ $key }}" onload="aClass({{ $key }})" src="{{ URL::to('/') }}/assets/pet/{{ $o->pPetModel }}.png" style="height:60px;"> @else <img class="object2" src="https://rpg.linkmania.ro/zzz.png" style="height:30px;"></br><img src="{{ URL::to('/') }}/assets/pet/{{ $o->pPetModel }}.png" style="height:60px;"> @endif</br>Name: {{ $o->pPetName }}</br>Level: {{ $o->pPetLevel }} @if($key < 4) <span class="badge badge-danger">best pet</span> @endif</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
<script>function aClass(n) { document.getElementById("i"+n+"").className = "object"+Math.floor(Math.random() * 5)+""; }</script>
@endsection