@extends('layouts.master')@section('breadcrumb','Home')@section('content')
<div class="row">
    <?php $is = \Cache::remember('indexStats',5,function() { return [['name' => 'Online Players', 'link' => 'online', 'data' => \Cache::get('onlineCount').'/1000','icon' => 'users','bg' => 'red'], ['name' => 'Registered', 'link' => 'search', 'data' => \Cache::get('rList'),'icon' => 'tachometer','bg' => 'yellow'], ['name' => 'Businesses', 'link' => 'general/businesses', 'data' => '83','icon' => 'building','bg' => 'lazur'], ['name' => 'Houses', 'link' => 'general/houses', 'data' => '150','icon' => 'home','bg' => 'navy'],['name' => 'Vehicles', 'link' => 'general/cars', 'data' => \Cache::get('vCount'),'icon' => 'car','bg' => 'blue'], ['name' => 'Clans', 'link' => 'clans', 'data' => \Cache::get('clanCount'),'icon' => 'sitemap','bg' => 'yel'], ['name' => 'Top Connected', 'link' => '#', 'data' => '327','icon' => 'user-plus','bg' => 'purple'], ['name' => 'Today Special Job', 'link' => 'todayjob', 'data' => \Cache::get('jco'),'icon' => 'tags','bg' => 'dds'],];}); ?> @foreach($is as $si)
        <div class="crs col-md-3">
            <div class="widget widget-stats {{ $si['bg'] }}-bg" style="margin-bottom: 10px">
                <div class="stats-icon">
                    <id class="fa fa-{{ $si['icon'] }}"></id>
                </div>
                <div class="stats-info">
                    <h4>{{ $si['name'] }}</h4>
                    <p>{{ $si['data'] }}</p>
                </div>
                <div class="stats-link"><a href="{{ $si['link'] }}"><small>View Detail <i class="fa fa-arrow-circle-right"></i></small></a></div>
            </div>
        </div> @endforeach</div>
<div class="row"><canvas id="infPlayersChart" width="45" height="9"></canvas></div>
<div class="row">
<center>
    <div class="alert alert-success" style="background: linear-gradient(to left, rgba(196, 48, 43, 0.05) 0%, rgba(196, 48, 43, 0.24) 100%);font-size:13px;color:white;">
    <img src="yt.png" width="80" height="50" /></br><b>ABONEAZA-TE SI TU LA YOUTUBERII ACESTEI COMUNITATI!</b><hr>
    Cheloo. (Helper): <a class="badge" href="https://www.youtube.com/channel/UCXdnhRHNyIfxrZDBFWi2XmA/videos" target="_blank"><i class="fa fa-heart"></i> Cheloo. CHANNEL</a>
    </br>
    PePe (Leader): <a class="badge" href="https://www.youtube.com/channel/UCsmxaaeK4hlquXerXwX1zlA?view_as=subscriber" target="_blank"><i class="fa fa-heart"></i> PePe CHANNEL</a>
    </br>
    OverBACK (Helper): <a class="badge" href="https://www.youtube.com/channel/UCgjTUVCCI9ZOsaRQG-YmrHw?view_as=subscriber" target="_blank"><i class="fa fa-heart"></i> OverBACK CHANNEL</a>
    </div>
