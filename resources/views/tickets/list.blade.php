@extends('layouts.master')
@section('breadcrumb','Ticket / List')
@section('content')
	<div class="row"><a class="btn btn-success" style="float:right;" href="{{ URL::to('tickets/create') }}">Create</a></div>
	@if($user)
		<h3>Tickets created by you</h3>
		<div class="row m-t-sm"><div class="table-responsive"><table class="table"><thead><tr><th>#</th><th>Username</th><th>Type</th><th>Date <i class="fa fa-clock-o"></i></th><th>Status</th><th>Actions</th></tr></thead><tbody>@foreach ($user as $u)<tr><td>{{ $u->id }}</td><td><img src="{{ URL::to('/') }}/assets/a/{{ $u->user->Skin }}.png" class="img-circle mt" data-toggle="tooltip" data-placement="top" title="{{ $u->user->user }} / Level: {{ $u->user->Score }}" style="height:29px;"> {!! $u->user->url !!}</td><td>{!! $u->getType !!} </td><td>{!! $u->created_at !!}</td><td>{!! $u->status !!}</td><td> <a href="{!! $u->url !!}"><i class="fa fa-external-link"></i> View</a> </td></tr>@endforeach</tbody></table></div></div>
	@endif
	@if(Auth::user()->Admin != 0)
		<div class="row m-t-sm"><div class="table-responsive"><table class="table"><thead><tr><th>#</th><th>Username</th><th>Type</th><th>Date <i class="fa fa-clock-o"></i></th><th>Status</th><th>Actions</th></tr></thead><tbody>@foreach ($tickets as $t)<tr><td>{{ $t->id }}</td><td><img src="{{ URL::to('/') }}/assets/a/{{ $t->user->Skin }}.png" class="img-circle mt" data-toggle="tooltip" data-placement="top" title="{{ $t->user->user }} / Level: {{ $t->user->Score }}" style="height:29px;"> {!! $t->user->url !!}</td><td>{!! $t->getType !!} </td><td>{!! $t->created_at !!}</td><td>{!! $t->status !!}</td><td> <a href="{!! $t->url !!}"><i class="fa fa-external-link"></i> View</a> </td></tr>@endforeach</tbody></table></div></div>
		{!! $tickets->render() !!}
	@endif
	@section('css')<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dt.min.css') }}"/>@endsection
	@section('js')<script>$(function () {$('.mt').tooltip({template: '<div class="tooltip md-tooltip-main"><div class="tooltip-arrow md-arrow"></div><div class="tooltip-inner md-inner-main"></div></div>'});})</script><script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.js"></script><script>$(document).ready(function(){$('.datatable').DataTable({iDisplayLength:5,"aLengthMenu": [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]]});});</script>@endsection

@endsection