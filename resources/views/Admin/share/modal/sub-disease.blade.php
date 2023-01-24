<style>
   #main_disease_select ul.list
   {
    width: 100% !important;
   }
</style>
<div class="modal-body">
    <form method="post" action="{{ route('admin.sub-disease.store') }}" id="main_diseasee_form" enctype="multipart/form-data" class="forms-sample">
        <input type="hidden" name="_method" id="main_diseasee_form_method">
        @csrf
        <div class="form-group mb-5">
            <label for="main_disease_select" class="form-label">Main Disease</label>
              <select class="w-100 border-1 border-primary" name="main_disease" id="main_disease_select" required>
                <option value="">Select Main Disease</option>
                    @foreach ($mainDiseases as $mainDisease)
                        <option value="{{ $mainDisease->id }}">{{ $mainDisease->name }}</option>
                    @endforeach
              </select>
        </div>
        <div class="form-group">
            <label for="sub_disease_name" class="form-label d-block">Sub Disease Name</label>
            <div class="">
              <input type="text" class="form-control border-1 border-primary" name='name' id="sub_disease_name" placeholder="Enter Name" required>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="form-label d-block">Sub Disease Image</label>
            <div id="sub_disease_image">

            </div>
        </div>
        <div class="form-check form-check-primary ms-5">
            <label for="sub_disease_status">
                <input id="sub_disease_status" class="form-check-input" type="checkbox" name="status" checked="" value="1"> Active
            </label>
        </div>
        <div class=" d-flex justify-content-center">
            <button type="button" class="btn btn-sm btn-secondary mx-2" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary">Save</button>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        $('#main_disease_select').niceSelect();
    });
</script>
