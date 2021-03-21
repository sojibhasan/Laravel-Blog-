@extends('layouts.back') @section('title') Blog Create @endsection @section('page_title') Post show @endsection @section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Post</a></li>
    <li class="breadcrumb-item active">Single Post</li>
</ul>
@endsection @section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="blogitem mb-5">
                    <div class="blogitem-image">
                        <a href="blog-details.html"><img src="{{ asset('front/images/post/' . $post_info->image) }}" alt="blog image" /></a>
                        <span class="blogitem-date">{{ $post_info->created_at->format("F j, Y, g:i a") }}</span>
                    </div>
                    <div class="blogitem-content">
                        <div class="blogitem-header">
                            <div class="blogitem-meta">
                                <span><i class="zmdi zmdi-account"></i>By {{ $post_info->user->profile->name }}</span>
                                <span><i class="zmdi zmdi-comments"></i>Comments(3)</span>
                                <span><i class="zmdi zmdi-bookmark"></i>{{ $post_info->category->name }}</span>
                            </div>
                        </div>
                        <h5><a href="javascript:void(0);">{!! $post_info->title !!}</a></h5>
                        <p>{!! $post_info->summery !!}</p>
                        {!! $post_info->content !!}
                    </div>
                </div>
            </div>

            @if(count($comments) > 0)
            <!-- post-comments -->
            <div class="card bg-white text-dark p-3">
                <div class="header mb-5">
                    <h2><strong>Recent Comments ( {{ $comment_count }} ) </strong></h2>
                </div>
                <div class="latest-comments">
                    <ul class="comment-reply list-unstyled">
                        @foreach($comments as $comment)
                        <li style="flex-wrap: wrap; margin-bottom: 30px;">
                            <div class="icon-box"><img class="img-fluid img-thumbnail" src="{{ asset('back/images/sm/avatar2.jpg') }}" alt="Awesome Image" /></div>
                            <div class="text-box">
                                <h5>{{ ucwords($comment->name) }}</h5>
                                <span class="comment-date">{{ $comment->created_at->format('d F Y, h:i:s A') }}</span>
                                <a comment-id="{{ $comment->id }}" href="javascript:void(0);" class="replybutton reply-btn"><i class="zmdi zmdi-mail-reply-all"></i> Reply</a>
                                <p>{{ $comment->comment }}</p>
                            </div>
                            @if(count($comment->reply) > 0)
                            <ul class="comments-reply" style="margin-top: 30px; width: 100%;">
                                @foreach($comment->reply->where('status', 1) as $reply)
                                <li style="flex-wrap: wrap;">
                                    <div class="icon-box"><img class="img-fluid img-thumbnail" src="{{ asset('back/images/sm/avatar2.jpg') }}" alt="Awesome Image" /></div>
                                    <div class="text-box">
                                        <h5>{{ ucwords($reply->name) }}</h5>
                                        <span class="comment-date">{{ $reply->created_at->format('d F Y, h:i:s A') }}</span>
                                        <a comment-id="{{ $comment->id }}" href="javascript:void(0);" class="replybutton reply-btn"><i class="zmdi zmdi-mail-reply-all"></i> Reply</a>
                                        <p>{{ $reply->comment }}</p>
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
            <div class="card post-comments-form">
                <div class="header mb-5">
                    <h2><strong>Leave your comment </strong></h2>
                </div>
                <form action="{{ route('comment') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xl-6 d-none" style="margin-bottom: 25px;">
                            <input type="hidden" placeholder="Your Name" name="name" value="{{ Auth::user()->profile->name }}" />
                            @if($errors->has('name'))
                            <span style="color: red;">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="col-xl-6 d-none" style="margin-bottom: 25px;">
                            <input type="hidden" placeholder="Your Email" name="email" value="{{ Auth::user()->email }}" />
                            @if($errors->has('email'))
                            <span style="color: red;">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="d-none">
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                            <input type="hidden" name="p_id" value="0" />
                            <input type="hidden" name="admin" value="1" />
                        </div>

                        <div class="form-group col-12">
                            <textarea name="comment" id="comments" rows="4" class="form-control w-100" placeholder="Please type what you want..."></textarea>
                            @if($errors->has('comment'))
                            <span style="color: red; display: block;">{{ $errors->first('comment') }}</span>
                            @endif
                        </div>

                        <div class="col-xl-12">
                            <button class="btn btn-success" type="submit">Send comment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Categories</strong></h2>
                </div>
                <div class="body">
                    <ul class="list-unstyled mb-0 widget-categories">
                        @foreach($categories as $category)
                        <li><a href="{{ route('post.category', $category->slug) }}">{{ ucwords($category->name) }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="header">
                    <h2><strong>Recent</strong> Posts</h2>
                </div>
                <div class="body">
                    <ul class="list-unstyled mb-0 widget-recentpost">
                        @foreach($recent_post as $post)
                        <li>
                            <a href="blog-details.html"><img src="{{ asset('front/images/post/' . $post->image) }}" alt="$post->alt" /></a>

                            <div class="recentpost-content">
                                <a href="{{ url('admin/post', $post->id) }}">{{ Str::limit($post->title, 25) }} ...</a>
                                <span>{{ $post->created_at->format('M d yy') }}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="header">
                    <h2><strong>Tag</strong> Clouds</h2>
                </div>
                <div class="body">
                    <ul class="list-unstyled mb-0 tag-clouds">
                        @foreach($post_info->tag as $tag)
                        <li><a target="_blank" href="{{ url('post/tag', $tag->slug) }}" class="tag badge badge-info">{{ ucwords($tag->name) }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let getMainForm = document.getElementsByClassName("post-comments-form")[0];
    var cln = getMainForm.cloneNode(true);
    for (let btn of document.getElementsByClassName("reply-btn")) {
        btn.addEventListener("click", function () {
            this.parentElement.parentElement.append(cln);
            cln.querySelector("h2").innerHTML = "reply comment";
            this.parentElement.parentElement.querySelector('[name="p_id"]').setAttribute("value", this.getAttribute("comment-id"));
        });
    }
</script>

@endsection
