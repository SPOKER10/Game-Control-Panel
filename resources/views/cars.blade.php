@extends('layouts.master')

@section('breadcrumb','Cars')

@section('content')

<div class="table-responsive">
	<table class="table table-bordered table-hover table-bordered">
		<thead><tr><th>#</th><th>Model</th><th>Owner</th><th>Value</th><th>Plate</th><th>Odometer <i class="fa fa-road"></i></th><th>Age</th><th>Class</th></tr></thead>
		<tbody>
			@foreach ($cars as $c)
				<tr>
					<td>{{ $c->ID }}</td>
					<td><center>{{ General::vehicle($c->Model) }}<br><img style="height:60px;" src="{{ URL::to('/') }}/assets/images/vehicles/Vehicle_{{ $c->Model }}.jpg"/></br></center></td>
					<td>{!! $c->user->url !!}</td>
					<td>{{ General::format($c->Value) . '$' }} </td>
					<td>{{ $c->Plate }}</td>
					<td>{{ number_format($c->KM, 0) }} KM</td>
					<td>{{ number_format((Carbon\Carbon::now()->timestamp-$c->Days)/86400) }} Days</td>
					<td>{{ $c->Class }}</td>
				</tr>
			@endforeach	
		</tbody>
	</table>
</div>
{!! $cars->render() !!}

@endsection