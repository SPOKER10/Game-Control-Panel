@extends('layouts.master')

@section('breadcrumb','Unban / List')

@section('content')


<div class="row">
	<div class="col-sm-5">
		<div class="row">

			<div class="panel panel-default">
				<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-file"></i>&nbsp; Unban request by</h3></div>
				<div class="list-group">
					<div class="list-group">
						</br><img alt="image" style="height:140px;margin-left: 20px;" src="{{ URL::to('/') }}/assets/s/Skin_{{ $unban->user->SkinID }}.png">
						<p style="margin-left: 120px; margin-top: -130px;">
						<i class="fa fa-certificate" style="color:{{ ($unban->user->Status == 1 ? 'green' : 'red') }};"></i> {!! $unban->user->url !!}
						</br>Level: {{ $unban->user->Score }}
						</br>Respect Points: {{ $unban->user->RPoints }}
						</br>Hours Played: {{ number_format($unban->user->HoursPlayed/3600) }}
						</br>Faction: {{ $unban->user->faction }} @if($unban->user->Rank == 10) (Leader) @elseif($unban->user->Rank != 0) (Rank {{ $unban->user->Rank }}) @endif
						</br>Warns: {{ $unban->user->Warns }}/3
						</br>{!! $unban->user->roles !!}
					</br>
						</p>
					</div>
					<div class="list-group-item app-details-children"><strong>Views:</strong><span> {{ $unban->View }}</span></div>
				</div>
				@if(Auth::user()->AdminLevel >= 1)
					<div class="panel-footer clearfix">
						<form method="post" action="">
							<div class="col-xs-6 col-button-left">
								<select class="form-control" name="_action" @if($unban->unban_status != 0) disabled="disabled" @endif>
									<option style="color: #000" value="1">Ban remains</option>
									<option style="color: #000" value="2">Unban</option>
								</select>
							</div>
							<div class="col-xs-6 col-button-right">
								<button class="btn btn-danger btn-sm btn-block" name="unban_respond" @if($unban->unban_status != 0) disabled="disabled" @endif>
									<i class="fa fa-remove"></i> Close
								</button>
							</div><br></br>
							<button class="btn btn-success btn-sm btn-block" name="unban_open" @if($unban->unban_status < 1) disabled="disabled" @endif><i class="fa fa-play"></i> Open</button>
							<button class="btn btn-danger btn-sm btn-block" name="unban_delete" @if(Auth::user()->AdminLevel < 5) disabled="disabled" @endif><i class="fa fa-trash"></i> Delete</button>
							{{ csrf_field() }}
						</form>
					</div>
				@endif
			</div>

		</div>
		<div class="row">
			<div class="feed-activity-list">
				<?php $logs = DB::table('logs')->where('Tip','=','11')->where('pName',$unban->user->name)->orderBy('Date','desc')->limit(10)->get();?>
				@if(!$logs->isEmpty())
				   @foreach($logs as $log)
						<div class="feed-element">
							<a href="#" class="pull-left"><img src="{{ URL::to('/') }}/assets/a/{{ $unban->user->Skin }}.png" class="img-circle" style="height:38px;"></a>
							<div class="media-body ">{{ $log->Text }}<br><small class="text-muted green"><i class="fa fa-clock-o"></i> {{ date("Y-m-d H:i:s", $log->Date) }}</small></div>
						</div>
					@endforeach
				@else <div class="feed-element"><div class="media-body">No data to show. (Last 10 sanctions)</div></div> @endif
    	</div>
	</div>
	</div>
	<div class="col-sm-7">
		<div class="ibox-content m-b-sm">
			<div class="row">
				<label class="col-md-3 app_style"><b>Creat la</b></label>
				<div class="col-md-9 app_style">{{ $unban->created_at }}</div>
			</div><br>
			<div class="row">
				<label class="col-md-3 app_style"><b>Motiv</b></label>
				<div class="col-md-9 app_style">{{ $unban->reason }}</div>
			</div><br>
			<div class="row">
				<label class="col-md-3 app_style"><b>Imagine</b></label>
				<div class="col-md-9 app_style">{{ $unban->img }}</div>
			</div><br>
			<div class="row">
				<label class="col-md-3 app_style"><b>Alte precizari</b></label>
				<div class="col-md-9 app_style">{{ $unban->description }}</div>
			</div><br>
			<div class="row">
				<label class="col-md-3 app_style"><b>IP</b></label>
				<div class="col-md-9 app_style">{{ $unban->IP }}</div>
			</div><br>
			<hr>
			<?php $comms = json_decode($unban->comments); ?>
			@if(count($comms) > 0)
				@foreach($comms as $c)
					<div class="feed-element">
						<a href="#" class="pull-left">
							<img src="{{ URL::to('/') }}/assets/a/{{ $c->skin }}.png" class="img-circle" style="height:38px;">
						</a>
						<div class="media-body">
							<?php
								$role = '';
								if(isset($c->role)) {
									switch($c->role) {
										case 2: $role = ' <span class="badge badge-danger">banned player</span>'; break;
										case 3: $role = ' <span class="badge badge-primary">admin</span>'; break;
										case 4: $role = ' <span class="badge badge-info">helper</span>'; break;
										case 5: $role = ' <span class="badge badge-warning">leader</span>'; break;
										default: $role = ''; break; 
									}
								}
							?>
							<b>{{ $c->name }}{!! $role !!}</b>: {{ $c->text }}<br>
							<small class="text-muted green"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::createFromTimestamp($c->time)->diffForHumans() }} ({{ \Carbon\Carbon::createFromTimestamp($c->time)->format('d.m.Y H:i') }})</small>
							@if(Auth::user()->AdminLevel > 0 && isset($c->ip))</br><small class="text-muted green"><i class="fa fa-desktop"></i> {{ $c->ip }}</small>@endif
						</div>
					</div>
				@endforeach
			@endif
		@if(!$unban->unban_status)
			<hr>
			<form method="POST" action="">
				<div class="form-group">
					<label class="control-label">Comment</label>
					<div><textarea name="_comment" rows="3" placeholder="Comment" class="form-control"></textarea></div>
				</div>
				<div class="form-group">
					<input type="submit" name="_comment_submit" class="btn btn-success"></input>
					{!! csrf_field() !!}
				</div>
			</form>
		@endif		
		</div>
	</div>
</div>

@endsection