@extends('layouts.master')
@section('breadcrumb','Live MAP (Players)')
@section('content')
<div id="map-canvas"></div>
@endsection

@section('css')
<style type="text/css">
#map-canvas {
	position: absolute !important; 
	height: 70% !important;
	width: 96% !important;
}
</style>
@endsection


@section('js')
<script src="{{ asset('assets/map/map.min.js') }}"></script><script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUljnGqAXvgxKsz8CqogPd3wSpfZ6KDos"></script><script>initMap({!! $players !!});</script>
@endsection