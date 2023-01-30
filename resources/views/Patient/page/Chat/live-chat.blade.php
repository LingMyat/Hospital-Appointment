@extends('Patient.Layout.Template.master')
@section('section')
    <!-- About Start -->
    <div class="container-fluid py-5" id="find_doctor">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5">{{ $room->name }}</h4>
            </div>

            <div class="row">
                <div class="col-lg-11 mx-auto grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="" style="height: 60vh; overflow-y: scroll; overflow-x:hidden;"
                                        id="mainContainer">
                                        <div id="message_Container">
                                            @foreach ($messages as $message)
                                                @if ($message->sender_role == patientAuth()->role)
                                                    @php
                                                        $sender = $message->patient;
                                                    @endphp
                                                    @if ($sender->id == patientAuth()->id)
                                                        <div class=" text-end m-1 mb-2">
                                                            <small class=''>
                                                                <div class="text-end">
                                                                    @if ($message->media)
                                                                        <div style="max-width: 320px"
                                                                        class='d-inline-block p-1 px-2 rounded-1 text-white bg-primary mx-3 rounded-1 text-start'>
                                                                            <img class="w-100" src="{{ $message->media->image }}"
                                                                                alt="">
                                                                        </div>
                                                                    @else
                                                                        <b style="max-width: 320px"
                                                                            class='d-inline-block p-1 px-2 rounded-1 text-white bg-primary mx-3 rounded-1 text-start'>
                                                                            <i class="">
                                                                                <small>{{ $message->message }}</small>
                                                                            </i>
                                                                        </b>
                                                                    @endif
                                                                </div>
                                                                @foreach ($message->childs as $sameUserMsg)
                                                                    <div class="text-end mt-1">
                                                                        <b style="max-width: 320px"
                                                                        class='d-inline-block p-1 px-2 rounded-1 text-white bg-primary mx-3 rounded-1 text-start'>
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
                                                            <img style="height: 25px;width: 25px;" src="{{ $sender->image }}"
                                                                alt="Profile" class="rounded-circle">
                                                            <small class="row msg-content">
                                                                <b class="col-12">{{ $sender->name }}</b>
                                                                @if ($message->media)
                                                                    <div style="max-width: 320px;background: rgba(62, 75, 91, 0.2);color: #3e4b5b;"
                                                                        class="bg-secondary-light ms-3 mt-1 py-2 rounded-1">
                                                                        <img class="w-100" src="{{ $message->media->image }}"
                                                                            alt="">
                                                                    </div>
                                                                @else
                                                                    <b style="background: rgba(62, 75, 91, 0.2);color: #3e4b5b;" class="col-lg-5 col-11 col-md-7 col-sm-9 bg-secondary-light ms-3 mt-1 py-2 rounded-1">
                                                                        <i>
                                                                            <small>{{ $message->message }}</small>
                                                                        </i>
                                                                    </b>
                                                                @endif

                                                                @foreach ($message->childs as $sameUserMsg)
                                                                    <div class='col-6 d-none d-lg-block'></div>
                                                                    <b style="background: rgba(62, 75, 91, 0.2);color: #3e4b5b;" class="col-lg-5 col-11 col-md-7 col-sm-9 bg-secondary-light ms-3 mt-1 py-2 rounded-1">
                                                                        <i>
                                                                            <small>{{ $sameUserMsg->message }}</small>
                                                                        </i>
                                                                    </b>
                                                                @endforeach
                                                            </small>
                                                        </div>
                                                    @endif
                                                @else
                                                    @php
                                                    $sender = $message->doctor;
                                                    @endphp
                                                        <div class="mb-2 px-2 d-flex gap-2">
                                                            <img style="height: 25px;width: 25px;" src="{{ $sender->image }}"
                                                                alt="Profile" class="rounded-circle">
                                                            <small class="row msg-content">
                                                                <b class="col-12">{{ $sender->name }}</b>
                                                                @if ($message->media)
                                                                    <div style="max-width: 320px;background: rgba(62, 75, 91, 0.2);color: #3e4b5b;"
                                                                    class="bg-secondary-light ms-3 mt-1 py-2 rounded-1">
                                                                        <img class="w-100" src="{{ $message->media->image }}"
                                                                            alt="">
                                                                    </div>
                                                                @else
                                                                    <b style="background: rgba(62, 75, 91, 0.2);color: #3e4b5b;" class="col-lg-5 col-11 col-md-7 col-sm-9 bg-secondary-light ms-3 mt-1 py-2 rounded-1">
                                                                        <i>
                                                                            <small>{{ $message->message }}</small>
                                                                        </i>
                                                                    </b>
                                                                @endif

                                                                @foreach ($message->childs as $sameUserMsg)
                                                                    <div class='col-6 d-none d-lg-block'></div>
                                                                    <b style="background: rgba(62, 75, 91, 0.2);color: #3e4b5b;" class="col-lg-5 col-11 col-md-7 col-sm-9 bg-secondary-light ms-3 mt-1 py-2 rounded-1">
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
                            </div>
                        </div>
                        <div class="card-footer">
                            {{-- <input type="file" id='img'> --}}
                            <div class="input-group">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <i class="fa-solid fa-image"></i>
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
                                                <form action="{{ route('patient.chat.image.store') }}" method="POST" id="image_form"
                                                    enctype="multipart/form-data" data-url="{{-- route('liveChat#storeImage') --}}">
                                                    @csrf
                                                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                                                    <div class="form-group">
                                                        <input id="image_input" type="file" name="image"
                                                            data-max-file-size="1M" data-allowed-file-extensions="jpeg jpg png"
                                                            required class="form-control">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-dark" id="modal_close"
                                                    data-bs-dismiss="modal">close</button>
                                                <button type="submit" form="image_form" class="btn btn-info">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input class="form-control" type="text" placeholder="Enter Message" id="msg">
                                <button class="btn btn-primary" data-url="{{ route('patient.chat.store') }}" id="send-btn">send <i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#image_input').dropify();
            // const {roomId} = Qs.parse(location.search,{
            //     ignoreQueryPrefix : true
            // });
            // scrollTop = $('#message_container').scrollHeight;
            const message_container = document.getElementById('message_Container');
            $id = "{{ patientAuth()->id }}"
            $name = "{{ patientAuth()->name }}";
            $profile = "{{ patientAuth()->image }}";
            $role = "{{ patientAuth()->role }}"
            $roomId = "{{ request('room_id') }}";
            let current_id = "{{ $lastMessage->sender_id ?? 0 }}";
            let current_role = "{{ $lastMessage->sender_role ?? 0 }}";
            let scrollFunc = () => {
                $('#mainContainer').animate({
                    scrollTop: $('#message_Container').height()
                }, 0);
            }
            let ip_address = '127.0.0.1';
            let socket_port = '3000';
            let socket = io(ip_address + ':' + socket_port);
            joinRoomData = {
                name: $name,
                profile: $profile,
                roomId: $roomId,
            }

            socket.emit('joinRoom', joinRoomData);

            socket.on('joining', name => {
                message_container.innerHTML +=
                    `<small class="text-center d-block my-1"><b>${name} has joined the room.</b></small>`;
                scrollFunc();
            })

            socket.on('leaving', name => {
                message_container.innerHTML +=
                    `<small class="text-center d-block my-1"><b>${name} has left the room.</b></small>`;
                scrollFunc();
            })
            // socket.on('connection');
            $('#send-btn').click(function(e) {

                e.preventDefault();
                if ($('#msg').val() == '') {
                    return
                }

                data = {
                    id: $id,
                    room_id: $roomId,
                    name: $name,
                    profile: $profile,
                    message: $('#msg').val(),
                    parent: 'false',
                    role:$role,
                }


                if (current_id == $id && current_role == $role) {
                    data.parent = 'true';
                }

                $.ajax({
                    type: "POST",
                    url: $(this).data('url'),
                    data: data,
                    dataType: "json",
                });
                socket.emit('message', data)
            });

            socket.on('message', (data) => {

                sender = `
                <div class="text-end m-1 mb-2">
                        <small class='text-start'>
                            <div class="text-end">
                                <b style="max-width: 320px"
                                    class='d-inline-block p-1 px-2 rounded-1 text-white bg-primary mx-3 rounded-1 text-start'>
                                    <i class="">
                                        <small>${data.message}</small>
                                    </i>
                                </b>
                            </div>
                        </small>
                </div>
                `;
                reciever = `
                <div class="mb-2 px-2 d-flex gap-2">
                        <img style="height: 30px;width: 30px;"
                            src="${data.profile}"
                            alt="Profile" class="rounded-circle">
                        <small class="row msg-content">
                            <b class="col-12">${data.name}</b>
                            <b style="background: rgba(62, 75, 91, 0.2);color: #3e4b5b;" class="col-lg-5 col-11 col-md-7 col-sm-9 bg-secondary-light ms-3 mt-1 py-2 rounded-1">
                                <i>
                                    <small>${data.message}</small>
                                </i>
                            </b>
                        </small>
                    </div>
                `;

                if (data.id == $id && data.role == $role) {
                    message_container.innerHTML += sender;
                } else {
                    if (current_id == data.id && current_role == data.role) {
                        let msg_content = document.getElementsByClassName('msg-content');
                        msg_content[msg_content.length - 1].innerHTML += `
                            <div class='col-6 d-none d-lg-block'></div>
                            <b style="background: rgba(62, 75, 91, 0.2);color: #3e4b5b;" class="col-lg-5 col-11 col-md-7 col-sm-9 bg-secondary-light ms-3 mt-1 py-2 rounded-1">
                                        <i>
                                            <small>${data.message}</small>
                                        </i>
                                    </b>
                            `;
                    } else {
                        message_container.innerHTML += reciever
                    }
                }
                $('#msg').val('');
                current_id = data.id;
                current_role = data.role;
                scrollFunc();
            })

            //imge start
            $('#image_form').submit(function(e) {
                e.preventDefault();

                var file = this;
                $.ajax({
                    type: $(file).attr('method'),
                    url: $(file).attr('action'),
                    data: new FormData(file),
                    processData:false,
                    dataType: "json",
                    contentType: false,
                    success: function (response) {

                    }
                });

                const reader = new FileReader();
                reader.addEventListener('load', () => {
                    data = {
                        id: $id,
                        room_id: $roomId,
                        role : $role,
                        name: $name,
                        profile: $profile,
                        src: reader.result,
                    };

                    socket.emit('image', data)
                });
                reader.readAsDataURL($('#image_input')[0].files[0]);

            });

            socket.on('image', (data) => {
                $sender = `<div class="text-end m-1 mb-2">
                    <small class='text-start'>
                        <div class="text-end">
                            <div style="max-width: 320px;" class ='d-inline-block bg-primary p-1 px-2 rounded-1 mx-3 rounded-1 text-start'>
                                <img class="w-100" src="${data.src}" alt="">
                            </div>
                        </div>
                    </small>
            </div>`;

                $reciever =  `
            <div class="mb-2 px-2 d-flex gap-2">
                    <img style="height: 25px;width: 25px;"
                        src="${data.profile}"
                        alt="Profile" class="rounded-circle">
                    <small class="row msg-content">
                        <b class="col-12">${data.name}</b>
                        <div style="max-width: 320px;background: rgba(62, 75, 91, 0.2);color: #3e4b5b;" class="bg-secondary-light ms-3 mt-1 py-2 rounded-1">
                            <img class="w-100" src="${data.src}"
                                alt="">
                        </div>
                    </small>
                </div>
            `
                data.id == $id && data.role == $role ? message_container.innerHTML += $sender : message_container.innerHTML += $reciever;
                $('.dropify-clear').click();
                $('#modal_close').click();
                current_id = data.id;
                current_role = data.role;
                scrollFunc();
            });

            scrollFunc();
        });
    </script>
@endsection
