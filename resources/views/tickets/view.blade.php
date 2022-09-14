@extends('layouts.master')

@section('breadcrumb','Ticket / View')

@section('content')

	<div class="row">
	<div class="col-sm-5">
		<div class="row">

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-file"></i>&nbsp; Ticket by</h3>
				</div>
				<div class="list-group">
					</br><img alt="image" style="height:140px;margin-left: 20px;" src="{{ URL::to('/') }}/assets/s/Skin_{{ $ticket->user->SkinID }}.png">
					<p style="margin-left: 120px; margin-top: -130px;">
					<i class="fa fa-certificate" style="color:{{ ($ticket->user->Status == 1 ? 'green' : 'red') }};"></i> {!! $ticket->user->url !!}
					</br>Level: {{ $ticket->user->Score }}
					</br>Respect Points: {{ $ticket->user->RPoints }}
					</br>Hours Played: {{ number_format($ticket->user->HoursPlayed/3600) }}
					</br>Faction: {{ $ticket->user->faction }}
					</br>Warns: {{ $ticket->user->Warns }}/3
				</br>{!! $ticket->user->roles !!}
			</br>
					</p>
				</div>
				@if(Auth::user()->AdminLevel >= 1)
					<div class="panel-footer clearfix">
						<form method="post" action="">
							<div class="col-xs-6 col-button-left">
								<select class="form-control" name="_action" @if($ticket->ticket_status != 0) disabled="disabled" @endif>
									@foreach(\App\Ticket::$statuses as $k=>$t)
										<option style="color: #000" value="{{ $k }}">{!! $t !!}</option>
									@endforeach
								</select>
							</div>
							<div class="col-xs-6 col-button-right">
								<button class="btn btn-danger btn-sm btn-block" name="ticket_respond" @if($ticket->ticket_status != 0) disabled="disabled" @endif>
									<i class="fa fa-remove"></i> Modify
								</button>
							</div><br></br>
							<button class="btn btn-success btn-sm btn-block" name="ticket_open" @if($ticket->ticket_status < 1) disabled="disabled" @endif><i class="fa fa-play"></i> Open</button>
							<button class="btn btn-danger btn-sm btn-block" name="ticket_delete" @if(Auth::user()->AdminLevel < 5) disabled="disabled" @endif><i class="fa fa-trash"></i> Delete</button>
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
				<label class="col-md-3 app_style"><b>Creat la</b></label> <div class="col-md-9 app_style">{{ $ticket->created_at }}</div>
			</div><br>
			<div class="row">
				<label class="col-md-3 app_style"><b>Descriere</b></label> <div class="col-md-9 app_style">{{ $ticket->description }}</div>
			</div><br>
			<div class="row">
				<label class="col-md-3 app_style"><b>IP</b></label> <div class="col-md-9 app_style">{{ $ticket->IP }}</div>
			</div><br>
			<hr>
			<div class="m-t-sm">
			<?php $comms = json_decode($ticket->comments); ?>
			@if(count($comms) > 0)
				@foreach($comms as $c)
					<div class="feed-element">
						<a href="#" class="pull-left">
							<img src="{{ URL::to('/') }}/assets/a/{{ $c->skin }}.png" class="img-circle" style="height:38px;">
						</a>
						<div class="media-body ">
							<b>{{ $c->name }}</b>: {{ $c->text }}<br>
							<small class="text-muted green"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::createFromTimestamp($c->time)->diffForHumans() }} ({{ \Carbon\Carbon::createFromTimestamp($c->time)->format('d.m.Y H:i') }})</small>
							@if(Auth::user()->AdminLevel > 0 && isset($c->ip))</br><small class="text-muted green"><i class="fa fa-desktop"></i> {{ $c->ip }}</small>@endif
						</div>
					</div>
				@endforeach
			@endif
			@if(!$ticket->ticket_status)
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
</div>

@endsection