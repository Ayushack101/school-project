@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            {{-- BreadCrumb --}}
            <div class="card mb-4">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-12 col-sm-8">
                        <div class="mx-3 my-2">
                            <ul class="breadcrumb ">
                                <li class="breadcrumb-item"><a href="./"
                                        class="d-flex justify-content-center align-items-center"><i
                                            class="nc-icon nc-chart-pie-35 me-2"></i><span>Dashboard</span></a>
                                </li>
                                <li class="breadcrumb-item">Teacher</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                            <h4>Manage Teacher</h4>
                            <div>
                                <a href="{{ route('add.teacher') }}">
                                    <button class='btn btn-primary btn-fill'><span class="mdi mdi-plus me-1"></span>Add
                                        Teacher</button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                @if (session()->has('success_message'))
                                    <div class="d-flex justify-content-center">
                                        <div class="alert alert-success col-md-12" role="alert">
                                            <div class="d-flex">
                                                <div class="me-3">
                                                    <span class="mdi mdi-check-circle-outline"
                                                        style="font-size:21px;"></span>
                                                </div>
                                                <div class="w-100">
                                                    <span style="font-size: 15px;">
                                                        {{ session('success_message') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <span class="alert alert-danger" id="alert-danger" style="display: none;">
                                </span>
                            </div>
                            <div class="table-full-width table-responsive">
                                <table id="example" class="table table-bordered table-hover table-striped my-3 text-start"
                                    style="width:100%">
                                    <thead class="table-head-color">
                                        <tr>
                                            <th width="20px">#</th>
                                            <th width='160px'>Teacher Name</th>
                                            <th width='156px'>Age</th>
                                            <th width="160px">Contact</th>
                                            <th width="160px">Email</th>
                                            <th width="200px">Action</th>
                                            {{-- <td>
                                            <p class="badge text-bg-primary">asd</p>
                                        </td> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teachers as $teacher)
                                            <tr>
                                                <td><img class='rounded mx-auto d-block' width='70px' height='70px'
                                                        src='{{ $teacher->photo_path }}'>
                                                </td>
                                                <td>{{ $teacher->first_name }} {{ $teacher->last_name }}</td>
                                                <td>{{ $teacher->age }}</td>
                                                <td>{{ $teacher->contact }}</td>
                                                <td>{{ $teacher->email }}</td>
                                                <td>
                                                    <div class='d-flex justify-content-center align-items-center'>
                                                        <a href="{{ route('edit.teacher', $teacher->id) }}"
                                                            class='btn btn-primary btn-fill me-3'>
                                                            <span class="mdi mdi-pencil"></span>
                                                        </a>
                                                        <a href="#" data-id='{{ $teacher->id }}'
                                                            class='btn btn-danger btn-fill delete-btn'
                                                            data-bs-toggle="modal" data-bs-target="#delete-teacher">
                                                            <span class="mdi mdi-trash-can-outline"></span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Delete Teacher --}}
    <div class="modal fade" id="delete-teacher" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete
                        Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure want to delete this Teacher?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-fill" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger btn-fill" id='deleteClass'>Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Delete Teacher
            var deleteId;
            $('.delete-btn').on("click", function() {
                deleteId = $(this).data('id');
                console.log(deleteId);
            });
            $("#deleteClass").on("click", function(e) {
                if (deleteId) {
                    var url = "{{ route('delete.teacher', 'deleteId') }}";
                    url = url.replace('deleteId', deleteId);
                    $.ajax({
                        url: url,
                        type: "GET",
                        contentType: false,
                        processData: false,
                        cache: false,
                        beforeSend: function() {
                            $("#deleteClass").prop("disabled", true);
                        },
                        complete: function() {
                            $("#deleteClass").prop("disabled", false);
                        },
                        success: function(resp, textStatus, xhr) {
                            if (xhr.status === 201 || xhr.status === 200) {
                                $("#delete-class").modal("hide");
                                window.location.reload();
                            } else {
                                printErrorMsg(resp.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            $("#delete-class").modal("hide");
                            printErrorMsg(
                                xhr.responseJSON.message ||
                                "An unexpected error occurred."
                            );
                        },
                    });
                }
            });
            // the functions for flash messages
            function printErrorMsg(msg) {
                $("#alert-danger").html("");
                $("#alert-danger").css("display", "block");
                $("#alert-danger").append("" + msg + "");
            }
        })
    </script>
@endpush
