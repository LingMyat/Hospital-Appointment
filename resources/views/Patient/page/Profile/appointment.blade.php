@extends('Patient.Layout.Template.master')
@section('css')
@endsection
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
                            <div class="col-12 col-sm-5 h-100 mb-3">
                                <a href="">
                                    <img class="img-fluid h-100" src="{{ $appointment->doctor->image }}" style="object-fit: cover;">
                                </a>
                            </div>
                            <div class="col-12 col-sm-7 ps-md-2 ps-sm-1 h-100 d-flex flex-column">
                                @php
                                    $time_from = date('h:i A', strtotime($appointment->doctorTime->time_from));
                                    $time_to = date('h:i A', strtotime($appointment->doctorTime->time_to));
                                @endphp
                                <h3 class="mb-2">
                                    @if ($appointment->time == null)
                                        {{ "$time_from - $time_to / {$appointment->doctorTime->day->name}" }}
                                    @else
                                        @php
                                            $time = date('h:i A', strtotime($appointment->time)-1200);
                                        @endphp
                                        {{ "$time / {$appointment->doctorTime->day->name}" }}
                                    @endif
                                @if ($appointment->status == 'success')
                                    <button class="btn btn-sm btn-success">Success</button>
                                @elseif ($appointment->status == 'canceled')
                                    <button class="btn btn-sm btn-danger">Canceled</button>
                                @else
                                <button class="btn btn-sm btn-primary">Pending</button>
                                @endif
                                </h3>
                                <h4>Doctor: Dr. {{ $appointment->doctor->name }}</h4>
                                <h4>Diagnosis: {{ $appointment->disease->name }}</h4>
                                <h4>Doctor Ph: {{ $appointment->doctor->phone }}</h4>
                                <div class="d-flex mt-auto border-top p-3">
                                    @if ($appointment->status == 'success')
                                        <h6 class="mt-3">
                                            {{ "{$appointment->doctorTime->day->name_mm} $time အရောက်လာရန်။" }}
                                        </h6>
                                    @elseif ($appointment->status == 'canceled')
                                        <small class="mt-0 text-dark">
                                            <b>{{ "$appointment->cancel_remark" }}</b>
                                        </small>
                                    @else
                                        <h6 class="mt-1">
                                            {{ 'ကျေးဇူးပြုပြီးခဏစောင့်ပါ။ သင့်ချိန်းဆိုမှုကို ယခု ကျွန်ုပ်တို့ စီစစ်နေပါပြီ။' }}
                                        </h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="">
                    {{ $appointments->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endsection
