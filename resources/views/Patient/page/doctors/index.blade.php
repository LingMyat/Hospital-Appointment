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
                                <a href="{{ route('patient.doctor.show',$doctor->slug) }}">
                                    <img class="img-fluid h-100" src="{{ $doctor->image }}" style="object-fit: cover;">
                                </a>
                            </div>
                            <div class="col-12 col-sm-7 h-100 d-flex flex-column">
                                <div class="mt-auto p-4">
                                    <a href="{{ route('patient.doctor.show',$doctor->slug) }}">
                                        <h3>Dr. {{ $doctor->name }}</h3>
                                    </a>
                                    <h6 class="fw-normal fst-italic text-primary mb-4">Specialist :
                                        @foreach ($doctor->Specialities as $speciality)
                                        <span>{{ $speciality->name }}</span>
                                        @endforeach
                                    </h6>
                                    <p class="m-0">Dolor lorem eos dolor duo eirmod sea. Dolor sit magna rebum clita rebum dolor</p>
                                </div>
                                <div class="d-flex mt-auto border-top p-4">
                                    <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-3" href="#"><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-3" href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-lg btn-primary btn-lg-square rounded-circle" href="#"><i class="fab fa-linkedin-in"></i></a>
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
