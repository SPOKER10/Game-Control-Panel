@extends('layouts.master')
@section('breadcrumb','Admin')
@section('content')
<div class="panel panel-success">
<div class="table-responsive">
	<center><b>MANAGE INDEX ANNOUNCES</b></br></center></br>
	@foreach($inano as $i)
	<div class="col-md-3 _2q{{ $i->ID }}">
    <div class="ibox">
        <div class="ibox-content product-box" style="margin-left:4px; background-color:#2121218f;">
            <div class="product-imitation" style="padding:0; background-color:#0000000d;"><img src="{{ $i->ImgLink }}" id="x{{ $i->ID }}" width="204" height="130" alt="Loading..."/><div style="font-size:14px;"><span id="{{ $i->ID }}">{{ $i->Title }}</span></br><font id="s{{ $i->ID }}" style="color:orange;">{{ $i->SecondTitle }}</font></div></div>
	            <div class="product-desc">
	                <center>
	                Topic ID: <b>{{ $i->ID }}</b>
	                </br><i class="fa fa-clock-o"></i> Date: <b>{{ $i->created_at }}</b>
	                </br><i class="fa fa-clock-o"></i> Last Edit: <b>{{ $i->updated_at }}</b>
	                </br><i class="fa fa-eye"></i> Views: <b>{{ $i->Views }}</b>
        			</br>By: <img src="{{ URL::to('/') }}/assets/a/{{ $i->Skin }}.png" class="img-circle" style="height:26px;"/> <b>{!! ($i->user ? $i->user->url : $i->PostedByID) !!}</b>
        			</br></br><a class="btn btn-xs btn-outline btn-primary _delAN" id="{{ $i->ID }}" id2="2" pBy="{{ $i->user->user }}"><i class="fa fa-trash" style="color:red;"></i> delete</a></br><a class="btn btn-xs btn-outline btn-primary" id="btnPrompt" tit="{{ $i->Title }}" sid="{{ $i->ID }}"><i class="fa fa-edit" style="color:green;"></i> edit title</a>
        			</br><a class="btn btn-xs btn-outline btn-primary" id="btnPrompt2" tit="{{ $i->SecondTitle }}" sid="{{ $i->ID }}"><i class="fa fa-edit" style="color:green;"></i> edit second title</a></br><a class="btn btn-xs btn-outline btn-primary" id="btnPrompt3" tit="{{ $i->ImgLink }}" sid="{{ $i->ID }}"><i class="fa fa-edit" style="color:green;"></i> edit image</a>
        			</br><a class="btn btn-xs btn-outline btn-primary" id="btnAlert" tit="<center>{{ $i->Text }}</center>" sid="{{ $i->ID }}"><i class="fa fa-eye" style="color:green;"></i> view</a></center>
	            </div>
        	</div>
    	</div>
	</div>
	@endforeach
</div>
<hr><center><b>POST INDEX ANNOUNCE</b>
	<div>
		@if (count($errors) > 0)<div class="alert alert-danger">@foreach ($errors->all() as $error){!! $error !!}<br>@endforeach</div>@endif
		<form method="POST" action="/postANNO">
			<div class="form-group">
		    	<label class="control-label">Titlu</label>
	            <div><input type="text" name="title" placeholder="Titlul principal..." class="form-control"></div>
	        </div>
	        <div class="form-group">
		    	<label class="control-label">Titlu Secundar</label>
	            <div><input type="text" name="stitle" placeholder="Titlul secundar..." class="form-control"></div>
	        </div>
		    <div class="form-group">
		    	<label class="control-label">Descriere</label>
	            <div><textarea name="description" rows="5" placeholder="Descriere topic..." class="form-control"></textarea></div>
	        </div>
	        <div class="form-group">
		    	<label class="control-label">Link Imagine</label>
	            <div><input type="text" name="link" placeholder="Linkul trebuie sa fie DIRECT spre imagine, doar imaginea in linkul respectiv." class="form-control"></div>
	        </div>
		    <div class="form-group">
		        <input type="submit" class="btn btn-success" value="POST"></input>
		        {!! csrf_field() !!}
		    </div>
		</form>
	</div>
