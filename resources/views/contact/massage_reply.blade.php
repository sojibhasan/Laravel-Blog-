@extends('layouts.back') @section('title') Contact @endsection @section('page_title') Contact Info @endsection @section('css_plugins')
<link rel="stylesheet" href="{{ asset('back/plugins/summernote/dist/summernote.css') }}" />
@endsection @section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item active"><a href="{{ route('contact.index') }}">All Contact Info</a></li>
    <li class="breadcrumb-item active">Show</li>
</ul>
@endsection @section('content')
<div class="container-fluid">
    <!-- Exportable Table -->
    <form action="{{ route('contact.reply.send') }}" method="POST">
        @csrf
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="form-row">
                            <div class="col-lg-6">
                                <label for="name">To: Name</label>
                                <div class="form-group">
                                    <input type="text" id="name" disabled class="form-control" value="{{ $info->name }}" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="email">To: Email Address</label>
                                <div class="form-group">
                                    <input name="email" type="text" id="email" disabled class="form-control" value="{{ $info->email }}" />
                                    <input name="email" class="d-none" value="{{ $info->email }}" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label for="subject">Subject</label>
                                <div class="form-group">
                                    <input type="text" id="subject" name="subject" class="form-control" value="{{ old('subject') }}" placeholder="Your subject" />
                                    @if($errors->has('subject'))
                                    <span style="color: red;">{{ $errors->first('subject') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label>Massage</label>
                                <textarea class="form-control summernote" id="meta_des" rows="4" placeholder="Meta Description" name="content"></textarea>
                                @if($errors->has('content'))
                                <span style="color: red;">{{ $errors->first('content') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-12 mt-1">
                                <button type="submit" class="btn btn-primary">Send Reply</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection @section('custom_js')
<script src="{{ asset('back/plugins/summernote/dist/summernote.js') }}"></script>
@endsection
