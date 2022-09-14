@extends('layouts.master')

@section('breadcrumb','Donation / View')

@section('content')

	<div class="row">
	<div class="col-sm-5">
		<div class="row">

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="fa fa-file"></i>&nbsp; Details
					</h3>
				</div>
				<div class="list-group">
					<div class="list-group-item app-details-children">
						<strong>Created at:</strong> {{ $donation->donateTime }}
					</div>
					<div class="list-group-item app-details-children">
						<strong>Username:</strong> {!! $donation->donateName !!}
					</div>
					<div class="list-group-item app-details-children">
						<strong>Status:</strong> <span> {!! $donation->status !!}</span>
					</div>
					<div class="list-group-item app-details-children">
						<strong>Admin action:</strong> {{ $donation->donateAdminAction }}
					</div>
				</div>
				@if(Auth::user()->AdminLevel >= 6)
					<div class="panel-footer clearfix">
						<form method="post" action="">
							<div class="col-xs-6 col-button-left">
								<select class="form-control" name="_action" @if($donation->donateStatus != 0) disabled="disabled" @endif>
									@foreach(\App\Donation::$statuses as $k=>$t)
										<option style="color: #000" value="{{ $k }}">{!! $t !!}</option>
									@endforeach
								</select>
							</div>
							<div class="col-xs-6 col-button-right">
								<button class="btn btn-danger btn-sm btn-block" name="donation_respond" @if($donation->donateStatus != 0) disabled="disabled" @endif>
									<i class="fa fa-remove"></i> Modify
								</button>
							</div>
							{{ csrf_field() }}
						</form>
					</div>
				@endif
			</div>

		</div>
	</div>
	<div class="col-sm-7">
		<div class="ibox-content m-b-sm">
			<div class="row">
				<label class="col-md-3 app_style"><b>Amount</b></label>
				<div class="col-md-9 app_style">
					{{ $donation->getSum }} RON
				</div>
			</div><br>
			<div class="row">
				<label class="col-md-3 app_style"><b>PIN</b></label>
				<div class="col-md-9 app_style">
					{{ $donation->donatePIN }}
				</div>
			</div><br>
			<hr>
			<div class="m-t-sm">	
			</div>
		</div>
	</div>
</div>

@endsection