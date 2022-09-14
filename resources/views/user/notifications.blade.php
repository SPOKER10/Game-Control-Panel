@if($notif == false)


<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
    <i class="fa fa-bell"></i>
</a>
<ul class="dropdown-menu dropdown-alerts">
    <li>
        <a href="#">
            <div>
                <i class="fa fa-envelope fa-fw"></i> Notificari
            </div>
        </a>
    </li>
    <li>
        <div class="text-center link-block">
            <a href="{{ URL::to('user/notifications') }}">
                <strong>{{ Lang::get('general.show_more') }}</strong>
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </li>
</ul>


@else

{!! $notif !!}

@endif

