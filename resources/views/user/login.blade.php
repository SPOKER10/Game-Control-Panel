@extends('layouts.master')
@section('breadcrumb','Login')
@section('content')
<div class="panel panel-success">
<div class="col-sm-4 col-sm-offset-4">
    <center><h3><b>RPG.LINKMANIA.RO</b></h3></center>
    <form class="m-t" role="form" action="" method="post" style="color:#000;">
    	<div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user" style="font-size:12px;"></i></span>
                <input type="text" class="form-control" name="login_username" placeholder="Username" required="">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" name="login_password" placeholder="Password" required="">
            </div>
        </div>
        {{ csrf_field() }}
        <input type="submit" class="btn btn-primary block full-width m-b" value="Login" name="submit"></input>
    </form>
    <center><a href="{{ URL::to('user/forgot') }}"><small>Forgot Password</small></a></center>
</div>
</div>
@endsection