<div class="modal-body">
    @if ($appointment->status == 'success')
        <h3 class="text-center">
            <i class="mdi mdi-check-circle-outline text-success"></i>
            This Appointment is already success!
        </h3>
    @elseif ($appointment->status == 'canceled')
        <h3 class="text-center">
            <i class="mdi mdi-close-circle-outline text-danger"></i>
            This Appointment is already canceled!
        </h3>
    @else
        @if (isAppointmentAvaliabe($appointment->doctor->id, $appointment->doctor_time_id))
            <form method="post" action="{{ route('doctor.appointment.update', $appointment->id) }}" id=""
                class="forms-sample">
                @csrf
                @method('PATCH')
                <div class="form-group mb-5">
                    <label for="">Status</label>
                    <select name="status" class="w-100" id="status_select">
                        <option value="pending">Pending</option>
                        <option value="success">Success</option>
                        <option value="canceled">Cancel</option>
                    </select>
                </div>
                <div style="display: none" class="form-group" id="cancel_remark_div">
                    <label for="">Cancel Remark</label>
                    <textarea name="cancel_remark" id="cancel_remark" class="form-control" rows="6"></textarea>
                </div>
                <div class=" d-flex justify-content-center">
                    <button type="button" class="btn btn-sm btn-secondary mx-2" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </form>
        @else
            <h3>
                <i class="mdi mdi-close-circle-outline text-danger"></i> Your Appointment time
                {{ $appointment->doctorTime->time_from }} - {{ $appointment->doctorTime->time_to }} is full cancel this
                appointment! <button class="btn btn-danger btn-sm"
                    data-url="{{ route('doctor.appointment.update.cancel', $appointment->id) }}"
                    id="cancel-btn">Cancel</button>
            </h3>
        @endif
    @endif
</div>
<script>
    $(document).ready(function() {
        $('#status_select').niceSelect();
    });
</script>
