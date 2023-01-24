@extends('layout.app')
@section('css')
    <style>
        div.dataTables_wrapper div.dataTables_paginate ul.pagination li.active a
        {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            background-image: linear-gradient(to right, rgb(218, 140, 255), rgb(154, 85, 255));
            background-position-x: initial;
            background-position-y: initial;
            background-size: initial;
            background-repeat-x: initial;
            background-repeat-y: initial;
            background-attachment: initial;
            background-origin: initial;
            background-clip: initial;
            background-color: initial;
            border: 0;
        }
    </style>
@endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">Diseases </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Diseses Management</li>
                <li class="breadcrumb-item active" aria-current="page">Sub Diseases</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <h4 class=" d-inline-block">All Sub Diseases</h4>
                        <button class="btn float-end btn-sm btn-inverse-primary btn-icon-text " id="add_btn"
                            data-bs-toggle="modal" data-bs-target="#exampleModal"
                            data-url="{{ route('admin.sub-disease.create') }}">
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
                        <table class="table table-hover Datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subDiseases as $key => $subDisease)
                                    <tr>
                                        <td>{{ $key += 1 }}</td>
                                        <td>{{ $subDisease->name }}</td>
                                        <td>
                                            <img src="{{ $subDisease->media->image ?? asset('assets/theme/profile/default-disease.png') }}"
                                                alt="{{ $subDisease->name }}">
                                        </td>
                                        <td class="">
                                            {!! getStatusBadge($subDisease->status) !!}
                                        </td>
                                        <td class="">
                                            <a
                                                style="cursor: pointer"
                                                class="update-btn"
                                                data-sub-disease-name="{{ $subDisease->name }}"
                                                data-sub-disease-status="{{ $subDisease->status }}"
                                                data-sub-disease-parent-id="{{ $subDisease->parent_id }}"
                                                data-sub-disease-image="{{ $subDisease->media->image }}"
                                                data-url="{{ route('admin.sub-disease.update',$subDisease->id) }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"
                                            ><i class="mdi mdi-square-edit-outline h4"></i></a>
                                            <a class="text-danger" href="{{ route('admin.disease.destroy',$subDisease->id) }}"><i
                                                    class="mdi mdi-delete-forever h4"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tbody>

                            </tbody>
                        </table>
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
                        $('#sub_disease_image').html(`<input type="file" class="dropify form-control" data-max-file-size="2M" id="image" data-max-width="700"
                           data-max-height="700" name="image" data-allowed-file-extensions="jpeg jpg png jfif"  required/>`);

                        $('.dropify').dropify();
                    }
                });
            });

            $('.update-btn').click(function(e){
                e.preventDefault();
                let parent_id = $(this).data('sub-disease-parent-id');
                let name = $(this).data('sub-disease-name');
                let img = $(this).data('sub-disease-image');
                let status = $(this).data('sub-disease-status');
                let url = $(this).data('url');

                console.log(name);
                $.ajax({
                    type: "get",
                    url: get_modal_url,
                    success: function (view) {
                        $('#modal-content').html(view);
                        $('#sub_disease_name').val(name);
                        $(`#main_disease_select option[value=${parent_id}]`).attr('selected', 'selected');


                        $('#sub_disease_image').html(`<input type="file" class="dropify form-control" data-max-file-size="2M" id="image" data-max-width="700"
                           data-max-height="700" name="image" data-allowed-file-extensions="jpeg jpg png jfif"  data-default-file="${img}"/>`);
                           $('.dropify').dropify();

                        if (status) {
                            $('#sub_disease_status').attr('checked', true);
                        } else {
                            $('#sub_disease_status').removeAttr('checked');
                        }

                        $('#main_diseasee_form').attr('action', url);
                        $('#main_diseasee_form_method').val('patch');
                    }
                });
            })


        });
    </script>
@endsection
