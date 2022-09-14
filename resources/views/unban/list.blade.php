@extends('layouts.master')

@section('breadcrumb','Unban / List')

@section('content')

	@if (count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {!! $error !!}<br>
            @endforeach
        </div>
    @endif

	<div class="row"><a class="btn btn-success" style="float:right;" href="{{ URL::to('unban/create') }}">Create</a></div>
	<div class="row m-t-sm">
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Username</th>
						<th>Status</th>
						<th>Created Date <i class="fa fa-clock-o"></i></th>
						<th>Views</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($unban as $u)
						<tr>
							<td>{{ $u->id }}</td>
							<td>{!! isset($u->user) ? $u->user->url : $u->unban_userid !!}</td>
							<td>{!! $u->status !!}</td>
							<td>{!! $u->created_at !!}</td>
							<td>{{ $u->View }}</td>
							<td> <a href="{!! $u->url !!}"><i class="fa fa-external-link"></i> View</a> </td>
						</tr>
					@endforeach	
				</tbody>
			</table>
		</div>
	</div>
	{!! $unban->render() !!}

@endsection