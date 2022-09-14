@extends('layouts.master')

@section('breadcrumb','Unban / Create')

@section('content')

	@if (count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    @if($ban && $ban->BanDays != -1)
    	<a href="{{ url('buyUnban') }}" class="btn btn-danger btn-sm btn-block"><i class="fa fa-child" style="font-size:30px;"></i></br><b>CUMPARA UNBAN!</br>COST: {{ $ban->BanDays*30 }} Diamonds</b></br><small>(1 Zi * 30 Diamonds - Tu ai fost banat pentru {{ $ban->BanDays }} zile)</small></a>
    	<hr>
    @endif
	<div>
		<form method="POST" action="">
		    <div class="form-group">
		    	<label class="control-label">Nume</label>
	            <div><input type="text" name="name" value="{{ Auth::user()->name }}" disabled class="form-control"></div>
	        </div>
			
			
	        <div class="form-group">
		    	<label class="control-label">Motiv</label>
	            <div><input type="text" name="_reason" value="{{old('_reason')}}" class="form-control"></div>
	        </div>
			
			<div class="form-group">
		    	<label class="control-label">Poza</label>
	            <div><input type="text" name="_img" value="{{old('_img')}}" class="form-control"></div>
	        </div>
			
			<div class="form-group">
		    	<label class="control-label">Alte precizari</label>
	            <div><textarea name="_p" rows="4" value="{{old('_p')}}" class="form-control"></textarea></div>
	        </div>

		    <div class="form-group">
		        <input type="submit" class="btn btn-success"></input>
		        {!! csrf_field() !!}
		    </div>
		</form>
	</div>

@endsection