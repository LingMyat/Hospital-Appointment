@extends('layout.app')
@section('css')
    <style>
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
