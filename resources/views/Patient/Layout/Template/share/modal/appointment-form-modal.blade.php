<div class="modal-body">
    <form method="post" action="" class="forms-sample">
        @csrf
        <div class="row">
            <input type="text" class="form-input" name='name' value="{{ patientAuth()->name }}">
        </div>
        <div class=" d-flex justify-content-center">
            <button type="button" class="btn btn-sm btn-secondary mx-2" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary">Save</button>
        </div>
    </form>
</div>