</center>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="panel panel-success updates">
            <div class="panel-heading clearfix">
                <h2 class="pull-left panel-title"><i class="fa fa-briefcase"></i> Backpack Of The Week</h2></div>
            <div class="panel-body updatesb">
                <center>
                    <img class="zoom" src="be.png" width="100" height="100" />
                </center>
                </br>Cauta rucsacul din aceasta saptamana pentru a castiga premiul ce se afla in el.</br>Rucsacul se reseteaza in fiecare duminica la ora <b>23:59</b>.</br>Oras: <b>{{ \Cache::get('glr') }}</b></br>Greutate: <b>{{ \Cache::get('wowwk') }} kg</b></br>Gasit de: <b>{{ \Cache::get('woww') }} jucatori</b></br>Zona rucsacului: <b><a href="https://rpg.linkmania.ro/backpack.php/" target="_blank">Click!</a></b></br>Gasit prima data de: <b><a href="user/profile/{{ \Cache::get('gpr') }}"><img src="{{ URL::to('/') }}/assets/a/{{ \Cache::get('dasd') }}.png" class="img-circle" style="height:22px;"> {{ \Cache::get('gpr') }}</a></b>
                <br><small class="text-muted green" style="font-size: 10px;"><i class="fa fa-clock-o"></i> {{ \Cache::get('gpddr') }}</small></br>
                </br>Gasit ultima data de: <b><a href="user/profile/{{ \Cache::get('gur') }}"><img src="{{ URL::to('/') }}/assets/a/{{ \Cache::get('dusd') }}.png" class="img-circle" style="height:22px;"> {{ \Cache::get('gur') }}</a></b>
                <br><small class="text-muted green" style="font-size: 10px;"><i class="fa fa-clock-o"></i> {{ \Cache::get('guddr') }}</small></div>
        </div>
        <div class="panel panel-success updates">
            <div class="panel-heading clearfix">
                <h2 class="pull-left panel-title"><i class="fa fa-users"></i> Top 3 Players On Week</h2></div>
            <div class="panel-body updatesb">
                <div class="feed-element"><img src="{{ URL::to('/') }}/assets/a/{{ \Cache::get('hwke1s') }}.png" class="pull-left img-circle mt" data-toggle="tooltip" data-placement="top" data-html="true" title="<img src='{{ URL::to('/') }}/assets/s/Skin_{{ \Cache::get('hwke1s') }}.png' style='height:84px;vertical-align:middle;' /><div style='float:right;'><font style='color:orange;'>{{ \Cache::get('hwke1') }}</font></br>Week Hours: {{ number_format(\Cache::get('hwke1h')/3600) }}</br><img src='1st.png' width='45' height='40' /></div>" style="height:38px;">
                    <div class="media-body ">
                        <h4><a href="user/profile/{{ \Cache::get('hwke1') }}">{{ \Cache::get('hwke1') }}</a></h4><small class="text-muted green" style="font-size:11px"><i class="fa fa-gamepad"></i> Hours Played On Week: {{ number_format(\Cache::get('hwke1h')/3600) }}</small>
                        <br><small class="text-muted green" style="font-size:11px"><i class="fa fa-arrow-up"></i> Level: {{ \Cache::get('hwke1l') }}</small><span class="pull-right"><img class="zoom" src="1st.png" width="45" height="40" /></span>
                        <br><small class="text-muted green" style="font-size:11px"><i class="fa fa-asterisk"></i> Respect-Points: {{ \Cache::get('hwke1r') }}/{{ \Cache::get('hwke1re') }}</small></div>
                    <hr><img src="{{ URL::to('/') }}/assets/a/{{ \Cache::get('hwke2s') }}.png" class="pull-left img-circle mt" data-toggle="tooltip" data-placement="top" data-html="true" title="<img src='{{ URL::to('/') }}/assets/s/Skin_{{ \Cache::get('hwke2s') }}.png' style='height:84px;vertical-align:middle;' /><div style='float:right;'><font style='color:orange;'>{{ \Cache::get('hwke2') }}</font></br>Week Hours: {{ number_format(\Cache::get('hwke2h')/3600) }}</br><img src='2nd.png' width='45' height='40' /></div>" style="height:38px;">
                    <div class="media-body ">
                        <h4><a href="user/profile/{{ \Cache::get('hwke2') }}">{{ \Cache::get('hwke2') }}</a></h4><small class="text-muted green" style="font-size:11px"><i class="fa fa-gamepad"></i> Hours Played On Week: {{ number_format(\Cache::get('hwke2h')/3600) }}</small>
                        <br><small class="text-muted green" style="font-size:11px"><i class="fa fa-arrow-up"></i> Level: {{ \Cache::get('hwke2l') }}</small><span class="pull-right"><img class="zoom" src="2nd.png" width="45" height="40" /></span>
                        <br><small class="text-muted green" style="font-size:11px"><i class="fa fa-asterisk"></i> Respect-Points: {{ \Cache::get('hwke2r') }}/{{ \Cache::get('hwke2re') }}</small></div>
                    <hr><img src="{{ URL::to('/') }}/assets/a/{{ \Cache::get('hwke3s') }}.png" class="pull-left img-circle mt" data-toggle="tooltip" data-placement="top" data-html="true" title="<img src='{{ URL::to('/') }}/assets/s/Skin_{{ \Cache::get('hwke3s') }}.png' style='height:84px;vertical-align:middle;' /><div style='float:right;'><font style='color:orange;'>{{ \Cache::get('hwke3') }}</font></br>Week Hours: {{ number_format(\Cache::get('hwke3h')/3600) }}</br><img src='3rd.png' width='45' height='40' /></div>" style="height:38px;">
                    <div class="media-body ">
                        <h4><a href="user/profile/{{ \Cache::get('hwke3') }}">{{ \Cache::get('hwke3') }}</a></h4><small class="text-muted green" style="font-size:11px"><i class="fa fa-gamepad"></i> Hours Played On Week: {{ number_format(\Cache::get('hwke3h')/3600) }}</small>
                        <br><small class="text-muted green" style="font-size:11px"><i class="fa fa-arrow-up"></i> Level: {{ \Cache::get('hwke3l') }}</small><span class="pull-right"><img class="zoom" src="3rd.png" width="45" height="40" /></span>
                        <br><small class="text-muted green" style="font-size:11px"><i class="fa fa-asterisk"></i> Respect-Points: {{ \Cache::get('hwke3r') }}/{{ \Cache::get('hwke3re') }}</small></div>
                </div>
            </div>
        </div>
        <div class="panel panel-success updates">
            <div class="panel-heading clearfix">
                <h2 class="pull-left panel-title"><i class="fa fa-comment"></i> Media</h2></div>
            <div class="panel-body updatesb">
                <center>
                    <div class="container r"><a href="https://www.facebook.com/linkmaniasamp/" target="_blank"><i class="fa fa-facebook" style="font-size:40px;" aria-hidden="true"></i><span><b>FaceBook Page</b></span></a></div>
                    <div class="container"><a href="https://www.youtube.com/channel/UCeNcUq5qKcje39Q4pkhiHPQ/videos" target="_blank"><i class="fa fa-youtube" style="font-size:40px;" aria-hidden="true"></i><span><b>YouTube Channel</b></span></a></div>
                    <div class="container f"><a href="https://www.linkmania.ro/forum/1732-gtasa-sa-mp/" target="_blank"><i class="fa fa-forumbee" style="font-size:40px;" aria-hidden="true"></i><span><b>Forum</br>(SA-MP Section)</b></span></a></div>
                </center>
            </div>
        </div>
        <div class="panel panel-success updates">
            <div class="panel-heading clearfix">
                <h2 class="pull-left panel-title"><i class="fa fa-bullhorn"></i> Staff Logs</h2></div>
            <div class="panel-body updatesb">
                <?php $slo = \Cache::remember('slog',1,function() { return \DB::table('stafflogs')->orderBy('Date', 'desc')->LIMIT('20')->get(); }); ?>
                @foreach($slo as $o)
                <div class="media-body"><?=str_replace('AdmCmd:', '<b>*</b>', $o->Text)?><br><small class="text-muted green"><i class="fa fa-clock-o"></i> {{ $o->Date }}</small></div></br>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="panel panel-success feed feed-activity-list">
            <div class="panel-heading clearfix">
                <h2 class="pull-left panel-title"><i class="fa fa-ban"></i> Recent Bans</h2>
                <span class="pull-right"><button type="button" class="btn btn-danger btn-xs refresh" style="font-size:9px;"><i class="fa fa-refresh"></i></button></span>
            </div>
            <div class="panel-body clearfix feed-data"></div>
        </div>
        <div class="panel panel-success updates">
            <div class="panel-heading clearfix">
                <h2 class="pull-left panel-title"><i class="fa fa-gamepad"></i> Server Updates (<font style="color:orange;">{{ \Cache::get('uptx')->Version }}</font> / {{ \Cache::get('uptx')->created_at }} / by Spoker)</br><div class="pull-left panel-title"><form class="foodstars" action="{{route('foodStar')}}" id="addStar" method="POST">
{{ csrf_field() }}
@if(Auth::check())
<input class="star star-5" value="5" id="star-5" type="radio" name="star" {{ Auth::user()->RateUP > 0 ? 'disabled' : '' }}/>
<label class="star star-5" onclick="myFunction(5)" style="{{ Auth::user()->RateUP > 4 ? 'color: #FE7;text-shadow: 0 0 20px #952' : '' }};" for="star-5"></label>
<input class="star star-4" value="4" id="star-4" type="radio" name="star" {{ Auth::user()->RateUP > 0 ? 'disabled' : '' }}/>
<label class="star star-4" onclick="myFunction(4)" style="{{ Auth::user()->RateUP > 3 ? 'color: #FE7;text-shadow: 0 0 20px #952' : '' }};" for="star-4"></label>
<input class="star star-3" value="3" id="star-3" type="radio" name="star" {{ Auth::user()->RateUP > 0 ? 'disabled' : '' }}/>
<label class="star star-3" onclick="myFunction(3)" style="{{ Auth::user()->RateUP > 2 ? 'color: #FE7;text-shadow: 0 0 20px #952;' : '' }};" for="star-3"></label>
<input class="star star-2" value="2" id="star-2" type="radio" name="star" {{ Auth::user()->RateUP > 0 ? 'disabled' : '' }}/>
<label class="star star-2" onclick="myFunction(2)" style="{{ Auth::user()->RateUP > 1 ? 'color: #FE7;text-shadow: 0 0 20px #952;' : '' }};" for="star-2"></label>
<input class="star star-1" value="1" id="star-1" type="radio" name="star" {{ Auth::user()->RateUP > 0 ? 'disabled' : '' }}/>
<label class="star star-1" onclick="myFunction(1)" style="{{ Auth::user()->RateUP > 0 ? 'color: #FE7;text-shadow: 0 0 20px #952;' : '' }};" for="star-1"></label>
</form></div>
<div style="font-size:12px;"><b>{{ number_format(\Cache::get('uprate'), 1) }} ({{ \Cache::get('uptotal') }} Votes)</b>@if(Auth::user()->RateUP > 0)<p><b>Ai oferit <font color="{{ (Auth::user()->RateUP < 3 ? '#ff2a00' : '#FD4') }}">{{ Auth::user()->RateUP }}<i class='fa fa-star'></i></font> acestui update!</b></p>@else<p id="demo"></p>@endif</div>
</h2></div>
@else
<input class="star star-5" value="5" id="star-5" type="radio" name="star" disabled/>
<label class="star star-5" onclick="Restrict()" style="{{ number_format(\Cache::get('uprate')) > 4 ? 'color: #FE7;text-shadow: 0 0 20px #952' : '' }};" for="star-5"></label>
<input class="star star-4" value="4" id="star-4" type="radio" name="star" disabled/>
<label class="star star-4" onclick="Restrict()" style="{{ number_format(\Cache::get('uprate')) > 3 ? 'color: #FE7;text-shadow: 0 0 20px #952' : '' }};" for="star-4"></label>
<input class="star star-3" value="3" id="star-3" type="radio" name="star" disabled/>
<label class="star star-3" onclick="Restrict()" style="{{ number_format(\Cache::get('uprate')) > 2 ? 'color: #FE7;text-shadow: 0 0 20px #952;' : '' }};" for="star-3"></label>
<input class="star star-2" value="2" id="star-2" type="radio" name="star" disabled/>
<label class="star star-2" onclick="Restrict()" style="{{ number_format(\Cache::get('uprate')) > 1 ? 'color: #FE7;text-shadow: 0 0 20px #952;' : '' }};" for="star-2"></label>
<input class="star star-1" value="1" id="star-1" type="radio" name="star" disabled/>
<label class="star star-1" onclick="Restrict()" style="{{ number_format(\Cache::get('uprate')) > 0 ? 'color: #FE7;text-shadow: 0 0 20px #952;' : '' }};" for="star-1"></label>
</form></div>
<div style="font-size:12px;"><b>{{ number_format(\Cache::get('uprate'), 1) }} ({{ \Cache::get('uptotal') }} Votes)</b><p id="Restrict"></p></div>
</h2></div>
@endif

