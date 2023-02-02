@extends('Patient.Layout.Template.master')
@section('section')
    <!-- About Start -->
    <div class="container-fluid py-5" id="find_doctor">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5">Your Appointments</h4>
            </div>

            <div class="row">
                @foreach ($appointments as $appointment)
                    <div class="team-item col-lg-6 mb-4">
                        <div class="row g-0 bg-light rounded overflow-hidden shadow-sm">
                            <div class="col-12 col-sm-5 h-100">
                                <a href="">
                                    <img class="img-fluid h-100" src="{{ $appointment->doctor->image }}" style="object-fit: cover;">
                                </a>
                            </div>
                            <div class="col-12 col-sm-7 h-100 d-flex flex-column">
                                @php
                                    $time_from = date('h:i A', strtotime($appointment->doctorTime->time_from));
                                    $time_to = date('h:i A', strtotime($appointment->doctorTime->time_to));
                                @endphp
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- About End -->
@endsection
