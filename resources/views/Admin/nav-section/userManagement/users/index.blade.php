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
        <h3 class="page-title">Users</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Users Management</li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <h4 class=" d-inline-block">All Users</h4>
                        @can('user-create')
                            <a class="btn float-end btn-sm btn-inverse-primary btn-icon-text" href="{{ route('admin.user.create') }}">
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ $key+=1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $role)
                                                    <h5><span class="badge badge-gradient-primary">{{ $role }}</span></h5>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @can('user-edit')
                                                <a href="{{ route('admin.user.edit',$user->id) }}" class="">
                                                    <i class="mdi mdi-square-edit-outline h4"></i>
                                                </a>
                                            @endcan
                                            @if (!$user->hasrole('Superadmin'))
                                                @can('user-delete')
                                                <a class="text-danger delete_data_btn"
                                                href="{{ route('admin.user.destroy',$user->id) }}"
                                                ><i class="mdi mdi-delete-forever h4"></i></a>
                                                @endcan
                                            @endif
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