<div class="panel-body updatesb">{!! nl2br(e(\Cache::get('uptx')->Text)) !!}
<center><a href="{{action('GeneralController@sUpdates')}}" class="btn btn-danger btn-xs" style="font-size:12px;margin-top:5px;"><i class="fa fa-external-link"></i> all updates ({{ \Cache::get('upCount') }})</a></center></div>
</div></div></div> @endsection @section('css')<style>.zoom {transition: transform .3s; } .zoom:hover {-ms-transform: scale(1.2); /* IE 9 */-webkit-transform: scale(1.2); /* Safari 3-8 */transform: scale(1.2); }.container {display: inline-flex;width: 100px;height: 100px;text-align: center;cursor: pointer;}.container i {width: 100%;position: relative;top: 25%;font-size: 1.5em;transition: 0.5s all;}.container span {opacity: 0;position: relative;top: 25%;transition: 0.5s all;}.container.f:hover i {top: 15%;font-size: 2em;color: orange;}.container.r:hover i {top: 15%;font-size: 2em;color: #3b5998;}.container:hover i {top: 15%;font-size: 2em;color: #c4302b;}.container:hover span {opacity: 1;}.crs id {transition: 0.3s all;}.crs:hover id {font-size: 52px;}input.star {display: none;}label.star {float: right;font-size: 21px;color: #444;transition: all .2s;}input.star:checked ~ label.star:before {content: '\2605';color: #FD4;transition: all .25s;}input.star-5:checked ~ label.star:before {color: #FE7;text-shadow: 0 0 20px #952;}label.star:hover {transform: rotate(-15deg) scale(1.3);}label.star:before {content: '\2605';}</style>@endsection
@section('js')<script>function Restrict() { document.getElementById("Restrict").innerHTML = "<b style='color:red'>Pentru a vota trebuie sa fii logat!</b>"; }function myFunction(nr) {if(document.getElementById('star-1').disabled) return 1;document.getElementById("demo").innerHTML = "<b>Ai oferit <font color=" + (nr < 3 ? '#ff2a00' : '#FD4') + ">" + nr + "<i class='fa fa-star'></i></font> acestui update!</b>";}$(function() {$('.mt').tooltip({template: '<div class="tooltip md-tooltip-main"><div class="tooltip-arrow md-arrow"></div><div class="tooltip-inner md-inner-main"></div></div>'});})</script><script>$('#addStar').change('.star', function(e) {$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),}});$.ajax({type: 'POST',cache: false,dataType: 'JSON',url: $(this).attr('action'),data: $(this).serialize(),success: function(data) {console.log(data);}});$("input").prop('disabled', true);});</script><script src="{{ asset('d.js') }}"></script><?php $cd = ['labels','data']; $cd = \Cache::remember('indexChart',10,function() use ($cd) { $dr = DB::table('inf_record')->orderBy('record_id','desc')->take(29)->get(); $dr = $dr->reverse();foreach($dr as $d) { $c = \Carbon\Carbon::createFromFormat('d-m-Y',$d->record_date); $cd['labels'][] = $c->format('d M'); $cd['data'][] = $d->record_players; } return $cd; }); $cds = ['labels','data']; $cds = \Cache::remember('indexCharts',10,function() use ($cds) { $dr = DB::table('inf_record')->where('record_id','<',DB::table('inf_record')->orderBy('record_id','desc')->first()->record_id-29)->orderBy('record_id','desc')->take(29)->get(); $dr = $dr->reverse();foreach($dr as $d) { $c = \Carbon\Carbon::createFromFormat('d-m-Y',$d->record_date); $cds['labels'][] = $c->format('d M'); $cds['data'][] = $d->record_players; } return $cds; }); ?><script>$(document).ready(function() {var infChart = new Chart($('#infPlayersChart'), {type: 'line',data: {labels: <?php echo json_encode($cd['labels']); ?>,datasets: [{label: 'Players Last 30 Days',data: <?php echo json_encode($cd['data']); ?>,backgroundColor: 'rgba(0,0,0,0)',borderColor: '#5cb373',}, {label: 'Players Last 60 Days',data: <?php echo json_encode($cds['data']); ?>,backgroundColor: 'rgba(0,0,0,0)',borderColor: '#3b5998',}]},options: {scales: {yAxes: [{ticks: {fontColor: "#e0e2e6"}}],xAxes: [{ticks: {fontColor: "#e0e2e6"}}]}}});});</script>@endsection