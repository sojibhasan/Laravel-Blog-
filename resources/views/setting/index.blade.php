@extends('layouts.back') 
@section('title') 
Theme Setting 
@endsection 
@section('page_title') 
Theme Setting 
@endsection 
@section('css_plugins')
<link rel="stylesheet" href="{{ asset('back/plugins/summernote/dist/summernote.css') }}" />
<link href="{{ asset('back/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('back/plugins/dropify/css/dropify.min.css') }}" />
@endsection @section('custom_css')
<style>
    .profile-edit .form label {
        margin-bottom: 0;
        width: 210px;
        font-weight: bold;
        text-transform: capitalize;
    }

    @media (min-width: 992px) {
        .profile-edit .form-group .form-control {
            width: calc(100% - 210px);
        }
    }

    @media (min-width: 992px) {
        .profile-edit .row .form-group .form-control {
            width: 100%;
        }
    }

    .profile-edit .row.with-control label {
        width: 100%;
    }

    .profile-edit .input-group-prepend {
        width: 50px;
        display: block;
    }

    .profile-edit .input-group-prepend i {
        display: block;
        line-height: 35px;
        margin-left: 7px;
    }
</style>
@endsection @section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Theme Setting</li>
</ul>
@endsection @section('content')
<div class="container-fluid">
    <!-- Tabs With Icon Title -->
    <div class="row clearfix profile-edit">
        <form action="{{ route('setting.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="col-sm-12">
                @if(count($errors) > 0)
                <span style="color: red; width: 100%; text-align: right;">Something wrong - you have to fill all required fields. </span>
                @endif
                <div class="card">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="body">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs mb-3 px-0 nav-tabs-success" role="tablist">
                                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#profile-info">INFORMATION</a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-contact">CONTACT</a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-property">PROPERTY</a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-config">CONFIG</a></li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane in active" id="profile-info">
                                                <div class="form">
                                                    <div class="form-group d-lg-flex align-items-start">
                                                        <label for="site-des">Site description</label>
                                                        <textarea rows="4" class="form-control no-y" id="site-des" placeholder="Site description" name="description">{{ old('description') ? old('description') : $setting->description }}</textarea>
                                                    </div>
                                                    <div class="form-group d-lg-flex align-items-start">
                                                        <label for="site-meta">Meta keyword</label>
                                                        <textarea rows="4" class="form-control no-y" id="site-meta" placeholder="Meta keyword" name="meta_key">{{ old('meta_key') ? old('meta_key') : $setting->meta_key }}</textarea>
                                                    </div>
                                                    <div class="form-group d-lg-flex align-items-start">
                                                        <label for="copyright">Footer Copyright</label>
                                                        <textarea rows="4" class="form-control no-y summernote" id="copyright" placeholder="Copyright" name="copyright">
                                                        {{ old('copyright') ? old('copyright') : $setting->copyright }}
                                                        </textarea>
                                                    </div>
                                                    @if($errors->has('copyright'))
                                                    <span style="color: red; width: 100%; text-align: right;">{{ $errors->first('copyright') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane" id="profile-contact">
                                                <div class="row">
                                                    <div class="form-group col-lg-6">
                                                        <label for="city">city</label>
                                                        <input id="city" type="text" class="form-control" placeholder="city" name="city" value="{{ old('city') ? old('city') : $setting->city }}" />
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label for="pos-code">Postal code</label>
                                                        <input id="pos-code" type="number" class="form-control" placeholder="Postal code" name="post_code" value="{{ old('post_code') ? old('post_code') : $setting->post_code }}" />
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label for="state">State</label>
                                                        <input id="state" type="text" class="form-control" placeholder="State" name="street" value="{{ old('street') ? old('street') : $setting->street }}" />
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label for="country">Country</label>
                                                        <input id="country" type="text" class="form-control" placeholder="Country" name="country" value="{{ old('country') ? old('country') : $setting->country }}" />
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label for="email">Email</label>
                                                        <input id="email" type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') ? old('email') : $setting->email }}" />
                                                        @if($errors->has('email'))
                                                        <span style="color: red; width: 100%; text-align: right;">{{ $errors->first('email') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label for="phone">phone</label>
                                                        <input id="phone" type="text" class="form-control" placeholder="phone" name="phone" value="{{ old('phone') ? old('phone') : $setting->phone }}" />
                                                        @if($errors->has('phone'))
                                                        <span style="color: red; width: 100%; text-align: right;">{{ $errors->first('phone') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label for="site">Address</label>
                                                        <textarea rows="4" class="form-control no-y" id="site" placeholder="Address" name="address"> {{ old('address') ? old('address') : $setting->address }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane" id="profile-property">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <label>Header Logo</label>
                                                                <input name="header_logo" type="file" class="dropify" data-default-file="{{ asset($setting->header_logo) }}" value="{{ $setting->header_logo }}" />
                                                                @if($errors->has('header_logo'))
                                                                <span style="color: red; width: 100%; text-align: right;">{{ $errors->first('header_logo') }}</span>
                                                                @endif
                                                                <br />
                                                                <small>File format must be in the format jpg, jpeg, png</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <label>Footer Logo</label>
                                                                <input name="footer_logo" type="file" class="dropify" data-default-file="{{ asset($setting->footer_logo) }}" value="{{ $setting->footer_logo }}" />
                                                                @if($errors->has('footer_logo'))
                                                                <span style="color: red; width: 100%; text-align: right;">{{ $errors->first('footer_logo') }}</span>
                                                                @endif
                                                                <br />
                                                                <small>File format must be in the format jpg, jpeg, png</small>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <label>Preloader</label>
                                                                <input name="preloader" type="file" class="dropify" name="preloader" data-default-file="{{ asset($setting->preloader) }}" value="{{ $setting->preloader }}" />
                                                                @if($errors->has('preloader'))
                                                                <span style="color: red; width: 100%; text-align: right;">{{ $errors->first('preloader') }}</span>
                                                                @endif
                                                                <br />
                                                                <small>File format must be in the format jpg, jpeg, png</small>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <label>Favicon</label>
                                                                <input name="favicon" type="file" class="dropify" data-default-file="{{ asset($setting->favicon) }}" value="{{ $setting->favicon }}" />
                                                                @if($errors->has('favicon'))
                                                                <span style="color: red; width: 100%; text-align: right;">{{ $errors->first('favicon') }}</span>
                                                                @endif
                                                                <br />
                                                                <small> File format must be in the format jpg, jpeg, ico, png</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane" id="profile-config">
                                                <div class="row with-control">
                                                    <div class="col-12 mb-3">
                                                        <div class="input-group appendable">
                                                            <label class="mt-2" for="google-id">Google Analytics ID</label>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="zmdi zmdi-google-glass"></i></span>
                                                            </div>
                                                            <input
                                                                id="google-id"
                                                                type="text"
                                                                class="form-control timepicker"
                                                                placeholder="Google Analytics ID"
                                                                name="google_analytics_id"
                                                                value="{{ old('google_analytics_id') ? old('google_analytics_id') : $setting->google_analytics_id }}"
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <div class="input-group appendable">
                                                            <label class="mt-2" for="publish-id">Publisher ID</label>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="zmdi zmdi-google-glass"></i></span>
                                                            </div>
                                                            <input
                                                                id="publish-id"
                                                                type="text"
                                                                class="form-control timepicker"
                                                                placeholder="Publisher ID"
                                                                name="publisher_id"
                                                                value="{{ old('publisher_id') ? old('publisher_id') : $setting->publisher_id }}"
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label for="google-map">Google map</label>
                                                        <textarea rows="4" class="form-control no-y" id="google-map" placeholder="Google map" name="google_map">{{ old('google_map') ? old('google_map') : $setting->google_map }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group text-right">
                                                <button style="font-size: 14px;" class="btn btn-primary" type="submit">Update Information</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection @section('js_plugins')
<script src="{{ asset('back/plugins/summernote/dist/summernote.js') }}"></script>
<script src="{{ asset('back/plugins/dropify/js/dropify.min.js') }}"></script>
@endsection @section('custom_js')
<script src="{{ asset('back/js/pages/forms/dropify.js') }}"></script>
@endsection
