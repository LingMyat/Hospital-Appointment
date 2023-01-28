<!-- JavaScript Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/patient/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('assets/patient/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/patient/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/patient/lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/patient/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('assets/patient/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
{{-- Dropify --}}
<script src="{{ asset('assets/theme/lib/dropify/dropify.min.js') }}"></script>
@include('Patient.Layout.Addition.addition-script')

<!-- Template Javascript -->
<script src="{{ asset('assets/patient/js/main.js') }}"></script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
@yield('script')
