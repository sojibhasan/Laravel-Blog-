<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>:: Aero Bootstrap4 Admin ::</title>
<!-- Favicon-->
<link rel="icon" href="{{ url('favicon.ico') }}" type="image/x-icon">
<!-- Custom Css -->
<link rel="stylesheet" href="{{ asset('back/plugins/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('back/css/style.min.css') }}">    
</head>

<body class="theme-blush">

<div class="authentication">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12 m-auto">
                <form class="card auth_form" action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="header">
                        <img style="min-width: 120px;" class="logo" src="{{ url('header-logo.png') }}" alt="barand logo">
                        <h5>Forgot Password?</h5>
                        <span>Enter your e-mail address below to reset your password.</span>
                    </div>
                    <div class="body">
                        @if(session('status') != '')
                        <div class="alert alert-success" role="alert">
                            <div class="container p-0">
                                <span>{{ session('status') }}</span>
                                <button style="position: absolute; top: 15px; right: 15px;" type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                        <i class="zmdi zmdi-close"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                        @endif
                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">SUBMIT</button>                        
                        <div class="signin_with mt-3">
                            <a href="{{ url('/') }}" class="link">Back to home</a>
                        </div>
                    </div>
                </form>
                <div class="copyright text-center">
                    © <script>document.write(new Date().getFullYear())</script><span> Developed by <a href="https://divinecoder.com" target="_blank">Nasrullah Mansur</a></span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="{{ asset('back/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('back/bundles/vendorscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js --> 
</body>
</html>