@extends('layouts.master')

@section('breadcrumb','OZN Quest')

@section('content')
<style>.objectq {animation: MoveUpDownq 1s linear infinite;position: relative;}@keyframes MoveUpDownq {0%, 100% {bottom: 0;}50% {bottom: 10px;}}</style>
<center><img class="objectq" src="https://rpg.linkmania.ro/ozn.png" style="height:200px;"/></br><img src="https://rpg.linkmania.ro/cow.png" style="height:80px;"/>
</br></br><div class="alert alert-success" style="margin-bottom:0;font-size:13px;">
 - O noua invazie a extraterestrilor a luat cu asalt orasele din San Andreas...
</br> - Vacile satenilor au fost rapite de OZN-urile acestora, mergi si distruge OZN-urile care pazesc animalele fermierilor.
</br> - Dupa ce vei distruge OZN-ul va trebui sa transporti animalul recuperat cu masina inapoi in ferma locatarilor pagubiti.
</br> - Locatia quest-ului se gaseste in meniul GPS. (/gps)
</br> - Pentru mai multe detalii se foloseste in joc la locatia respectiva comanda "/infoquest".
</br> <b>- Premiul este oferit random jucatorilor, insa te asiguram ca este unul generos.</b>
</br> - Acest quest se reseteaza in fiecare Duminica la 00:00.
<hr>Quest completat (in aceasta saptamana) de: <b>{{ \Cache::get('coQUCount') }}</b> jucatori!</div>
</center>
@endsection