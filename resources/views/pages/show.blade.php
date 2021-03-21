@extends('layouts.back') 
@section('title') 
Page Info Show
@endsection 
@section('page_title') 
Page Info Show
@endsection 

@section('top_btn')
<a href="{{ route('pages.edit', $page->label) }}" class="btn btn-info float-right" style="line-height: 22px; margin-right: 5px;">Edit page</a>
@endsection 

@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('pages.index') }}"><i class="zmdi zmdi-home"></i> All pages</a>
    </li>
    <li class="breadcrumb-item active">Page show</li>
</ul>
@endsection

@section('content')
<div class="container-fluid">
    <h1 style="font-size: 26px;"><span style="color: #ff4dab">{{ ucfirst($page->name) }}</span> page info</h1>
    <form method="post">
        <div class="card">
            <div class="body">
                <h2 class="card-inside-title">Page title</h2>
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">                                    
                            <input disabled type="text" class="form-control" placeholder="Page title" value="{{ $page->title }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="body">
                <h2 class="card-inside-title">Meta Keyword</h2>
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">                                    
                            <input disabled type="text" class="form-control" placeholder="Meta Keyword" value="{{ $page->meta_tag }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="body">
                <h2 class="card-inside-title">Meta Description</h2>
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">                                    
                            <input disabled type="text" class="form-control" placeholder="Meta Description" value="{{ $page->meta_des }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="body">
                <h2 class="card-inside-title">Another data ( Like OG Content )</h2>
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-line">
                                <textarea disabled rows="4" class="form-control" placeholder="Another data ( Like OG Content )">{{ $page->another }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>                        
            </div>
        </div>

    </form>   
</div>
@endsection
