@extends('layouts.master')

@section('breadcrumb','Resignations / Create')

@section('content')

	@if($errors->count() != 0)<div class="alert alert-danger"><ul>@foreach($errors->all() as $error)<li>{!! $error !!}</li>@endforeach</ul></div>@endif

	<form class="form-horizontal" role="form" method="post" name="app_create" id="app_create">
		<fieldset>
			<legend>Create resignation</legend>
				<div class="form-group"><label class="col-md-3 control-label">Motivul demisiei:</label>
					<div class="col-md-9"><textarea class="form-control" placeholder="Motivul demisiei..." rows="5" name="a1"></textarea></div>
				</div>
				<div class="form-group"><label class="col-md-3 control-label">Alte precizari?</label>
					<div class="col-md-9"><textarea class="form-control" placeholder="Alte precizari..." rows="5" name="a2"></textarea></div>
				</div>
		<div class="form-group">
			<input type="submit" style="float:right;" class="btn btn-primary" name="app_submit"/>
			{{ csrf_field() }}
		</div>
		</fieldset>
	</form>	
@endsection