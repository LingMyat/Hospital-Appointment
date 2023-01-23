@extends('layout.app')
@section('css')
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
                    <form method="post">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="header-title mt-5 mt-sm-0">Permission Name</h4>
                                    <div class="form-group mt-3">
                                        <input type="text" class="form-control" name="name" value="{{ $permission->name }}" placeholder="Enter permission name" required>
                                    </div>
                            </div> <!-- end col -->

                            <div class="col-md-6">
                                <h4 class="header-title mt-5 mt-sm-0">Assign Roles To Permission</h4>
                                <div class="mt-3">
                                    @foreach ($roles as $role)
                                        <div class="custom-control custom-checkbox">
                                            <input name="roles[]" type="checkbox" class="custom-control-input" id="role{{ $role->id }}" value="{{ $role->id }}"
                                            @if (in_array($role->id, $rolePermissions))
                                               checked
                                            @endif
                                            >
                                            <label class="custom-control-label" for="role{{ $role->id }}">{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center mt-3 mb-3">
                                    <a href="{{ route('admin.permissions') }}"><button type="button" class="btn w-sm btn-light waves-effect">Cancel</button></a>
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
