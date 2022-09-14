@extends('layouts.master',['f' => true])

@section('breadcrumb',General::forumBreadcrumb())

@section('content')

<div class="forum_buttons">
	<button class="btn btn-success btn-sm _new_topic" id="{{ $cat_id }}" @if(!Auth::check()) disabled="disabled" @endif>{{ Lang::get('forum.new_topic') }}</button>
</div>
<div class="row">
	<div class="ibox-content forum-container">
		@if(count($subcats))
			<div class="forum-title">
	            <h3>{{ Lang::get('forum.subforums') }}</h3><hr>
	        </div>
			@foreach($subcats as $subcat)
		        <div class="forum-item">
		            <div class="row">
		                <div class="col-md-9">
		                    <div class="forum-icon">
		                        <i class="fa fa-{{ $subcat->icon }}" style="color:{{ $subcat->sub_icon_color }};"></i>
		                    </div>
		                    <a href="{{ URL::to('forum',[General::formatUrl($subcat->id,$subcat->name)]) }}" class="forum-item-title">{{ $subcat->name }}</a>
		                    <div class="forum-sub-title">{{ $subcat->description }}</div>
		                </div>

		                <div class="col-md-2 forum-info">
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
		            </div>
		        </div>
	       	@endforeach
	    @endif
	    @if(count($topics) || count($pinned))
	       	<div class="forum-title">
	            <h3>{{ Lang::get('forum.topics') }}</h3><hr>
	        </div>  
	        @foreach($pinned as $pin)
			    <div class="forum-item-topic">
			        <div class="row">
			            <div class="col-md-9">
			                <div class="forum-icon">
			                    <i class="fa fa-star"></i>
			                </div>
			                <a href="{{ URL::to('forum/topic',[General::formatUrl($pin->id,$pin->name)]) }}" class="forum-item-title-topic">{{ $pin->name }}</a>
			                <div class="forum-sub-title">{{ Lang::get('forum.created_by') }} <b>{{ $pin->user->Name }}</b>, {{ $pin->created }}</div>
			            </div>

			            <div class="col-md-3 forum-info" style="text-align:inherit;">
			            	<?php $last = $pin->LastReply(); ?>
			            	@if($last)
			                	<div style="display: inline-block;">
				                	<img alt="image" data-original="{{ $last->user->profile->avatar }}" class="forum-avatar-little"/>
				                	</div>
			                    <div style="display: inline-block; vertical-align: middle;">
			                    	 <div>{{ $last->created }} by {!! $last->user->url !!}</div>
			                    	 <div>{{ $pin->TotalReplies }} {{ Lang::choice('forum.replies',$pin->TotalReplies) }}</div>
			                    </div>
			               @endif     
			            </div>
			        </div>
			    </div>
			@endforeach
			@if(count($pinned)) <hr> @endif
	      	@foreach($topics as $topic)
		        <div class="forum-item-topic">
		            <div class="row">
		                <div class="col-md-9">
		                    <div class="forum-icon">
		                        <i class="fa @if($topic->locked) fa-lock @else fa-align-left @endif"></i>
		                    </div>
		                    <a href="{{ URL::to('forum/topic',[General::formatUrl($topic->id,$topic->name)]) }}" class="forum-item-title-topic">{{ $topic->name }}</a>
		                    <div class="forum-sub-title">{{ Lang::get('forum.created_by') }} <b>{{ $topic->user->Name }}</b>, {{ $topic->created }}</div>
		                </div>

		                <div class="col-md-3 forum-info" style="text-align:inherit;">
		                	<?php $last = $topic->LastReply(); ?>
		                	@if($last)
			                	<div style="display: inline-block;">
				                	<img alt="image" data-original="{{ $last->user->profile->avatar }}" class="forum-avatar-little"/>
				                	</div>
			                    <div style="display: inline-block; vertical-align: middle;">
			                    	 <div>{{ $last->created }} by {!! $last->user->url !!}</div>
			                    	 <div>{{ $topic->TotalReplies }} {{ Lang::choice('forum.replies',$topic->TotalReplies) }}</div>
			                    </div>
			               @endif     
		                </div>
		            </div>
		        </div>
	       @endforeach
	       {!! $topics->render() !!}
		@endif
	</div>
</div>
@section('js')
<script src="{{ asset('assets/jm.min.js') }}"></script>
<script src="{{ asset('assets/bt.min.js') }}"></script>
<script src="{{ asset('assets/bootbox.min.js') }}"></script>
<script src="{{ asset('assets/smn.min.js') }}"></script>
<script src="{{ asset('assets/forum.js') }}"></script>
@endsection

@endsection