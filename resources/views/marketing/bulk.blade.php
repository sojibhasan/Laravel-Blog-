@extends('layouts.back') @section('title') Marketing - Bulk @endsection @section('page_title') Marketing - Bulk @endsection @section('custom_css')
<link rel="stylesheet" href="{{ asset('back/plugins/summernote/dist/summernote.css') }}" />
<link rel="stylesheet" href="{{ asset('back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" />
@endsection @section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Marketing - Bulk</li>
</ul>
@endsection @section('content')
<div class="container-fluid">
    <form action="{{ route('bulkMail') }}" method="POST">
        @csrf
        <div class="row clearfix">
            <div class="col-sm-12">
                <div class="card">
                    <div class="body">
                        <h2 class="card-inside-title">Subject</h2>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input name="subject" type="text" class="form-control" placeholder="Subject" value="{{ old('subject') }}" />
                                    @if($errors->has('subject'))
                                    <span style="color: red;">{{ $errors->first('subject') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="body">
                        <h2 class="card-inside-title">Input all email separated by (,)</h2>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group border">
                                    <input id="email" type="text" name="email" data-role="tagsinput" class="form-control" placeholder="To:" value="{{ old('emeil') }}" />
                                </div>
                                @if($errors->has('email'))
                                <span style="color: red;">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="body">
                        <h2 class="card-inside-title">Email Content</h2>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea name="content" rows="4" class="form-control no-resize summernote" placeholder="Please type what you want..."></textarea>
                                        @if($errors->has('content'))
                                        <span style="color: red;">{{ $errors->first('content') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Send Mail</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection @section('custom_js')
<script src="{{ asset('back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<!-- Bootstrap Tags Input Plugin Js -->
<script src="{{ asset('back/plugins/summernote/dist/summernote.js') }}"></script>
@endsection
