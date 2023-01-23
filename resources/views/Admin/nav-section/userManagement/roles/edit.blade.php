@extends('layout.app')
@section('css')
@endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">Edit Role</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Users Management</li>
                <li class="breadcrumb-item">Roles</li>
                <li class="breadcrumb-item active" aria-current="page">Edit Role</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" novalidate action="" method="post">
                        @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="header-title mt-5 mt-sm-0">Role Name</h4>
                                        <div class="form-group mt-3">
                                            <input type="text" class="form-control" name="name" value="{{ $role->name }}" placeholder="Enter role name" required>
                                        </div>
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <h4 class="header-title mt-5 mt-sm-0">Assign Permissions To Role</h4>
                                    <div class="mt-3">
                                        @foreach ($permissions as $permission)
                                            <div class="custom-control custom-checkbox">
                                                <input name="permissions[]" type="checkbox" class="custom-control-input" id="permission{{ $permission->id }}" value="{{ $permission->id }}"
                                                @if (in_array($permission->id, $rolePermissions))
                                                   checked
                                                @endif
                                                >
                                                <label class="custom-control-label" for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-center mt-3 mb-3">
                                        <a href="{{ route('admin.roles') }}"><button type="button" class="btn btn-light">Cancel</button></a>
                                        <button type="submit" class="btn btn-gradient-success">Save</button>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
