@extends('layouts.master')
@section('breadcrumb','Billboards')
@section('content')
@foreach ($billboards as $a)
	<div>
	<center style="font-size: 50px; background:#{{ General::blcol($a->BackColor) }}; color: #{{ $a->TextColor }}; line-height: 80px">{{ $a->Text }}</br>{{ $a->Text2 }}</center>
	<center>Billboard: <b>#{{ $a->ID }}</b></br>Owner: <b>@if($a->OwnID > -1)<img src="{{ URL::to('/') }}/assets/a/{{ $a->user->Skin }}.png" class="img-circle mt" data-toggle="tooltip" data-placement="top" data-html="true" title="<img src='{{ URL::to('/') }}/assets/s/Skin_{{ $a->user->Skin }}.png' style='height:84px;vertical-align:middle;' /><div style='bottom:33px;float:right;'>Name: {{ $a->user->user }}</br>Level: {{ $a->user->Score }}</br>RP: {{ $a->user->RPoints }}/{{ $a->user->Score*3 }}</br>Hours Played: {{ number_format($a->user->HoursPlayed/3600) }}</br>Job: {{ General::job($a->user->Job) }}</div>" style="height:33px;"> {!! ($a->user ? $a->user->url : $a->OwnID) !!} @else <span style="color:#C90000;">No</span> @endif</b></br>Expire: <b>{{ (date("Y-m-d H:i:s", $a->Expire)) }}</b></br>Status: <b><span style="color:{{ (Carbon\Carbon::now()->timestamp > $a->Expire ? '#00BA19' : '#C90000') }}">{{ (Carbon\Carbon::now()->timestamp > $a->Expire ? 'Available' : 'Unavailable') }}</span></b></center><hr>
	</div>
@endforeach
@section('js')
<script>$(function () {$('.mt').tooltip({template: '<div class="tooltip md-tooltip-main"><div class="tooltip-arrow md-arrow"></div><div class="tooltip-inner md-inner-main"></div></div>'});})</script>
@endsection
@endsection