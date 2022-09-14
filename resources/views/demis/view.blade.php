@extends('layouts.master')

@section('breadcrumb','Resignations / View')

@section('content')


<div class="row">
	<div class="col-sm-5">
		<div class="row">

			<div class="panel panel-default">
				<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-file"></i>&nbsp; Resignation by</h3></div>
				<div class="list-group">
					<div class="list-group-item app-details-children">
						</br><img src="{{ URL::to('/') }}/assets/a/{{ $app->user->Skin }}.png" class="img-circle" style="height:85px;">
						<p style="margin-left: 120px; margin-top: -90px;">
						<i class="fa fa-certificate" style="color:{{ ($app->user->Status == 1 ? 'green' : 'red') }};"></i> {!! $app->user->url !!}
						</br>Level: {{ $app->user->Score }}
						</br>Respect Points: {{ $app->user->RPoints }}
						</br>Hours Played: {{ number_format($app->user->HoursPlayed/3600) }}
						</br>Faction: {{ $app->user->faction }}
						</br>Warns: {{ $app->user->Warns }}/3
						</br>{!! $app->user->roles !!}
						</p>
					</div>
					<div class="list-group-item app-details-children"><strong>Status:</strong><span class="app-status"> {!! $app->status !!} </span></div>
					@if($app->demis_status != 0)<div class="list-group-item app-details-children"><strong>Other specifications:</strong><span class="app-status"> {{ $app->OPrec }} </span></div>@endif
				</div>
				@if((Auth::user()->AdminLevel >= 5) || (Auth::user()->Member == $app->faction && Auth::user()->Rank > 5))
					<div class="panel-footer clearfix">
						<form method="post" action="">
							@if($app->demis_status < 1)<textarea name="demisc" rows="1" placeholder="Aici poti scrie cateva cuvinte pentru jucator..." class="form-control">{{ old('demisc') }}</textarea></br>@endif
							<div class="col-xs-6 col-button-left">
								<?php $method = 'app_accept'; ?>
								<button class="btn btn-success btn-sm btn-block" name="{{ $method }}" @if(in_array($app->demis_status,[1,2])) disabled="disabled" @endif>
									<i class="fa fa-check"></i> Accept
								</button>
							</div>
							<div class="col-xs-6 col-button-right">
								<button class="btn btn-danger btn-sm btn-block" name="app_reject" @if(in_array($app->demis_status,[1,2])) disabled="disabled" @endif>
									<i class="fa fa-remove"></i> Reject
								</button>
							</div>
							{{ csrf_field() }}
						</form>
					</div>
				@endif	
			</div>

		</div>
		<div class="row">
			<div class="feed-activity-list">
	        
				@if($app->faction != 0)
					<?php $logs = \App\FLog::where('pID',$app->user->ID)->orderBy('Date','desc')->get();?>
					@if(!$logs->isEmpty())
					   @foreach($logs as $log)
							<div class="feed-element">
								<a href="#" class="pull-left"><img src="{{ URL::to('/') }}/assets/a/{{ $app->user->Skin }}.png" class="img-circle" style="height:38px;"></a>
								<div class="media-body ">
									{{ $log->Text }}<br>
									<small class="text-muted green"><i class="fa fa-clock-o"></i> {{ $log->Date }}</small>

								</div>
							</div>
						@endforeach
					@else
						<div class="feed-element"><div class="media-body">No data to show. (Faction Logs)</div></div>
					@endif
				@endif
			
	        </div>
        </div>
	</div>
	<div class="col-sm-7"><div class="row"><label class="col-md-3 app_style"><b>Creat la</b></label>
		<div class="col-md-9 app_style">{{ $app->created_at }}</div></div>
		</br><div class="row"><label class="col-md-3 app_style"><b>Motiv</b></label>
		<div class="col-md-9 app_style">{{ $app->Motiv }}</div></div>
		</br><div class="row"><label class="col-md-3 app_style"><b>Alte precizari</b></label>
		<div class="col-md-9 app_style">{{ $app->Prec }}</div></div>

</div>

@endsection