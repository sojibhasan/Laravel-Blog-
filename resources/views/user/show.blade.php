@extends('layouts.back') @section('title') My profile @endsection @section('page_title') My Profile @endsection @section('css_plugins')
<link href="{{ asset('back/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
<link href="{{ asset('back/plugins/cropie/cropie.css') }}" rel="stylesheet" />

@endsection @section('custom_css')
<style>
    .profile-edit form label {
        margin-bottom: 0;
        width: 120px;
        font-weight: bold;
        text-transform: capitalize;
    }
    @media (min-width: 992px) {
        .profile-edit .form-group .form-control {
            width: calc(100% - 120px);
        }
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

    @media (max-width: 420px) {
        .input-group.appendable {
            flex-wrap: wrap;
        }
        .input-group.appendable label {
            width: 100%;
        }
    }
</style>
@endsection @section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item"><a href="{{ url('admin/user') }}">User</a></li>
    <li class="breadcrumb-item active">User Info</li>
</ul>
@endsection @section('content')
<div class="container-fluid">
    <!-- Tabs With Icon Title -->
    <div class="row clearfix profile-edit">
        <div class="col-sm-12">
            <div class="card">
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="body">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs mb-3 px-0 nav-tabs-success" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#profile-setting">SETTING</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-photo">PHOTO</a></li>
                                    </ul>

                                    <?php 
                                if($profile->user->role == 1) { $role = 'Super Admin'; } elseif($profile->user->role == 2) { $role = 'Administrator'; } else { $role = 'Blogger'; } ?>

                                    <!-- Tab panes -->
                                    <form action="{{ route('profile.update', $profile->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane in active" id="profile-setting">
                                                <div class="form-group d-lg-flex align-items-center">
                                                    <label for="name">name</label>
                                                    <input id="name" type="text" class="form-control" placeholder="Name" name="name" value="{{ $profile->name == '' ? old('name') : $profile->name }}" />
                                                </div>
                                                <div class="form-group d-lg-flex align-items-center">
                                                    <label for="email">Email</label>
                                                    <input id="email" type="email" class="form-control" value="{{ $profile->user->email }}" disabled />
                                                </div>
                                                <div class="form-group d-lg-flex align-items-center">
                                                    <label for="phone">Phone</label>
                                                    <input id="phone" type="text" class="form-control" value="{{ $profile->user->phone }}" disabled />
                                                </div>
                                                <div class="form-group d-lg-flex align-items-center">
                                                    <label for="role">Role</label>

                                                    <input id="role" type="text" class="form-control" value="{{ $role }}" disabled />
                                                </div>
                                                <div class="form-group d-lg-flex align-items-center">
                                                    <label for="occupation">Occupation</label>
                                                    <input id="occupation" type="text" class="form-control" placeholder="Occupation" name="occupation" value="{{ $profile->occupation == '' ? old('occupation') : $profile->occupation }}" />
                                                </div>
                                                <div class="form-group d-lg-flex align-items-start">
                                                    <label for="about">About</label>
                                                    <textarea id="about" rows="4" class="form-control no-y" placeholder="About" name="about">{{ $profile->about == '' ? old('about') : $profile->about }}</textarea>
                                                </div>

                                                <div class="input-group appendable mb-3">
                                                    <label class="mt-2" for="facebook">Facebook</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="zmdi zmdi-facebook"></i></span>
                                                    </div>
                                                    <input
                                                        name="facebook"
                                                        id="facebook"
                                                        type="text"
                                                        class="form-control timepicker"
                                                        placeholder="https://www.facebook.com"
                                                        value="{{ $profile->facebook == '' ? old('facebook') : $profile->facebook }}"
                                                    />
                                                    @if($errors->has('facebook'))
                                                    <span style="color: red; width: 100%; text-align: right;">{{ $errors->first('facebook') }}</span>
                                                    @endif
                                                </div>
                                                <div class="input-group appendable mb-3">
                                                    <label class="mt-2" for="twitter">Twitter</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="zmdi zmdi-twitter"></i></span>
                                                    </div>
                                                    <input
                                                        name="twitter"
                                                        id="twitter"
                                                        type="text"
                                                        class="form-control timepicker"
                                                        placeholder="https://www.twitter.com"
                                                        value="{{ $profile->twitter == '' ? old('twitter') : $profile->twitter }}"
                                                    />
                                                    @if($errors->has('twitter'))
                                                    <span style="color: red; width: 100%; text-align: right;">{{ $errors->first('twitter') }}</span>
                                                    @endif
                                                </div>
                                                <div class="input-group appendable mb-3">
                                                    <label class="mt-2" for="linkdin">Linkedin</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="zmdi zmdi-linkedin"></i></span>
                                                    </div>
                                                    <input
                                                        name="linkedin"
                                                        id="linkdin"
                                                        type="text"
                                                        class="form-control timepicker"
                                                        placeholder="https://www.linkedin.com"
                                                        value="{{ $profile->linkedin == '' ? old('linkedin') : $profile->linkedin }}"
                                                    />
                                                    @if($errors->has('linkedin'))
                                                    <span style="color: red; width: 100%; text-align: right;">{{ $errors->first('linkedin') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="profile-photo">
                                                <div class="container py-5">
                                                    <!-- Image crop start -->
                                                    <div class="img-content">
                                                        <div class="img-croppie upload-demo">
                                                            <div id="upload-demo">
                                                                <div class="action-btns">
                                                                    <a href="javascript:void(0)" id="crop-btn" class="btn btn-primary text-capitalize upload-result">use photo</a>
                                                                    <a href="javascript:void(0)" id="remove-img" class="btn btn-danger text-capitalize">remove photo</a>
                                                                </div>
                                                            </div>
                                                            <div class="actions">
                                                                <label style="width: 100%;" for="upload">
                                                                    @if($profile->image == null) Click To Upload Your Photo @else
                                                                    <div class="old-img-info">
                                                                        <img src="{{ $profile->image }}" id="old_img" src="profile image" />
                                                                        <span class="btn btn-warning" id="use-another">Use another</span>
                                                                    </div>
                                                                    @endif
                                                                </label>
                                                                <input type="file" id="upload" accept="image/*" name="image" />
                                                            </div>
                                                            <div class="output-img">
                                                                <img src="" id="output" />
                                                                <a href="javascript:void(0)" class="btn btn-warning" id="try-again">Try again</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Image crop end -->
                                                </div>

                                                <!-- Get image base64 value bi ID -->
                                                <input type="hidden" name="image" id="cropped-img" value="{{ $profile->image }}" />
                                            </div>
                                            <div class="form-group text-right">
                                                <button style="font-size: 14px;" class="btn btn-primary" type="submit">Update Profile</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('js_plugins')
<script src="{{ asset('back/plugins/cropie/cropie.min.js') }}"></script>

@endsection @section('custom_js')
<script>
    function demoUpload() {
        $("#upload-demo").css({
            opacity: 0,
            height: "0",
        });
        $(".output-img").hide();
        $(".actions").show();
        $("#remove-img , #try-again").on("click", function () {
            $("#upload-demo").css({
                opacity: 0,
                height: 0,
            });
            $(".output-img").hide();
            $(".actions").show();
        });
        $("#upload").on("change", function () {
            $("#upload-demo").css({
                opacity: 1,
                height: "auto",
            });
            $(".output-img").hide();
            $(".actions").hide();
        });
        $("#crop-btn").on("click", function () {
            $("#upload-demo").css({
                opacity: 0,
                height: 0,
            });
            $(".output-img").show();
            $(".actions").hide();
        });
        var $uploadCrop;

        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(".upload-demo").addClass("ready");
                    $uploadCrop
                        .croppie("bind", {
                            url: e.target.result,
                        })
                        .then(function () {
                            // console.log('jQuery bind complete');
                        });
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                swal("Sorry - you're browser doesn't support the FileReader API");
            }
        }
        $uploadCrop = $("#upload-demo").croppie({
            viewport: {
                width: 250,
                height: 250,
            },
            enableExif: true,
            boundary: {
                width: 300,
                height: 300,
            },
        });
        $("#upload").on("change", function () {
            readFile(this);
        });
        $(".upload-result").on("click", function (ev) {
            $uploadCrop
                .croppie("result", {
                    type: "canvas",
                    size: "viewport",
                })
                .then(function (resp) {
                    document.getElementById("output").setAttribute("src", resp);
                    // Set input:hidden value here;
                    document.getElementById("cropped-img").setAttribute("value", resp);
                });
        });
    }
    demoUpload();
</script>
@endsection
