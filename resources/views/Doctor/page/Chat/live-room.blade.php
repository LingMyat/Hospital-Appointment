@extends('layout.app')
@section('css')
    <style>
    </style>
@endsection
@section('content')
{{-- <div class="page-header">
    <h3 class="page-title">Rooms</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Rooms Management</li>
            <li class="breadcrumb-item active" aria-current="page">Rooms</li>
        </ol>
    </nav>
</div> --}}
<div class="row">
    <div class="col-lg-11 mx-auto grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <h4 class=" d-inline-block">All Rooms</h4>
                </div>
                <div class="" style="height: 60vh; overflow-y: scroll; overflow-x:hidden;" id="mainContainer">
                    <div id="message_Container">
                        @foreach ($messages as $message)
                            @if ($message->user->id == doctorAuth()->id)
                                <div class=" text-end m-1 mb-2">
                                    <small class=''>
                                        <div class="text-end">
                                            @if ($message->media)
                                                <div style="max-width: 320px" class ='d-inline-block p-1 px-2 rounded-1 bg-info-light mx-3 rounded-1 text-start'>
                                                    <img class="w-100" src="{{ $message->media->image }}" alt="">
                                                </div>
                                            @else
                                                <b style="max-width: 320px"
                                                class='d-inline-block p-1 px-2 rounded-1 bg-info-light mx-3 rounded-1 text-start'>
                                                    <i class="">
                                                        <small>{{ $message->message }}</small>
                                                    </i>
                                                </b>
                                            @endif
                                        </div>
                                        @foreach ($message->childs as $sameUserMsg)
                                            <div class="text-end mt-1">
                                                <b style="max-width: 320px"
                                                    class='d-inline-block  p-1 px-2 rounded-1 bg-info-light mx-3 rounded-1 text-start'>
                                                    <i class="">
                                                        <small>{{ $sameUserMsg->message }}</small>
                                                    </i>
                                                </b>
                                            </div>
                                        @endforeach
                                    </small>
                                </div>
                            @else
                                <div class="mb-2 px-2 d-flex gap-2">
                                    <img style="height: 25px;width: 25px;" src="{{ $message->user->image }}"
                                        alt="Profile" class="rounded-circle">
                                    <small class="row msg-content">
                                        <b class="col-12">{{ $message->user->name }}</b>
                                        @if ($message->media)
                                            <div style="max-width: 320px" class="bg-secondary-light py-1 ms-2 my-1 rounded-1">
                                                <img class="w-100" src="{{ $message->image }}"
                                                    alt="">
                                            </div>
                                        @else
                                            <b class="col-8 bg-secondary-light ms-2 mt-1 rounded-1">
                                                <i>
                                                    <small>{{ $message->message }}</small>
                                                </i>
                                            </b>
                                        @endif

                                        @foreach ($message->childs as $sameUserMsg)
                                            <b class="col-8 bg-secondary-light ms-2 mt-1 rounded-1">
                                                <i>
                                                    <small>{{ $sameUserMsg->message }}</small>
                                                </i>
                                            </b>
                                        @endforeach
                                    </small>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    {{-- <div class="mb-2 px-2 d-flex gap-2">
                        <img style="height: 25px;width: 25px;"
                            src="{{ asset(auth()->user()->media->image ?? 'assets/theme/default_user/defuser.png') }}"
                            alt="Profile" class="rounded-circle">
                        <small class="row">
                            <b class="col-12">{{ auth()->user()->name }}</b>
                            <div class="col-6 bg-secondary-light ms-2 mt-1 rounded-1">
                                <img class="w-100" src="{{ asset('upload/room/2023/01/63b79dde036561672977886.png') }}"
                                    alt="">
                            </div>
                        </small>
                    </div> --}}
                </div>
            </div>
            <div class="card-footer">
                {{-- <input type="file" id='img'> --}}
                <div class="input-group">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-card-image"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Select Image</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{-- route('liveChat#storeImage') --}}" method="POST" id="image_form" enctype="multipart/form-data" data-url="{{-- route('liveChat#storeImage') --}}">
                                        @csrf
                                        <input type="hidden" name="room_id" value="{{-- $room->id --}}">
                                        <div class="form-group">
                                            <input id="image_input" type="file" name="image" data-max-file-size="1M"
                                                data-allowed-file-extensions="jpeg jpg png" required class="form-control">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="modal_close" data-bs-dismiss="modal">close</button>
                                    <button type="submit" form="image_form" class="btn btn-info">Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input class="form-control" type="text" placeholder="Enter Message" id="msg">
                    <button class="btn btn-primary" data-url="{{--  --}}" id="send-btn">send <i
                            class="bx bxl-telegram"></i></button>
                </div>
            </div>
            </div>
        </div>
    </div>

</div>
@endsection
