<div class="modal-header">
    <h4>{{ "Dr. $doctor->name" }} Avaliable Times</h4>
</div>
<div class="modal-body">
    @foreach ($days as $day)
        <div>
            @foreach ($day->doctorTimes as $time)
                @if ($time->doctor_id == $doctor->id)
                    @php
                        $time_from = date('h:i A', strtotime($time->time_from));
                        $time_to = date('h:i A', strtotime($time->time_to));
                    @endphp
                    <a
                    href="javascript:void(0)"
                    class="appointment-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#appointmentModal"
                    data-url="{{ route('patient.appointment.form',$time->id) }}"
                    >
                        <div class='alert alert-primary'>{{ $time_from }} - {{ $time_to }}/{{ $time->day->name }}</div>
                    </a>
                @endif
            @endforeach
        </div>
    @endforeach
    <div class="mt-3 d-flex justify-content-center">
        <button type="button" class="btn btn-sm btn-secondary mx-2" data-bs-dismiss="modal">Close</button>
    </div>
</div>
