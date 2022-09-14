@extends('layouts.master')

@if($comp->complaint_type != 4)
	@section('breadcrumb','Complaints / ' . $comp->getType)
@else
	@section('breadcrumb','Complaints / ' . $comp->getType . ' / ' . General::faction($comp->complaint_faction,'name'))
@endif

@section('content')


<div class="row">
	<div class="col-sm-5">
		<div class="row">

			<div class="panel panel-default">
				<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-file"></i>&nbsp; Details</h3></div>
				<div class="list-group"><div class="list-group-item app-details-children"><strong>Created by</strong></br><img src="{{ URL::to('/') }}/assets/a/{{ $comp->user->Skin }}.png" class="img-circle" style="height:85px;"><p style="margin-left: 120px; margin-top: -90px;"><i class="fa fa-certificate" style="color:{{ ($comp->user->Status == 1 ? 'green' : 'red') }};"></i> {!! $comp->user->url !!}</br>Level: {{ $comp->user->Score }}</br>Respect Points: {{ $comp->user->RPoints }}</br>Hours Played: {{ number_format($comp->user->HoursPlayed/3600) }}</br>Faction: {{ $comp->user->faction }}</br>Warns: {{ $comp->user->Warns }}/3</br>{!! $comp->user->roles !!}</p></div><div class="list-group-item app-details-children"><strong>Against by</strong></br><img src="{{ URL::to('/') }}/assets/a/{{ $comp->against->Skin }}.png" class="img-circle" style="height:85px;"><p style="margin-left: 120px; margin-top: -90px;"><i class="fa fa-certificate" style="color:{{ ($comp->against->Status == 1 ? 'green' : 'red') }};"></i> {!! $comp->against->url !!}</br>Level: {{ $comp->against->Score }}</br>Respect Points: {{ $comp->against->RPoints }}</br>Hours Played: {{ number_format($comp->against->HoursPlayed/3600) }}</br>Faction: {{ $comp->against->faction }}</br>Warns: {{ $comp->against->Warns }}/3</br>{!! $comp->against->roles !!}</p></div><div class="list-group-item app-details-children"><strong>Status:</strong><span> {!! $comp->status !!} @if($comp->action) ({{ $comp->action_text }}) @if($comp->action_text == "Nothing")<i style="color:green" class="fa fa-smile-o"></i>@else<i style="color:red" class="fa fa-frown-o"></i>@endif  @endif </span></div><div class="list-group-item app-details-children"><strong>Views:</strong><span> {{ $comp->View }}</span></div></div>
				<?php switch($comp->complaint_type) {case 0: { $lv = 1; break; }case 1: { $lv = 3; break; }case 2: { $lv = 5; break; }case 3: { $lv = 6; break; }case 4: { $lv = 6; break; }} ?>
				@if((Auth::user()->AdminLevel >= $lv) || ($comp->complaint_type == 4 && (Auth::user()->Member == $comp->complaint_faction && Auth::user()->Rank == 10)))
					<div class="panel-footer clearfix">
						<form method="post" action="">
							<div class="col-xs-6 col-button-left">
								<select class="form-control" name="_action" @if($comp->complaint_status) disabled="disabled" @endif>
									@if($comp->complaint_type != 4)
										<option style="color: #000" value="nothing">Do nothing</option>
										<option style="color: #000" value="mute15">Mute</option>
										<option style="color: #000" value="jail">AJail</option>
										<option style="color: #000" value="warn">Warn</option>
										<option style="color: #000" value="ban1">Ban temporary</option>
										<option style="color: #000" value="ban3">Ban permanent</option>
									@else	
										<option style="color: #000" value="nothing">Do nothing</option>
										<option style="color: #000" value="fpunish">Faction punish</option>
										<option style="color: #000" value="fwarn">Faction warn</option>
										<option style="color: #000" value="uninvite">Uninvite</option>
									@endif
								</select>
							</div>
							<div class="col-xs-6 col-button-right"><button class="btn btn-danger btn-sm btn-block" name="comp_respond" @if($comp->complaint_status) disabled="disabled" @endif><i class="fa fa-remove"></i> Close</button></div><br></br>
							@if($comp->complaint_type != 4 && $comp->complaint_status != 1)<textarea name="compr" rows="1" placeholder="Mute Minutes / AJail Minutes / Warn (no input here) / Ban Temporary Days / Ban Permanent (no input here)" class="form-control">{{ old('compr') }}</textarea></br> @endif
							<button class="btn btn-success btn-sm btn-block" name="comp_open" @if($comp->complaint_status < 1) disabled="disabled" @endif><i class="fa fa-play"></i> Open</button>
							<button class="btn btn-danger btn-sm btn-block" name="comp_delete" @if(Auth::user()->AdminLevel < 5) disabled="disabled" @endif><i class="fa fa-trash"></i> Delete</button>
							{{ csrf_field() }}
						</form>
					</div>
				@endif
			</div>
		</div>
		<div class="row"><div class="feed-activity-list"><?php $logs = DB::table('logs')->where('Tip','=','11')->where('pName',$comp->against->name)->orderBy('Date','desc')->limit(10)->get();?>@if(!$logs->isEmpty())@foreach($logs as $log)<div class="feed-element"><a href="#" class="pull-left"><img src="{{ URL::to('/') }}/assets/a/{{ $comp->against->Skin }}.png" class="img-circle" style="height:38px;"></a><div class="media-body ">{{ $log->Text }}<br><small class="text-muted green"><i class="fa fa-clock-o"></i> {{ date("Y-m-d H:i:s", $log->Date) }}</small></div></div>@endforeach @else <div class="feed-element"><div class="media-body">No data to show. (Last 10 sanctions)</div></div> @endif</div>
	</div>
	</div>
	<div class="col-sm-7">
		<div class="ibox-content m-b-sm">
			<div class="row">
				<label class="col-md-3 app_style"><b>Creat la</b></label>
				<div class="col-md-9 app_style">{{ $comp->created_at }}</div>
			</div><br>
			<div class="row">
				<label class="col-md-3 app_style"><b>Descriere</b></label>
				<div class="col-md-9 app_style">{{ $comp->description }}</div>
			</div><br>
			<div class="row">
				<label class="col-md-3 app_style"><b>Dovezi</b></label>
				<div class="col-md-9 app_style">{{ $comp->proof }}</div>
			</div>
			<hr>
			<div class="m-t-sm">
			<?php $comms = json_decode($comp->comments); ?>
			@if(count($comms) > 0)
				@foreach($comms as $c)
					<div class="feed-element">
						<a href="#" class="pull-left">
							<img src="{{ URL::to('/') }}/assets/a/{{ $c->skin }}.png" class="img-circle" style="height:38px;">
						</a>
						<div class="media-body">
							<?php
								switch($c->role)
								{
									case 1: $role = ' <span class="badge badge-success">complaint creator</span>'; break;
									case 2: $role = ' <span class="badge badge-danger">reported player</span>'; break;
									case 3: $role = ' <span class="badge badge-primary">admin</span>'; break;
									case 4: $role = ' <span class="badge badge-info">helper</span>'; break;
									case 5: $role = ' <span class="badge badge-warning">leader</span>'; break;
									default: $role = ''; break;
								}
							?>
							<b>{{ $c->name }}{!! $role !!}</b>: {{ $c->text }}<br>
							<small class="text-muted green"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::createFromTimestamp($c->time)->diffForHumans() }} ({{ \Carbon\Carbon::createFromTimestamp($c->time)->format('d.m.Y H:i') }})</small>
							@if(Auth::user()->AdminLevel > 0)</br><small class="text-muted green"><i class="fa fa-desktop"></i> {{ $c->ip }}</small>@endif
						</div>
					</div>
				@endforeach
			@endif
			@if(!$comp->complaint_status) <hr><form method="POST" action=""><div class="form-group"><label class="control-label">Comment</label><div><textarea name="_comment" rows="3" placeholder="Comment" class="form-control"></textarea></div></div><div class="form-group"><input type="submit" name="_comment_submit" class="btn btn-success"></input>{!! csrf_field() !!}</div></form> @endif
			</div>
		</div>
	</div>
</div>
@endsection