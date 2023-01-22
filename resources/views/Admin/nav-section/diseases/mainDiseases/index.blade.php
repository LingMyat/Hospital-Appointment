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
                <li class="breadcrumb-item active" aria-current="page">Diseases</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <h4 class=" d-inline-block">Main Diseases</h4>
                        <a class="btn float-end btn-sm btn-gradient-info btn-icon-text" href="">
                            <i class="mdi mdi-plus-circle"></i>
                            Add
                        </a>
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
                                @foreach ($mainDiseases as $key => $mainDisease)
                                    <tr>
                                        <td>{{ $key += 1 }}</td>
                                        <td>{{ $mainDisease->name }}</td>
                                        <td>
                                            <img src="{{ $mainDisease->media->image ?? asset('assets/theme/profile/default-disease.png') }}"
                                                alt="{{ $mainDisease->name }}">
                                        </td>
                                        <td class="">
                                            {!! getStatusBadge($mainDisease->status) !!}
                                        </td>
                                        <td class=" ">
                                            <a class="text-secondary" href=""><i
                                                    class="mdi mdi-pencil-box-outline h4"></i></a>
                                            <a class="text-secondary" href=""><i
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
        });
    </script>
@endsection
