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
        <h3 class="page-title">Create Permission</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Users Management</li>
                <li class="breadcrumb-item">Permissions</li>
                <li class="breadcrumb-item active" aria-current="page">Create Permission</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" novalidate action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="header-title mt-5 mt-sm-0">Permission Name</h4>
                                    <div class="form-group mt-3">
                                        <input type="text" class="form-control" name="name" placeholder="Enter permission name" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please enter permission name.
                                        </div>
                                    </div>
                            </div> <!-- end col -->

                            <div class="col-md-6">
                                <h4 class="header-title mt-5 mt-sm-0">Assign Roles To Permission</h4>
                                <div class="mt-3">
                                    @foreach ($roles as $role)
                                        <div class="custom-control custom-checkbox">
                                            <input name="roles[]" type="checkbox" class="custom-control-input" id="role{{ $role->id }}" value="{{ $role->id }}">
                                            <label class="custom-control-label" for="role{{ $role->id }}">{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center mt-3 mb-3">
                                    <a href="{{ route('admin.permissions') }}"><button type="button" class="btn btn-gradient-secondary btn-sm">Cancel</button></a>
                                    <button type="submit" class="btn btn-gradient-success btn-sm">Save</button>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
