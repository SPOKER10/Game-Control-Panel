<!DOCTYPE html>
<html>
<head>@if(Auth::check() && Auth::user()->BanP == 1)@if(Auth::user()->BanPDays != 0 && Auth::user()->BanPDays< time()) <?php Auth::user()->BanP = 0; Auth::user()->save(); Auth::user()->push(); ?> @endif<link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"><link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet"><body class="bg-img-login"><div class="middle-box text-center animated fadeInDown"><center><b><img src="{{ URL::to('/') }}/assets/a/{{ Auth::user()->Skin }}.png" class="img-circle" style="height:100px;"> </br><font size="4">{{ Auth::user()->user }}</br></br>Your account was banned on panel by {{ Auth::user()->BanPBy }}.</br>Reason: {{ Auth::user()->BanRS }}</br>Date: {{ Auth::user()->BanPDate }}</br>Ban expire: {{ Auth::user()->BanDP == "0" ? 'Permanent' : Auth::user()->BanDP }}</font></b></center></body></div><?php return 1; ?>@endif<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0"><title>LinkMania Panel - @yield('breadcrumb')</title><meta name="csrf-token" content="{{ csrf_token() }}" /><link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"><link href="{{ URL::asset('assets/css/font-awesome.min.css') }}" rel="stylesheet"><link href="{{ URL::asset('assets/css/animate.css') }}" rel="stylesheet"><link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet"> @yield('css')<script>var _PAGE_URL = "{{ URL::to('/') }}/";</script></head>
<body class="skin-def">
    <div id="tek" class={{ Auth::check() ? Auth::user()->T : "page-cover16" }}>
        <div id="wrapper">
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header" style="background: linear-gradient(to right, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);"><div class="logo-element">LinkMania</div></li>
                        <li class="sidebar-search" style="padding: 10px"><form action="{{ url('search') }}" method="post"><div class="input-group custom-search-form"><input type="text" class="form-control" name="search" placeholder="Search..." style="font-size: 12px;border-top-left-radius: 6px; border-bottom-left-radius: 6px;"><span class="input-group-btn"><button class="btn btn-primary" type="submit" value="submit" style="border-top-right-radius: 6px; border-bottom-right-radius: 6px;"><i class="fa fa-search"></i></button>{{ csrf_field() }}</span></div></form></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_"><a href="{{ URL::to('/') }}"><i class="fa fa-tachometer"></i><span class="nav-label">Home</span></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_online"><a href="{{ URL::to('online') }}"><i class="fa fa-users"></i><span>Online</span><span class="badge badge-neutral pull-right">{{ \Cache::get('onlineCount') }}/1000</span></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_staff"><a href="{{ URL::to('staff') }}"><i class="fa fa-legal"></i><span>Staff</span><span class="badge badge-neutral pull-right">{{ \Cache::get('staffCount') }}</span></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_factions"><a href="{{ URL::to('factions') }}"><i class="fa fa-user-plus"></i><span>Factions</span><span class="badge badge-neutral pull-right">19</span></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_clans"><a href="{{ URL::to('clans') }}"><i class="fa fa-user-plus"></i><span>Clans</span><span class="badge badge-neutral pull-right">{{ \Cache::get('clanCount') }}</span></a></li> @if(Auth::check()) @if(Auth::user()->Rank == 10)
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_leader"><a href="{{ URL::to('leader') }}"><i class="fa fa-tv"></i><span class="nav-label"> Leader Panel</span></a></li>@endif @if(Auth::user()->CRank > 6)
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_cleader"><a href="{{ URL::to('cleader') }}"><i class="fa fa-android"></i><span class="nav-label"> Clan Panel</span></a></li>@endif @if(Auth::user()->Admin > 4)
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_svc"><a href="{{ URL::to('svc') }}"><i class="fa fa-gamepad"></i><span class="nav-label">Server Control</span></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_donation"><a href="{{ URL::to('donation/list') }}"><i class="fa fa-money"></i><span class="nav-label">Donations</span></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_admin"><a href="{{ URL::to('admin') }}"><i class="fa fa-legal"></i><span class="nav-label">Admin</span></a></li>@endif @endif
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_premium"><a href="{{ URL::to('premium') }}" style="color:#d42426;"><i class="fa fa-diamond"></i><span class="nav-label">Premium</span></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);"><a href="{{ URL::to('carquest') }}" style="color:#d42426;"><i class="fa fa-500px"></i><span class="nav-label">Car Repair Quest</span></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_parkauto"><a href="{{ URL::to('dealership') }}"><i class="fa fa-bus"></i><span class="nav-label">Dealership<span class="badge badge-neutral pull-right">117</span></span></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_parkauto"><a href="{{ URL::to('parkauto') }}"><i class="fa fa-car"></i><span class="nav-label">Park Auto<span class="badge badge-neutral pull-right">{{ \Cache::get('vSON') }}</span></span></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_bids"><a href="{{ URL::to('bids') }}"><i class="fa fa-suitcase"></i><span class="nav-label">Bids<span class="badge badge-neutral pull-right">{{ \Cache::get('bSON') }}</span></span></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_cnn"><a href="{{ URL::to('cnn') }}"><i class="fa fa-bullhorn"></i><span class="nav-label">Announces<span class="badge badge-neutral pull-right">50</span></span></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_cnn"><a href="{{ URL::to('livemap') }}"><i class="fa fa-map-pin"></i><span class="nav-label">Live MAP<span class="badge badge-neutral pull-right">{{ \Cache::get('onlineCount') }}</span></span></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_general"><a href="#"><i class="fa fa-align-left"></i> <span class="nav-label">General</span> <span class="fa arrow"></span></a><ul class="nav nav-second-level collapse"><li><a href="{{ URL::to('general/top') }}">Top Players<span class="badge badge-neutral pull-right">50</span></a></li><li><a href="{{ URL::to('general/topw') }}">Top Week Players<span class="badge badge-neutral pull-right">50</span></a></li><li><a href="{{ URL::to('general/toprc') }}">Top Richest Players<span class="badge badge-neutral pull-right">50</span></a></li><li><a href="{{ URL::to('general/topp') }}">Top Pool Players<span class="badge badge-neutral pull-right">50</span></a></li><li><a href="{{ URL::to('general/tvip') }}" style="color:#F0375F;">V.I.P Players<span class="badge badge-neutral pull-right">{{ \Cache::get('vipCount') }}</span></a></li><li><a href="{{ URL::to('general/stunt') }}">Top Stunts<span class="badge badge-neutral pull-right">50</span></a></li><li><a href="{{ URL::to('general/pet') }}">Top Pets<span class="badge badge-neutral pull-right">50</span></a></li><li><a href="{{ URL::to('general/paintball') }}">PaintBall Ranks<span class="badge badge-neutral pull-right">50</span></a></li>
                        <li><a href="{{ URL::to('general/war') }}">War Ranks<span class="badge badge-neutral pull-right">50</span></a></li><li><a href="{{ URL::to('general/billboards') }}">Billboards<span class="badge badge-neutral pull-right">24</span></a></li><li><a href="{{ URL::to('general/houses') }}">Houses<span class="badge badge-neutral pull-right">150</span></a></li><li><a href="{{ URL::to('general/businesses') }}">Businesses<span class="badge badge-neutral pull-right">83</span></a></li><li><a href="{{ URL::to('general/cars') }}">Cars<span class="badge badge-neutral pull-right">{{ \Cache::get('vCount') }}</span></a></a></li><li><a href="{{ URL::to('general/wars') }}">Wars<span class="badge badge-neutral pull-right">{{ \Cache::get('wCount') }}</span></a></li><li><a href="{{ URL::to('general/turfs') }}">Turfs<span class="badge badge-neutral pull-right">55</span></a></li><li><a href="{{ URL::to('general/walls') }}">Clan Walls<span class="badge badge-neutral pull-right">30</span></a></li>
                        <li><a href="{{ URL::to('graffiti') }}">Graffiti Walls<span class="badge badge-neutral pull-right">12</span></a></li><li><a href="{{action('GeneralController@sUpdates')}}">Server Updates<span class="badge badge-neutral pull-right">{{ \Cache::get('upCount') }}</span></a></li><li><a href="{{ URL::to('general/faq') }}">F.A.Q</a></li></ul></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_applications"><a href="#"><i class="fa fa-briefcase"></i> <span class="nav-label">Aplicatii</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li><a href="{{ URL::to('factions') }}">Lider @if(\Cache::get('slo') == '[{"option_value":"0"}]')<span class="badge badge-neutral pull-right">OFF</span>@else<span class="badge badge-success pull-right">ON</span>@endif</a></li>
                                <li><a href="{{ URL::to('factions') }}">Factiune <span class="badge badge-success pull-right">{{ \Cache::get('pqiw') }}/19</span></a></li>
                                <li><a href="{{ URL::to('clans') }}">Clan <span class="badge badge-success pull-right">ON</span></a></li>
                                <li><a href="{{ URL::to('applications/helper/list') }}">Helper @if(\Cache::get('spo') == '[{"option_value":"0"}]')<span class="badge badge-neutral pull-right">OFF</span>@else<span class="badge badge-success pull-right">ON</span>@endif</a></li>
                            </ul>
                        </li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_complaints"><a href="{{ URL::to('complaints/list') }}"><i class="fa fa-th-large"></i><span class="nav-label">Reclamatii<span class="badge badge-neutral pull-right">{{ \Cache::get('rCount') }}</span></span></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_banlist"><a href="{{ URL::to('banlist') }}"><i class="fa fa-ban"></i><span class="nav-label">Banlist</span><span class="badge badge-neutral pull-right">{{ \Cache::get('bList') }}</span></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_unban"><a href="{{ URL::to('unban') }}"><i class="fa fa-eraser"></i><span class="nav-label">Unban<span class="badge badge-neutral pull-right">{{ \Cache::get('uCount') }}</span></span></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_tickets"><a href="{{ URL::to('tickets/list') }}"><i class="fa fa-comments"></i><span class="nav-label">Tickets <span class="badge badge-neutral pull-right"> {{ \Cache::get('tCount') }}</span></span></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);" class="_mps"><a href="{{ URL::to('mps') }}"><i class="fa fa-globe"></i>Map <span class="badge badge-neutral pull-right">324 Locations</span></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);"><a href="https://www.linkmania.ro/forum/1765-evenimente-gta/" target="_blank"><i class="fa fa-calendar"></i><span class="nav-label">Events <span class="badge badge-neutral pull-right">2+</span></span></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);"><a href="{{ URL::to('youtube') }}"><i class="fa fa-youtube"></i><span class="nav-label">YouTube</span></a></li>
                        <li style="    background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);"><a href="{{ URL::to('discord') }}"><i class="fa fa-microphone"></i><span class="nav-label">Discord</span></a></li>
                    </ul>
                </div>
            </nav>
            <div id="page-wrapper" class="img-bg">
                <div class="row">
                    <nav class="navbar navbar-static-top  " role="navigation" style="background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.44) 100%);margin-bottom: 0; min-height:52px">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-menu " style="color:white;" href="#"><i class="fa fa-bars"></i></a>
                            <a class="minimalize-styl-2 btn btn-menu " style="color:white;" href="{{ URL::to('changeimg') }}"><i class="fa fa-css3"></i></a>
                        </div>
                        <ul class="nav navbar-top-links navbar-right" style="height: 51px; margin-top: -4px; margin-bottom: 4.4px;">@if(Auth::check())<li class="dropdown notifications" style="color: #000; border-bottom: 0px"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#"><i class="fa fa-bell"></i></a></li>{{Auth::user()->Diamonds}} <i class="fa fa-diamond"></i> / {{ General::format(Auth::user()->Money+Auth::user()->BankMoney) }} <i class="fa fa-dollar"></i> <li style="border-bottom: 0px"><a style="padding:10px 10px 10px 0;" href="{{ url('user/profile',[Auth::user()->user]) }}"><img src="{{ URL::to('/') }}/assets/a/{{ Auth::user()->Skin }}.png" class="img-circle" style="height:36px;"> {{ Auth::user()->user }}</a></li><li class="lgd" style="border-bottom: 0px"><a href="{{ URL::to('user/logout') }}"><i class="fa fa-sign-out"></i><span>Logout</span></a></li>@else<li class="lg" style="border-bottom: 0px; margin-bottom: 1px;"><a href="{{ URL::to('user/login') }}"><i class="fa fa-sign-in"></i><span>Login</span></a></li>@endif</ul></nav></div><div class="row wrapper page-heading"><div class="col-sm-12"><h2 style="font-weight: 400;">@yield('breadcrumb')</h2></div></div><div class="wrapper wrapper-content">@yield('content')</div><div class="footer"><small style="float: right;">Copyright © 2020 LinkMania.Ro</small></div></div></div>
    </div><style>.lg i {transition: 0.5s all;}.lg span {transition: 0.5s all;}.lg:hover i {color: #00BA19;}.lg:hover span {color: #00BA19;}.lgd i {transition: 0.5s all;}.lgd span {transition: 0.5s all;}.lgd:hover i {color: #C90000;}.lgd:hover span {color: #C90000;}</style><script src="{{ URL::asset('assets/jquery.min.js') }}"></script><script src="{{ URL::asset('assets/bootstrap.min.js') }}"></script><script src="{{ URL::asset('assets/menu.min.js') }}"></script><script src="{{ URL::asset('assets/ss.min.js') }}"></script><script src="{{ URL::asset('assets/ll.min.js') }}"></script><script src="{{ URL::asset('assets/app.min.js') }}"></script><script src="{{ URL::asset('assets/pace.min.js') }}"></script>@yield('js')@if (Session::has('message'))@include('partials.notif',['type' => Session::get('type'),'message' => Session::get('message'),'title' => Session::get('title')])@endif</body>
</html>