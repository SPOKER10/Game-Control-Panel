@extends('layouts.master')

@section('breadcrumb','YouTube')

@section('content')

<center><img src="yt.png" width="150" height="100" /></br></br>Pentru a primi beneficiile, trebuie sa detineti un canal cu minim <b>1.000 subscriberi</b> si sa aveti <b>5 videoclipuri</b> create cu tema SA:MP pe serverul nostru ce au minim <b>500 de vizualizari</b> fiecare. In cazul in care ati ajuns la aceste standarde deschideti un ticket pe panel si postati acolo link-ul de la videoclipuri, cand faci ticket-ul selecteaza la TIP "YouTube".</br></br><b>Beneficii:</br>- <font color="#4EE2EC">200 Diamante</font></br>- <font color="orange">Cont p﻿remium valabil 90  zile</font></br>- <font color="#00C27E">Clan cu 50 sloturi valabil 60  zile</font>
</br>- Alte beneficii in viitor...</b>
</br></br><div class="row"><a class="btn btn-success" href="{{ URL::to('tickets/create') }}">Create Ticket</a></div>
</center>
@endsection