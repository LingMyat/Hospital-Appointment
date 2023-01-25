<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('Patient.Layout.Auth.share.header-css')
    <title>Booking</title>
</head>

<body>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        @yield('content')
                    </div>

                </div>

                <div class="col-md-6 mb-2">
                    <img src="{{ asset('assets/patient/Auth/images/undraw_medicine_b-1-ol (1).svg') }}" alt="Image" class="img-fluid">

                    @if (Request::segment(1) == 'login')
                        <div class="text-center mt-2">
                            <h3 >DON'T HAVE AN ACCOUNT?</h3>
                            <a class="btn btn-primary" href="{{ route('patient.registerPage') }}">CREATE ACCOUNT</a>
                        </div>
                    @else
                        <div class="text-center mt-2">
                            <h3 >ALREADY HAVE AN ACCOUNT ?</h3>
                            <a class="btn btn-primary" href="{{ route('patient.loginPage') }}">LOGIN ACCOUNT</a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    @include('Patient.Layout.Auth.share.footer-script')
</body>

</html>
