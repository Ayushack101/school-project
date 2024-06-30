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
                                <li class="breadcrumb-item">Section</li>
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
                            <h4>Manage Section</h4>
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
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#add-section">
                                        <button style='white-space:nowrap;' class='btn btn-primary btn-fill'><span
                                                class="mdi mdi-plus me-1"></span>Add
                                            Section</button>
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
                                            <th width='160px'>Section Name</th>
                                            <th width='156px'>Teacher Name</th>
                                            <th width="200px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sections_table">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Section --}}
    <div class="modal fade" id="add-section" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 600px !important">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add
                        Section</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addSection">
                        @csrf
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="section_name">
                                        <h5 style="white-space: nowrap">Section Name:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <input type="text" class="form-control" id="section_name" name="section_name"
                                        placeholder="Section Name">
                                    <span id="section_name_error" class="text-danger">
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
                    <button type="submit" class="btn btn-primary btn-fill save-btn">Add Section</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Delete Section --}}
    <div class="modal fade" id="delete-section" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete
                        Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure want to delete this Section?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-fill" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger btn-fill" id='deleteSection'>Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Section --}}
    <div class="modal fade" id="edit-section" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit
                        Class</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editSection">
                        @csrf
                        <input type='hidden' id='section_id' name='id' />
                        <div class="form-group">
                            <div class="row gx-0">
                                <div class="col-12 col-md-3 mb-3 d-flex justify-content-end pt-2 pe-3">
                                    <label for="section_name">
                                        <h5 style="white-space: nowrap">Section Name:</h5>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9 mb-3">
                                    <input type="text" class="form-control" id="section_name_edit"
                                        name="section_name" placeholder="Section Name">
                                    <span id="section_name_edit_error" class="text-danger">
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
            {{-- Fetch Sections based on class id --}}

            function fetchSections(classId) {
                $.ajax({
                    url: '{{ route('view.section') }}',
                    type: 'GET',
                    data: {
                        class_id: classId
                    },
                    success: function(response) {
                        $('#sections_table').html(response);
                    }
                });
            }

            @if ($classes->isNotEmpty())
                // Fetch sections for the default selected class on page load
                var defaultClassId = $('#class_select').val();
                if (defaultClassId) {
                    fetchSections(defaultClassId);
                }

                // Fetch sections when a new class is selected
                $('#class_select').on('change', function() {
                    var classId = $(this).val();
                    fetchSections(classId);
                });
            @endif

            // Add Section
            $("#addSection").on("submit", function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $(".text-danger").text("");
                $('.form-control').removeClass('is-invalid');

                $.ajax({
                    url: "{{ route('add.section') }}",
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
                            $("#add-section").modal("hide");
                            window.location.reload();
                            $("#addSection")[0].reset();
                        } else {
                            printErrorMsg(resp.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            // Validation error
                            printValidationErrorMsg(xhr.responseJSON.errors);
                        } else {
                            $("#add-section").modal("hide");
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

            $("#deleteSection").on("click", function(e) {
                console.log(deleteId);
                if (deleteId) {
                    var url = "{{ route('delete.section', 'deleteId') }}";
                    url = url.replace('deleteId', deleteId);
                    $.ajax({
                        url: url,
                        type: "GET",
                        contentType: false,
                        processData: false,
                        cache: false,
                        beforeSend: function() {
                            $("#deleteSection").prop("disabled", true);
                        },
                        complete: function() {
                            $("#deleteSection").prop("disabled", false);
                        },
                        success: function(resp, textStatus, xhr) {
                            if (xhr.status === 201 || xhr.status === 200) {
                                $("#delete-section").modal("hide");
                                window.location.reload();
                            } else {
                                printErrorMsg(resp.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            $("#delete-section").modal("hide");
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
                var section_name = $(this).attr('data-section-name');
                var teacher_id = $(this).attr('data-teacher');

                console.log($(this).attr('data-section-name'));

                $('#section_id').val(editId);
                $('#section_name_edit').val(section_name);
                $('#teacher_id_edit').val(teacher_id);
            });

            $('#editSection').on('submit', function(e) {
                e.preventDefault();
                var section_id = $('#section_id').val();
                if (!section_id) {
                    return;
                }
                let formData = new FormData(this);

                $(".text-danger").text("");
                $('.form-control').removeClass('is-invalid');

                $.ajax({
                    url: "{{ route('update.section') }}",
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
                            $("#edit-section").modal("hide");
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
                            $("#edit-section").modal("hide");
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
