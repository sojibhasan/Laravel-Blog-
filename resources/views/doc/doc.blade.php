@extends('layouts.back')

@section('title')
Documentation
@endsection

@section('page_title')
Documentation
@endsection

@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
    <li class="breadcrumb-item active">Documentation</li>
</ul>
@endsection

@section('content')
<div class="container-fluid card">
    <div class="row">
        <div class="col-12">
            <h4 style="color: #e47297;">DivineBlog - v 1.0</h4>
        </div>
        <div class="col-lg-6">
                <div class="">
                <h4>Front end pages</h4>
                <ul>
                    <li>Home</li>
                    <li>About</li>
                    <li>Post</li>
                    <li>Post details</li>
                    <li>Post by category</li>
                    <li>Post by tag</li>
                    <li>Contact</li>
                    <li>Privacy and policy</li>
                    <li>Terms and conditions</li>
                    <li>Search result</li>
                </ul>
                </div>
        </div>
        <div class="col-lg-6">
                <div class="">
                <h4>Image handle</h4>
                <ul>
                    <li style="margin-bottom: 10px;">Slider image 1920px - 800px | max-size: 300px;</li>
                    <li style="margin-bottom: 10px;">Post image 840px - 420px | max-size: 200px;</li>
                    <li style="margin-bottom: 10px;">Logo max-width 150px | max-size: 200px;</li>
                    <li style="margin-bottom: 10px;">Favicon 32px - 32px | max-size: 200px;</li>
                    <li style="margin-bottom: 10px;">Preloader 100px - 100px | max-size: 200px;</li>
                    <li style="margin-bottom: 10px;">Profile image | any size</li>
                </ul>
                </div>
        </div>
        <div class="col-lg-6">
                <div class="">
                <h4>Social media</h4>
                <p>Use one/any of these</p>
                <ul>
                   <li>facebook</li>
                   <li>twitter</li>
                   <li>instagram</li>
                   <li>dribbble</li>
                   <li>pinterest</li>
                   <li>google-plus</li>
                   <li>youtube</li>
                </ul>
                </div>
        </div>
        <div class="col-lg-6">
            <div class="">
                <h4>Upcoming version</h4>
                <ul>
                    <li>Category with ajax</li>
                    <li>Tag with ajax</li>
                    <li>All contact table use checkbox</li>
                    <li>All delete request use ajax</li>
                    <li>All mail sending using ajax</li>
                    <li>Frontend send contact using ajax</li>
                    <li>Frontend send subscribe using ajax</li>
                    <li>Use chart in dashboard</li>
                    <li>Create graphical document</li>
                    <li>Image media using ajax</li>
                </ul>
            </div>
        </div>
        
    </div>

</div>
@endsection