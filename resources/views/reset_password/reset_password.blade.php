<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Reset Password Pegawai</title>
    <link href="{{ asset('assets/vendors/bootstrap/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/themify-icons/css/themify-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/main.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pages/auth-light.css') }}" rel="stylesheet" />
</head>

<body class="bg-silver-300 mt-5">
    <div class="content">
        <form id="login-form" action="{{ url('proses_reset_password/'.Request::segment(2)) }}" method="post">
            @csrf
            <h2 class="login-title">Reset Password</h2>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
                        placeholder="Password...">
                </div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                    <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                        name="password_confirmation" placeholder="Konfirmasi Password...">
                </div>
                @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <button class="btn btn-info btn-block" type="submit">Reset Password</button>
            </div>
        </form>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrap/bootstrap.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/app.min.js') }}" type="text/javascript"></script>
</body>

</html>