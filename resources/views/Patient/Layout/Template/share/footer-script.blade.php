<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/patient/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('assets/patient/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/patient/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/patient/lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/patient/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('assets/patient/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

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
