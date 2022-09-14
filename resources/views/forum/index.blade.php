@extends('layouts.master',['f' => true])

@section('breadcrumb',General::forumBreadcrumb())

@section('content')
<div class="row">
    <div class="ibox-content m-b-sm border-bottom">
        <div class="p-xs">
            <div class="pull-left m-r-md">
                <i class="fa fa-globe text-navy mid-icon"></i>
            </div>
            <h2>{{ Config::get('app.app_name') }}</h2>
            <span>{{ Lang::get('messages.forum_index') }}</span>
        </div>
    </div>

    <div class="ibox-content forum-container border-bottom">
   
    	@foreach($categories as $category)
    		<div class="forum-title">
	            <h3><i class="fa fa-{{ $category->icon }}"></i> {{ $category->name }}</h3>
	        </div>
	        @foreach($category->subcats as $subcat)
		        <div class="forum-item">
		            <div class="row">
		                <div class="col-md-7">
		                    <div class="forum-icon">
		                        <i class="fa fa-{{ $subcat->icon }}" style="color:{{ $subcat->sub_icon_color }};"></i>
		                    </div>
		                    <a href="{{ URL::to('forum',[General::formatUrl($subcat->id,$subcat->name)]) }}" class="forum-item-title">{{ $subcat->name }}</a>
		                    <div class="forum-sub-title">{{ $subcat->description }}.</div>
		                </div>

		                <div class="col-md-1 forum-info">
		                    <span class="views-number">
		                        {{ $subcat->countTopics() }}
		                    </span>
		                    <div>
		                        <small>{{ Lang::get('forum.topics') }}</small>
		                    </div>
		                </div>
		                <div class="col-md-1 forum-info">
		                    <span class="views-number">
		                        {{ $subcat->countPosts() }}
		                    </span>
		                    <div>
		                        <small>{{ Lang::get('forum.posts') }}</small>
		                    </div>
		                </div>
		                <div class="col-md-3 forum-info" style="text-align:initial;">
		                	<?php $t = $subcat->lastPost(); ?>
		                	@if($t)
			                    <a href="{{ URL::to('forum/topic',[General::formatUrl($t->id,$t->name)]) }}" class="forum-item-title-topic"><small>{{ $t->name }}</small></a>
			                    <div>
			                        <small>{{ $t->lastReply()->created }} by {!! $t->lastReply()->user->url !!}</small>
			                    </div>
			                @endif 
		                </div>
		            </div>
		        </div>
	        @endforeach
    	@endforeach

        
	</div>
	 <div class="ibox-content m-b-md m-t-md border-bottom" style="padding: 15px 20px 15px 20px;">
        <div class="row">
            <div class="col-sm-12">
		        <div class="col-sm-3"><button type="button" class="btn btn-danger m-r-sm btn-sm">{{ \App\Topic::count() }}</button>{{ Lang::get('forum.topics') }}</div>
		        <div class="col-sm-3"><button type="button" class="btn btn-danger m-r-sm btn-sm">{{ \App\Post::where('post_first','0')->count() }}</button>{{ Lang::get('forum.posts') }}</div>
		        <div class="col-sm-3"><button type="button" class="btn btn-danger m-r-sm btn-sm">{{ \App\User::count() }}</button>{{ Lang::get('forum.members') }}</div>
		        <div class="col-sm-3"><button type="button" class="btn btn-danger m-r-sm btn-sm">{!! \App\User::orderBy('playerID', 'desc')->first()->url !!}</button>{{ Lang::get('forum.last_member') }}</div>
		    </div>
        </div>
    </div>

</div>

@endsection