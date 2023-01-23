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
        <h3 class="page-title">Roles</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Users Management</li>
                <li class="breadcrumb-item active" aria-current="page">Roles</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <h4 class=" d-inline-block">All Roles</h4>
                        @can('role-create')
                            <a class="btn float-end btn-sm btn-inverse-primary btn-icon-text" href="{{ route('admin.role.create') }}">
                                <i class="mdi mdi-plus-circle"></i>
                                Add
                            </a>
                        @endcan
                    </div>
                    <div class="">
                        <table class="table table-hover Datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key=>$role)
                                    <tr>
                                        <td>{{ $key+=1 }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @can('role-edit')
                                                <a class="" href="{{ route('admin.role.edit',$role->id) }}"><i class="mdi mdi-square-edit-outline h4"></i></a>
                                            @endcan
                                            @can('role-delete')
                                                <a class="text-danger delete_data_btn"
                                                href="{{ route('admin.role.destroy',$role->id) }}"
                                                ><i class="mdi mdi-delete-forever h4"></i></a>
                                            @endcan
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

        });
    </script>
@endsection
