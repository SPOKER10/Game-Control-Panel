@extends('layouts.master')

@section('breadcrumb','Reset password')

@section('content')

	@if (count($errors) > 0)
        <div class="alert alert-info">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

	<div class="col-sm-4 col-sm-offset-4">
		<form method="POST" action="">
		    <div class="form-group">
		    	<label class="control-label">Email</label>
	            <div><input type="text" name="email" placeholder="Email" class="form-control"></div>
	        </div>
	        <div class="form-group">
		    	<label class="control-label">Password</label>
	            <div><input type="password" name="password" placeholder="Password" class="form-control"></div>
	        </div> 
	        <div class="form-group">
		    	<label class="control-label">Confirm password</label>
	            <div><input type="password" name="password_confirmation" placeholder="Confirm password" class="form-control"></div>
	        </div>

		    <div class="form-group">
		        <input type="submit" class="btn btn-success"></input>
		        <input type="hidden" name="token" value="{{ $token }}"></input>
		        {!! csrf_field() !!}
		    </div>
		</form>
	</div>

@endsection