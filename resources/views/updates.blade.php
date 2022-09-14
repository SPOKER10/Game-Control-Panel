@extends('layouts.master')
@section('breadcrumb','Server Updates')
@section('content')
<center><img src="{{ URL::to('/') }}/assets/images/d.png" style="height:260px;"/></center>
<div class="row"><div class="tab-content"><div id="faq-tab-1" class="tab-pane fade in active"><div id="faq-list-1" class="panel-body">
	@foreach ($updates as $key => $u)
		<div class="panel panel-default">
			<div class="panel-heading">
				<a href="#{{ $u->ID }}" data-parent="#{{ $u->ID }}" data-toggle="collapse"><i class="fa fa-chevron-right"></i> <font style="color:{{ $key == 0 ? 'orange' : '' }};">{{ $u->Version }}</font> / <i class="fa fa-clock-o"></i> {{ $u->created_at }} / by Spoker @if($key > 0) / <i class="fa fa-star" style="color: #FE7;text-shadow: 0 0 20px #952;"></i> {{ $u->Rate }} ({{ $u->TotalV }} Votes) @else / <i class="fa fa-star" style="color: #FE7;text-shadow: 0 0 20px #952;"></i> {{ number_format(\Cache::get('uprate'), 1) }} ({{ \Cache::get('uptotal') }} Votes)@endif</a>
			</div>
			<div class="panel-collapse collapse" id="{{ $u->ID }}"><div class="panel-body">{!! nl2br(e($u->Text)) !!}</div></div>
		</div>
	@endforeach
</div></div></div></div>	
@endsection		