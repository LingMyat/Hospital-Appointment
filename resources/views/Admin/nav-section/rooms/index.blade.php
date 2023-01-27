@extends('layout.app')
@section('css')
    <style>
    </style>
@endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">Rooms</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Rooms Management</li>
                <li class="breadcrumb-item active" aria-current="page">Rooms</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <h4 class=" d-inline-block">All Rooms</h4>
                        <button class="btn float-end btn-sm btn-inverse-primary btn-icon-text " id="add_btn"
                            data-bs-toggle="modal" data-bs-target="#exampleModal"
                            data-url="{{ route('admin.room.create') }}">
                            <i class="mdi mdi-plus-circle"></i>
                            Add
                        </button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content" id="modal-content">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.Datatable').DataTable();
            var get_modal_url = $('#add_btn').data('url')

            $('#add_btn').click(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "get",
                    url: get_modal_url,
                    success: function(view) {
                        $('#modal-content').html(view);
                        $('#room_image').html(`<input type="file" class="dropify form-control" data-max-file-size="2M" id="image" data-max-width="700"
                           data-max-height="700" name="image" data-allowed-file-extensions="jpeg jpg png"  required/>`);

                        $('.dropify').dropify();
                    }
                });
            });

            // $('.edit-btn').click(function(e) {
            //     e.preventDefault();
            //     let name = $(this).data('main-disease-name');
            //     let status = $(this).data('main-disease-status');
            //     let url = $(this).data('url');

            //     $.ajax({
            //         type: "get",
            //         url: get_modal_url,
            //         success: function(view) {
            //             $('#modal-content').html(view);

            //             $('#main_disease_name').val(name);

            //             if (status) {
            //                 $('#main_disease_status').attr('checked', true);
            //             } else {
            //                 $('#main_disease_status').removeAttr('checked');
            //             }

            //             $('#main_diseasee_form').attr('action', url);
            //             $('#main_diseasee_form_method').val('patch');

            //         }
            //     });
            // });

        });
    </script>
@endsection
