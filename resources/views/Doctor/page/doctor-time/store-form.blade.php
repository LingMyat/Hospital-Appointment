<div class="modal-body">
    <form method="post" action="{{ route('doctor.time.store') }}" id="" class="forms-sample">
        @csrf
        <div class="form-group row">
            <label for="" class="col-sm-4 col-form-label">From</label>
            <div class="col-sm-8">
              <input type="time" class="form-control border-1 border-primary" name='from_time' id=""  required>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-4 col-form-label">To</label>
            <div class="col-sm-8">
              <input type="time" class="form-control border-1 border-primary" name='to_time' id=""  required>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-4 col-form-label">Day</label>
            <div class="col-sm-8">
              <select name="day" class="w-100" id="day_select">
                <option value="">Select Day</option>
                @foreach ($days as $day)
                    <option value="{{ $day->id }}">{{ $day->name }}</option>
                @endforeach
              </select>
            </div>
        </div>
        <div class=" d-flex justify-content-center">
            <button type="button" class="btn btn-sm btn-secondary mx-2" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary">Save</button>
        </div>
    </form>
</div>
