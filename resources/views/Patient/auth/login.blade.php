@extends('Patient.Layout.Auth.app')
@section('content')
    <div class="col-md-8">
        <div class="mb-4">
            <h3>Sign In</h3>
            <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur
                adipisicing.</p>
        </div>
        <form action="" method="post">
            @csrf
            <div class="form-group first">
                <label for="username">Email or Phone</label>
                <input type="text" class="form-control" name="email_or_phone" id="username">

            </div>
            <div class="form-group last mb-4">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password">

            </div>

            <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember
                        me</span>
                    <input type="checkbox" checked="checked" />
                    <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Forgot
                        Password</a></span>
            </div>

            <input type="submit" value="LOGIN" class="btn btn-block btn-primary">

            <span class="d-block text-left my-4 text-muted">&mdash; or login with &mdash;</span>

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
