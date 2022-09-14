@extends('layouts.master')
@section('breadcrumb','Graffiti Walls')
@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1"><style>.centered {position: absolute;top: 25%;left: 50%;transform: translate(-50%, -50%);}</style>
<div class="table-responsive">
<div class="col-md-3">
    <div class="ibox">
        <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
            <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/1g.png" width="204" height="130"/><div class="centered" style="font-size:14px;color:#1092E3;">{{ \Cache::get('kdacnh') }}</br>{{ \Cache::get('kdac1') }}</div></div>
            <div class="product-desc">
                <center><a href="#" class="product-name">Graffiti Wall #1</a>
                Can Attack: <b>@if(Carbon\Carbon::now()->timestamp > \Cache::get('kkdx1')) <font color="#00ba19"><i class="fa fa-unlock"></i> Yes</font> @else <font color="#c90000"><i class="fa fa-lock"></i> No</font> @endif</b>
                </br>Zone: <b>Market</b>
              	</br>Date: <b>{{ \Cache::get('dat1') }}</center></b>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="ibox">
        <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
            <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/2g.png" width="204" height="130"/><div class="centered" style="font-size:14px;color:#1092E3;">{{ \Cache::get('kdacnh2') }}</br>{{ \Cache::get('kdac2') }}</div></div>
            <div class="product-desc">
                <center><a href="#" class="product-name">Graffiti Wall #2</a>
                Can Attack: <b>@if(Carbon\Carbon::now()->timestamp > \Cache::get('kkdx2')) <font color="#00ba19"><i class="fa fa-unlock"></i> Yes</font> @else <font color="#c90000"><i class="fa fa-lock"></i> No</font> @endif</b>
            	</br>Zone: <b>Rodeo</b>
            	</br>Date: <b>{{ \Cache::get('dat2') }}</center></b>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="ibox">
        <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
            <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/3g.png" width="204" height="130"/><div class="centered" style="font-size:14px;color:#1092E3;">{{ \Cache::get('kdacnh3') }}</br>{{ \Cache::get('kdac3') }}</div></div>
            <div class="product-desc">
                <center><a href="#" class="product-name">Graffiti Wall #3</a>
                Can Attack: <b>@if(Carbon\Carbon::now()->timestamp > \Cache::get('kkdx3')) <font color="#00ba19"><i class="fa fa-unlock"></i> Yes</font> @else <font color="#c90000"><i class="fa fa-lock"></i> No</font> @endif</b>
            	</br>Zone: <b>Santa Maria Beach</b>
            	</br>Date: <b>{{ \Cache::get('dat3') }}</center></b>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="ibox">
        <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
            <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/4g.png" width="204" height="130"/><div class="centered" style="font-size:14px;color:#1092E3;">{{ \Cache::get('kdacnh4') }}</br>{{ \Cache::get('kdac4') }}</div></div>
            <div class="product-desc">
                <center><a href="#" class="product-name">Graffiti Wall #4</a>
                Can Attack: <b>@if(Carbon\Carbon::now()->timestamp > \Cache::get('kkdx4')) <font color="#00ba19"><i class="fa fa-unlock"></i> Yes</font> @else <font color="#c90000"><i class="fa fa-lock"></i> No</font> @endif</b>
            	</br>Zone: <b>Temple</b>
            	</br>Date: <b>{{ \Cache::get('dat4') }}</center></b>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="ibox">
        <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
            <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/5g.png" width="204" height="130"/><div class="centered" style="font-size:14px;color:#1092E3;">{{ \Cache::get('kdacnh5') }}</br>{{ \Cache::get('kdac5') }}</div></div>
            <div class="product-desc">
                <center><a href="#" class="product-name">Graffiti Wall #5</a>
            	Can Attack: <b>@if(Carbon\Carbon::now()->timestamp > \Cache::get('kkdx5')) <font color="#00ba19"><i class="fa fa-unlock"></i> Yes</font> @else <font color="#c90000"><i class="fa fa-lock"></i> No</font> @endif</b>
                </br>Zone: <b>Idlewood</b>
            	</br>Date: <b>{{ \Cache::get('dat5') }}</center></b>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="ibox">
        <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
            <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/6g.png" width="204" height="130"/><div class="centered" style="font-size:14px;color:#1092E3;">{{ \Cache::get('kdacnh6') }}</br>{{ \Cache::get('kdac6') }}</div></div>
            <div class="product-desc">
                <center><a href="#" class="product-name">Graffiti Wall #6</a>
            	Can Attack: <b>@if(Carbon\Carbon::now()->timestamp > \Cache::get('kkdx6')) <font color="#00ba19"><i class="fa fa-unlock"></i> Yes</font> @else <font color="#c90000"><i class="fa fa-lock"></i> No</font> @endif</b>
                </br>Zone: <b>El Corona</b>
            	</br>Date: <b>{{ \Cache::get('dat6') }}</center></b>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="ibox">
        <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
            <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/7g.png" width="204" height="130"/><div class="centered" style="font-size:14px;color:#1092E3;">{{ \Cache::get('kdacnh7') }}</br>{{ \Cache::get('kdac7') }}</div></div>
            <div class="product-desc">
                <center><a href="#" class="product-name">Graffiti Wall #7</a>
            	Can Attack: <b>@if(Carbon\Carbon::now()->timestamp > \Cache::get('kkdx7')) <font color="#00ba19"><i class="fa fa-unlock"></i> Yes</font> @else <font color="#c90000"><i class="fa fa-lock"></i> No</font> @endif</b>
                </br>Zone: <b>Red County</b>
            	</br>Date: <b>{{ \Cache::get('dat7') }}</center></b>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="ibox">
        <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
            <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/8g.png" width="204" height="130"/><div class="centered" style="font-size:14px;color:#1092E3;">{{ \Cache::get('kdacnh8') }}</br>{{ \Cache::get('kdac8') }}</div></div>
            <div class="product-desc">
                <center><a href="#" class="product-name">Graffiti Wall #8</a>
            	Can Attack: <b>@if(Carbon\Carbon::now()->timestamp > \Cache::get('kkdx8')) <font color="#00ba19"><i class="fa fa-unlock"></i> Yes</font> @else <font color="#c90000"><i class="fa fa-lock"></i> No</font> @endif</b>
                </br>Zone: <b>Flint Range</b>
            	</br>Date: <b>{{ \Cache::get('dat8') }}</center></b>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="ibox">
        <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
            <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/9g.png" width="204" height="130"/><div class="centered" style="font-size:14px;color:#1092E3;">{{ \Cache::get('kdacnh9') }}</br>{{ \Cache::get('kdac9') }}</div></div>
            <div class="product-desc">
                <center><a href="#" class="product-name">Graffiti Wall #9</a>
            	Can Attack: <b>@if(Carbon\Carbon::now()->timestamp > \Cache::get('kkdx9')) <font color="#00ba19"><i class="fa fa-unlock"></i> Yes</font> @else <font color="#c90000"><i class="fa fa-lock"></i> No</font> @endif</b>
                </br>Zone: <b>Downtown</b>
            	</br>Date: <b>{{ \Cache::get('dat9') }}</b></center>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="ibox">
        <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
            <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/10g.png" width="204" height="130"/><div class="centered" style="font-size:14px;color:#1092E3;">{{ \Cache::get('kdacnh10') }}</br>{{ \Cache::get('kdac10') }}</div></div>
            <div class="product-desc">
                <center><a href="#" class="product-name">Graffiti Wall #10</a>
                Can Attack: <b>@if(Carbon\Carbon::now()->timestamp > \Cache::get('kkdx10')) <font color="#00ba19"><i class="fa fa-unlock"></i> Yes</font> @else <font color="#c90000"><i class="fa fa-lock"></i> No</font> @endif</b>
                </br>Zone: <b>Ganton</b>
                </br>Date: <b>{{ \Cache::get('dat10') }}</b></center>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="ibox">
        <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
            <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/11g.png" width="204" height="130"/><div class="centered" style="font-size:14px;color:#1092E3;">{{ \Cache::get('kdacnh11') }}</br>{{ \Cache::get('kdac11') }}</div></div>
            <div class="product-desc">
                <center><a href="#" class="product-name">Graffiti Wall #11</a>
                Can Attack: <b>@if(Carbon\Carbon::now()->timestamp > \Cache::get('kkdx11')) <font color="#00ba19"><i class="fa fa-unlock"></i> Yes</font> @else <font color="#c90000"><i class="fa fa-lock"></i> No</font> @endif</b>
                </br>Zone: <b>R. Los Santos</b>
                </br>Date: <b>{{ \Cache::get('dat11') }}</b></center>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="ibox">
        <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
            <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/12g.png" width="204" height="130"/><div class="centered" style="font-size:14px;color:#1092E3;">{{ \Cache::get('kdacnh12') }}</br>{{ \Cache::get('kdac12') }}</div></div>
            <div class="product-desc">
                <center><a href="#" class="product-name">Graffiti Wall #12</a>
                Can Attack: <b>@if(Carbon\Carbon::now()->timestamp > \Cache::get('kkdx12')) <font color="#00ba19"><i class="fa fa-unlock"></i> Yes</font> @else <font color="#c90000"><i class="fa fa-lock"></i> No</font> @endif</b>
                </br>Zone: <b>Verona Beach</b>
                </br>Date: <b>{{ \Cache::get('dat12') }}</b></center>
            </div>
        </div>
    </div>
</div></div>
@endsection		