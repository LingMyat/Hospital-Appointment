@extends('Patient.Layout.Template.master')
@section('section')
    <!-- About Start -->
    <div class="container-fluid py-5" id="find_doctor">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5">Rooms</h4>
            </div>

            <div class="row">
                <div class="col-11 mx-auto">
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
                                                <h5 class="card-title">{{ $room->name }}</h5>
                                                {{-- <div>{{ $room->admin->name }}</div> --}}
                                                <a href="chats/show?room_id={{ $room->slug }}"
                                                    class="btn float-end btn-primary">Enter</a>
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
    <!-- About End -->
@endsection
