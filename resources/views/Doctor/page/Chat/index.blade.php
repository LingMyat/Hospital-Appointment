@extends('Doctor.layout.app')
@section('css')
    <style>
    </style>
@endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-cellphone-link"></i>
            </span> Rooms
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
                        <h4 class=" d-inline-block">All Rooms</h4>
                    </div>
                    <div class="row">
                        @foreach ($rooms as $room)
                            <div class="my-3 col-md-6">
                                <!-- Card with an image on left -->
                                <div class="card mx-1 mb-3">
                                    <div class="row m-1 g-0">
                                        <div class="col-md-6">
                                            <img src="{{ asset($room->image) }}" class="img-fluid rounded-start"
                                                alt="{{ $room->name }}">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-body p-2">
                                                <h6 class="card-title">{{ $room->name }}</h6>
                                                {{-- <div>{{ $room->admin->name }}</div> --}}
                                                <a href="/doctor/rooms/chat?room_id={{ $room->slug }}"
                                                    class="btn btn-md-sm float-end btn-inverse-danger">Enter</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End Card with an image on left -->
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
