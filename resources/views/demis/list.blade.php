@extends('layouts.master')
@section('breadcrumb','Resignations / ' . ($type != "Faction" ? ($type) : (General::faction(\Request::route('faction'),'name'))))
@section('content')

	<div class="row">
		<a 
			class="btn btn-success" 
			style="float:right;" 
			href="{{ URL::to('demis') }}/<?php echo \Request::segment(2) . (\Request::route('faction') ? '/' . \Request::route('faction') : null); ?>/create">Create</a>
	</div>

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
							<td>{!! $a->user->url !!}</td>
							<td>@if($a->demis_status == 0) No-One @else {!! $a->acby->url !!} @endif</td>
							<td>{!! $a->created_at !!}</td>
							<td>{!! $a->status !!}</td>
							<td> <a href="{!! $a->url !!}"><i class="fa fa-external-link"></i> View</a> </td>
						</tr>
					@endforeach	
				</tbody>
			</table>
		</div>
	</div>
	{!! $apps->render() !!}

@endsection