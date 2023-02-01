@extends('Doctor.layout.app')
@section('css')
    <style>
    </style>
@endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-content-paste"></i>
            </span> Appointments
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Over view <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <h4 class=" d-inline-block">Your Appointments</h4>
                    </div>
                    <div class="">
                        <table class="table table-hover Datatable">
                            <thead>
                                <tr>
                                    <th>Patient</th>
                                    <th>Title</th>
                                    <th>Appointment Time</th>
                                    <th>Day</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $key => $appointment)
                                    <tr>
                                        <td>{{ $appointment->patient->name }}</td>
                                        <td>{{ $appointment->disease->name }}</td>
                                        @php
                                            $time_from = date('h:i A', strtotime($appointment->doctorTime->time_from));
                                            $time_to = date('h:i A', strtotime($appointment->doctorTime->time_to));
                                        @endphp
                                        <td>{{ "$time_from - $time_to" }}</td>
                                        <td>{{ $appointment->doctorTime->day->name }}</td>
                                        <td class="">
                                            {!! getAppointmentStatus($appointment->status) !!}
                                        </td>
                                        <td class=" ">
                                            <a href="{{ route('doctor.appointment.show',$appointment->id) }}"><i class="mdi mdi-square-edit-outline h4"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('table').DataTable()
        });
    </script>
@endsection
