@extends('Patient.Layout.Template.master')
@section('css')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
@endsection
@section('section')
    <!-- About Start -->
    <div class="container-fluid py-5" id="find_doctor">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5">Personal Info</h4>
            </div>

            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-lg-5 col-md-6 ms-auto">
                        <div class="row">
                            <div class="col-lg-11 mx-auto">
                                <img class="w-100 mb-2 rounded" src="{{ patientAuth()->image }}"
                                    alt="{{ patientAuth()->name }}">
                                <input type="file" class="form-control mb-2" name="image" id="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pt-lg-3 pt-md-0 pt-4 me-auto">
                        <div class="">
                            <label class="form-label mb-1" for="">Name</label>
                            <input type="text" class="form-control mb-2" name="name"
                                value="{{ patientAuth()->name }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label d-block mb-1" for="">NRC(optional)</label>
                            <div class="row">
                                <div class="col-2">
                                    <select name="nrc_code" class="w-100 niceSelect" id="nrc_code_select">
                                        <option value="">no</option>
                                        @foreach ($nrc_codes as $nrc_code)
                                            <option data-url="{{ route('patient.nrc.names', $nrc_code) }}"
                                                value="{{ $nrc_code }}"
                                                @if (patientAuth()->nrc) {{ $nrc_code == patientAuth()->nrc->nrc_code ? 'selected' : '' }} @endif>
                                                {{ $nrc_code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-5" id="nrc_name_container">
                                    <select class="w-100 niceSelect" name="" id="" disabled>
                                        <option value="{{ patientAuth()->nrc->name_mm ?? '' }}">
                                            {{ patientAuth()->nrc->name_mm ?? 'nrc-name' }}</option>
                                    </select>
                                </div>
                                <div class="col-2" id="">
                                    <input type="text" name="mid_txt" class="form-control ps-xl-3  ps-md-2 ps-sm-3"
                                        value='နိုင်'>
                                </div>
                                <div class="col-3" id="">
                                    <input type="number" name="nrc_number" placeholder="" value="{{ patientAuth()->NRC }}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="form-label mb-1" for="">Email</label>
                            <input type="text" class="form-control mb-2" name="email"
                                value="{{ patientAuth()->email }}">
                        </div>
                        <div class="">
                            <label class="form-label mb-1" for="">Phone</label>
                            <input type="number" class="form-control mb-2" name="phone"
                                value="{{ patientAuth()->phone }}">
                        </div>
                        <div class="">
                            <label class="form-label mb-1" for="">Address</label>
                            <input type="text" class="form-control mb-2" name="address"
                                value="{{ patientAuth()->address }}">
                        </div>
                        <div class="">
                            <label class="form-label mb-1" for="">Date Of Birth</label>
                            <input type="date" class="form-control mb-2" id="date" name="date_of_birth"
                                value="{{ patientAuth()->date_of_birth }}">
                        </div>
                        <div class="">
                            <label class="form-label mb-1" for="">Gender</label>
                            <select class="w-100 mb-3 niceSelect" name="gender" id="">
                                <option value="Male" {{ patientAuth()->gender == 'Male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="Female" {{ patientAuth()->gender == 'Female' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                        </div>
                        <div class="">
                            <button class="w-100 btn btn-dark" type="submit">Edit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- About End -->
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#date').flatpickr();
            $('#date').removeAttr('readonly');
            $('.niceSelect').niceSelect();

            $('#nrc_code_select').change(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: $(this).children("option:selected").data('url'),
                    success: function(view) {
                        $('#nrc_name_container').html(view);
                    }
                });
            });
        });
    </script>
@endsection
