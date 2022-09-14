@extends('layouts.master')

@section('breadcrumb','Ticket / Create')

@section('content')

<div class="row">
	@if (count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {!! $error !!}<br>
            @endforeach
        </div>
    @endif

		<form method="POST" action="">
	        <div class="form-group">
		    	<label class="control-label">Tip <i class="fa fa-spinner fa-spin fa-fw _lt" style="display:none;"></i></label>
	            <div>
	            	<select class="form-control _type" name="_type">
		            	@foreach(\App\Ticket::$types as $k=>$t)
							<option style="color: #000" value="{{ $k }}">{{ $t }}</option>
						@endforeach
					</select>
	            </div>
	        </div>    
		    <div class="form-group">
		    	<label class="control-label">Descriere</label>
	            <div><textarea name="description" rows="5" placeholder="Descriere" class="form-control">{{ old('description') }}</textarea></div>
	        </div>
		    <div class="form-group">
		        <input type="submit" class="btn btn-success"></input>
		        {!! csrf_field() !!}
		    </div>
		</form>
</div>
@endsection