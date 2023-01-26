<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    @include('layout.share.header-css')
  </head>
  <body>
    <div class="container-scroller">

      @include('Doctor.layout.share.top-nav-bar')
      <div class="container-fluid page-body-wrapper">
        @include('Doctor.layout.share.nav-bar')

        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
        <!-- content-wrapper ends -->
        @include('layout.share.footer-content')
      </div>
      <!-- main-panel ends -->

      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('Doctor.layout.share.footer-script')
  </body>
</html>
