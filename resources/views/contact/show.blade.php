@extends('layouts.back') @section('title') Contact @endsection @section('page_title') Contact Info @endsection @section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item active"><a href="{{ route('contact.index') }}">All Contact Info</a></li>
    <li class="breadcrumb-item active">Show</li>
</ul>
@endsection @section('top_btn')
<a href="{{ route('contact.reply', $info->id) }}" class="btn btn-primary float-right" style="line-height: 22px; margin-right: 5px;">Reply</a>
@endsection @section('content')
<div class="container-fluid">
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    <div class="form-row">
                        <div class="col-lg-6">
                            <label for="name">Name</label>
                            <div class="form-group">
                                <input type="text" id="name" disabled class="form-control" value="{{ $info->name }}" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Email Address</label>
                            <div class="form-group">
                                <input type="text" id="email" disabled class="form-control" value="{{ $info->email }}" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="subject">Subject</label>
                            <div class="form-group">
                                <input type="text" disabled id="subject" class="form-control" value="{{ $info->subject }}" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="massage">Massage</label>
                            <div style="font-size: 14px; border: 1px solid #ced4da; border-radius: 0.25rem; padding: 0.375rem 0.75rem; background-color: #e9ecef; line-height: 1.8;">
                                {{ $info->content }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
