@extends('layouts.back') 
@section('title') 
Page Info Edit
@endsection 
@section('page_title') 
Page Edit
@endsection 

@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('pages.index') }}"><i class="zmdi zmdi-home"></i> All pages</a>
    </li>
    <li class="breadcrumb-item active">Page edit</li>
</ul>
@endsection

@section('content')
<div class="container-fluid">
    <h1 style="font-size: 26px;">Edit your <span style="color: #ff4dab">{{ ucfirst($page->name) }}</span> page</h1>
    <form method="post" id="update-form" action="{{ route('pages.update', $page->label) }}">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="body">
                <h2 class="card-inside-title">Page title</h2>
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">                                    
                            <input type="text" name="title" class="form-control" placeholder="Page title" value="{{ old('title') ? old('title') : $page->title }}"/>
                            @if($errors->has('title'))
                            <span style="color: red;">{{ $errors->first('title') }}</span>
                            @endif
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
                            <input type="text" name="meta_tag" class="form-control" placeholder="Meta Keyword" value="{{ old('meta_tag') ? old('meta_tag') : $page->meta_tag }}"/>
                            @if($errors->has('meta_tag'))
                            <span style="color: red;">{{ $errors->first('meta_tag') }}</span>
                            @endif
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
                            <input type="text" name="meta_des" class="form-control" placeholder="Meta Description" value="{{ old('meta_des') ? old('meta_des') : $page->meta_des }}" />
                            @if($errors->has('meta_des'))
                            <span style="color: red;">{{ $errors->first('meta_des') }}</span>
                            @endif
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
                                <textarea rows="4" name="another" class="form-control" placeholder="Another data ( Like OG Content )">{{ old('another') ? old('another') : $page->another }}</textarea>
                                @if($errors->has('another'))
                                <span style="color: red;">{{ $errors->first('another') }}</span>
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
                        <a href="javascript:void(0);" class="btn btn-info" id="update-btn">Update Page Info</a>
                    </div>
                </div>                        
            </div>
        </div>


    </form>   
</div>
@endsection

@section('custom_js')
<script>
    let btn = document.getElementById('update-btn');
     btn.addEventListener("click", function () {
            swal({
                title: "Are you sure?",
                text: "Please check your imported data then click OK",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    swal("Updating process in progress.", {
                        icon: "success",
                    });
                    document.getElementById('update-form').submit();
                } else {
                    swal("Your page content is safe and unchanged!");
                }
            });
        });
</script>
@endsection