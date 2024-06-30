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
                                <li class="breadcrumb-item">Marksheet</li>
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
                            <h4>Manage Marksheet</h4>
                            <div>
                                {{-- <button class="btn btn-primary me-2">Export <span
                                    class="mdi mdi-tray-arrow-down"></span></button> --}}
                                <div class='d-flex justify-content-center align-items-center'>
                                    <select id="class_select" style='width: 260px;' class="form-control me-4">
                                        <option value="" disabled selected>Select Class</option>
                                        @if (!empty($classes) && isset($classes[0]))
                                            <option value="{{ $classes[0]->id }}" selected>
                                                {{ $classes[0]->class_name }}({{ $classes[0]->numeric_name }})
                                            </option>
                                            @foreach ($classes->slice(1) as $class)
                                                <option value="{{ $class->id }}">
                                                    {{ $class->class_name }}({{ $class->numeric_name }})</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#add-marksheet">
                                        <button style='white-space:nowrap;' class='btn btn-primary btn-fill'><span
                                                class="mdi mdi-plus me-1"></span>Add
                                            Marksheet</button>
                                    </a>
                                </div>
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
                                <table class="table table-bordered table-hover table-striped my-3 text-start"
                                    style="width:100%">
                                    <thead class="table-head-color">
                                        <tr>
                                            <th width='160px'>Marksheet Name</th>
                                            <th width='160px'>Date</th>
                                            <th width="200px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="marksheets_table">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Subject --}}
    <div class="modal fade" id="add-marksheet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 600px !important">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add
                        Marksheet</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addMarksheet">
                        @csrf
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="marksheet_name">
                                        <h5 style="white-space: nowrap">Marksheet Name:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <input type="text" class="form-control" id="marksheet_name" name="marksheet_name"
                                        placeholder="Marksheet Name">
                                    <span id="marksheet_name_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="exam_date">
                                        <h5 style="white-space: nowrap">Date:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <input type="date" class="form-control" id="exam_date" name="exam_date">
                                    <span id="exam_date_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="class_id">
                                        <h5 style="white-space: nowrap">Select Class:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select class="form-control" name="class_id" id="class_id">
                                        <option value="" disabled selected>Select an option</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->class_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span id="class_id_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-fill" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-fill save-btn">Add Marksheet</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Delete Section --}}
    <div class="modal fade" id="delete-marksheet" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete
                        Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure want to delete this Marksheet?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-fill" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger btn-fill" id='deleteMarksheet'>Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Section --}}
    <div class="modal fade" id="edit-marksheet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit
                        Marksheet</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editMarksheet">
                        @csrf
                        <input type='hidden' id='marksheet_id' name='id' />
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="marksheet_name_edit">
                                        <h5 style="white-space: nowrap">Marksheet Name:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <input type="text" class="form-control" id="marksheet_name_edit"
                                        name="marksheet_name" placeholder="Marksheet Name">
                                    <span id="marksheet_name_edit_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="exam_date_edit">
                                        <h5 style="white-space: nowrap">Date:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <input type="date" class="form-control" id="exam_date_edit" name="exam_date">
                                    <span id="exam_date_edit_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="teacher_id">
                                        <h5 style="white-space: nowrap">Select Class:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select class="form-control" name="class_id" id="class_id_edit">
                                        <option value="" disabled selected>Select an option</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->class_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span id="teacher_id_edit_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-fill" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-fill save-btn">Edit Marksheet</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            {{-- Fetch Marksheets based on class id --}}

            function fetchMarksheets(classId) {
                $.ajax({
                    url: '{{ route('view.marksheet') }}',
                    type: 'GET',
                    data: {
                        class_id: classId
                    },
                    success: function(response) {
                        $('#marksheets_table').html(response);
                    }
                });
            }

            @if ($classes->isNotEmpty())
                var defaultClassId = $('#class_select').val();
                if (defaultClassId) {
                    fetchMarksheets(defaultClassId);
                }

                $('#class_select').on('change', function() {
                    var classId = $(this).val();
                    fetchMarksheets(classId);
                });
            @endif

            // Add Subject
            $("#addMarksheet").on("submit", function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $(".text-danger").text("");
                $('.form-control').removeClass('is-invalid');

                $.ajax({
                    url: "{{ route('add.marksheet') }}",
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
                            $("#add-marksheet").modal("hide");
                            window.location.reload();
                            $("#addMarksheet")[0].reset();
                        } else {
                            printErrorMsg(resp.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            // Validation error
                            printValidationErrorMsg(xhr.responseJSON.errors);
                        } else {
                            $("#add-marksheet").modal("hide");
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
            $(document).on("click", ".delete-btn", function() {
                deleteId = $(this).data('id');
            });

            $("#deleteMarksheet").on("click", function(e) {
                if (deleteId) {
                    var url = "{{ route('delete.marksheet', 'deleteId') }}";
                    url = url.replace('deleteId', deleteId);
                    $.ajax({
                        url: url,
                        type: "GET",
                        contentType: false,
                        processData: false,
                        cache: false,
                        beforeSend: function() {
                            $("#deleteSubject").prop("disabled", true);
                        },
                        complete: function() {
                            $("#deleteSubject").prop("disabled", false);
                        },
                        success: function(resp, textStatus, xhr) {
                            if (xhr.status === 201 || xhr.status === 200) {
                                $("#delete-marksheet").modal("hide");
                                window.location.reload();
                            } else {
                                printErrorMsg(resp.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            $("#delete-marksheet").modal("hide");
                            printErrorMsg(
                                xhr.responseJSON.message ||
                                "An unexpected error occurred."
                            );
                        },
                    });
                }
            })

            // Edit Section
            $(document).on("click", ".edit-btn", function() {
                $(".text-danger").text("");
                $('.form-control').removeClass('is-invalid');

                var editId = $(this).attr('data-id');
                var marksheet_name = $(this).attr('data-marksheet-name');
                var exam_date = $(this).attr('data-exam-date');

                $('#marksheet_id').val(editId);
                $('#marksheet_name_edit').val(marksheet_name);
                $('#exam_date_edit').val(exam_date);
            });

            $('#editMarksheet').on('submit', function(e) {
                e.preventDefault();
                var marksheet_id = $('#marksheet_id').val();
                if (!marksheet_id) {
                    return;
                }
                let formData = new FormData(this);

                $(".text-danger").text("");
                $('.form-control').removeClass('is-invalid');

                $.ajax({
                    url: "{{ route('update.marksheet') }}",
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
                            $("#edit-subject").modal("hide");
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
                            $("#edit-subject").modal("hide");
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
