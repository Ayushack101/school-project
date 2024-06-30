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
                                <li class="breadcrumb-item">Student</li>
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
                            <h4>Manage Student</h4>
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
                                    {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#add-marksheet">
                                        <button style='white-space:nowrap;' class='btn btn-primary btn-fill'><span
                                                class="mdi mdi-plus me-1"></span>Add
                                            student</button>
                                    </a> --}}
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
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                            </ul>

                            <div class="table-full-width table-responsive">
                                <table class="table table-bordered table-hover table-striped my-3 text-start"
                                    style="width:100%">
                                    <thead class="table-head-color">
                                        <tr>
                                            <th width='45px'>Photo</th>
                                            <th width='160px'>Student Name</th>
                                            <th width='160px'>Father's Name</th>
                                            <th width="200px">Mother's Name</th>
                                            <th width="200px">Student Id</th>
                                            <th width="200px">Admission No</th>
                                            <th width="200px">Class</th>
                                            <th width="200px">Section</th>
                                            <th width="200px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="students_table">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Section --}}
    <div class="modal fade" id="delete-student" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete
                        Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure want to delete this Student?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-fill" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger btn-fill" id='deleteStudent'>Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // fetch students based on class id and section id
            function fetchStudents(classId, sectionId = '') {
                $.ajax({
                    url: '{{ route('view.student') }}',
                    type: 'GET',
                    data: {
                        class_id: classId,
                        section_id: sectionId
                    },
                    success: function(response) {
                        $('#students_table').html(response);
                    }
                });
            }

            // fetch sections based on class id
            function fetchSections(classId) {
                var url = "{{ route('get.student.section', 'classId') }}";
                url = url.replace('classId', classId);
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        class_id: classId
                    },
                    success: function(response) {
                        updateSections(response);
                    }
                });
            }

            function updateSections(sections) {
                var tabs = '<li class="nav-item" role="presentation">' +
                    '<button class="nav-link active" id="all-student-tab" data-bs-toggle="tab"' +
                    'data-bs-target="#all-student-tab-pane" type="button" role="tab"' +
                    'aria-controls="all-student-tab-pane" aria-selected="true" data-section-id="">All Students</button>' +
                    '</li>';
                sections.forEach(function(section) {
                    tabs += '<li class="nav-item" role="presentation">' +
                        '<button class="nav-link" id="section-tab-' + section.id +
                        '" data-bs-toggle="tab"' +
                        'data-bs-target="#section-tab-pane-' + section.id + '" type="button" role="tab"' +
                        'aria-controls="section-tab-pane-' + section.id +
                        '" aria-selected="false" data-section-id="' + section.id + '">' +
                        'Section (' + section.section_name + ')</button>' +
                        '</li>';
                });
                $('#myTab').html(tabs);

                // Re-bind the click event for the new section tabs
                $('#myTab button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                    var sectionId = $(e.target).data('section-id');
                    var classId = $('#class_select').val();
                    fetchStudents(classId, sectionId);
                });

                // Set the "All Students" tab as active
                $('#myTab button.nav-link').removeClass('active').attr('aria-selected', 'false');
                $('#myTab button#all-student-tab').addClass('active').attr('aria-selected', 'true');
            }
            @if ($classes->isNotEmpty())
                var defaultClassId = $('#class_select').val();
                if (defaultClassId) {
                    fetchStudents(defaultClassId);
                    fetchSections(defaultClassId);
                }

                $('#class_select').on('change', function() {
                    var classId = $(this).val();
                    fetchStudents(classId);
                    fetchSections(classId);
                });
            @endif

            // Delete Class
            var deleteId;
            $(document).on("click", ".delete-btn", function() {
                deleteId = $(this).data('id');
            });

            $("#deleteStudent").on("click", function(e) {
                if (deleteId) {
                    var url = "{{ route('delete.student', 'deleteId') }}";
                    url = url.replace('deleteId', deleteId);
                    $.ajax({
                        url: url,
                        type: "GET",
                        contentType: false,
                        processData: false,
                        cache: false,
                        beforeSend: function() {
                            $("#deleteStudent").prop("disabled", true);
                        },
                        complete: function() {
                            $("#deleteStudent").prop("disabled", false);
                        },
                        success: function(resp, textStatus, xhr) {
                            if (xhr.status === 201 || xhr.status === 200) {
                                $("#delete-student").modal("hide");
                                window.location.reload();
                            } else {
                                printErrorMsg(resp.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            $("#delete-student").modal("hide");
                            printErrorMsg(
                                xhr.responseJSON.message ||
                                "An unexpected error occurred."
                            );
                        },
                    });
                }
            })

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
