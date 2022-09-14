@extends('layouts.master')

@section('breadcrumb','Dealership')

@section('content')
<div class="panel-body">
@foreach ($dealership as $c)
	@if($c->Stock > -1)
		<div class="col-md-3">
		    <div class="ibox">
		        <div class="ibox-content product-box" style="margin-left:4px; background-color:{{ ($c->Stock == 0 ? '#a06a263d' : '#2121218f') }};">
		            <div class="product-imitation" style="padding:0; background-color:{{ ($c->Stock == 0 ? '#a06a263d' : '#2121218f') }};"><img src="{{ URL::to('/') }}/assets/images/vehicles/Vehicle_{{ $c->Model }}.jpg" class="img-circle" width="170" height="140"/></div>
		            <div class="product-desc">
		            	<span class="product-price" style="background: linear-gradient(to left, rgba(0, 0, 0, 0.25) 0%, rgba(0, 255, 115, 0.44) 100%);">{{ General::format($c->Price) }} $</span>
		                <center><a href="#" class="product-name">{{ General::vehicle($c->Model) }}</a>
		              	Stock: <b>{{ $c->Stock }}</b></br>
		              	Max Speed: <b>{{ General::vsp($c->Model) }} KM/h</b></br>
		              	Info: <b><a href="https://gta.fandom.com/wiki/{{ General::vehicle($c->Model) }}" target="_blank"><i class="fa fa-external-link"></i> CLICK</a></b></br>Total Buyers: <b>{{ $c->TotB }}</b></br>Class: <b><span style="color:green;">{{ General::clv($c->Model) }}</span></b>
		              	</br></br>SPEED<div class="progress" style="background-color: #77777736"><div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (General::vsp($c->Model))*100/(210) }}%; color: #c7c7c7; font-size: 10px;">{{ General::vsp($c->Model) }} KM/H</div></div><hr>
		             	<a @if($c->Stock == 0) disabled="disabled" @else href="{{ URL::to('buyd',['id' => $c->Model]) }}" @endif class="btn btn-success btn-sm mt" data-toggle="tooltip" data-placement="top" title="{{ General::format($c->Price) }}$"><i class="fa fa-shopping-cart"></i> buy</a></center>
		            </div>
		        </div>
			</div>
		</div>
	@else
		<div class="col-md-3">
		    <div class="ibox">
		        <div class="ibox-content product-box" style="margin-left:4px; background-color:#a06a263d;">
		            <div class="product-imitation" style="padding:0; background-color:#a06a2600;"><img src="{{ URL::to('/') }}/assets/images/vehicles/Vehicle_{{ $c->Model }}.jpg" class="img-circle" width="170" height="140"/></div>
		            <div class="product-desc">
		            	<span class="product-price" style="background: linear-gradient(to left, rgba(0, 0, 0, 0.25) 0%, rgba(0, 255, 115, 0.44) 100%);">{{ General::format($c->Price) }} <i class="fa fa-diamond"></i></span>
		                <center><a href="#" class="product-name">{{ General::vehicle($c->Model) }}</a>
	                	Stock: <b>Full</b></br>
		              	Max Speed: <b>{{ General::vsp($c->Model) }} KM/h</b></br>
		              	Info: <b><a href="https://gta.fandom.com/wiki/{{ General::vehicle($c->Model) }}" target="_blank"><i class="fa fa-external-link"></i> CLICK</a></b></br>Total Buyers: <b>{{ $c->TotB }}</b></br>Class: <b><span style="color:green;">Specials</span></b>
		              	</br></br>SPEED<div class="progress" style="background-color: #77777736"><div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (General::vsp($c->Model))*100/(210) }}%; color: #c7c7c7; font-size: 10px;">{{ General::vsp($c->Model) }} KM/H</div></div><hr>
		              	<a href="{{ URL::to('buydd',['id' => $c->Model]) }}" class="btn btn-success btn-sm mt" data-toggle="tooltip" data-placement="top" title="{{ General::format($c->Price) }} Diamonds"><i class="fa fa-shopping-cart"></i> buy</a></center>
		            </div>
		        </div>
			</div>
		</div>
	@endif
@endforeach	
</div>
<center><div class="alert alert-success" style="margin-bottom:0;font-size:13px;"><b>INFO!</b></br>Vehiculele sunt afisate in ordine descrescatoare a pretului!</br>Ca sa poti cumpara un vehicul de aici trebuie sa fii <b>offline</b> pe server!</b></div></center></br>
@section('js')
<script>$(function () {$('.mt').tooltip({template: '<div class="tooltip md-tooltip-main"><div class="tooltip-arrow md-arrow"></div><div class="tooltip-inner md-inner-main"></div></div>'});})</script>
@endsection
@endsection