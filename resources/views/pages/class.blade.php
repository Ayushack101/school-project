@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            {{-- BreadCrumb --}}
            <div class="card mb-4">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-12 col-sm-8">
                        <div class="mx-3 my-2">
                            {{-- <h4 class="page-heading">
                            Product
                        </h4> --}}
                            <ul class="breadcrumb ">
                                <li class="breadcrumb-item"><a href="./"
                                        class="d-flex justify-content-center align-items-center"><i
                                            class="nc-icon nc-chart-pie-35 me-2"></i><span>Dashboard</span></a>
                                </li>
                                <li class="breadcrumb-item">Class</li>
                            </ul>
                        </div>
                    </div>
                    {{-- <div
                    class="col-12 col-sm-4 d-flex justify-content-start justify-content-sm-end align-items-center">
                    <div class=" mx-3 my-2">
                        <a href="./product-add">
                            <button class='btn btn-primary btn-fill'><span class="mdi mdi-plus me-1"></span>Add
                                Product</button>
                        </a>
                    </div>
                </div> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                            <h4>Manage Class</h4>
                            <div>

                                {{-- <button class="btn btn-primary me-2">Export <span
                                    class="mdi mdi-tray-arrow-down"></span></button> --}}
                                <a href="#" data-bs-toggle="modal" data-bs-target="#add-class">
                                    <button class='btn btn-primary btn-fill'><span class="mdi mdi-plus me-1"></span>Add
                                        Class</button>
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
                                            <th width='160px'>Class Name</th>
                                            <th width='156px'>Numeric Name</th>
                                            <th width="160px">Monthly Fee</th>
                                            <th width="160px">Development Fee</th>
                                            <th width="160px">Exam Fee</th>
                                            <th width="160px">Extra Activities</th>
                                            <th width="200px">Action</th>
                                            {{-- <td>
                                            <p class="badge text-bg-primary">asd</p>
                                        </td> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($class as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->class_name }}</td>
                                                <td>{{ $item->numeric_name }}</td>
                                                <td>{{ $item->monthly_fee }}</td>
                                                <td>{{ $item->development_fee }}</td>
                                                <td>{{ $item->exam_fee }}</td>
                                                <td>{{ $item->extra_activities }}</td>
                                                <td>
                                                    <div class='d-flex justify-content-center align-items-center'>
                                                        <div style="padding-right: 10px;"><a href="#"
                                                                data-id='{{ $item->id }}'
                                                                data-class='{{ $item->class_name }}'
                                                                data-numeric='{{ $item->numeric_name }}'
                                                                data-monthly='{{ $item->monthly_fee }}'
                                                                data-development='{{ $item->development_fee }}'
                                                                data-exam='{{ $item->exam_fee }}'
                                                                data-extra='{{ $item->extra_activities }}'
                                                                class='btn btn-primary btn-fill edit-btn'
                                                                data-bs-toggle="modal" data-bs-target="#edit-class">
                                                                <span class="mdi mdi-pencil"></span>
                                                            </a>
                                                        </div>
                                                        <a href="#" data-id='{{ $item->id }}'
                                                            class='btn btn-danger btn-fill delete-btn'
                                                            data-bs-toggle="modal" data-bs-target="#delete-class">
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

    {{-- Add Class --}}
    <div class="modal fade" id="add-class" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 600px !important">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add
                        Class</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addClass">
                        @csrf
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="class_name">
                                        <h5 style="white-space: nowrap">Class Name:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <input type="text" class="form-control" id="class_name" name="class_name"
                                        placeholder="Class Name">
                                    <span id="class_name_error" class="text-danger">
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="numeric_name">
                                        <h5 style="white-space: nowrap">Numeric Name:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <input type="text" class="form-control" id="numeric_name" name="numeric_name"
                                        placeholder="Numeric Name">
                                    <span id="numeric_name_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="monthly_fee">
                                        <h5 style="white-space: nowrap">Monthly Fee:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <input type="text" class="form-control" id="monthly_fee" name="monthly_fee"
                                        placeholder="Monthly Fee">
                                    <span id="monthly_fee_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="development_fee">
                                        <h5 style="white-space: nowrap">Development Fee:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <input type="text" class="form-control" id="development_fee"
                                        name="development_fee" placeholder="Development Fee">
                                    <span id="development_fee_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="exam_fee">
                                        <h5 style="white-space: nowrap">Exam Fee:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <input type="text" class="form-control" id="exam_fee" name="exam_fee"
                                        placeholder="Exam Fee">
                                    <span id="exam_fee_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="extra_activities">
                                        <h5 style="white-space: nowrap">Extra Activities:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control" id="extra_activities"
                                        name="extra_activities" placeholder="Extra Activities">
                                    <span id="extra_activities_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-fill" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-fill save-btn">Add Class</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Delete Class --}}
    <div class="modal fade" id="delete-class" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete
                        Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure want to delete this Class?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-fill" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger btn-fill" id='deleteClass'>Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Class --}}
    <div class="modal fade" id="edit-class" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit
                        Class</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editClass">
                        @csrf
                        <input type='hidden' id='class_id' name='id' />
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="class_name">
                                        <h5 style="white-space: nowrap">Class Name:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <input type="text" class="form-control" id="class_name_edit" name="class_name"
                                        placeholder="Class Name">
                                    <span id="class_name_edit_error" class="text-danger">
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="numeric_name">
                                        <h5 style="white-space: nowrap">Numeric Name:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <input type="text" class="form-control" id="numeric_name_edit"
                                        name="numeric_name" placeholder="Numeric Name">
                                    <span id="numeric_name_edit_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="monthly_fee">
                                        <h5 style="white-space: nowrap">Monthly Fee:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <input type="text" class="form-control" id="monthly_fee_edit" name="monthly_fee"
                                        placeholder="Monthly Fee">
                                    <span id="monthly_fee_edit_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="development_fee">
                                        <h5 style="white-space: nowrap">Development Fee:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <input type="text" class="form-control" id="development_fee_edit"
                                        name="development_fee" placeholder="Development Fee">
                                    <span id="development_fee_edit_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="exam_fee">
                                        <h5 style="white-space: nowrap">Exam Fee:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <input type="text" class="form-control" id="exam_fee_edit" name="exam_fee"
                                        placeholder="Exam Fee">
                                    <span id="exam_fee_edit_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="extra_activities">
                                        <h5 style="white-space: nowrap">Extra Activities:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control" id="extra_activities_edit"
                                        name="extra_activities" placeholder="Extra Activities">
                                    <span id="extra_activities_edit_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-fill" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-fill save-btn" data-id=''>Edit Class</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Add Class
            $("#addClass").on("submit", function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $(".text-danger").text("");
                $('.form-control').removeClass('is-invalid');

                $.ajax({
                    // url: $(this).attr('action'),
                    url: "{{ route('add.class') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    cache: false,
                    beforeSend: function() {
                        $(".save-btn").prop("disabled", true);
                    },
                    complete: function() {
                        $(".save-btn").prop("disabled", false);
                    },
                    success: function(resp, textStatus, xhr) {
                        if (xhr.status === 201 || xhr.status === 200) {
                            $("#add-class").modal("hide");
                            window.location.reload();
                            // printSuccessMsg(resp.message);
                            $("#addClass")[0].reset();
                        } else {
                            printErrorMsg(resp.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            // Validation error
                            printValidationErrorMsg(xhr.responseJSON.errors);
                        } else {
                            $("#add-class").modal("hide");
                            printErrorMsg(
                                xhr.responseJSON.message ||
                                "An unexpected error occurred."
                            );
                        }
                    },
                });

                function printValidationErrorMsg(msg) {
                    $.each(msg, function(field_name, error) {
                        $(document)
                            .find("#" + field_name + "_error")
                            .text(error);
                        $(document).find('#' + field_name).addClass('is-invalid');
                    });
                }
            });

            // Delete Class
            var deleteId;
            $('.delete-btn').on("click", function() {
                deleteId = $(this).data('id');
                console.log(deleteId);
            });

            $("#deleteClass").on("click", function(e) {
                if (deleteId) {
                    var url = "{{ route('delete.class', 'deleteId') }}";
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
            })

            // Edit Class
            $('.edit-btn').on('click', function() {
                $(".text-danger").text("");
                $('.form-control').removeClass('is-invalid');

                var editId = $(this).attr('data-id');
                var class1 = $(this).attr('data-class');
                var numeric = $(this).attr('data-numeric');
                var monthly = $(this).attr('data-monthly');
                var development = $(this).attr('data-development');
                var exam = $(this).attr('data-exam');
                var extra = $(this).attr('data-extra');

                $('#class_id').val(editId);
                $('#class_name_edit').val(class1);
                $('#numeric_name_edit').val(numeric);
                $('#monthly_fee_edit').val(monthly);
                $('#development_fee_edit').val(development);
                $('#exam_fee_edit').val(exam);
                $('#extra_activities_edit').val(extra);
            });

            $('#editClass').on('submit', function(e) {
                e.preventDefault();
                var class_id = $('#class_id').val();
                if (!class_id) {
                    return;
                }
                let formData = new FormData(this);

                $(".text-danger").text("");
                $('.form-control').removeClass('is-invalid');

                $.ajax({
                    url: "{{ route('update.class') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    cache: false,
                    beforeSend: function() {
                        $(".save-btn").prop("disabled", true);
                    },
                    complete: function() {
                        $(".save-btn").prop("disabled", false);
                    },
                    success: function(resp, textStatus, xhr) {
                        if (xhr.status === 201 || xhr.status === 200) {
                            $("#edit-class").modal("hide");
                            window.location.reload();
                        } else {
                            printErrorMsg(resp.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            // Validation error
                            printValidationErrorMsg(xhr.responseJSON.errors);
                        } else {
                            $("#edit-class").modal("hide");
                            printErrorMsg(
                                xhr.responseJSON.message ||
                                "An unexpected error occurred."
                            );
                        }
                    },
                });

                function printValidationErrorMsg(msg) {
                    $.each(msg, function(field_name, error) {
                        $(document)
                            .find("#" + field_name + "_edit_error")
                            .text(error);
                        $(document).find('#' + field_name + '_edit').addClass('is-invalid');
                    });
                }
            });

            // the functions for flash messages
            function printErrorMsg(msg) {
                $("#alert-danger").html("");
                $("#alert-danger").css("display", "block");
                $("#alert-danger").append("" + msg + "");
            }

            function printSuccessMsg(msg) {
                $("#alert-success").html("");
                $("#alert-success").css("display", "block");
                $("#alert-success").append("" + msg + "");
            }
        });
    </script>
@endpush
