@extends('Patient.Layout.Template.master')
@section('section')
        <!-- Hero Start -->
        <div class="container-fluid py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-start">
                    <div class="col-lg-8 text-center text-lg-start">
                        <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5" style="border-color: rgba(256, 256, 256, .3) !important;">Welcome To Medinova</h5>
                        <h1 class="display-1 text-white mb-md-4">Best Healthcare Solution In Your City</h1>
                        <div class="pt-2">
                            <a href="#find_doctor" class="btn btn-light rounded-pill py-md-3 px-md-5 mx-2">Find Doctor</a>
                            <a href="" class="btn btn-outline-light rounded-pill py-md-3 px-md-5 mx-2">Your Appointments</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->

        <!-- About Start -->
        <div class="container-fluid py-5" id="find_doctor">
            <div class="container">
                @foreach ($mainDiseases as $mainDisease)
                    <div class="row gx-5 my-2">
                        <h5 class="my-3">{{ $mainDisease->name }}</h5>
                        @foreach($mainDisease->children as $subDisease)
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="bg-light rounded overflow-hidden">
                                    <img class="img-fluid w-100" src="{{ $subDisease->media->image }}" alt="">
                                    <div class="p-4">
                                        <a class="h5 d-block mb-3" href="">{{ $subDisease->name }}</a>

                                        <a href="{{ route('patient.doctors') }}?speciality={{ $subDisease->slug }}" class="btn btn-primary">Find Doctor</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                @endforeach
            </div>
        </div>
        <!-- About End -->
@endsection
