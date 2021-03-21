@extends('layouts.back') @section('title') Password change @endsection @section('page_title') Password Change @endsection @section('css_plugins')
<link href="{{ asset('back/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endsection @section('custom_css')
<style>
    .profile-edit form label {
        margin-bottom: 0;
        width: 215px;
        font-weight: bold;
        text-transform: capitalize;
    }

    @media (min-width: 992px) {
        .profile-edit .form-group .form-control {
            width: calc(100% - 215px);
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
</style>
@endsection @section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Change Password</li>
</ul>
@endsection @section('content')
<div class="container-fluid">
    <!-- Tabs With Icon Title -->
    <div class="row clearfix profile-edit">
        <div class="col-lg-6 m-auto col-sm-12">
            <div class="card">
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="body">
                                    <form action="{{ route('change.password') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="old-pass">old password</label>
                                            <input id="old-pass" type="password" class="form-control" placeholder="Old password" name="current_password" />
                                            @if($errors->has('current_password'))
                                            <span style="color: red;">{{ $errors->first('current_password') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="new-pass">new password</label>
                                            <input id="new-pass" type="password" class="form-control" placeholder="New password" name="new_password" />
                                            @if($errors->has('new_password'))
                                            <span style="color: red;">{{ $errors->first('new_password') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="new-pass-again">new password (again)</label>
                                            <input id="new-pass-again" type="password" class="form-control" placeholder="New password (again)" name="new_confirm_password" />
                                            @if($errors->has('new_confirm_password'))
                                            <span style="color: red;">{{ $errors->first('new_confirm_password') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group text-right">
                                            <button style="font-size: 14px;" class="btn btn-primary" type="submit">Update Password</button>
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
@endsection @section('custom_js')
<script>
    // Password show hide;
    let allPassArea = document.querySelectorAll('input[type="password"');
    allPassArea.forEach(function (value) {
        value.style.cssText = "width: 100%; ";
        // Icon Class name;
        let openEyeClassName = "zmdi zmdi-eye";
        let closeEyeClassName = "zmdi zmdi-eye-off";
        let passArea = document.createElement("div");
        passArea.classList.add("password_area");
        let eyeOn = document.createElement("i");
        eyeOn.setAttribute("class", openEyeClassName);
        passArea.appendChild(value.cloneNode(true));
        value.parentNode.replaceChild(passArea, value);
        passArea.appendChild(eyeOn);
        eyeOn.addEventListener("click", function (e) {
            if (e.target.classList.value == openEyeClassName) {
                this.setAttribute("class", closeEyeClassName);
                this.previousSibling.setAttribute("type", "text");
            } else if (e.target.classList.value == closeEyeClassName) {
                this.setAttribute("class", openEyeClassName);
                this.previousSibling.setAttribute("type", "password");
            }
        });

        // CSS;
        passArea.style.cssText = "position: relative; width: 100%;";
        eyeOn.style.cssText = "position: absolute; z-index: 1; top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; ";
    });
</script>
@endsection
