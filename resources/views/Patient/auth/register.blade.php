@extends('Patient.Layout.Auth.app')
@section('css')
    <style>
        /* .form-select
        {
            overflow: visible !important;
            height: 75px;
        }
        select
        {
            border: none;
        }
        .nice-select
        {
            background: #EDF2F5;
            border: none;
            padding-left: 0;
        }
        span.current
        {
            font-size: 20px;
        } */
        .content
        {
            padding: 6rem 0 7rem 0;
        }
    </style>
@endsection
@section('content')
    <div class="col-md-8">
        <div class="mb-4">
            <h3>Register</h3>
        </div>
        <form action="" method="post">
            @csrf
            <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="name" id="username">
            </div>

            <div class="form-group">
                <label for="email">Email or Phone</label>
                <input type="text" class="form-control" name="email_or_phone" id="email">
            </div>

            {{-- <div class="form-group form-select field--not-empty">
                <label class="" for="gender">Gender</label>
                <select class="nice-select w-100 mt-3" name="gender" id="gender">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div> --}}

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>

            <div class="form-group last mb-4">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password">
            </div>

            <input type="submit" value="REGISTER" class="btn btn-block btn-primary">

            <span class="d-block text-left my-4 text-muted">&mdash; or register with &mdash;</span>

            <div class="social-login">
                <a href="#" class="facebook">
                    <span class="icon-facebook mr-3"></span>
                </a>
                <a href="#" class="twitter">
                    <span class="icon-twitter mr-3"></span>
                </a>
                <a href="#" class="google">
                    <span class="icon-google mr-3"></span>
                </a>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $('.nice-select').niceSelect();
    </script>
@endsection
