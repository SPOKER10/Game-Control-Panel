@extends('layouts.master')

@section('breadcrumb','Server Control')

@section('content')
<div class="panel panel-success">
<div class="panel-body" style="padding: 24px">
	<center><img src="https://www.game-state.com/193.203.39.215:7777/560x95_FFFFFF_FF9900_000000_000000.png" /></center>
	</br><div class="row">
		<div class="col-md-6">
			<form name="sname" action="{{ url('sname') }}" method="get">
			   <legend>Server Name</legend>
			   <textarea name="compr" rows="1" placeholder="Enter Server Name" class="form-control">{{ old('compr') }}</textarea>
			   <input class="btn btn-custom btn-sm btn-block" type="submit" value="Set Server Name" />
			</form>
		</div>
		<div class="col-md-6">
			<form name="spass" action="{{ url('spass') }}" method="get">
			   <legend>Server Password</legend>
			   <textarea name="compr" rows="1" placeholder="Enter Server Password" class="form-control">{{ old('compr') }}</textarea>
			   <input class="btn btn-custom btn-sm btn-block" type="submit" value="Set Server Password" />
			   <a href="{{ url('removepass') }}" class="btn btn-danger btn-sm btn-block"><i class="fa fa-eraser"></i> Remove Server Password</a>
			</form>
		</div>
		<div class="col-md-6">
		</br>
			<form class="form-horizontal" data-type="h" role="form" method="get" data-id="0">
				<fieldset>
					<legend>Kick All Players</legend>
					<a href="{{ url('kickall') }}" class="btn btn-danger btn-sm btn-block"><i class="fa fa-ban"></i> Kick All Online Players</a>
				</fieldset>
			</form>
		</div>
		<div class="col-md-6">
		</br>
			<form class="form-horizontal" data-type="h" role="form" method="get" data-id="0">
				<fieldset>
					<legend>Server Restart</legend>
					<a href="{{ url('restart') }}" class="btn btn-danger btn-sm btn-block"><i class="fa fa-external-link"></i> Restart Server</a>
				</fieldset>
			</form>
		</div>
		<div class="col-md-6">
		</br>
			<form name="soo" action="{{ url('soo') }}" method="get">
			   <legend>Send Players Message (/o)</legend>
			   <textarea name="compr" rows="1" placeholder="Enter Text" class="form-control">{{ old('compr') }}</textarea>
			   <input class="btn btn-custom btn-sm btn-block" type="submit" value="Send" />
			</form>
		</div>
		<div class="col-md-6">
		</br>
			<form name="soog" action="{{ url('soog') }}" method="get">
			   <legend>Send Players Game-Text (/cnn)</legend>
			   <textarea name="compr" rows="1" placeholder="Enter Text (Use: ~w~ / ~r~ / ~y~ ...etc for colors)" class="form-control">{{ old('compr') }}</textarea>
			   <input class="btn btn-custom btn-sm btn-block" type="submit" value="Send" />
			</form>
		</div>
		<div class="col-md-6">
		</br>
			<form name="soogg" action="{{ url('soogg') }}" method="get">
			   <legend>Server Game-Mode Text</legend>
			   <textarea name="compr" rows="1" placeholder="Enter Text" class="form-control">{{ old('compr') }}</textarea>
			   <input class="btn btn-custom btn-sm btn-block" type="submit" value="Change Game-Mode Text" />
			</form>
		</div>
		<div class="col-md-6">
		</br>
			<form name="soow" action="{{ url('soow') }}" method="get">
			   <legend>Server Weather</legend>
			   <textarea name="compr" rows="1" placeholder="Enter Weather ID (1,2,3 ...etc)" class="form-control">{{ old('compr') }}</textarea>
			   <input class="btn btn-custom btn-sm btn-block" type="submit" value="Change Weather" />
			   Weather ID's: <a href="https://dev.prineside.com/gtasa_weather_id/" target="_blank">All SA-MP Weather IDs</a>
			</form>
		</div>
	</div>
	</div>
	</div>
</br>
@endsection