<hr>
<div class="row">
	<div class="col-sm-12">
		<form class="form-horizontal" role="form" method="post" name="manage_questions" id="manage_questions">
			<fieldset><b>INDEX ANNOUNCES LOGS</br>(ONLY LAST 20 ORDER BY DATE)</b>
				<?php $ial = DB::table('indexanolog')->orderBy('Date','desc')->limit(20)->get(); ?>
				<div class="table-responsive">
						<table class="table table-bordered table-hover table-bordered datatable">
							<thead>
								<tr>
									<th>Topic ID</th>
									<th>Text</th>
									<th>Date <i class="fa fa-clock-o"></i></th>
								</tr>
							</thead>
							<tbody>
								@foreach ($ial as $l)
									<tr>
										<td>{{ $l->ID }}</td>
										<td>{{ $l->Text }}</td>
										<td>{{ $l->Date }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				<hr>
			</fieldset>
		</form>
	</div>
</div>
<b>POST SERVER UPDATE</b><form method="POST" action="/postUP">
	<div class="form-group">
    	<label class="control-label">Versiune</label>
        <div><input type="text" name="title" placeholder="Versiunea update-ului..." class="form-control"></div>
    </div>
    <div class="form-group">
    	<label class="control-label">Descriere</label>
        <div><textarea name="description" rows="5" placeholder="Descriere update..." class="form-control"></textarea></div>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-success" value="POST NEW UPDATE"></input>
        {!! csrf_field() !!}
    </div>
</form>
<hr>
<b>STAFF LOGS</b>
<div class="col-sm-12">
			<fieldset>
				<?php $safelogs = \Cache::remember('slog2',1,function() { return \DB::table('stafflogs')->orderBy('Date', 'desc')->get(); }); ?>
				<div class="table-responsive">
						<table class="table table-bordered table-hover table-bordered datatable">
							<thead>
								<tr>
									<th>Text</th>
									<th>Date <i class="fa fa-clock-o"></i></th>
								</tr>
							</thead>
							<tbody>
								@foreach ($safelogs as $l)
									<tr>
										<td>{{ $l->Text }}</td>
										<td>{{ $l->Date }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				<hr>
			</fieldset>
	</div>
</center>
<div class="panel-body" style="padding: 24px">
	<script src="{{ asset('bc.js') }}"></script>
	<div class="row">
		<div class="col-md-6">
			<form class="form-horizontal" data-type="h" role="form" method="post" data-id="0">
				<fieldset>
					<legend>Manage Helper Questions</legend>
					<select class="form-control _app" data-type="h"><option style="color: #000" @if(!$lh->option_value) selected="selected" @endif value="0">Closed</option><option style="color: #000" @if($lh->option_value) selected="selected" @endif value="1">Opened</option></select><hr>
					<div class="form-group"><a style="float:right;" class="btn btn-primary _add" id="0"><i class="fa fa-plus"></i> Add question</a></div>	
						@foreach(json_decode($qhd->option_value) as $i=>$qe)
							<div class="form-group _0q{{$i}}">
								<label class="col-md-2 control-label">Question</label>
								<div class="col-md-8"><input type="text" class="form-control _0q" placeholder="Question" value="{{ $qe }}" id="{{$i}}" name="a{{$i}}"></input></div>
								<div class="col-md-2"><a class="btn btn-danger _remove" id="{{ $i }}" id2="0"><i class="fa fa-remove"></i></a></div>
							</div>
						@endforeach
					<div class="form-group"><input type="submit" style="float:right;" class="btn btn-success _save" value="Save"/></div>
					<hr>
					<div id="w" style="width: 500px; height: 400px;"></div><script>google.charts.load('current', {'packages':['bar']});google.charts.setOnLoadCallback(d);function d(){new google.charts.Bar(document.getElementById('w')).draw(new google.visualization.arrayToDataTable([['Graph','Answered Helps','Hours This Month','Hours This Week'],@foreach($hlp as $c)['{{ $c->user }}',{{$c->Staff}},{{number_format($c->Hom/3600)}},{{number_format($c->HWKE/3600)}}],@endforeach]), {bars:'horizontal',series:{0:{axis:'distance'},1:{axis: 'brightness'}},axes:{x:{brightness:{side:'top',label:'All Helper Stats'}}}});};</script>
				</fieldset>
			</form>
		</div>
		<div class="col-md-6">
			<form class="form-horizontal" data-type="l" role="form" method="post" data-id="1">
				<fieldset>
					<legend>Manage Leader Questions</legend>
					<select class="form-control _app" data-type="l"><option style="color: #000" @if(!$ls->option_value) selected="selected" @endif value="0">Closed</option><option style="color: #000" @if($ls->option_value) selected="selected" @endif value="1">Opened</option></select><hr>
					<div class="form-group"><a style="float:right;" class="btn btn-primary _add" id="1"><i class="fa fa-plus"></i> Add question</a></div>	
						@foreach(json_decode($qld->option_value) as $i=>$ql)
							<div class="form-group _1q{{$i}}">
								<label class="col-md-2 control-label">Question</label>
								<div class="col-md-8"><input type="text" class="form-control _1q" placeholder="Question" value="{{ $ql }}" id="{{$i}}" name="a{{$i}}"></input></div>
								<div class="col-md-2"><a class="btn btn-danger _remove" id="{{ $i }}" id2="1"><i class="fa fa-remove"></i></a></div>
							</div>
						@endforeach
					<div class="form-group"><input type="submit" style="float:right;" class="btn btn-success _save" value="Save"/></div>
				</fieldset>
			</form>
		</div>
	</div>
	@section('js')
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.js"></script><script>$(document).ready(function(){$('.datatable').DataTable({"order": [[ 1, "desc" ]],iDisplayLength:10,"aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]]});});</script>
		<script src="{{ asset('assets/bt.min.js') }}"></script><script src="{{ asset('assets/admin.min.js') }}"></script>
		<script>
		function ezBSAlert(e){var a=$.Deferred(),s={type:"alert",modalSize:"modal-sm",okButtonText:"Set",cancelButtonText:"Cancel",yesButtonText:"Yes",noButtonText:"No",headerText:"Attention",messageText:"Message",alertType:"default",placeHold:"", inputFieldType:"text"};$.extend(s,e);return function(){var e="navbar-default";switch(s.alertType){case"primary":e="alert-primary";break;case"success":e="alert-success";break;case"info":e="alert-info";break;case"warning":e="alert-warning";break;case"danger":e="alert-danger"}$("BODY").append('<div id="ezAlerts" class="modal fade"><div class="modal-dialog" class="'+s.modalSize+'"><div class="modal-content"><div id="ezAlerts-header" class="modal-header '+e+'"><button id="close-button" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button><h4 id="ezAlerts-title" class="modal-title">Modal title</h4></div><div id="ezAlerts-body" class="modal-body"><div id="ezAlerts-message" ></div></div><div id="ezAlerts-footer" class="modal-footer"></div></div></div></div>'),$(".modal-header").css({padding:"15px 15px","-webkit-border-top-left-radius":"5px","-webkit-border-top-right-radius":"5px","-moz-border-radius-topleft":"5px","-moz-border-radius-topright":"5px","border-top-left-radius":"5px","border-top-right-radius":"5px"}),$("#ezAlerts-title").text(s.headerText),$("#ezAlerts-message").html(s.messageText);var t="";switch(s.type){case"confirm":var o='<button id="ezok-btn" class="btn btn-primary">'+s.yesButtonText+"</button>";s.noButtonText&&0<s.noButtonText.length&&(o+='<button id="ezclose-btn" class="btn btn-default">'+s.noButtonText+"</button>"),$("#ezAlerts-footer").html(o).on("click","button",function(e){"ezok-btn"===e.target.id?(t=!0,$("#ezAlerts").modal("hide")):"ezclose-btn"===e.target.id&&(t=!1,$("#ezAlerts").modal("hide"))});break;case"prompt":$("#ezAlerts-message").html(s.messageText+'<br /><br /><div class="form-group"><input placeholder="'+s.placeHold+'" type="'+s.inputFieldType+'" class="form-control" id="prompt" /></div>'),$("#ezAlerts-footer").html('<button class="btn btn-primary">'+s.okButtonText+"</button>").on("click",".btn",function(){t=$("#prompt").val(),$("#ezAlerts").modal("hide")})}$("#ezAlerts").modal({show:!1,backdrop:"static",keyboard:"false"}).on("hidden.bs.modal",function(e){$("#ezAlerts").remove(),a.resolve(t)}).on("shown.bs.modal",function(e){0<$("#prompt").length&&$("#prompt").focus()}).modal("show")}(),a.promise()}
		$(document).ready(function()
		{
			$("#btnAlert").on("click", function()
			{
			    var prom = ezBSAlert({
			      messageText: $(this).attr('tit').replace(/(?:\r\n|\r|\n)/g, '<br>'),
			      headerText: "INDEX ANNOUNCE - TEXT",
			      alertType: "warning"
			    });
		  	});   
		  $("#btnPrompt").on("click", function(b){
		  	var sid = $(this).attr('sid');
		    ezBSAlert({
		      type: "prompt",
		      placeHold: $(this).attr('tit'),
		      headerText: "INDEX ANNOUNCE - EDIT TITLE",
		      messageText: "Enter new title:",
		      alertType: "success"
		    }).done(function (e)
		    {
		    	if(e.length < 1) return 1;
		      	ezBSAlert({
			      	headerText: "INDEX ANNOUNCE - TITLE EDITED",
			        messageText: "New title: " + e,
			        alertType: "success"
		      });
	      		document.getElementById(sid).innerHTML=e;
	      		$.ajax({
		            url: _PAGE_URL + "admin/edittitle",
		            type: "POST",
		            data: { id:sid, title: e }
		        });
		    });
		  });
		  $("#btnPrompt2").on("click", function(b){
		  	var sid = $(this).attr('sid');
		    ezBSAlert({
		      type: "prompt",
		      placeHold: $(this).attr('tit'),
		      headerText: "INDEX ANNOUNCE - EDIT SECOND TITLE",
		      messageText: "Enter new second title:",
		      alertType: "success"
		    }).done(function (e)
		    {
		    	if(e.length < 1) return 1;
		      	ezBSAlert({
			      	headerText: "INDEX ANNOUNCE - SECOND TITLE EDITED",
			        messageText: "New second title: " + e,
			        alertType: "success"
		      });
	      		document.getElementById("s"+sid).innerHTML=e;
	      		$.ajax({
		            url: _PAGE_URL + "admin/editsectitle",
		            type: "POST",
		            data: { id:sid, title: e }
		        });
		    });
		  });
		  $("#btnPrompt3").on("click", function(b){
		  	var sid = $(this).attr('sid');
		    ezBSAlert({
		      type: "prompt",
		      placeHold: $(this).attr('tit'),
		      headerText: "INDEX ANNOUNCE - EDIT IMAGE",
		      messageText: "Enter new image link:",
		      alertType: "success"
		    }).done(function (e)
		    {
		    	if(e.length < 1) return 1;
		      	ezBSAlert({
			      	headerText: "INDEX ANNOUNCE - IMAGE EDITED",
			        messageText: "New image link: " + e,
			        alertType: "success"
		      });
	      		document.getElementById("x"+sid).src=e;
	      		$.ajax({
		            url: _PAGE_URL + "admin/editimg",
		            type: "POST",
		            data: { id:sid, title: e }
		        });
		    });
		  });
		});
		</script>

	</div>
</div>
	@endsection
@endsection