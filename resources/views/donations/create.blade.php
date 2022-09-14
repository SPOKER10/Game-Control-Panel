@extends('layouts.master')

@section('breadcrumb','Donation / Create')

@section('content')

<div class="row">
	@if (count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {!! $error !!}<br>
            @endforeach
        </div>
    @endif

	<div class="col-sm-8 col-sm-offset-2">
		<form method="POST" action="">
	        <div class="form-group">
		    	<label class="control-label">Suma </label>
	            <div>
	            	<select class="form-control _sum" name="_sum">
		            	@foreach(\App\Donation::$sums as $k=>$t)
							<option style="color: #000" value="{{ $k }}">{{ $t }}</option>
						@endforeach
					</select>
	            </div>
	        </div>    
		    <div class="form-group">
		    	<label class="control-label">PIN</label>
	            <div><input name="_pin" placeholder="0000-0000-0000-0000" class="form-control">{{ old('_pin') }}</textarea></div>
	        </div>
		    <div class="form-group">
		        <input type="submit" class="btn btn-success"></input>
		        {!! csrf_field() !!}
		    </div>
		</form>
	</div>
</div>
@endsection