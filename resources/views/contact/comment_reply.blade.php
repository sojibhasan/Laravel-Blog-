@extends('layouts.back') 
@section('title') 
Reply comment 
@endsection 
@section('page_title') 
Reply comment 
@endsection 
@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item active"><a href="{{ route('contact.index') }}">All Contact Info</a></li>
    <li class="breadcrumb-item active">Show</li>
</ul>
@endsection 
@section('content')
<div class="container-fluid">
    <!-- Exportable Table -->
    <form action="{{ route('comment.reply.send', $comment->id) }}" method="POST">
        @csrf
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="form-row">
                            <div class="col-lg-6">
                                <label for="name">Name</label>
                                <div class="form-group">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" />
                                    @if($errors->has('name'))
                                    <span style="color: red;">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="email">Email Address</label>
                                <div class="form-group">
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Email" />
                                    @if($errors->has('email'))
                                    <span style="color: red;">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label>Comment</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea name="comment" rows="4" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                                        @if($errors->has('comment'))
                                        <span style="color: red;">{{ $errors->first('comment') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="id" value="{{ $comment->id }}" />
                                    <input type="hidden" name="post_id" value="{{ $comment->post_id }}" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-primary">Publish Reply</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
