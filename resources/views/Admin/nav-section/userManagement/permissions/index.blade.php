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
        <h3 class="page-title">Permissions</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Users Management</li>
                <li class="breadcrumb-item active" aria-current="page">Permissions</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <h4 class=" d-inline-block">All Permissions</h4>
                        <a class="btn float-end btn-sm btn-gradient-info btn-icon-text" href="{{ route('admin.permissions.create') }}">
                            <i class="mdi mdi-plus-circle"></i>
                            Add
                        </a>
                    </div>
                    <div class="">
                        <table class="table table-hover Datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Permission Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $key=>$permission)
                                    <tr>
                                        <td>{{ $key+=1 }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <a class="text-secondary" href=""><i class="mdi mdi-pencil-box-outline h4"></i></a>
                                            <a class="text-secondary delete_data_btn"
                                            href="javascript:void(0);"
                                            data-id="{{ $permission->id }}"
                                            data-url="{{ url('admin/permissions/'.$permission->id)}} "
                                            ><i class="mdi mdi-delete-forever h4"></i></a>
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
            $('.delete_data_btn').click(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: $(this).data('url'),
                });
            });
        });
    </script>
@endsection
