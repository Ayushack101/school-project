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
                                <li class="breadcrumb-item">Subject</li>
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
                            <h4>Manage Subject</h4>
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
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#add-subject">
                                        <button style='white-space:nowrap;' class='btn btn-primary btn-fill'><span
                                                class="mdi mdi-plus me-1"></span>Add
                                            Subject</button>
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
                                            <th width='160px'>Subject Name</th>
                                            <th width='160px'>Total Marks</th>
                                            <th width='156px'>Teacher Name</th>
                                            <th width="200px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="subjects_table">
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
    <div class="modal fade" id="add-subject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 600px !important">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add
                        Section</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addSubject">
                        @csrf
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="subject_name">
                                        <h5 style="white-space: nowrap">Subject Name:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <input type="text" class="form-control" id="subject_name" name="subject_name"
                                        placeholder="Subject Name">
                                    <span id="subject_name_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="total_marks">
                                        <h5 style="white-space: nowrap">Total Marks:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <input type="text" class="form-control" id="total_marks" name="total_marks"
                                        placeholder="Subject Name">
                                    <span id="total_marks_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="teacher_id">
                                        <h5 style="white-space: nowrap">Select Teacher:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <select class="form-control" name="teacher_id" id="teacher_id">
                                        <option value="" disabled selected>Select an option</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->first_name }}
                                                {{ $teacher->last_name }}</option>
                                        @endforeach
                                    </select>
                                    <span id="teacher_id_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="teacher_id">
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
                    <button type="submit" class="btn btn-primary btn-fill save-btn">Add Subject</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Delete Section --}}
    <div class="modal fade" id="delete-subject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete
                        Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure want to delete this Subject?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-fill" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger btn-fill" id='deleteSubject'>Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Section --}}
    <div class="modal fade" id="edit-subject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit
                        Subject</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editSubject">
                        @csrf
                        <input type='hidden' id='subject_id' name='id' />
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="subject_name_edit">
                                        <h5 style="white-space: nowrap">Subject Name:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <input type="text" class="form-control" id="subject_name_edit"
                                        name="subject_name" placeholder="Subject Name">
                                    <span id="subject_name_edit_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="total_marks_edit">
                                        <h5 style="white-space: nowrap">Total Marks:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <input type="text" class="form-control" id="total_marks_edit" name="total_marks"
                                        placeholder="Subject Name">
                                    <span id="total_marks_edit_error" class="text-danger">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="teacher_id">
                                        <h5 style="white-space: nowrap">Select Teacher:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <select class="form-control" name="teacher_id" id="teacher_id_edit">
                                        <option value="" disabled selected>Select an option</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">
                                                {{ $teacher->first_name }}
                                                {{ $teacher->last_name }}</option>
                                        @endforeach
                                    </select>
                                    <span id="teacher_id_edit_error" class="text-danger">
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
                    <button type="submit" class="btn btn-primary btn-fill save-btn">Edit Subject</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            {{-- Fetch Subjects based on class id --}}

            function fetchSubjects(classId) {
                $.ajax({
                    url: '{{ route('view.subject') }}',
                    type: 'GET',
                    data: {
                        class_id: classId
                    },
                    success: function(response) {
                        $('#subjects_table').html(response);
                    }
                });
            }

            @if ($classes->isNotEmpty())
                // Fetch sections for the default selected class on page load
                var defaultClassId = $('#class_select').val();
                if (defaultClassId) {
                    fetchSubjects(defaultClassId);
                }

                // Fetch sections when a new class is selected
                $('#class_select').on('change', function() {
                    var classId = $(this).val();
                    fetchSubjects(classId);
                });
            @endif

            // Add Subject
            $("#addSubject").on("submit", function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $(".text-danger").text("");
                $('.form-control').removeClass('is-invalid');

                $.ajax({
                    url: "{{ route('add.subject') }}",
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
                            $("#add-subject").modal("hide");
                            window.location.reload();
                            $("#addSubject")[0].reset();
                        } else {
                            printErrorMsg(resp.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            // Validation error
                            printValidationErrorMsg(xhr.responseJSON.errors);
                        } else {
                            $("#add-subject").modal("hide");
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

            $("#deleteSubject").on("click", function(e) {
                if (deleteId) {
                    var url = "{{ route('delete.subject', 'deleteId') }}";
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
                                $("#delete-subject").modal("hide");
                                window.location.reload();
                            } else {
                                printErrorMsg(resp.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            $("#delete-subject").modal("hide");
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
                var subject_name = $(this).attr('data-subject-name');
                var total_marks = $(this).attr('data-total-marks');
                var teacher_id = $(this).attr('data-teacher');

                $('#subject_id').val(editId);
                $('#subject_name_edit').val(subject_name);
                $('#total_marks_edit').val(total_marks);
                $('#teacher_id_edit').val(teacher_id);
            });

            $('#editSubject').on('submit', function(e) {
                e.preventDefault();
                var subject_id = $('#subject_id').val();
                if (!subject_id) {
                    return;
                }
                let formData = new FormData(this);

                $(".text-danger").text("");
                $('.form-control').removeClass('is-invalid');

                $.ajax({
                    url: "{{ route('update.subject') }}",
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
