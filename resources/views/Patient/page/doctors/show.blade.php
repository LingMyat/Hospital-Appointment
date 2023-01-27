@extends('Patient.Layout.Template.master')
@section('section')
        <!-- About Start -->
        <div class="container-fluid py-5" id="find_doctor">
            <div class="container">
                <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                    <h4 class="d-inline-block text-uppercase border-bottom border-5">{{ "Dr. $doctor->name" }}</h4>
                    {{-- <h1 class="display-6">Qualified Healthcare Professionals</h1> --}}
                </div>

                <div class="row">
                    <div class="col-lg-5 col-md-6 ms-auto">
                        <div class="row">
                            <div class="col-lg-11 mx-auto">
                                <img  class="w-100 rounded" src="{{ $doctor->image }}" alt="{{ $doctor->name }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 pt-lg-4 pt-md-0 pt-4 me-auto">
                        <div class="row my-3">
                            <h5 class="col-4 offset-1">Speciality:</h5>
                            <div class="col-7">
                                @foreach ($doctor->specialities as $speciality)
                                    <span class="me-2"><b>{{ $speciality->name }}</b></span>
                                @endforeach
                            </div>
                        </div>
                        <div class="row my-3">
                            <h5 class="col-4 offset-1">Degree:</h5>
                            <div class="col-7">
                                <b>{{ $doctor->degree }}</b>
                            </div>
                        </div>
                        <div class="row my-3">
                            <h5 class="col-4 offset-1">SAMA:</h5>
                            <div class="col-7">
                                <b>{{ $doctor->SAMA }}</b>
                            </div>
                        </div>
                        <div class="row my-3">
                            <h5 class="col-4 offset-1">Email:</h5>
                            <div class="col-7">
                                <b>{{ $doctor->email }}</b>
                            </div>
                        </div>
                        <div class="row my-3">
                            <h5 class="col-4 offset-1">Mobile:</h5>
                            <div class="col-7">
                                <b>{{ $doctor->phone }}</b>
                            </div>
                        </div>

                    </div>
                    <div class="col-10 pt-md-5 ps-md-4 mx-auto">
                        <h3 class="mb-3">Biography</h3>
                        <p style="letter-spacing: 1px" class="text-dark ">{{ $doctor->biography }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->
@endsection
