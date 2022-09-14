@extends('layouts.master')

@section('breadcrumb','Turfs')

@section('content')
	<center><div class="table-responsive">
		<span class="car-color" style="background-color:#009100"></span> - Grove Street |
		<span class="car-color" style="background-color:#910082"></span> - The Ballas Family |
		<span class="car-color" style="background-color:#876922"></span> - La Cosa Nostra |
		<span class="car-color" style="background-color:#8c1111"></span> - Sicilian Mafia
		</br><span class="car-color" style="background-color:#EB4F00"></span> - Insomnia Racing Club |
		<span class="car-color" style="background-color:#00A876"></span> - Midnight Racers Club
		</br><table class="table table-bordered table-hover table-bordered"><img src="http://rpg.linkmania.ro/tr.php" /></table>
	<hr>
	@foreach ($turfs as $c)
		<div class="col-md-3">
	        <div class="ibox">
	            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
	                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/{{ $c->Fac }}.jpg" class="img-circle" width="200" height="170" /></div>
	                <div class="product-desc">
	                        <center><a href="#" class="product-name" style="color:{{ General::fColor($c->Fac) }};">{{ General::alliance($c->Fac) }}</a>Type: <b>Gang</b></br>Level: <b>10</b>
	                        	<hr>Alliance: <b style="color:{{ General::fColor($c->AllWith) }};">{{ General::alliance($c->AllWith) }}</b>
	                        </br><i class="fa fa-clock-o"></i> Date: <b>@if($c->AllWith != 0) {{ $c->Date }} @else No @endif</b>
	                </div>
	            </div>
	        </div>
	    </div>
    @endforeach
	</div></center>
@endsection