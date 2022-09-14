@extends('layouts.master')

@section('breadcrumb','Clan Panel')

@section('content')
<div class="panel panel-success">
<div class="panel-body" style="padding: 24px">
<div class="alert alert-success" style="margin-bottom:0;font-size:13px;"><b>{{ $clan->Name }}</b> / <b>[{{ $clan->Tag }}]</b>
<br>HQ: <b>{{ ($clan->HQ > 1 ? 'Yes' : 'No') }} @if($clan->Lk == 0) <i class="fa fa-unlock" style="color:#00FA00"></i> @else <i class="fa fa-lock" style="color:#FF1C1C"></i> @endif</b>
<br>Members: <b>{{ count($members) }}/{{ $clan->MaxMembers }}</b>
<br>MOTD: <b>{{ $clan->MOTD }}</b>
<br>Expire: <b>{{ date("Y-m-d H:i:s", $clan->Expire) }}</b> (<b>{{ round(($clan->Expire-time())/(60 * 60 * 24)) }} days left</b>)</div>

<div class="row m-t-sm m-b-sm">
	<div class="row">
		<div class="col-md-6">
			<h4>Applications</h4>
			<form method="post">
				<div class="input-group">
					<input type="hidden" value="{{ (!$status ? 0 : (!$status->option_value ? 0 : 1)) }}" name="appstatus"/>
					<input type="text" readonly class="form-control" value="Application status: {{ (!$status ? 'Open' : (!$status->option_value ? 'Closed' : 'Open')) }}"> 
					<span class="input-group-btn"> <input type="submit" type="button" class="btn btn-primary" name="_appStatus" value="Modify"></input> </span>
					{{ csrf_field() }}
				</div>
			</form>
			
		</div>
		<div class="col-md-6">
			<h4>Minimum level</h4>
			<form method="post">
				<div class="input-group">
					<input type="text" class="form-control" name="minlevel" placeholder="Minimum level (Current: {{ ($level ? $level->option_value : 0) }})" value="{{ $level ? $level->option_value : 0 }}"> 
					<span class="input-group-btn"> <input type="submit" type="button" class="btn btn-primary" name="_appLevel" value="Modify"></input> </span>
					{{ csrf_field() }} 
				</div>
			</form>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-6 container">
			<h4>Application questions</h4>
			<form class="form-horizontal" method="post">
				<input type="submit" name="_questionsSave" class="btn btn-primary" value="Save"></input>
				<input type="submit" name="_questionsAdd" class="btn btn-warning stat-percent" value="+ Add question"></input>
				@foreach($questions[0] as $i=>$q)
					<div class="form-group _q2 m-t-sm">
						<label class="col-md-2 control-label">Question</label>
						<div class="col-md-8"><input type="text" class="form-control _q" placeholder="Question" value="{{ $q }}" id="{{ $i }}" name="a{{ $i }}"></div>
						<div class="col-md-2"><button class="btn btn-danger" type="submit" name="_questionsRemove" value="{{ $i }}"><i class="fa fa-remove"></i></button></div>
					</div>
				@endforeach
				<input type="hidden" name="_questionsType" value="0">
				{{ csrf_field() }}
			</form>
		</div>
		<div class="col-md-6">
			<h4>Resignation questions</h4>
			<form class="form-horizontal" method="post">
				<input type="submit" name="_questionsSave" class="btn btn-primary" value="Save"></input>
				<input type="submit" name="_questionsAdd" class="btn btn-warning stat-percent" value="+ Add question"></input>
				@foreach($questions[1] as $i=>$q)
					<div class="form-group _q2 m-t-sm">
						<label class="col-md-2 control-label">Question</label>
						<div class="col-md-8"><input type="text" class="form-control _q" placeholder="Question" value="{{ $q }}" id="{{ $i }}" name="a{{ $i }}"></div>
						<div class="col-md-2"><button class="btn btn-danger" type="submit" name="_questionsRemove" value="{{ $i }}"><i class="fa fa-remove"></i></button></div>
					</div>
				@endforeach
				<input type="hidden" name="_questionsType" value="1">
				{{ csrf_field() }}
			</form>
		</div>
	</div>
