<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>:: Aero Bootstrap4 Admin :: Sign Up</title>
<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Custom Css -->
<link rel="stylesheet" href="{{ asset('back/plugins/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('back/css/style.min.css') }}">
</head>

<body class="theme-blush">

<div class="authentication">    
    <div class="container">
        <div class="row">
            <div class="col-lg-4 m-auto col-sm-12">
                <form class="card auth_form" method="POST" action="{{ route('register') }}">
                    @csrf 
                    <div class="header">
                        <img class="logo" src="{{ url('front/images/logo.png') }}" alt="">
                        <h5>Sign Up</h5>
                        <span>Register a new membership</span>
                    </div>
                    <div class="body">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" class="form-control  @error('username') is-invalid @enderror" placeholder="Username" name="username" value="{{ old('username') }}" required autocomplete="name" autofocus>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Enter email" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                        
                            <div class="form-group mb-3">
                                <input type="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <div class="form-group mb-3">
                                <div class="radio">
                                    <input type="radio" id="blogger" name="role" value="2" checked>
                                    <label for="blogger">Blogger</label>
                               
                                    <input type="radio" id="administrator" name="role" value="3">
                                    <label for="administrator">Administrator</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">{{ __('Register') }}</button>
                        </form>
                        <div class="signin_with mt-3">
                            <a style="font-size: 12px;" class="link" href="#">Have you already a membership?</a>
                        </div>
                    </div>
                </form>
                <div class="copyright text-center">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>,
                    <span>Developed by <a href="#" target="_blank">Nasrullah Mansur</a></span>
                </div>
            </div>
            
        </div>
    </div>
</div>


<!-- Jquery Core Js -->
<script src="{{ asset('back/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('back/bundles/vendorscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->
<script>
    // Password show hide;
let allPassArea = document.querySelectorAll('input[type="password"');
allPassArea.forEach(function (value) {
    value.style.cssText = 'width: 100%; ';
    // Icon Class name;
    let openEyeClassName = 'zmdi zmdi-eye';
    let closeEyeClassName = 'zmdi zmdi-eye-off'; 
    let passArea = document.createElement('div');
    passArea.classList.add('password_area');
    let eyeOn = document.createElement('i');
    eyeOn.setAttribute('class', openEyeClassName);
    passArea.appendChild(value.cloneNode(true));
    value.parentNode.replaceChild(passArea, value);
    passArea.appendChild(eyeOn);
    eyeOn.addEventListener('click', function (e) {
        if (e.target.classList.value == openEyeClassName) {
            this.setAttribute('class', closeEyeClassName);
            this.previousSibling.setAttribute('type', 'text');
        } else if (e.target.classList.value == closeEyeClassName) {
            this.setAttribute('class', openEyeClassName);
            this.previousSibling.setAttribute('type', 'password');
        }
    });

// CSS;
passArea.style.cssText = 'position: relative;';
eyeOn.style.cssText = 'position: absolute; z-index: 1; top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; color: #666;';

});
</script>
</body>
</html>