@extends('layouts.master')

@section('breadcrumb','Donations / List')

@section('content')

	<div class="row m-t-sm">
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Username</th>
						<th>Amount</th>
						<th>Date <i class="fa fa-clock-o"></i></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($donations as $t)
						<tr>
							<td>{{ $t->donateID }}</td>
							<td>{!! ($t->user ? $t->user->url : $t->donateName) !!}</td>
							<td>{{ $t->donateSUM }} Euro</td>
							<td>{{ $t->donateTime }}</td>
						</tr>
					@endforeach	
				</tbody>
			</table>
		</div>
	</div>
	{!! $donations->render() !!}

@endsection