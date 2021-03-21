<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="DivineBlog :: laravel blog website" />
        <title>:: DivineBlog :: Sign In</title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- Custom Css -->
        <link rel="stylesheet" href="{{ asset('back/plugins/bootstrap/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('back/css/style.min.css') }}" />
        <style>
            .password_area::after {
                content: "";
                width: 1px;
                height: 100%;
                background-color: #ddd;
                position: absolute;
                top: 0;
                right: 42px;
                z-index: 9;
            }
        </style>
    </head>

    <body class="theme-blush">
        <div class="authentication">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 m-auto col-sm-12">
                        <div class="card auth_form">
                            <div class="header">
                                <img style="min-width: 120px;" class="logo" src="{{ asset('header-logo.png') }}" alt="brand logo" />
                                <h5>Log in</h5>
                            </div>
                            <div class="body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="input-group flex-wrap mb-3">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="admin@email.com"/>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                                        </div>
                                        @error('email')
                                        <span class="invalid-feedback d-block w-100" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3 flex-wrap">
                                        <input type="password" class="form-control w-100 @error('password') is-invalid @enderror" placeholder="Password" name="password" value="password"/>

                                        @error('password')
                                        <span class="invalid-feedback d-block w-100" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="checkbox">
                                        <input id="remember_me" type="checkbox" {{ old('remember') ? 'checked' : '' }} name="remember">
                                        <label for="remember_me">Remember Me</label>
                                        <a style="font-size: 12px; float: right; margin-top: 5px;" href="{{ route('password.request') }}">Forgotten password?</a>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">LOG IN</button>
                                </form>
                            </div>
                        </div>
                        <div class="copyright text-center">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            ,
                            <span>Developed by <a href="#" target="_blank">Sojib Hasan</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jquery Core Js -->
        <script src="{{ asset('back/bundles/libscripts.bundle.js') }}"></script>
        <script src="{{ asset('back/bundles/vendorscripts.bundle.js') }}"></script>
        <!-- Lib Scripts Plugin Js -->
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
    </body>
</html>
