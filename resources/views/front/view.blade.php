@extends('layouts.front') 
@section('page_title') 
DivineBlog :: Single Post 
@endsection 
@section('content')
<div class="col-xl-8 col-lg-8">
    <!-- post-details -->
    <div class="post-details">
        <h2 class="details-title mb-15">{{ Str::limit($post->title, 80) }}</h2>

        <!-- meta -->
        <div class="postbox__text-meta pb-30">
            <ul>
                <li>
                    <i class="far fa-user-circle"></i>
                    <span>{{ $post->user->profile->name }}</span>
                </li>
                <li>
                    <i class="fas fa-calendar-alt"></i>
                    <span>{{ $post->created_at->format('d-M-Y') }}</span>
                </li>
                <li>
                    <i class="far fa-comment"></i>
                    <span>( {{ count($post->comment) }} )</span>
                </li>
            </ul>
        </div>

        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <div style="margin-bottom: 30px;" class="addthis_inline_share_toolbox_ipfb"></div>

        <!-- post-thumb -->
        <div class="post-thumb mb-25">
            <img class="img-fluid w-100" src="{{ asset('front/images/post/' . $post->image) }}" alt="{{ $post->alt }}" />
        </div>

        <!-- post-content -->
        <div class="post-content">
            <h4 style="margin-bottom: 30px;">{!! $post->title !!}</h4>
            {!! $post->summery !!}
            <br>
            {!! $post->content !!}
        </div>

        <!-- s-content__pagenav -->
        <div class="s-content__pagenav mt-60">
            <div class="s-content__nav">
                <div class="row">
                    <div class="col-md-6">
                        <div class="s-content__prev mb-30">
                            @if($prev)
                            <a href="{{ route('single.post', $prev->slug) }}" rel="prev">
                                <span>Previous Post</span>
                                {!! Str::limit($prev->title, 60) !!}
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="s-content__next mb-30 text-left text-md-right">
                            @if($next)
                            <a href="{{ route('single.post', $next->slug) }}" rel="prev">
                                <span>Next Post</span>
                                {!! Str::limit($next->title, 60) !!}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- also-like -->
        @if(count($posts) > 1)
        <div class="also-like mt-30">
            <div class="section-title mb-30">
                <h2>You may also like</h2>
            </div>
            <div class="row">
                @foreach($posts as $r_post)
                <div class="col-lg-4 col-md-4">
                    <div class="postbox mb-30">
                        <div class="postbox__thumb">
                            <a href="{{ route('single.post', $r_post->slug) }}">
                                <img class="img-100" src="{{ asset('front/images/post/' . $r_post->image) }}" alt="{{ $r_post->alt }}" />
                            </a>
                        </div>
                        <div class="postbox__text pt-10">
                            <div class="postbox__text-meta pb-10">
                                <ul>
                                    <li>
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>{{ $r_post->created_at->format('d M yy') }}</span>
                                    </li>
                                    <li>
                                        <i class="far fa-comment"></i>
                                        <span>( {{ count($r_post->comment) }} )</span>
                                    </li>
                                </ul>
                            </div>
                            <h4 class="pr-0">
                                <a href="{{ route('single.post', $r_post->slug) }}">{!! Str::limit($post->title, 90) !!}</a>
                            </h4>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- post-comments -->        
        @if(count($comments) > 0)
        <div class="post-comments mt-30">
            <div class="section-title mb-30">
                <h2>Recent Comments ( {{ $comment_count }} )</h2>
            </div>
            <div class="latest-comments">
                <ul>
                    @foreach($comments as $comment)
                    <li>
                        <div class="comments-box">
                            <div class="comments-avatar">
                                <img src="{{ asset('front/images/comment-icon.png') }}" alt="comment-icon" />
                            </div>
                            <div class="comments-text">
                                <div class="avatar-name">
                                    <h5>{{ ucwords($comment->name) }}</h5>
                                    <span>{{ $comment->created_at->format('d F Y, h:i:s A') }}</span>
                                </div>
                                <p>{{ $comment->comment }}</p>
                               <a class="reply-btn" data-id="{{ $comment->id }}" href="javascript:void(0);"><i class="fas fa-reply-all"></i> Reply</a>
                            </div>
                        </div>
                        @if(count($comment->reply) > 0)
                        <ul class="comments-reply">
                            @foreach($comment->reply->where('status', 1) as $reply)
                            <li>
                                <div class="comments-box">
                                    <div class="comments-avatar">
                                    <img src="{{ asset('front/images/comment-icon.png') }}" alt="comment-icon" />
                                    </div>
                                    <div class="comments-text">
                                        <div class="avatar-name">
                                            <h5>{{ $reply->name }}</h5>
                                            <span>{{ $reply->created_at->format('d F Y, h:i:s A') }}</span>
                                        </div>
                                        <p>{{ $reply->comment }}</p>
                                        <a data-id="{{ $comment->id }}" class="reply-btn" href="javascript:void(0);"><i class="fas fa-reply-all"></i> Reply</a>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <!-- post-comments-form -->
        <div class="post-comments-form mt-40 mb-40">
            <div class="section-title mb-30">
                <h2>Your comment</h2>
            </div>
            <form action="{{ route('comment') }}" method="POST" >
                @csrf
                <div class="row">
                    <div class="col-xl-6" style="margin-bottom: 25px;">
                        <input type="text" placeholder="Your Name" name="name" />
                        @if($errors->has('name'))
                        <span style="color: red;">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-6" style="margin-bottom: 25px;">
                        <input type="email" placeholder="Your Email" name="email" />
                        @if($errors->has('email'))
                        <span style="color: red;">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="d-none">
                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        <input type="hidden" name="p_id" value="0" />
                    </div>
                    <div class="col-xl-12" style="margin-bottom: 25px;">
                        <textarea name="comment" id="comments" cols="30" rows="10" placeholder="Your Comments"></textarea>
                        @if($errors->has('comment'))
                        <span style="color: red; display: block;">{{ $errors->first('comment') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-12">
                        <button class="btn brand-btn" type="submit">Send message</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>


<script>
    let getMainForm = document.getElementsByClassName('post-comments-form')[0];
    var cln = getMainForm.cloneNode(true);
    for(let btn of document.getElementsByClassName('reply-btn')) {
        btn.addEventListener('click', function() {
            this.parentElement.parentElement.append(cln);
            cln.querySelector('h2').innerHTML = 'reply comment';
            this.parentElement.parentElement.querySelector('[name="p_id"]').setAttribute('value', this.getAttribute('data-id'));
        });
    } 
</script>



@endsection @section('tags')
<div class="widget widget-border mb-40">
    <h3 class="widget-title">Popular Tags</h3>
    <div class="tagcloud">
        @foreach($tags as $tag)
        <a href="{{ route('post.tag', $tag->slug) }}">{{ ucwords($tag->name) }}</a>
        @endforeach
    </div>
</div>
@endsection

@section('custom_js')
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5fe457938288c7f3"></script>

@endsection
