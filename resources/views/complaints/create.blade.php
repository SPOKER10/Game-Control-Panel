@extends('layouts.master')

@section('breadcrumb','Complaints / Create')

@section('content')

@section('css')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
@endsection
@section('js')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
	<script src="{{ URL::asset('assets/complaint.js') }}"></script>
@endsection

<div class="row">
	@if (count($errors) > 0)<div class="alert alert-danger">@foreach ($errors->all() as $error){!! $error !!}<br>@endforeach</div>@endif
		<form method="POST" action="">
			<div class="form-group">
		    	<label class="control-label">Username</label>
	            <div>
	            	@if(isset($user))
	            		<input type="text" class="form-control" placeholder="{{ $user->name }}" disabled="disabled" />
	            		<input type="hidden" name="_selected" value="{{ $user->ID }}" />
	            	@else
				        <select class="_cs" name="_selected" style="width:100%"><option style="color: #000"></option></select>	
	            	@endif
	            </div>
	        </div>
	        <div class="form-group">
		    	<label class="control-label">Tip <i class="fa fa-spinner fa-spin fa-fw _lt" style="display:none;"></i></label>
	            <div>
	            	<select class="form-control _type" name="_type">
	            		@if(isset($user))
		            		{!! \App\Complaint::getTypes($user) !!}
		            	@else
				       		<option style="color: #000" value="-1">Niciunul</option>
						@endif
						
					</select>
	            </div>
	        </div>  
	        <div class="form-group">
		    	<label class="control-label">Motiv <i class="fa fa-spinner fa-spin fa-fw _lr" style="display:none;"></i></label>
	            <div>
	            	<select class="form-control _reason" name="_reason">
						<option style="color: #000" value="-1">Niciunul</option>
					</select>
	            </div>
	        </div>    
		    <div class="form-group">
		    	<label class="control-label">Descriere</label>
	            <div><textarea name="description" rows="5" placeholder="Descriere" class="form-control">{{ old('description') }}</textarea></div>
	        </div>
	        <div class="form-group">
		    	<label class="control-label">Dovezi</label>
	            <div><input type="text" name="link" placeholder="Imagine/Video" class="form-control" value="{{ old('link') }}"></div>
	        </div>
		    <div class="form-group"><input type="submit" class="btn btn-success"></input>{!! csrf_field() !!}</div>
		</form>
</div>
@endsection