@extends('layouts.back')

@section('title')
Image Gallery
@endsection

@section('page_title')
Image Gallery
@endsection

@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
    <li class="breadcrumb-item active">Gallery</li>
</ul>
@endsection


@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-sm-12">
            <div class="card">
                <div class="body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs p-0 mb-3">
                        <li class="nav-item"><a class="text-uppercase nav-link" href="{{ route('gallery.blogs') }}">Blog</a></li>
                        <li class="nav-item"><a class="text-uppercase nav-link active" href="javascript:void(0);">User</a></li>
                        <li class="nav-item"><a class="text-uppercase nav-link" href="{{ route('gallery.sliders') }}">Slider</a></li>
                    </ul>                        
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane in active" id="home">
                            <h4>User Images</h4>
                            <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                @foreach($users as $user)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-b-30"><img style="height: 250px;" class="img-fluid img-thumbnail" src="{{ $user->image == '' ? asset('back/images/image-gallery/1.jpg') : $user->image }}" alt="user image"></div>
                                @endforeach
                                <div class="col-12">
                                    <div class="card">
                                        {{ $users->onEachSide(5)->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection