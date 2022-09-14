@extends('layouts.master')

@section('breadcrumb','Leader Panel')

@section('content')

<script src="{{ asset('bc.js') }}"></script>
<div class="alert alert-success" style="margin-bottom:0;font-size:13px;"><b>{{ General::facc($acs)['name'] }}</b> / <b>{{ General::facc($acs)['Type'] }}</b>
<br>Members: <b>{{ count($members) }}/{{ General::facc($acs)['Mem'] }}</b>
<br>Faction MOTD: <b>{{ $fm }}</b>
<br>Leader MOTD: <b>{{ $lm }}</b></div>
<div class="panel panel-success">
<div class="panel-body" style="padding: 24px">
</br><div id="e" style="margin-bottom:0;height:460px;"></div><script>google.charts.load('current', {'packages':['bar']});google.charts.setOnLoadCallback(i);function i(){new google.charts.Bar(document.getElementById('e')).draw(new google.visualization.arrayToDataTable([['Graph', 'Raport Activity', 'Hours (Week)'],@foreach($members as $c)['{{ $c->user }}',{{$c->R1+$c->R2+$c->R3+$c->R4}},{{number_format($c->HWKE/3600)}}],@endforeach]), {bars: 'horizontal',series: {0: {axis:'distance'}, 1:{axis: 'brightness' }},axes:{x:{brightness:{side:'top',label:'All Members Stats'}}}});};</script>

</br><div class="row">
	<div class="col-md-6">
		<h4>Applications</h4>
		<select class="form-control _app" id="{{ Auth::user()->Member }}">
			<option style="color: #000" @if(!$status) selected="selected" @endif value="0">Closed</option>
			<option style="color: #000" @if($status) selected="selected" @endif value="1">Opened</option>
		</select>
	</div>
	<div class="col-md-6">
		<h4>Minimum level</h4>
		<form method="post"><div class="input-group"><input type="text" class="form-control" name="minlevel" value="{{ $minlevel->option_value }}"> {{ csrf_field() }} <span class="input-group-btn"> <input type="submit" type="button" class="btn btn-primary" value="Modify"></input> </span></div></form>
	</div>
</div>
<div class="row m-t-sm">
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Username</th>
					<th>Rank</th>
					<th>FW</th>
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
						<td class="rank-{{ $m->ID }}">{{ ($m->Rank == 10 ? 'Leader' : $m->Rank) }}</td>
						<td>{{ $m->FWarns }}/3</td>
						<td>{{ number_format((time()-$m->DaysF)/86400, 2) }} Days</td>
						<td>{{ date("Y-m-d H:i:s", $m->DaysF) }}</td>
						<td>{{ $m->LastLogin }}</td>
						<td>
							<a class="btn btn-primary btn-icon btn-circle btn-sm rank" action="up" 
									{{ ($m->Rank == 10 ? 'disabled':'') }}
									id="{{ $m->ID }}">
								<i class="fa fa-arrow-up"></i>
							</a>
							<a class="btn btn-danger btn-icon btn-circle btn-sm rank" action="down"
									{{ ($m->Rank == 10 ? 'disabled':'') }}
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
<div class="row">
	<div class="col-sm-12">
		<form class="form-horizontal" role="form" method="post" name="manage_questions" id="manage_questions">
			<fieldset>
				<legend>Manage questions</legend>
				<div class="form-group"><a style="float:right;" class="btn btn-primary _add"><i class="fa fa-plus"></i> Add question</a></div>
				@foreach($questions as $i=>$q)
					<div class="form-group _q{{$i}}">
						<label class="col-md-2 control-label">Question</label>
						<div class="col-md-8"><input type="text" class="form-control _q" placeholder="Question" value="{{ $q }}" id="{{$i}}" name="a{{$i}}"></input></div>
						<div class="col-md-2"><a class="btn btn-danger _remove" id="{{ $i }}"><i class="fa fa-remove"></i></a></div>
					</div>
				@endforeach
				<div class="form-group"><input type="submit" style="float:right;" class="btn btn-success _save" value="Save"/></div>
			</fieldset>
		</form>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<form class="form-horizontal" role="form" method="post" name="manage_questions" id="manage_questions">
			<fieldset>
				<legend>Logs</legend>
				<?php $safelogs = DB::table('safelogs')->where('factionID',Auth::user()->Member)->orderBy('Date','desc')->get(); ?>
				<div class="table-responsive">
						<table class="table table-bordered table-hover table-bordered datatable">
							<thead>
								<tr>
									<th>Text</th>
									<th>Date <i class="fa fa-clock-o"></i></th>
								</tr>
							</thead>
							<tbody>
								@foreach ($safelogs as $l)
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