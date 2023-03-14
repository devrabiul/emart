<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('public/assets/backend')}}/images/dashboard/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('public/assets/backend')}}/images/dashboard/favicon.png"
        type="image/x-icon">
    <title>Login or Register</title>

    <!-- Google font-->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,500;1,600;1,700;1,800;1,900&display=swap">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">


    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/css/vendors/font-awesome.css">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/css/vendors/themify-icons.css">

    <!-- slick icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/css/vendors/slick-theme.css">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/css/vendors/bootstrap.css">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/css/style.css">

</head>

<body>

    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div class="authentication-box">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7 p-0 card-right">
                        <div class="card tab2-card card-login">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="top-profile-tab" data-bs-toggle="tab"
                                            href="#top-profile" role="tab" aria-controls="top-profile"
                                            aria-selected="true"><span class="icon-user me-2"></span>Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-top-tab" data-bs-toggle="tab"
                                            href="#top-contact" role="tab" aria-controls="top-contact"
                                            aria-selected="false"><span class="icon-unlock me-2"></span>Register</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="top-tabContent">
                                    <div class="tab-pane fade show active" id="top-profile" role="tabpanel"
                                        aria-labelledby="top-profile-tab">


                                        <form class="form-horizontal auth-form" method="POST"
                                            action="{{ route('login') }}">
                                            @csrf

                                            <div class="form-group">
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" autofocus placeholder="Email">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password"
                                                    placeholder="Password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-terms">
                                                <div class="form-check mesm-2">

                                                    <input class="form-check-input" type="checkbox" name="remember"
                                                        id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="form-check-label ps-2" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>


                                                    @if (Route::has('password.request'))
                                                    <a class="btn btn-default forgot-pass"
                                                        href="{{ route('password.request') }}">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-button">
                                                <button class="btn btn-primary" type="submit">Login</button>
                                            </div>
                                            <div class="form-footer">
                                                <span>Or Login up with social platforms</span>
                                                <ul class="social">
                                                    <li><a class="ti-facebook" href=""></a></li>
                                                    <li><a class="ti-twitter" href=""></a></li>
                                                    <li><a class="ti-instagram" href=""></a></li>
                                                    <li><a class="ti-pinterest" href=""></a></li>
                                                </ul>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="top-contact" role="tabpanel"
                                        aria-labelledby="contact-top-tab">

                                        <form class="form-horizontal auth-form" method="POST"
                                            action="{{ route('register') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="Name" name="name" value="{{ old('name') }}" required
                                                    autocomplete="name" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" placeholder="Email Address">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="new-password"
                                                    placeholder="Password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">

                                                    <input id="password-confirm" type="password" class="form-control"
                                                        name="password_confirmation" required
                                                        autocomplete="new-password" placeholder="Confirm Password">
                                            </div>

                                            {{-- <div class="form-terms">
                                                <div class="form-check mesm-2">
                                                    <input type="checkbox" class="form-check-input"
                                                        id="customControlAutosizing1">
                                                    <label class="form-check-label ps-2"
                                                        for="customControlAutosizing1"><span>I agree all statements in
                                                            <a href="" class="pull-right">Terms &amp;
                                                                Conditions</a></span></label>
                                                </div>
                                            </div>
                                             --}}
                                            <div class="form-button">
                                                <button class="btn btn-primary" type="submit">Register</button>
                                            </div>
                                            <div class="form-footer">
                                                <span>Or Sign up with social platforms</span>
                                                <ul class="social">
                                                    <li><a class="ti-facebook" href=""></a></li>
                                                    <li><a class="ti-twitter" href=""></a></li>
                                                    <li><a class="ti-instagram" href=""></a></li>
                                                    <li><a class="ti-pinterest" href=""></a></li>
                                                </ul>
                                            </div>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{url('/')}}" class="btn btn-primary back-btn"><i data-feather="arrow-left"></i>back</a>
            </div>
        </div>
    </div>

    <!-- latest jquery-->
    <script src="{{asset('public/assets/backend')}}/js/jquery-3.3.1.min.js"></script>

    <!-- Bootstrap js-->
    <script src="{{asset('public/assets/backend')}}/js/bootstrap.bundle.min.js"></script>

    <!-- feather icon js-->
    <script src="{{asset('public/assets/backend')}}/js/icons/feather-icon/feather.min.js"></script>
    <script src="{{asset('public/assets/backend')}}/js/icons/feather-icon/feather-icon.js"></script>

    <!-- Sidebar jquery-->
    <script src="{{asset('public/assets/backend')}}/js/sidebar-menu.js"></script>
    <script src="{{asset('public/assets/backend')}}/js/slick.js"></script>

    <!-- lazyload js-->
    <script src="{{asset('public/assets/backend')}}/js/lazysizes.min.js"></script>

    <!--right sidebar js-->
    <script src="{{asset('public/assets/backend')}}/js/chat-menu.js"></script>

    <!--script admin-->
    <script src="{{asset('public/assets/backend')}}/js/admin-script.js"></script>
    <script>
        $('.single-item').slick({
            arrows: false,
            dots: true
        });

    </script>

</body>

</html>
