@extends('layouts.back') 
@section('title') 
@if(Route::is('slider.create'))
Banner Slider Create 
@else
Banner Slider Update 
@endif
@endsection 
@section('page_title') 
@if(Route::is('slider.create'))
Banner Slider Create 
@else
Banner Slider Update 
@endif
@endsection 
@section('css_plugins')
<link rel="stylesheet" href="{{ asset('back/plugins/dropify/css/dropify.min.css') }}" />
<link rel="stylesheet" href="{{ asset('back/plugins/summernote/dist/summernote.css') }}" />
@endsection @section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item"><a href="{{ url('admin/slider') }}">Slider</a></li>
    <li class="breadcrumb-item active">{{ Route::is('slider.create') ? 'Create' : 'Update' }}</li>
</ul>
@endsection @section('content')
<div class="container-fluid">
    <!-- Exportable Table -->
    <form action="{{ isset($slider) ? route('slider.update', $slider->id) : route('slider.store') }}" method="POST" enctype="multipart/form-data">
        @csrf @if(isset($slider)) @method('PUT') @endif
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Slider Image</h2>
                    </div>
                    <div class="body">
                        <input type="file" class="dropify" name="image" data-default-file="{{ isset($slider) ? asset('front/images/slider/' . $slider->image) : '' }}" />
                        @if($errors->has('image'))
                        <span style="color: red;">{{ $errors->first('image') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Your Slider Content Here</h2>
                    </div>
                    <div class="body">
                        <textarea id="sliderText" class="summernote" name="text">
                            {{ isset($slider) ? $slider->text : old('text') }}
                        </textarea>
                        @if($errors->has('text'))
                        <span style="color: red;">{{ $errors->first('text') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <button name="status" value="1" class="btn btn-primary" type="submit">Publish</button>
                    <button name="status" value="2" class="btn btn-info" type="submit">Save Draft</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection @section('js_plugins')
<script src="{{ asset('back/plugins/dropify/js/dropify.min.js') }}"></script>
@endsection @section('custom_js')
<script src="{{ asset('back/js/pages/forms/dropify.js') }}"></script>
<script src="{{ asset('back/plugins/summernote/dist/summernote.js') }}"></script>

@endsection
