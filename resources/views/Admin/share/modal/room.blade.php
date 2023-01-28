<div class="modal-body">
    <form method="post" action="{{ route('admin.room.store') }}" id="main_diseasee_form" class="forms-sample" enctype="multipart/form-data">
        <input type="hidden" name="_method" id="room_form_method">
        @csrf
        <div class="form-group row">
            <label for="room_name" class="col-sm-4 col-form-label">Room Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control border-1 border-primary" name='name' id="room_name" placeholder="Enter Name" required>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="form-label d-block">Room Image</label>
            <div id="room_image">

            </div>
        </div>
        <div class="form-check form-check-primary ms-5">
            <label for="room_status">
                <input id="room_status" class="form-check-input" type="checkbox" name="status" checked="" value="1"> Active
            </label>
        </div>
        <div class=" d-flex justify-content-center">
            <button type="button" class="btn btn-sm btn-secondary mx-2" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary">Save</button>
        </div>
    </form>
</div>
