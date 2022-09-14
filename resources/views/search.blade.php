@extends('layouts.master')

@section('breadcrumb','Search')

@section('content')

	<div class="card">
		<div class="card-body">
			@if(isset($searched) && count($searched))
				<div class="alert alert-info">Se afiseaza doar primele 50 de rezultate, scrie mai mult dintr-un nickname daca nu gasesti jucatorul!</div>
				<table class="table">
					<thead>
						<tr>
							<th>Avatar</th>
							<th>Username</th>
							<th>Level</th>
							<th>Faction</th>
							<th>Hours Played</th>
						</tr>
					</thead>
					<tbody>
						@foreach($searched as $s)
							<tr>
								<td style="width:15px;"><img src="{{ URL::to('/') }}/assets/a/{{ $s->Skin }}.png" class="img-circle" style="height:52px;"></td>
								<td>{!! $s->url !!}</td>
								<td>{{ $s->Level }}</td>
								<td>{{ $s->faction }}</td>
								<td>{{ number_format($s->HoursPlayed/3600) }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@else
				@if(isset($searched) && !count($searched))
					<div class="alert alert-danger">There were no results for your search.</div>
				@endif
				<div class="col-4 mx-auto"><center>
					<form action="" method="POST">
						<label for="search">Insert here the username of the player your are looking for</label>
						<input type="text" name="search" id="search" class="form-control" style="width: 50%"/><br>
						<input type="submit" value="Search" class="btn btn-primary float-right mt-1" />
						{{ csrf_field() }}
					</form>
				</center></div>
			@endif
		</div>
	</div>
	
@endsection