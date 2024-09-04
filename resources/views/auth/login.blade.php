<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JITUPASNA</title>
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/css/bootstrap.css') }}">

    <link rel="shortcut icon" href="{{ asset('frontend/dist/assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/css/app.css') }}">
    <style>
        body {
            background-image: url('{{ asset('frontend/dist/assets/images/test_bg.jpeg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        
        <div class="row">
            <div class="col-md-5 col-sm-12 mx-auto">
                <div class="card pt-4">
                    <div class="card-body">
                        <div class="text-center mb-5">
                            <img src="assets/images/favicon.svg" height="48" class='mb-4'>
                            <h3>Sign In</h3>
                            <p>Please sign in to continue to Voler.</p>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group position-relative has-icon-left">
                                <label for="username">Email</label>
                                <div class="position-relative">
                                    <input id="email" class="form-control" type="email" name="email"
                                        :value="old('email')" required autofocus autocomplete="username">
                                    <div class="form-control-icon">
                                        <i data-feather="user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left">
                                <div class="clearfix">
                                    <label for="password">Password</label>
                                    <a href="auth-forgot-password.html" class='float-right'>
                                        <small>Forgot password?</small>
                                    </a>
                                </div>
                                <div class="position-relative">
                                    <input id="password" class="form-control" type="password" name="password" required
                                        autocomplete="current-password">
                                    <div class="form-control-icon">
                                        <i data-feather="lock"></i>
                                    </div>
                                </div>
                            </div>

                            <div class='form-check clearfix my-4'>
                                <div class="checkbox float-left">
                                    <input type="checkbox" id="remember_me" class='form-check-input' name="remember">
                                    <label for="checkbox1">Remember me</label>
                                </div>
                                <div class="float-right">
                                    <a href="auth-register.html">Don't have an account?</a>
                                </div>
                            </div>
                            <div class="clearfix">
                                <button class="btn btn-primary float-right">Submit</button>
                            </div>
                        </form>
                        <div class="divider">
                            <div class="divider-text">OR</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <button class="btn btn-block mb-2 btn-primary"><i data-feather="facebook"></i>
                                    Facebook</button>
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-block mb-2 btn-secondary"><i data-feather="github"></i>
                                    Github</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('frontend/dist/assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/js/app.js') }}"></script>

    <script src="{{ asset('frontend/dist/assets/js/main.js') }}"></script>
</body>

</html>
