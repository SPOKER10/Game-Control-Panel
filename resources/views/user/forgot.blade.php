@extends('layouts.master')

@section('breadcrumb','Forgot password')

@section('content')

	@if (count($errors) > 0)
        <div class="alert alert-info">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

	<center><div class="alert alert-danger" style="margin-bottom:0;font-size:13px;"><b>ATENTIE!!!</b>
	</br>In cazul in care ai pierdut parola contului fa-ti un nou cont pe server si deschide un ticket pe panel.
	</br>In cel mai scurt un administrator te va ajuta in recuperarea contului.
	</br>Acest lucru este posibil <b>NUMAI</b> daca ai acces la mail-ul contului pierdut.</div></center>

@endsection