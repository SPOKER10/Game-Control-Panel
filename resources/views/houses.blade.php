@extends('layouts.master')

@section('breadcrumb','Houses')

@section('content')

	<div class="table-responsive">
		<table class="table table-bordered table-hover table-bordered">
			<thead><tr><th>#</th><th>Owner</th><th>Discription</th><th>Level</th><th>Rent</th><th>Value</th><th>Garage</th><th>Status</th><th>Actions</th></tr></thead>
			<tbody>
				@foreach ($houses as $h)
					<tr>
						<td>{{ $h->ID }}</td>
						<td>{!! ($h->user ? $h->user->url : $h->Owner) !!}</td>
						<td><center>{{ $h->Discription }}<br><img style="height:90px;" src="{{ URL::to('/') }}/assets/images/h/h{{ $h->ID }}.png"/></br></center></td>
						<td>{{ $h->Level }}</td>
						<td>@if($h->Rentabil == 0) Not rent available @else {{ General::format($h->RentPrice) }}$@endif</td>
						<td>{{ General::format($h->Value) }}$</td>
						<td><span style="color:{{ ($h->hGarage < 1 ? '#c90000' : '#00ba19') }};">{{ ($h->hGarage < 1 ? "No" : "Yes") }}</span></td>
						<td><span style="color:{{ (!$h->Lock ? '#00ba19' : '#c90000') }};">{{ (!$h->Lock ? "Unlocked" : "Locked") }}</span></td>
						<td><a><div class=" _locate house" id="{{ $h->ID }}"><i class="fa fa-map-marker"></i> Show on map</div></a></br><a><div class=" _renters" id="{{ $h->ID }}"><i class="fa fa-users"></i> Renters</div></a></td>
					</tr>
				@endforeach	
			</tbody>
		</table>
	</div>
	
	{!! $houses->render() !!}
@section('js')
    <script src="{{ asset('assets/bootbox.min.js') }}"></script>
@endsection	
@endsection