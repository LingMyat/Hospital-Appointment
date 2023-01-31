@extends('Doctor.layout.app')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .form-group {
            margin-bottom: 11px !important;
        }

        .select2-container--default .select2-selection--multiple,
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: 1px solid #e0e2e4;
            padding: 0.9rem 1.2rem;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #9a55ff;
            color: #fff;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice button,
        .select2-container--default .select2-selection--multiple .select2-selection__choice button:hover,
        .select2-container--default .select2-selection--multiple .select2-selection__choice button:focus {
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
                <button class="btn btn-inverse-primary btn-icon-text " id="add_btn" data-bs-toggle="modal"
                    data-bs-target="#exampleModal" data-url="{{ route('doctor.time.form') }}">
                    <i class="mdi mdi-plus-circle"></i>
                    Appointment-Time
                </button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" id="modal-content">

                        </div>
                    </div>
                </div>
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
                                <input type="file" class="dropify form-control" data-max-file-size="2M" id="image"
                                    name="image" data-allowed-file-extensions="jpeg jpg png"
                                    data-default-file="{{ $doctor->image }}" />
                            </div>
                        </div>
                        @if ($doctor->times->isNotEmpty())
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Times</label>
                                <div class="col-sm-9">
                                    @foreach ($days as $day)
                                        <div>
                                            @foreach ($day->doctorTimes as $time)
                                                @if ($time->doctor_id == $doctor->id)
                                                    @php
                                                        $time_from = date('h:i A', strtotime($time->time_from));
                                                        $time_to = date('h:i A', strtotime($time->time_to));
                                                    @endphp
                                                    <label class='badge badge-success me-2'>{{ $time_from }} - {{ $time_to }}/{{ $time->day->name }} <a
                                                        style="cursor: pointer"
                                                        data-time-from="{{ $time->time_from }}"
                                                        data-time-to="{{ $time->time_to }}"
                                                        data-day="{{ $time->day->id }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"
                                                        data-url="{{ route('doctor.time.update',$time->id) }}"
                                                        class="text-white edit-time-btn">
                                                        <i class="mdi mdi-lead-pencil"></i></a> <a
                                                        href="{{ route('doctor.time.destroy',$time->id) }}" class="text-white">
                                                        <i class="mdi mdi-close"></i>
                                                    </a></label>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
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
                                <input type="email" name="email" class="form-control" id="email"
                                    value="{{ $doctor->email }}" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="degree" class="col-sm-3 col-form-label">Degree</label>
                            <div class="col-sm-9">
                                <input type="text" name='degree' class="form-control" id="degree"
                                    value="{{ $doctor->degree }}" placeholder="Degree">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sama" class="col-sm-3 col-form-label">SAMA</label>
                            <div class="col-sm-9">
                                <input type="text" name="SAMA" class="form-control" id="sama"
                                    value="{{ $doctor->SAMA }}" placeholder="SAMA">
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="speciality" class="col-sm-3 col-form-label">Speciality</label>
                            <div class="col-sm-9">
                                <select name="professions[]" class="js-example-basic-multiple js-states form-control"
                                    id="id_label_multiple" multiple="multiple">
                                    @foreach ($mainDiseases as $mainDisease)
                                        <optgroup label="{{ $mainDisease->name }}">
                                            @foreach ($mainDisease->children as $subDisease)
                                                <option value="{{ $subDisease->id }}"
                                                    {{ in_array($subDisease->id, $doctor->Specialities->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                    {{ $subDisease->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group mt-3 row">
                            <label for="biography" class="col-sm-3 col-form-label">Biography</label>
                            <div class="col-sm-9">
                                <textarea name="biography" class="form-control" id="" placeholder="Biography" cols="30"
                                    rows="9">{{ $doctor->biography }}</textarea>
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

            $getFormUrl = $('#add_btn').data('url');

            $('#add_btn').click(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "get",
                    url: $getFormUrl,
                    success: function(view) {
                        $('#modal-content').html(view);
                        $('#day_select').niceSelect();
                    }
                });
            });

            $('.edit-time-btn').click(function(e) {
                e.preventDefault();
                let time_from = $(this).data('time-from');
                let time_to = $(this).data('time-to');
                let day_id = $(this).data('day');
                let url = $(this).data('url');
                $.ajax({
                    type: "GET",
                    url: $getFormUrl,
                    success: function(view) {
                        $('#modal-content').html(view);
                        $(`#day_select option[value=${day_id}]`).attr('selected', 'selected');
                        $('#day_select').niceSelect();
                        $('#time_from').val(time_from);
                        $('#time_to').val(time_to)

                        $('#time_form').attr('action', url);
                        $('#time_form_method').val('patch');
                    }
                });
            });

        });
    </script>
@endsection
