@extends('layouts.master')

@section('breadcrumb', !$type ? 'Applications' : 'Resignations' . ' / List')

@section('content')
@if($errors->count() != 0)<div class="alert alert-danger"><ul>@foreach($errors->all() as $error)<li>{!! $error !!}</li>@endforeach</ul></div>@endif
	<div class="row"><a class="btn btn-success" style="float:right;" href="{{ route('clanCreateApp', ['$clan' => request()->route('clan'), 'type' => !$type ? 'applications' : 'resignations']) }}">Create</a></div>
	<div class="row m-t-sm">
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Username</th>
						<th>Answered by</th>
						<th>Date <i class="fa fa-clock-o"></i></th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($apps as $a)
						<tr>
							<td>{{ $a->id }}</td>
							<td><img src="{{ URL::to('/') }}/assets/a/{{ $a->user->Skin }}.png" class="img-circle mt" data-toggle="tooltip" data-placement="top" title="{{ $a->user->user }} / Level: {{ $a->user->Score }}" style="height:29px;"> {!! $a->user->url !!}</td>
							<td>
								@if(!$a->status)
									No-One 
								@else
									@if($a->ans)
										<img src="{{ URL::to('/') }}/assets/a/{{ $a->ans->Skin }}.png" class="img-circle mt" data-toggle="tooltip" data-placement="top" title="{{ $a->ans->user }} / Level: {{ $a->ans->Score }}" style="height:29px;"> {!! $a->ans->url !!} 
									@endif
								@endif
							</td>
							<td>{!! $a->created_at !!}</td>
							<td>{!! $a->statusText !!}</td>
							<td> <a href="{!! $a->url !!}"><i class="fa fa-external-link"></i> View</a> </td>
						</tr>
					@endforeach	
				</tbody>
			</table>
		</div>
	</div>
	{!! $apps->render() !!}
	
	@section('css')<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dt.min.css') }}"/>@endsection
	@section('js')<script>$(function () {$('.mt').tooltip({template: '<div class="tooltip md-tooltip-main"><div class="tooltip-arrow md-arrow"></div><div class="tooltip-inner md-inner-main"></div></div>'});})</script><script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.js"></script><script>$(document).ready(function(){$('.datatable').DataTable({iDisplayLength:5,"aLengthMenu": [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]]});});</script>@endsection

@endsection