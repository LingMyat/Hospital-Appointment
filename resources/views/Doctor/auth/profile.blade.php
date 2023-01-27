@extends('Doctor.layout.app')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .form-group{
            margin-bottom: 11px !important;
        }
        .select2-container--default .select2-selection--multiple,
        .select2-container--default.select2-container--focus .select2-selection--multiple
        {
            border: 1px solid #e0e2e4;
            padding: 0.9rem 1.2rem;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice
        {
            background-color: #9a55ff;
            color: #fff;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice button,
        .select2-container--default .select2-selection--multiple .select2-selection__choice button:hover,
        .select2-container--default .select2-selection--multiple .select2-selection__choice button:focus
        {
            color: #fff;
            background-color: #9a55ff;
            border: none;
        }

    </style>
@endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-account-settings"></i>
            </span> Profile
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Personal Info <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-sm-10 mx-auto grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" method="POST" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label">Profile</label>
                            <div class="col-sm-9">
                                <input type="file"
                                    class="dropify form-control"
                                    data-max-file-size="2M"
                                    id="image"
                                    name="image"
                                    data-allowed-file-extensions="jpeg jpg png"
                                    data-default-file="{{ $doctor->image }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" value="{{ $doctor->name }}"
                                    id="name" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile_phone" class="col-sm-3 col-form-label">Mobile</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name='phone' value="{{ $doctor->phone }}"
                                    id="mobile_phone" placeholder="Mobile number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" id="email" value="{{ $doctor->email }}"
                                    placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="degree" class="col-sm-3 col-form-label">Degree</label>
                            <div class="col-sm-9">
                                <input type="text" name='degree' class="form-control" id="degree" value="{{ $doctor->degree }}"
                                    placeholder="Degree">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sama" class="col-sm-3 col-form-label">SAMA</label>
                            <div class="col-sm-9">
                                <input type="text" name="SAMA" class="form-control" id="sama" value="{{ $doctor->SAMA }}"
                                    placeholder="SAMA">
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="speciality" class="col-sm-3 col-form-label">Speciality</label>
                            <div class="col-sm-9">
                                <select name="professions[]" class="js-example-basic-multiple js-states form-control" id="id_label_multiple" multiple="multiple">
                                    @foreach ($mainDiseases as $mainDisease)
                                        <optgroup label="{{ $mainDisease->name }}">
                                            @foreach ($mainDisease->children as $subDisease)
                                                <option value="{{ $subDisease->id }}" {{ in_array($subDisease->id,$doctor->Specialities->pluck('id')->toArray())?'selected':'' }}>{{ $subDisease->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group mt-3 row">
                            <label for="biography" class="col-sm-3 col-form-label">Biography</label>
                            <div class="col-sm-9">
                                <textarea name="biography" class="form-control" id="" placeholder="Biography" cols="30" rows="9">{{ $doctor->biography }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn float-end btn-gradient-primary me-2">Save Info</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#image').dropify();
            $('#id_label_multiple').select2({
                placeholder: "Select your speciality",
                allowClear: true
            })
        });
    </script>
@endsection
