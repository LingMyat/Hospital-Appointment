@extends('Patient.Layout.Template.master')
@section('section')
    <!-- About Start -->
    <div class="container-fluid py-5" id="find_doctor">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Our Doctors</h5>
                <h1 class="display-6">Qualified Healthcare Professionals</h1>
            </div>

            <div class="row">
                @foreach ($doctors as $doctor)
                    <div class="team-item col-lg-6 mb-4">
                        <div class="row g-0 bg-light rounded overflow-hidden shadow-sm">
                            <div class="col-12 col-sm-5 h-100">
                                <a href="{{ route('patient.doctor.show', $doctor->slug) }}">
                                    <img class="img-fluid h-100" src="{{ $doctor->image }}" style="object-fit: cover;">
                                </a>
                            </div>
                            <div class="col-12 col-sm-7 h-100 d-flex flex-column">
                                <div class="mt-auto p-4">
                                    <a href="{{ route('patient.doctor.show', $doctor->slug) }}">
                                        <h3>Dr. {{ $doctor->name }}</h3>
                                    </a>
                                    <h6 class="fw-normal fst-italic text-primary mb-4">Specialist :
                                        @foreach ($doctor->Specialities as $speciality)
                                            <span>{{ $speciality->name }}</span>
                                        @endforeach
                                    </h6>
                                    <p class="m-0">Dolor lorem eos dolor duo eirmod sea. Dolor sit magna rebum clita
                                        rebum dolor</p>
                                </div>
                                <div class="d-flex mt-auto border-top p-4">
                                    <button class="btn btn-primary time-modal-btn" data-bs-toggle="modal"
                                        data-bs-target="#timeModal"
                                        data-url="{{ route('patient.doctor.time', $doctor->slug) }}">Get Appointment</button>

                                    <div class="modal fade" id="timeModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content" id="modal-content">

                                            </div>
                                        </div>
                                    </div>

                                    <div id="appointment_form_modal"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- About End -->
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.time-modal-btn').click(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "get",
                    url: $(this).data('url'),
                    success: function(view) {
                        $('#modal-content').html(view);
                        $('#appointment_form_modal').html(`
                            <div class="modal fade" id="appointmentModal" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content" id="appointment-modal-content">

                                    </div>
                                </div>
                            </div>
                        `);
                        $('.appointment-btn').click(function(e) {
                            e.preventDefault();

                            $.ajax({
                                type: "get",
                                url: $(this).data('url'),
                                error: function(response) {
                                    let redirect = window.location.href;
                                    window.location.href=`/login?redirect=${redirect}`;
                                },
                                success: function(view) {
                                    $('#appointment-modal-content').html(view);
                                    $("select").niceSelect();
                                    $('#date_of_birth').flatpickr();
                                    $('#date_of_birth').attr('readonly', false);
                                },
                            });
                        })

                        $('#modal-close-btn').click(function (e) {
                            e.preventDefault();
                            $('#modal-content').html('');
                            $('#appointment_form_modal').html('');
                        });
                    }
                });
            });
        });
    </script>
@endsection
