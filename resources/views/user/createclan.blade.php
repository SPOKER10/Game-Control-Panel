@extends('layouts.master')

@section('breadcrumb','Create clan')

@section('content')

@if(count($messages) > 0)
    <div class="alert alert-info"><ul>
        @foreach($messages as $message)
            <li>{!! $message !!}</li>
        @endforeach
    </ul></div>
@endif

<div class="col-sm-4 col-sm-offset-4">	
	<form class="form-horizontal" role="form" method="post" action="">
		<div class="form-group">
			<label class="control-label">Clan name</label>
			<input class="form-control" name="clan_name" placeholder="Clan name" type="text" autocomplete="off">

		</div>
		<div class="form-group">
			<label class="control-label">Tag</label>
			<input class="form-control" name="clan_tag" placeholder="Tag" type="text" autocomplete="off">

		</div>
		<div class="form-group">
			{{ csrf_field() }}
			<button type="submit" class="btn btn-success" name="submit">Create</button>
		</div>
	</form>
</div>
@endsection