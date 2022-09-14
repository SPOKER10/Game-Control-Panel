@extends('layouts.master')

@section('breadcrumb','Businesses')

@section('content')

	<div class="table-responsive">
		<table class="table table-bordered table-hover table-bordered">
			<thead><tr><th>#</th><th>Owner</th><th>Co-Owner</th><th>Name</th><th>Level</th><th>Fee</th><th>Value</th><th>Status</th><th>Actions</th></tr></thead>
			<tbody>
				@foreach ($businesses as $b)
					<tr>
						<td>{{ $b->ID }}</td>
						<td>{!! ($b->user ? $b->user->url : $b->Owner) !!}</td>
						<td>{!! ($b->userc ? $b->userc->url : $b->CoOwner) !!}</td>
						<td><center>{{ $b->Discription }}<br><img style="height:90px;" src="{{ URL::to('/') }}/assets/images/biz/b_{{ $b->ID }}.jpg"/></br></center></td>
						<td>{{ $b->Level }}</td>
						<td>{{ General::format($b->Fee) }}$</td>
						<td>{{ General::format($b->Value) }}$</td>
						<td><span style="color:{{ (!$b->Lock ? '#00ba19' : '#c90000') }};">{{ (!$b->Lock ? "Unlocked" : "Locked") }}</span></td>
						<td> <a><div class=" _locate business" id="{{ $b->ID }}"><i class="fa fa-map-marker"></i> Show on map</div></a> </td>
					</tr>
				@endforeach	
			</tbody>
		</table>
	</div>
	
	{!! $businesses->render() !!}
@section('js')<script src="{{ asset('assets/bootbox.min.js') }}"></script>@endsection	
@endsection