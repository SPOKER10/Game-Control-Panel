@extends('layouts.master')
@section('breadcrumb','Background Theme')
@section('content')
@if(!Auth::check())<center><div class="alert alert-danger" style="background-color:#ff000047;margin-bottom:0;font-size:13px;"><b>ATENTIE!!!</b></br>Imaginea nu o sa ramana salvata la refresh deoarece <b>NU</b> esti logat pe panel!</div></center></br>@endif
<div class="table-responsive">
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p1.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(1);"><i class="fa fa-asterisk"></i> set theme #1</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p2.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(2);"><i class="fa fa-asterisk"></i> set theme #2</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p3.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(3);"><i class="fa fa-asterisk"></i> set theme #3</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p4.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(4);"><i class="fa fa-asterisk"></i> set theme #4</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p5.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(5);"><i class="fa fa-asterisk"></i> set theme #5</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p6.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(6);"><i class="fa fa-asterisk"></i> set theme #6</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p7.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(7);"><i class="fa fa-asterisk"></i> set theme #7</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p8.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(8);"><i class="fa fa-asterisk"></i> set theme #8</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p9.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(9);"><i class="fa fa-asterisk"></i> set theme #9</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p10.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(10);"><i class="fa fa-asterisk"></i> set theme #10</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p11.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(11);"><i class="fa fa-asterisk"></i> set theme #11</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p12.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(12);"><i class="fa fa-asterisk"></i> set theme #12</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p13.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(13);"><i class="fa fa-asterisk"></i> set theme #13</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p14.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(14);"><i class="fa fa-asterisk"></i> set theme #14</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p15.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(15);"><i class="fa fa-asterisk"></i> set theme #15</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p16.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(16);"><i class="fa fa-asterisk"></i> set theme #16</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p17.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(17);"><i class="fa fa-asterisk"></i> set theme #17</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p18.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(18);"><i class="fa fa-asterisk"></i> set theme #18</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p19.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(19);"><i class="fa fa-asterisk"></i> set theme #19</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p20.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(20);"><i class="fa fa-asterisk"></i> set theme #20</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p21.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(21);"><i class="fa fa-asterisk"></i> set theme #21</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p22.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(22);"><i class="fa fa-asterisk"></i> set theme #22</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p23.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(23);"><i class="fa fa-asterisk"></i> set theme #23</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p24.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(24);"><i class="fa fa-asterisk"></i> set theme #24</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p25.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(25);"><i class="fa fa-asterisk"></i> set theme #25</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p26.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(26);"><i class="fa fa-asterisk"></i> set theme #26</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p27.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(27);"><i class="fa fa-asterisk"></i> set theme #27</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p28.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(28);"><i class="fa fa-asterisk"></i> set theme #28</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p29.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(29);"><i class="fa fa-asterisk"></i> set theme #29</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p30.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(30);"><i class="fa fa-asterisk"></i> set theme #30</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p31.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(31);"><i class="fa fa-asterisk"></i> set theme #31</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p32.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(32);"><i class="fa fa-asterisk"></i> set theme #32</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p33.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(33);"><i class="fa fa-asterisk"></i> set theme #33</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p34.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(34);"><i class="fa fa-asterisk"></i> set theme #34</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p35.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(35);"><i class="fa fa-asterisk"></i> set theme #35</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p36.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(36);"><i class="fa fa-asterisk"></i> set theme #36</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p37.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(37);"><i class="fa fa-asterisk"></i> set theme #37</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p38.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(38);"><i class="fa fa-asterisk"></i> set theme #38</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p39.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(39);"><i class="fa fa-asterisk"></i> set theme #39</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p40.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(40);"><i class="fa fa-asterisk"></i> set theme #40</a></center></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
                <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ URL::to('/') }}/assets/p41.jpg" class="img-circle" width="200" height="170" /></div>
                <div class="product-desc"><center><a class="btn btn-success" onclick="cThem(41);"><i class="fa fa-asterisk"></i> set theme #41</a></center></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')<script>function cThem(nr){$("#tek").removeClass(document.getElementById('tek').className).addClass('page-cover'+nr);$.ajax({url: _PAGE_URL + "saveth",type: "POST",data: { id: "page-cover"+nr },success: () => {$.gritter.add({title: 'Background Theme',text: 'New Theme ID: #'+nr+'.<center><img src="{{ URL::to('/') }}/assets/p'+nr+'.jpg" class="img-circle" width="100" height="90" /></center>',class_name: "gritter-success gritter-light"});}})}</script>
<script src="{{ asset('assets/bt.min.js') }}"></script>@endsection