@extends('layouts.front')

@section('page_title')
DivineBlog :: Search Result
@endsection

@section('content')
<div class="col-lg-8 order-md-2">
    <section class="features-area pb-30">
        <div class="">
            <strong class="text-dark">Search Result: <span style="color: #f70d28;">"{{ $search_content }}"</span></strong>
            <div class="content-pad border pb-0">
                <div class="row">
                @if(count($posts) > 0)
                @foreach($posts as $post)
                <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="postbox mb-20">
                                    <div class="postbox__thumb">
                                        <a href="{{ route('single.post', $post->slug) }}">
                                            <img src="{{ asset('front/images/post/' . $post->image) }}" alt="{{ $post->alt }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="postbox__text mb-30">
                                    <h4 class="title-16 font-600 pr-0">
                                        <a href="{{ route('single.post', $post->slug) }}"> {!! Str::limit($post->title, 90) !!} </a> 
                                    </h4>
                                    <div class="postbox__text-meta pb-10">
                                        <ul>
                                            <li>
                                                <span class="post-cat">
                                                    <a href="{{ route('post.category', $post->category->slug) }}" tabindex="0">{{ $post->category->name }}</a>
                                                </span>
                                            </li>
                                            <li>
                                                <i class="fas fa-calendar-alt"></i>
                                                <span>{{ $post->created_at->format('d M Y') }}</span>
                                            </li>
                                            <li>
                                                <i class="far fa-comment"></i>
                                                <span>({{ count($post->comment->where('status', 1)) }})</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="desc-text mb-20">
                                        <p>
                                        {!! Str::limit($post->summery, 225) !!}
                                        </p>
                                    </div>
                                    <a href="{{ route('single.post', $post->slug) }}" class="btn btn-soft">read more</a>
                                </div>
                            </div>
                            
                @endforeach
                @else
                <p>No data found</p>
                @endif
                </div>
            </div>
        </div>
    </section>
    <div class="col-12 mb-5 text-center">
    {{ $posts->onEachSide(5)->links('front.pagination') }}
    </div>
</div>

@endsection