</div>
<hr>
<div class="row m-t-sm">
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Username</th>
					<th>Rank</th>
					<th>Days</th>
					<th>Joined</th>
					<th>Last Login</th>
					<th>Set Rank</th>
				</tr>
			</thead>
			<tbody>
				@foreach($members as $m)
					<tr>
						<td><i class="fa fa-certificate" style="color:{{ ($m->Status == 1 ? 'green' : 'red') }};"></i> <img src="{{ URL::to('/') }}/assets/a/{{ $m->Skin }}.png" class="img-circle" style="height:33px;"> {!! $m->url !!}</td>
						<td class="crank-{{ $m->ID }}">{{ ($m->CRank == 7 ? 'Leader' : $m->CRank) }}</td>
						<td>{{ number_format((time()-$m->DaysC)/86400, 2) }} Days</td>
						<td>{{ date("Y-m-d H:i:s", $m->DaysC) }}</td>
						<td>{{ $m->LastLogin }}</td>
						<td>
							<a class="btn btn-primary btn-icon btn-circle btn-sm crank" action="up" 
									{{ ($m->CRank == 7 ? 'disabled':'') }}
									id="{{ $m->ID }}">
								<i class="fa fa-arrow-up"></i>
							</a>
							<a class="btn btn-danger btn-icon btn-circle btn-sm crank" action="down"
									{{ ($m->CRank == 7 ? 'disabled':'') }}
									id="{{ $m->ID }}">
								<i class="fa fa-arrow-down"></i>
							</a>
						</td>
					</tr>	
				@endforeach			
			</tbody>
		</table>
	</div>
</div>
</br><div class="row">
	<div class="col-sm-12">
		<form class="form-horizontal" role="form" method="post" name="manage_questions" id="manage_questions">
			<fieldset>
				<legend>Clan Logs</legend>
				<?php $safeclogs = DB::table('clanlogs')->where('clanID',Auth::user()->Clan)->orderBy('Date','desc')->get(); ?>
				<div class="table-responsive">
						<table class="table table-bordered table-hover table-bordered datatable">
							<thead>
								<tr>
									<th>Text</th>
									<th>Date <i class="fa fa-clock-o"></i></th>
								</tr>
							</thead>
							<tbody>
								@foreach ($safeclogs as $l)
									<tr>
										<td>{{ $l->Text }}</td>
										<td>{{ $l->Date }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				<hr>
			</fieldset>
		</form>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<form class="form-horizontal" role="form" method="post" name="manage_questions" id="manage_questions">
			<fieldset>
				<legend>Clan Safe Logs</legend>
				<?php $safeclogs = DB::table('safeclogs')->where('clanID',Auth::user()->Clan)->orderBy('Date','desc')->get(); ?>
				<div class="table-responsive">
						<table class="table table-bordered table-hover table-bordered datatable">
							<thead>
								<tr>
									<th>Text</th>
									<th>Date <i class="fa fa-clock-o"></i></th>
								</tr>
							</thead>
							<tbody>
								@foreach ($safeclogs as $l)
									<tr>
										<td>{{ $l->Text }}</td>
										<td>{{ $l->Date }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				<hr>
			</fieldset>
		</form>
	</div>
</div>
</div>
</div>
@section('css')<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dt.min.css') }}"/>@endsection
@section('js')
<script src="{{ asset('assets/bt.min.js') }}"></script>
<script src="{{ asset('assets/lp.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.js"></script><script>$(document).ready(function(){$('.datatable').DataTable({"order": [[ 1, "desc" ]],iDisplayLength:10,"aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]]});});</script>
@endsection
@endsection