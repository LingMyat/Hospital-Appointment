<div class="modal-header">
    <h4>{{ "Dr. $doctor->name" }} Avaliable Times</h4>
</div>
<div class="modal-body">
    @foreach ($days as $key => $day)
        <div>
            @if ($day->doctorTimes->isNotEmpty())
                @php
                    $arr = $day->doctorTimes->pluck('doctor_id')->toArray();
                @endphp
                @if (in_array($doctor->id, $arr))
                    <a class="" data-bs-toggle="collapse" href="#collapseExample-{{ $key }}" role="button"
                        aria-expanded="false" aria-controls="collapseExample">
                        <h3>{{ $day->name }}</h3>
                    </a>
                    {{-- <button class="btn btn-primary btn-link mb-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseExample-{{ $key }}" aria-expanded="false"
                        aria-controls="collapseExample">
                        {{ $day->name }}
                    </button> --}}
                    <div class="collapse my-2" id="collapseExample-{{ $key }}">
                        <div class="card card-body">
                            @foreach ($day->doctorTimes as $time)
                                @if ($time->doctor_id == $doctor->id)
                                    @php
                                        $time_from = date('h:i A', strtotime($time->time_from));
                                        $time_to = date('h:i A', strtotime($time->time_to));
                                    @endphp
                                    <a href="javascript:void(0)" class="appointment-btn" data-bs-toggle="modal"
                                        data-bs-target="#appointmentModal"
                                        data-url="{{ route('patient.appointment.form', $time->id) }}">
                                        <div class='alert alert-primary'>{{ $time_from }} -
                                            {{ $time_to }}</div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
        </div>
    @endforeach
    <div class="mt-3 d-flex justify-content-center">
        <button type="button" class="btn btn-sm btn-secondary mx-2 " id="modal-close-btn" data-bs-dismiss="modal">Close</button>
    </div>
</div>
