@extends('layouts.master')

@section('breadcrumb','Applications / Create')

@section('content')

	@if($errors->count() != 0)<div class="alert alert-danger"><ul>@foreach($errors->all() as $error)<li>{!! $error !!}</li>@endforeach</ul></div>@endif

	<form class="form-horizontal" role="form" method="post" name="app_create" id="app_create">
		<fieldset>
			<legend>Create application</legend>
			@foreach($questions as $i=>$q)
				<div class="form-group"><label class="col-md-3 control-label">{{ $q }}</label>
					<div class="col-md-9"><textarea class="form-control" placeholder="{{ $q }}" rows="5" name="a{{$i}}">{{ old('a'.$i) }}</textarea></div>
				</div>
			@endforeach
		<div class="form-group">
			<input type="submit" style="float:right;" class="btn btn-primary" name="app_submit"/>
			{{ csrf_field() }}
		</div>
		</fieldset>
	</form>	
@endsection