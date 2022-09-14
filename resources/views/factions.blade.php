@extends('layouts.master') @section('breadcrumb','Factions') @section('content')
<div class="table-responsive">
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/1.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc">
                    <?php $s = \App\Option::where('option_name','factionAppStatus1')->first(); $s = (!$s || $s->option_value ? '<i class="fa fa-unlock" style="color:#00FA00"></i>' : '<i class="fa fa-lock" style="color:#FF1C1C"></i>'); ?>
                        <center><a href="#" class="product-name" style="color:#1269EB">L.S.P.D</a>Type: <b>Department</b></br>Level: <b>10</b></br>
                            </br><small>Members: <b>{{ \App\User::where('Member',1)->where('Rank', '<', 10)->count() }}/20</b></small>
                            <div class="progress" style="background-color: #21212196; border: 1px solid #54545470;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (\App\User::where('Member',1)->where('Rank', '<', 10)->count())*100/(20) }}%; color: #cacaca; font-size: 9px;">{{ \App\User::where('Member',1)->where('Rank', '<', 10)->count() }}/20</div>
                            </div>
                            </br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/faction/1') }}/list">{!! $s !!} applications</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/leader/1') }}/list">leader app</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('complaints/faction/1') }}/list">complaints</a> <a class="btn btn-xs btn-outline btn-primary _members" id="1" type="f" href="#">members</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('demis/faction/1') }}/list">demission</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('faction/1') }}/log">logs</a>
                            <a href="https://www.linkmania.ro/forum/1320-police-department/" target="_blank">
                                <div class="btn btn-xs btn-outline btn-primary"><i class="fa fa-external-link"></i> forum link</div>
                            </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/19.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc">
                    <?php $s = \App\Option::where('option_name','factionAppStatus19')->first(); $s = (!$s || $s->option_value ? '<i class="fa fa-unlock" style="color:#00FA00"></i>' : '<i class="fa fa-lock" style="color:#FF1C1C"></i>'); ?>
                        <center><a href="#" class="product-name" style="color:#1269EB">L.V.P.D</a>Type: <b>Department</b></br>Level: <b>10</b></br>
                            </br><small>Members: <b>{{ \App\User::where('Member',19)->where('Rank', '<', 10)->count() }}/20</b></small>
                            <div class="progress" style="background-color: #21212196; border: 1px solid #54545470;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (\App\User::where('Member',19)->where('Rank', '<', 10)->count())*100/(20) }}%; color: #cacaca; font-size: 9px;">{{ \App\User::where('Member',19)->where('Rank', '<', 10)->count() }}/20</div>
                            </div>
                            </br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/faction/19') }}/list">{!! $s !!} applications</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/leader/19') }}/list">leader app</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('complaints/faction/19') }}/list">complaints</a> <a class="btn btn-xs btn-outline btn-primary _members" id="19" type="f" href="#">members</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('demis/faction/19') }}/list">demission</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('faction/19') }}/log">logs</a>
                            <a href="https://www.linkmania.ro/forum/1895-las-venturas-police-department/" target="_blank">
                                <div class="btn btn-xs btn-outline btn-primary"><i class="fa fa-external-link"></i> forum link</div>
                            </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/2.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc">
                    <?php $s = \App\Option::where('option_name','factionAppStatus2')->first(); $s = (!$s || $s->option_value ? '<i class="fa fa-unlock" style="color:#00FA00"></i>' : '<i class="fa fa-lock" style="color:#FF1C1C"></i>'); ?>
                        <center><a href="#" class="product-name" style="color:#1710E0">F.B.I</a>Type: <b>Department</b></br>Level: <b>10</b></br>
                            </br><small>Members: <b>{{ \App\User::where('Member',2)->where('Rank', '<', 10)->count() }}/20</b></small>
                            <div class="progress" style="background-color: #21212196; border: 1px solid #54545470;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (\App\User::where('Member',2)->where('Rank', '<', 10)->count())*100/(20) }}%; color: #cacaca; font-size: 9px;">{{ \App\User::where('Member',2)->where('Rank', '<', 10)->count() }}/20</div>
                            </div>
                            </br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/faction/2') }}/list">{!! $s !!} applications</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/leader/2') }}/list">leader app</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('complaints/faction/2') }}/list">complaints</a> <a class="btn btn-xs btn-outline btn-primary _members" id="2" type="f" href="#">members</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('demis/faction/2') }}/list">demission</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('faction/2') }}/log">logs</a>
                            <a href="https://www.linkmania.ro/forum/1532-federal-bureau-of-investigation/" target="_blank">
                                <div class="btn btn-xs btn-outline btn-primary"><i class="fa fa-external-link"></i> forum link</div>
                            </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/3.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc">
                    <?php $s = \App\Option::where('option_name','factionAppStatus3')->first(); $s = (!$s || $s->option_value ? '<i class="fa fa-unlock" style="color:#00FA00"></i>' : '<i class="fa fa-lock" style="color:#FF1C1C"></i>'); ?>
                        <center><a href="#" class="product-name" style="color:#0600A8">National Guard</a>Type: <b>Department</b></br>Level: <b>10</b></br>
                            </br><small>Members: <b>{{ \App\User::where('Member',3)->where('Rank', '<', 10)->count() }}/20</b></small>
                            <div class="progress" style="background-color: #21212196; border: 1px solid #54545470;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (\App\User::where('Member',3)->where('Rank', '<', 10)->count())*100/(20) }}%; color: #cacaca; font-size: 9px;">{{ \App\User::where('Member',3)->where('Rank', '<', 10)->count() }}/20</div>
                            </div>
                            </br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/faction/3') }}/list">{!! $s !!} applications</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/leader/3') }}/list">leader app</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('complaints/faction/3') }}/list">complaints</a> <a class="btn btn-xs btn-outline btn-primary _members" id="3" type="f" href="#">members</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('demis/faction/3') }}/list">demission</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('faction/3') }}/log">logs</a>
                            <a href="https://www.linkmania.ro/forum/1354-national-guard/" target="_blank">
                                <div class="btn btn-xs btn-outline btn-primary"><i class="fa fa-external-link"></i> forum link</div>
                            </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/4.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc">
                    <?php $s = \App\Option::where('option_name','factionAppStatus4')->first(); $s = (!$s || $s->option_value ? '<i class="fa fa-unlock" style="color:#00FA00"></i>' : '<i class="fa fa-lock" style="color:#FF1C1C"></i>'); ?>
                        <center><a href="#" class="product-name" style="color:#FF6347">Paramedics LS</a>Type: <b>Department</b></br>Level: <b>5</b></br>
                            </br><small>Members: <b>{{ \App\User::where('Member',4)->where('Rank', '<', 10)->count() }}/30</b></small>
                            <div class="progress" style="background-color: #21212196; border: 1px solid #54545470;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (\App\User::where('Member',4)->where('Rank', '<', 10)->count())*100/(30) }}%; color: #cacaca; font-size: 9px;">{{ \App\User::where('Member',4)->where('Rank', '<', 10)->count() }}/30</div>
                            </div>
                            </br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/faction/4') }}/list">{!! $s !!} applications</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/leader/4') }}/list">leader app</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('complaints/faction/4') }}/list">complaints</a> <a class="btn btn-xs btn-outline btn-primary _members" id="4" type="f" href="#">members</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('demis/faction/4') }}/list">demission</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('faction/4') }}/log">logs</a>
                            <a href="https://www.linkmania.ro/forum/1322-paramedics-department/" target="_blank">
                                <div class="btn btn-xs btn-outline btn-primary"><i class="fa fa-external-link"></i> forum link</div>
                            </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/18.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc">
                    <?php $s = \App\Option::where('option_name','factionAppStatus18')->first(); $s = (!$s || $s->option_value ? '<i class="fa fa-unlock" style="color:#00FA00"></i>' : '<i class="fa fa-lock" style="color:#FF1C1C"></i>'); ?>
                        <center><a href="#" class="product-name" style="color:#FF6347">Paramedics LV</a>Type: <b>Department</b></br>Level: <b>5</b></br>
                            </br><small>Members: <b>{{ \App\User::where('Member',18)->where('Rank', '<', 10)->count() }}/30</b></small>
                            <div class="progress" style="background-color: #21212196; border: 1px solid #54545470;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (\App\User::where('Member',18)->where('Rank', '<', 10)->count())*100/(30) }}%; color: #cacaca; font-size: 9px;">{{ \App\User::where('Member',18)->where('Rank', '<', 10)->count() }}/30</div>
                            </div>
                            </br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/faction/18') }}/list">{!! $s !!} applications</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/leader/18') }}/list">leader app</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('complaints/faction/18') }}/list">complaints</a> <a class="btn btn-xs btn-outline btn-primary _members" id="18" type="f" href="#">members</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('demis/faction/18') }}/list">demission</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('faction/18') }}/log">logs</a>
                            <a href="https://www.linkmania.ro/forum/1322-paramedics-department/" target="_blank">
                                <div class="btn btn-xs btn-outline btn-primary"><i class="fa fa-external-link"></i> forum link</div>
                            </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/5.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc">
                    <?php $s = \App\Option::where('option_name','factionAppStatus5')->first(); $s = (!$s || $s->option_value ? '<i class="fa fa-unlock" style="color:#00FA00"></i>' : '<i class="fa fa-lock" style="color:#FF1C1C"></i>'); ?>
                        <center><a href="#" class="product-name" style="color:#E8D71E">Taxi LS</a>Type: <b>Peaceful</b></br>Level: <b>5</b></br>
                            </br><small>Members: <b>{{ \App\User::where('Member',5)->where('Rank', '<', 10)->count() }}/25</b></small>
                            <div class="progress" style="background-color: #21212196; border: 1px solid #54545470;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (\App\User::where('Member',5)->where('Rank', '<', 10)->count())*100/(25) }}%; color: #cacaca; font-size: 9px;">{{ \App\User::where('Member',5)->where('Rank', '<', 10)->count() }}/25</div>
                            </div>
                            </br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/faction/5') }}/list">{!! $s !!} applications</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/leader/5') }}/list">leader app</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('complaints/faction/5') }}/list">complaints</a> <a class="btn btn-xs btn-outline btn-primary _members" id="5" type="f" href="#">members</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('demis/faction/5') }}/list">demission</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('faction/5') }}/log">logs</a>
                            <a href="https://www.linkmania.ro/forum/1533-taxi-los-santos/" target="_blank">
                                <div class="btn btn-xs btn-outline btn-primary"><i class="fa fa-external-link"></i> forum link</div>
                            </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/16.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc">
                    <?php $s = \App\Option::where('option_name','factionAppStatus16')->first(); $s = (!$s || $s->option_value ? '<i class="fa fa-unlock" style="color:#00FA00"></i>' : '<i class="fa fa-lock" style="color:#FF1C1C"></i>'); ?>
                        <center><a href="#" class="product-name" style="color:#E8D71E">Taxi LV</a>Type: <b>Peaceful</b></br>Level: <b>5</b></br>
                            </br><small>Members: <b>{{ \App\User::where('Member',16)->where('Rank', '<', 10)->count() }}/25</b></small>
                            <div class="progress" style="background-color: #21212196; border: 1px solid #54545470;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (\App\User::where('Member',16)->where('Rank', '<', 10)->count())*100/(25) }}%; color: #cacaca; font-size: 9px;">{{ \App\User::where('Member',16)->where('Rank', '<', 10)->count() }}/25</div>
                            </div>
                            </br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/faction/16') }}/list">{!! $s !!} applications</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/leader/16') }}/list">leader app</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('complaints/faction/16') }}/list">complaints</a> <a class="btn btn-xs btn-outline btn-primary _members" id="16" type="f" href="#">members</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('demis/faction/16') }}/list">demission</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('faction/16') }}/log">logs</a>
                            <a href="https://www.linkmania.ro/forum/1898-taxi-las-venturas/" target="_blank">
                                <div class="btn btn-xs btn-outline btn-primary"><i class="fa fa-external-link"></i> forum link</div>
                            </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/6.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc">
                    <?php $s = \App\Option::where('option_name','factionAppStatus6')->first(); $s = (!$s || $s->option_value ? '<i class="fa fa-unlock" style="color:#00FA00"></i>' : '<i class="fa fa-lock" style="color:#FF1C1C"></i>'); ?>
                        <center><a href="#" class="product-name" style="color:#D67ED5">News Reporters</a>Type: <b>Peaceful</b></br>Level: <b>5</b></br>
                            </br><small>Members: <b>{{ \App\User::where('Member',6)->where('Rank', '<', 10)->count() }}/20</b></small>
                            <div class="progress" style="background-color: #21212196; border: 1px solid #54545470;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (\App\User::where('Member',6)->where('Rank', '<', 10)->count())*100/(20) }}%; color: #cacaca; font-size: 9px;">{{ \App\User::where('Member',6)->where('Rank', '<', 10)->count() }}/20</div>
                            </div>
                            </br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/faction/6') }}/list">{!! $s !!} applications</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/leader/6') }}/list">leader app</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('complaints/faction/6') }}/list">complaints</a> <a class="btn btn-xs btn-outline btn-primary _members" id="6" type="f" href="#">members</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('demis/faction/6') }}/list">demission</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('faction/6') }}/log">logs</a>
                            <a href="https://www.linkmania.ro/forum/1344-news-reporters/" target="_blank">
                                <div class="btn btn-xs btn-outline btn-primary"><i class="fa fa-external-link"></i> forum link</div>
                            </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/7.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc">
                    <?php $s = \App\Option::where('option_name','factionAppStatus7')->first(); $s = (!$s || $s->option_value ? '<i class="fa fa-unlock" style="color:#00FA00"></i>' : '<i class="fa fa-lock" style="color:#FF1C1C"></i>'); ?>
                        <center><a href="#" class="product-name" style="color:#24E3CA">School Instructor LS</a>Type: <b>Peaceful</b></br>Level: <b>5</b></br>
                            </br><small>Members: <b>{{ \App\User::where('Member',7)->where('Rank', '<', 10)->count() }}/20</b></small>
                            <div class="progress" style="background-color: #21212196; border: 1px solid #54545470;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (\App\User::where('Member',7)->where('Rank', '<', 10)->count())*100/(20) }}%; color: #cacaca; font-size: 9px;">{{ \App\User::where('Member',7)->where('Rank', '<', 10)->count() }}/20</div>
                            </div>
                            </br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/faction/7') }}/list">{!! $s !!} applications</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/leader/7') }}/list">leader app</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('complaints/faction/7') }}/list">complaints</a> <a class="btn btn-xs btn-outline btn-primary _members" id="7" type="f" href="#">members</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('demis/faction/7') }}/list">demission</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('faction/7') }}/log">logs</a>
                            <a href="https://www.linkmania.ro/forum/1445-los-santos-school-instructors/" target="_blank">
                                <div class="btn btn-xs btn-outline btn-primary"><i class="fa fa-external-link"></i> forum link</div>
                            </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/17.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc">
                    <?php $s = \App\Option::where('option_name','factionAppStatus17')->first(); $s = (!$s || $s->option_value ? '<i class="fa fa-unlock" style="color:#00FA00"></i>' : '<i class="fa fa-lock" style="color:#FF1C1C"></i>'); ?>
                        <center><a href="#" class="product-name" style="color:#24E3CA">School Instructor LV</a>Type: <b>Peaceful</b></br>Level: <b>5</b></br>
                            </br><small>Members: <b>{{ \App\User::where('Member',17)->where('Rank', '<', 10)->count() }}/20</b></small>
                            <div class="progress" style="background-color: #21212196; border: 1px solid #54545470;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (\App\User::where('Member',17)->where('Rank', '<', 10)->count())*100/(20) }}%; color: #cacaca; font-size: 9px;">{{ \App\User::where('Member',17)->where('Rank', '<', 10)->count() }}/20</div>
                            </div>
                            </br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/faction/17') }}/list">{!! $s !!} applications</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/leader/17') }}/list">leader app</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('complaints/faction/17') }}/list">complaints</a> <a class="btn btn-xs btn-outline btn-primary _members" id="17" type="f" href="#">members</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('demis/faction/17') }}/list">demission</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('faction/17') }}/log">logs</a>
                            <a href="https://www.linkmania.ro/forum/1897-las-venturas-school-instructors/" target="_blank">
                                <div class="btn btn-xs btn-outline btn-primary"><i class="fa fa-external-link"></i> forum link</div>
                            </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/8.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc">
                    <?php $s = \App\Option::where('option_name','factionAppStatus8')->first(); $s = (!$s || $s->option_value ? '<i class="fa fa-unlock" style="color:#00FA00"></i>' : '<i class="fa fa-lock" style="color:#FF1C1C"></i>'); ?>
                        <center><a href="#" class="product-name" style="color:#676A6C">Hitman Agency</a>Type: <b>Mixt</b></br>Level: <b>15</b></br>
                            </br><small>Members: <b>{{ \App\User::where('Member',8)->where('Rank', '<', 10)->count() }}/20</b></small>
                            <div class="progress" style="background-color: #21212196; border: 1px solid #54545470;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (\App\User::where('Member',8)->where('Rank', '<', 10)->count())*100/(20) }}%; color: #cacaca; font-size: 9px;">{{ \App\User::where('Member',8)->where('Rank', '<', 10)->count() }}/20</div>
                            </div>
                            </br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/faction/8') }}/list">{!! $s !!} applications</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/leader/8') }}/list">leader app</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('complaints/faction/8') }}/list">complaints</a> <a class="btn btn-xs btn-outline btn-primary _members" id="8" type="f" href="#">members</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('demis/faction/8') }}/list">demission</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('faction/8') }}/log">logs</a>
                            <a href="https://www.linkmania.ro/forum/1328-hitman-agency/" target="_blank">
                                <div class="btn btn-xs btn-outline btn-primary"><i class="fa fa-external-link"></i> forum link</div>
                            </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/9.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc">
                    <?php $s = \App\Option::where('option_name','factionAppStatus9')->first(); $s = (!$s || $s->option_value ? '<i class="fa fa-unlock" style="color:#00FA00"></i>' : '<i class="fa fa-lock" style="color:#FF1C1C"></i>'); ?>
                        <center><a href="#" class="product-name" style="color:#009100">Grove Street</a>Type: <b>Gang</b></br>Level: <b>10</b></br>
                            </br><small>Members: <b>{{ \App\User::where('Member',9)->where('Rank', '<', 10)->count() }}/15</b></small>
                            <div class="progress" style="background-color: #21212196; border: 1px solid #54545470;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (\App\User::where('Member',9)->where('Rank', '<', 10)->count())*100/(15) }}%; color: #cacaca; font-size: 9px;">{{ \App\User::where('Member',9)->where('Rank', '<', 10)->count() }}/15</div>
                            </div>
                            </br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/faction/9') }}/list">{!! $s !!} applications</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/leader/9') }}/list">leader app</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('complaints/faction/9') }}/list">complaints</a> <a class="btn btn-xs btn-outline btn-primary _members" id="9" type="f" href="#">members</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('demis/faction/9') }}/list">demission</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('faction/9') }}/log">logs</a>
                            <a href="https://www.linkmania.ro/forum/1324-grove-street/" target="_blank">
                                <div class="btn btn-xs btn-outline btn-primary"><i class="fa fa-external-link"></i> forum link</div>
                            </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/10.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc">
                    <?php $s = \App\Option::where('option_name','factionAppStatus10')->first(); $s = (!$s || $s->option_value ? '<i class="fa fa-unlock" style="color:#00FA00"></i>' : '<i class="fa fa-lock" style="color:#FF1C1C"></i>'); ?>
                        <center><a href="#" class="product-name" style="color:#910082">The Ballas Family</a>Type: <b>Gang</b></br>Level: <b>10</b></br>
                            </br><small>Members: <b>{{ \App\User::where('Member',10)->where('Rank', '<', 10)->count() }}/15</b></small>
                            <div class="progress" style="background-color: #21212196; border: 1px solid #54545470;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (\App\User::where('Member',10)->where('Rank', '<', 10)->count())*100/(15) }}%; color: #cacaca; font-size: 9px;">{{ \App\User::where('Member',10)->where('Rank', '<', 10)->count() }}/15</div>
                            </div>
                            </br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/faction/10') }}/list">{!! $s !!} applications</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/leader/10') }}/list">leader app</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('complaints/faction/10') }}/list">complaints</a> <a class="btn btn-xs btn-outline btn-primary _members" id="10" type="f" href="#">members</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('demis/faction/10') }}/list">demission</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('faction/10') }}/log">logs</a>
                            <a href="https://www.linkmania.ro/forum/1325-the-ballas-familly/" target="_blank">
                                <div class="btn btn-xs btn-outline btn-primary"><i class="fa fa-external-link"></i> forum link</div>
                            </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/11.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc">
                    <?php $s = \App\Option::where('option_name','factionAppStatus11')->first(); $s = (!$s || $s->option_value ? '<i class="fa fa-unlock" style="color:#00FA00"></i>' : '<i class="fa fa-lock" style="color:#FF1C1C"></i>'); ?>
                        <center><a href="#" class="product-name" style="color:#876922">La Cosa Nostra</a>Type: <b>Gang</b></br>Level: <b>10</b></br>
                            </br><small>Members: <b>{{ \App\User::where('Member',11)->where('Rank', '<', 10)->count() }}/15</b></small>
                            <div class="progress" style="background-color: #21212196; border: 1px solid #54545470;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (\App\User::where('Member',11)->where('Rank', '<', 10)->count())*100/(15) }}%; color: #cacaca; font-size: 9px;">{{ \App\User::where('Member',11)->where('Rank', '<', 10)->count() }}/15</div>
                            </div>
                            </br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/faction/11') }}/list">{!! $s !!} applications</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/leader/11') }}/list">leader app</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('complaints/faction/11') }}/list">complaints</a> <a class="btn btn-xs btn-outline btn-primary _members" id="11" type="f" href="#">members</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('demis/faction/11') }}/list">demission</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('faction/11') }}/log">logs</a>
                            <a href="https://www.linkmania.ro/forum/1429-camorra-family/" target="_blank">
                                <div class="btn btn-xs btn-outline btn-primary"><i class="fa fa-external-link"></i> forum link</div>
                            </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/12.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc">
                    <?php $s = \App\Option::where('option_name','factionAppStatus12')->first(); $s = (!$s || $s->option_value ? '<i class="fa fa-unlock" style="color:#00FA00"></i>' : '<i class="fa fa-lock" style="color:#FF1C1C"></i>'); ?>
                        <center><a href="#" class="product-name" style="color:#4e9251">Yakuza</a>Type: <b>Gang</b></br>Level: <b>10</b></br>
                            </br><small>Members: <b>{{ \App\User::where('Member',12)->where('Rank', '<', 10)->count() }}/15</b></small>
                            <div class="progress" style="background-color: #21212196; border: 1px solid #54545470;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (\App\User::where('Member',12)->where('Rank', '<', 10)->count())*100/(15) }}%; color: #cacaca; font-size: 9px;">{{ \App\User::where('Member',12)->where('Rank', '<', 10)->count() }}/15</div>
                            </div>
                            </br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/faction/12') }}/list">{!! $s !!} applications</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/leader/12') }}/list">leader app</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('complaints/faction/12') }}/list">complaints</a> <a class="btn btn-xs btn-outline btn-primary _members" id="12" type="f" href="#">members</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('demis/faction/12') }}/list">demission</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('faction/12') }}/log">logs</a>
                            <a href="https://www.linkmania.ro/forum/1703-sicilian-mafia/" target="_blank">
                                <div class="btn btn-xs btn-outline btn-primary"><i class="fa fa-external-link"></i> forum link</div>
                            </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/14.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc">
                    <?php $s = \App\Option::where('option_name','factionAppStatus14')->first(); $s = (!$s || $s->option_value ? '<i class="fa fa-unlock" style="color:#00FA00"></i>' : '<i class="fa fa-lock" style="color:#FF1C1C"></i>'); ?>
                        <center><a href="#" class="product-name" style="color:#EB4F00">Insomnia Racing Club</a>Type: <b>Race</b></br>Level: <b>10</b></br>
                            </br><small>Members: <b>{{ \App\User::where('Member',14)->where('Rank', '<', 10)->count() }}/20</b></small>
                            <div class="progress" style="background-color: #21212196; border: 1px solid #54545470;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (\App\User::where('Member',14)->where('Rank', '<', 10)->count())*100/(20) }}%; color: #cacaca; font-size: 9px;">{{ \App\User::where('Member',14)->where('Rank', '<', 10)->count() }}/20</div>
                            </div>
                            </br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/faction/14') }}/list">{!! $s !!} applications</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/leader/14') }}/list">leader app</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('complaints/faction/14') }}/list">complaints</a> <a class="btn btn-xs btn-outline btn-primary _members" id="14" type="f" href="#">members</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('demis/faction/14') }}/list">demission</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('faction/14') }}/log">logs</a>
                            <a href="https://www.linkmania.ro/forum/1646-insomnia-racing-club/" target="_blank">
                                <div class="btn btn-xs btn-outline btn-primary"><i class="fa fa-external-link"></i> forum link</div>
                            </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/15.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc">
                    <?php $s = \App\Option::where('option_name','factionAppStatus15')->first(); $s = (!$s || $s->option_value ? '<i class="fa fa-unlock" style="color:#00FA00"></i>' : '<i class="fa fa-lock" style="color:#FF1C1C"></i>'); ?>
                        <center><a href="#" class="product-name" style="color:#00A876">Midnight Racers Club</a>Type: <b>Race</b></br>Level: <b>10</b></br>
                            </br><small>Members: <b>{{ \App\User::where('Member',15)->where('Rank', '<', 10)->count() }}/20</b></small>
                            <div class="progress" style="background-color: #21212196; border: 1px solid #54545470;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (\App\User::where('Member',15)->where('Rank', '<', 10)->count())*100/(20) }}%; color: #cacaca; font-size: 9px;">{{ \App\User::where('Member',15)->where('Rank', '<', 10)->count() }}/20</div>
                            </div>
                            </br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/faction/15') }}/list">{!! $s !!} applications</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('applications/leader/15') }}/list">leader app</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('complaints/faction/15') }}/list">complaints</a> <a class="btn btn-xs btn-outline btn-primary _members" id="15" type="f" href="#">members</a></br><a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('demis/faction/15') }}/list">demission</a> <a class="btn btn-xs btn-outline btn-primary" href="{{ URL::to('faction/15') }}/log">logs</a>
                            <a href="https://www.linkmania.ro/forum/1645-midnight-racers-club/" target="_blank">
                                <div class="btn btn-xs btn-outline btn-primary"><i class="fa fa-external-link"></i> forum link</div>
                            </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/13.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc">
                    <?php $s = \App\Option::where('option_name','factionAppStatus13')->first(); $s = (!$s || $s->option_value ? '<i class="fa fa-unlock" style="color:#00FA00"></i>' : '<i class="fa fa-lock" style="color:#FF1C1C"></i>'); ?>
                        <center><a href="#" class="product-name" style="color:#00FF80">The Mayor</a>Type: <b>Policy</b></br>Level: <b>10</b></br>
                            </br><small>Members: <b>{{ \App\User::where('Member',13)->where('Rank', '<', 10)->count() }}/2</b></small>
                            <div class="progress" style="background-color: #21212196; border: 1px solid #54545470;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ (\App\User::where('Member',13)->where('Rank', '<', 10)->count())*100/(2) }}%; color: #cacaca; font-size: 9px;">{{ \App\User::where('Member',13)->where('Rank', '<', 10)->count() }}/2</div>
                            </div>
                            </br><a class="btn btn-xs btn-outline btn-primary _members" id="13" type="f" href="#">members</a>
                            <a href="https://www.linkmania.ro/forum/1321-the-mayor/" target="_blank">
                                <div class="btn btn-xs btn-outline btn-primary"><i class="fa fa-external-link"></i> forum link</div>
                            </a>
                </div>
            </div>
        </div>
    </div>
</div>@section('js')<script src="{{ asset('assets/bootbox.min.js') }}"></script><script src="{{ asset('assets/fc.min.js') }}"></script>@endsection @endsection