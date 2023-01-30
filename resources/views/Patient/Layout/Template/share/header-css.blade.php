<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<!-- Icon Font Stylesheet -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<!-- Libraries Stylesheet -->
<link href="{{ asset('assets/patient/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/patient/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
<!-- Customized Bootstrap Stylesheet -->
<link href="{{ asset('assets/patient/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- Template Stylesheet -->
<link href="{{ asset('assets/patient/css/style.css') }}" rel="stylesheet">
{{-- Dropify --}}
<link rel="stylesheet" href="{{ asset('assets/theme/lib/dropify/dropify.min.css') }}">
@include('Patient.Layout.Addition.addition-css')
<style>
    .hero-header
    {
        height: 83vh;
    }
</style>
@yield('css')
