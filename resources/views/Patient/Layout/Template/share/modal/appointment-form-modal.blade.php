<div class="modal-header">
    @php
        $time_from = date('h:i A', strtotime($time->time_from));
        $time_to = date('h:i A', strtotime($time->time_to));
    @endphp
    <h5>{{ "Dr. {$time->doctor->name} / $time_from - $time_to / {$time->day->name}" }}</h5>
</div>
<div class="modal-body">
    <form method="post" action="{{ route('patient.appointment.store') }}" class="forms-sample">
        @csrf
        <input type="hidden" name="doctor_time_id" value="{{ $time->id }}">
        <div style="height: auto" class="row">
            <div class="col-md-6 mb-2">
                <label for="" class="form-label">Name</label>
                <input type="text" class="form-control" name='name' value="{{ patientAuth()->name }}">
            </div>

            <div class="col-md-6 mb-2">
                <label for="" class="form-label">Mobile</label>
                <input type="text" placeholder="Phone" class="form-control" name='phone' value="{{ patientAuth()->phone }}">
            </div>

            <div class="col-md-6 mb-2">
                <label for="" class="form-label">Where You From?</label>
                <input type="text" placeholder="Address" class="form-control" name='address' value="{{ patientAuth()->address }}">
            </div>

            <div class="col-md-6 mb-2">
                <label for="" class="form-label">Date Of Birth</label>
                <input type="date" id="date_of_birth" placeholder='Date Of Birth' class="form-control" name='date_of_birth' value="{{ patientAuth()->date_of_birth }}">
            </div>

            <div class="col-md-6 mb-2">
                <label for="" class="form-label">gender</label>
                <select class="w-100" name="gender" id="gender_select">
                    <option value="">Select Gender</option>
                    <option value="Male" {{ patientAuth()->gender == "Male"?'selected':"" }}>Male</option>
                    <option value="Female" {{ patientAuth()->gender == "Female"?'selected':"" }}>Female</option>
                </select>
            </div>

            <div class="col-md-6 mb-2">
                <label for="" class="form-label"><span class="text-danger">*</span> Disease <span class="text-danger">*</span></label>
                <select class="w-100" name="disease" id="disease_select">
                    <option value="">Select</option>
                    @foreach ($time->doctor->Specialities as $disease)
                        <option value="{{ $disease->id }}">{{ $disease->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 mb-2">
                <label for="" class="form-label">Appointment Note (optional)</label>
                <textarea name="note" id="" class="form-control" placeholder="Appointment Note" rows="7"></textarea>
            </div>
        </div>
        <div class=" d-flex mt-2 justify-content-center">
            <button type="button" class="btn btn-sm btn-secondary mx-2" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary">Save</button>
        </div>
    </form>
</div>
