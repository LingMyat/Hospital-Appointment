@extends('layout.app')
@section('css')
    <style>
        div.dataTables_wrapper div.dataTables_paginate ul.pagination li.active a {
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
                <li class="breadcrumb-item active" aria-current="page">Main Diseases</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <h4 class=" d-inline-block">All Main Diseases</h4>
                        <button class="btn float-end btn-sm btn-inverse-primary btn-icon-text " id="add_btn"
                            data-bs-toggle="modal" data-bs-target="#exampleModal"
                            data-url="{{ route('admin.main-disease.create') }}">
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
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mainDiseases as $key => $mainDisease)
                                    <tr>
                                        <td>{{ $key += 1 }}</td>
                                        <td>{{ $mainDisease->name }}</td>
                                        <td class="">
                                            {!! getStatusBadge($mainDisease->status) !!}
                                        </td>
                                        <td class=" ">
                                            <a
                                                style="cursor: pointer"
                                                class="edit-btn"
                                                data-main-disease-name="{{ $mainDisease->name }}"
                                                data-main-disease-status="{{ $mainDisease->status }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"
                                                data-url="{{ route('admin.main-disease.update', $mainDisease->id) }}"><i
                                                    class="mdi mdi-square-edit-outline h4"></i></a>
                                            <a class="text-danger" href="{{ route('admin.disease.destroy',$mainDisease->id) }}"><i
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
                    }
                });
            });

            $('.edit-btn').click(function(e) {
                e.preventDefault();
                let name = $(this).data('main-disease-name');
                let status = $(this).data('main-disease-status');
                let url = $(this).data('url');

                $.ajax({
                    type: "get",
                    url: get_modal_url,
                    success: function(view) {
                        $('#modal-content').html(view);

                        $('#main_disease_name').val(name);

                        if (status) {
                            $('#main_disease_status').attr('checked', true);
                        } else {
                            $('#main_disease_status').removeAttr('checked');
                        }

                        $('#main_diseasee_form').attr('action', url);
                        $('#main_diseasee_form_method').val('patch');

                    }
                });
            });

        });
    </script>
@endsection
