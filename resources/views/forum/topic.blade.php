@extends('layouts.master',['f' => true])

@section('breadcrumb',General::forumBreadcrumb())

@section('content')

@section('css')
	<link href="{{ asset('assets/css/smn.css') }}" rel="stylesheet">
@endsection

<div class="forum_buttons">
	<button class="btn btn-success btn-sm _new_reply" id="{{ $topic->id }}" sub-id="{{ $topic->subcat }}" last="{{ $posts->lastPage() }}" @if(!Auth::check() || $topic->locked) disabled="disabled" @endif>{{ Lang::get('forum.new_reply') }}</button>
</div>
<div class="row">
	{!! $posts->render() !!}
    <div class="ibox-content forum-container" style="background-color:#F5F5F5;">
    		<div class="forum-title">
	            <h3><span class="_title">Topic - {{ $topic->name }}</span>
	            	@if(Auth::check())
				        @if(\App\Subcat::find($topic->subcat)->perm(Auth::user()))
					        <span class="forum-tools" style="padding:0;">
					        	@if($topic->locked)
					        	<i class="fa fa-unlock fa-fw _unlock_topic" sub-id="{{ $topic->subcat }}" id="{{ $topic->id }}"></i>
					        	<i class="fa fa-lock fa-fw _lock_topic" sub-id="{{ $topic->subcat }}" id="{{ $topic->id }}" style="display: none;"></i>
					        	@else
					        		<i class="fa fa-unlock fa-fw _unlock_topic" sub-id="{{ $topic->subcat }}" id="{{ $topic->id }}" style="display: none;"></i>
					        	<i class="fa fa-lock fa-fw _lock_topic" sub-id="{{ $topic->subcat }}" id="{{ $topic->id }}"></i>
					        	@endif
					        	@if($topic->pinned)
			            			<i class="fa fa-thumb-tack fa-fw _pin_topic" sub-id="{{ $topic->subcat }}" id="{{ $topic->id }}" style="display:none;"></i>
			            			<i class="fa fa-minus-square fa-fw _unpin_topic" sub-id="{{ $topic->subcat }}" id="{{ $topic->id }}"></i>
			            		@else
			            			<i class="fa fa-thumb-tack fa-fw _pin_topic" sub-id="{{ $topic->subcat }}" id="{{ $topic->id }}"></i>
			            			<i class="fa fa-minus-square fa-fw _unpin_topic" sub-id="{{ $topic->subcat }}" id="{{ $topic->id }}" style="display:none;"></i>
			            		@endif

			            		<i class="fa fa-trash fa-fw _delete_topic" sub-id="{{ $topic->subcat }}" id="{{ $topic->id }}"></i>
				            </span>
				        @endif
				        @if(Auth::user()->id == $topic->user->id || \App\Subcat::find($topic->subcat)->perm(Auth::user()))
				       	 <span class="forum-tools" style="padding:0;">
				        	<i class="fa fa-edit fa-fw _edit_topic" title="{{ $topic->name }}" sub-id="{{ $topic->subcat }}" id="{{ $topic->id }}"></i>
				        	</span>	
				        @endif	
				    @endif
	            </h3>
	        </div>
	        @foreach($posts as $post)
		        <div class="media reply-{{ $post->id }}">
		        	@if(Auth::check())
		        		@if(\App\Subcat::find($topic->subcat)->perm(Auth::user()))
					        <span class="forum-tools">
			            		<i class="fa fa-history fa-fw _history_reply" sub-id="{{ $topic->subcat }}" id="{{ $post->id }}"></i>
			            		<i class="fa fa-trash fa-fw _delete_reply" sub-id="{{ $topic->subcat }}" id="{{ $post->id }}"></i>
				            </span>
				        @endif
		        		@if(Auth::user()->id == $post->user->id || \App\Subcat::find($topic->subcat)->perm(Auth::user()))
		        			<span class="forum-tools">
		        			<i class="fa fa-save fa-fw _save_reply" sub-id="{{ $topic->subcat }}" id="{{ $post->id }}" style="display: none;"></i>
			            		<i class="fa fa-edit fa-fw _edit_reply" sub-id="{{ $topic->subcat }}" id="{{ $post->id }}"></i>
			            	</span>	
		        		@endif
				    @endif    
					<div class="forum-post-info">
						<span class="text-navy"><h4><i class="fa fa-user"></i> {!! $post->user->url !!}</h4></span>
					</div>
					<div class="forum-avatar">
						
						<div class="forum1" style="width: 170px;">
							<img data-original="{{ $post->user->profile->avatar }}" class="forum-avatar-img" style="padding: 9px" alt="image">
							<div class="author-info">

								<div class="forum-user">

									<dl class="forum-user-info">
										<li class="post_count desc lighter">
											<dt><i class="fa fa-comments"> </i> Postari:</dt>
											<dd>{{ $post->user->profile->posts }}</dd>
										</li>
									</dl>
									<dl class="forum-user-info">
										<li class="post_count desc lighter">
											<dt><i class="fa fa-calendar"> </i> Inregistrat:</dt>
											<dd>{{ $post->user->profile->joined }}</dd>
										</li>
									</dl>


									<dl class="forum-user-info">
										<li class="post_count desc lighter">
											<dt><i class="fa fa-users"> </i> Factiune:</dt>
											<dd>{{ $post->user->factionShort }}</dd>
										</li>
									</dl>

									<dl class="forum-user-info">
										<li class="post_count desc lighter">
											<dt><i class="fa fa-hand-rock-o"> </i> Clan:</dt>
											<dd> {{ $post->user->clan }}</dd>
										</li>
									</dl>



									<dl class="forum-user-info">
										<li class="post_count desc lighter">
											<dt><i class="fa fa-thumbs-up"> </i> Reputatie:</dt>
											<dd>{{ $post->user->profile->reputation }}</dd>
										</li>
									</dl>

									<dl class="forum-user-info">
										<li class="post_count desc lighter">
											<dt><i class="fa fa-star"> </i> V.I.P.:</dt>
											<dd>{{ $post->user->vip }}</dd>
										</li>
									</dl>

								</div>
							</div>

						</div>
					</div>
					<div class="media-body _reply-{{ $post->id }}">{!! $post->content !!}</div>  
			</div>
        	@endforeach
	</div>
	{!! $posts->render() !!}
</div>

@section('js')
<script src="{{ asset('assets/jm.min.js') }}"></script>
<script src="{{ asset('assets/bt.min.js') }}"></script>
<script src="{{ asset('assets/bootbox.min.js') }}"></script>
<script src="{{ asset('assets/smn.min.js') }}"></script>
<script src="{{ asset('assets/forum.js') }}"></script>


@endsection

@endsection