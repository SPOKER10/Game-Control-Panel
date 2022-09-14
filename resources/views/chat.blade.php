@extends('layouts.master')

@section('breadcrumb','Chat')

@section('content')
<div class="row">
	<div class="col-sm-6">
		<div class="chat"></div>
	</div>
	<div class="col-sm-6">
		
		<form class="form-horizontal" method="POST" style="margin: 0 15px 20px 60px;" action="" id="chat_add">
			
			<textarea class="form-control" placeholder="Chat" name="text" id="text" rows="3"></textarea><br>
			<input type="submit" name="chat_submit" class="btn btn-sm btn-danger" value="Submit">
			
		</form>

	</div>
</div>	
@section('js')
<script>var defaults = { user: '{{ Auth::user()->name }}', skin: {{ Auth::user()->skin }} };</script>
<script src="{{ URL::asset('assets/ch.min.js') }}"></script>
@endsection
@endsection