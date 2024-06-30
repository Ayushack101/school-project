@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-12 col-sm-8">
                        <div class="mx-3 my-2">
                            <ul class="breadcrumb ">
                                <li class="breadcrumb-item"><a href="{{ route('view.dashboard') }}"
                                        class="d-flex justify-content-center align-items-center"><i
                                            class="nc-icon nc-chart-pie-35 me-2"></i><span>Dashboard</span></a>
                                </li>
                                <li class="breadcrumb-item">Student Edit</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Student</h4>
                        </div>
                        <div class="card-body">
                            @if (session()->has('success_message'))
                                <div class="d-flex justify-content-center">
                                    <div class="alert alert-success col-md-12" role="alert">
                                        <div class="d-flex">
                                            <div class="me-3">
                                                <span class="mdi mdi-check-circle-outline" style="font-size:21px;"></span>
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

                            @if (session()->has('error_message'))
                                <div class="d-flex justify-content-center">
                                    <div class="alert alert-warning col-md-12" role="alert">
                                        <div class="d-flex">
                                            <div class="me-3">
                                                <span class="mdi mdi-check-circle-outline" style="font-size:21px;"></span>
                                            </div>
                                            <div class="w-100">
                                                <span style="font-size: 15px;">
                                                    {{ session('error_message') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <form action="{{ route('edit.studentstore') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type='hidden' name='id' value="{{ $student->id }}" />
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="student_name">
                                                <h5>Name of the Student</h5>
                                            </label>
                                            <input type="text" value="{{ $student->student_name }}"
                                                class="form-control @error('student_name') is-invalid @enderror"
                                                id="student_name" name="student_name" placeholder="Name of the Student">
                                            <span class="text-danger">
                                                @error('student_name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="father_name">
                                                <h5>Father's Name</h5>
                                            </label>
                                            <input type="text" value="{{ $student->father_name }}"
                                                class="form-control @error('father_name') is-invalid @enderror"
                                                id="father_name" name="father_name" placeholder="Father's Name">
                                            <span class="text-danger">
                                                @error('father_name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mother_name">
                                                <h5>Mother's Name</h5>
                                            </label>
                                            <input type="text" value="{{ $student->mother_name }}"
                                                class="form-control @error('mother_name') is-invalid @enderror"
                                                id="mother_name" name="mother_name" placeholder="Mother's Name">
                                            <span class="text-danger">
                                                @error('mother_name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="disease_name">
                                                <h5>If suffering from any disease</h5>
                                            </label>
                                            <input type="text" value="{{ $student->disease_name }}"
                                                class="form-control @error('disease_name') is-invalid @enderror"
                                                id="disease_name" placeholder="If suffering from any disease"
                                                name="disease_name">
                                            <span class="text-danger">
                                                @error('disease_name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="blood_group">
                                                <h5>Blood Group</h5>
                                            </label>
                                            <select class="form-control @error('blood_group') is-invalid @enderror"
                                                name="blood_group" id="blood_group">
                                                <option value="" disabled selected>Select an option</option>
                                                <option value="A+" @if ($student->blood_group == 'A+') selected @endif>A+
                                                </option>
                                                <option value="A-" @if ($student->blood_group == 'A-') selected @endif>A-
                                                </option>
                                                <option value="B+" @if ($student->blood_group == 'B+') selected @endif>B+
                                                </option>
                                                <option value="B-" @if ($student->blood_group == 'B+') selected @endif>B-
                                                </option>
                                                <option value="AB+" @if ($student->blood_group == 'AB+') selected @endif>AB+
                                                </option>
                                                <option value="AB-" @if ($student->blood_group == 'AB-') selected @endif>
                                                    AB-</option>
                                                <option value="O+" @if ($student->blood_group == 'O+') selected @endif>O+
                                                </option>
                                                <option value="O-" @if ($student->blood_group == 'O-') selected @endif>O-
                                                </option>
                                            </select>
                                            <span class="text-danger">
                                                @error('blood_group')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="is_paralysed">
                                                <h5>Whether paralysed</h5>
                                            </label>
                                            <input type="text" value="{{ $student->is_paralysed }}"
                                                class="form-control @error('is_paralysed') is-invalid @enderror"
                                                id="is_paralysed" placeholder="Whether paralysed" name="is_paralysed">
                                            <span class="text-danger">
                                                @error('is_paralysed')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="student_hobby">
                                                <h5>Student Hobby</h5>
                                            </label>
                                            <input type="text" value="{{ $student->student_hobby }}"
                                                class="form-control @error('student_hobby') is-invalid @enderror"
                                                id="address" name="student_hobby" placeholder="Student Hobby">
                                            <span class="text-danger">
                                                @error('student_hobby')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="student_interests">
                                                <h5>Student interested in</h5>
                                            </label>
                                            <input type="text" value="{{ $student->student_interests }}"
                                                class="form-control @error('student_interests') is-invalid @enderror"
                                                id="student_interests" placeholder="Student interested in"
                                                name="student_interests">
                                            <span class="text-danger">
                                                @error('student_interests')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="disease">
                                                <h5>Diseases</h5>
                                            </label>
                                            <input type="text" value="{{ $student->disease }}"
                                                class="form-control @error('disease') is-invalid @enderror"
                                                id="disease" name="disease" placeholder="Diseases">
                                            <span class="text-danger">
                                                @error('disease')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="extra_details_of_student">
                                                <h5>Extra Details of Students</h5>
                                            </label>
                                            <input type="text" value="{{ $student->extra_details_of_student }}"
                                                class="form-control @error('extra_details_of_student') is-invalid @enderror"
                                                placeholder='Extra Details of Students' id="extra_details_of_student"
                                                name="extra_details_of_student">
                                            <span class="text-danger">
                                                @error('extra_details_of_student')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                <h5>Documents attatched at the time of admission
                                                </h5>
                                            </label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="adhar card"
                                                    @if (in_array('adhar card', $student->documents_attached)) checked @endif
                                                    id="documents_attached" name='documents_attached[]'>
                                                <label class="form-check-label" for="documents_attached">
                                                    Adhar Card of Student
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="age proof"
                                                    @if (in_array('age proof', $student->documents_attached)) checked @endif
                                                    id="documents_attached1" name='documents_attached[]'>
                                                <label class="form-check-label" for="documents_attached1">
                                                    Age Proof
                                                </label>
                                            </div>
                                            <input type="text" disabled value='{{ $student->age_proof }}'
                                                class="form-control" id="age_proof" name="age_proof"
                                                placeholder='Name of document'>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="photo"
                                                    @if (in_array('photo', $student->documents_attached)) checked @endif
                                                    id="documents_attached2" name='documents_attached[]'>
                                                <label class="form-check-label" for="documents_attached2">
                                                    Photo
                                                </label>
                                            </div>
                                            <span class="text-danger">
                                                @error('documents_attached')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                <h5>Identity of Parents</h5>
                                            </label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="voter id"
                                                    @if (in_array('voter id', $student->parents_identity_docs)) checked @endif
                                                    id="parents_identity_docs1" name='parents_identity_docs[]'>
                                                <label class="form-check-label" for="parents_identity_docs1">
                                                    Voter ID
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="adhar card"
                                                    @if (in_array('adhar card', $student->parents_identity_docs)) checked @endif
                                                    id="parents_identity_docs2" name='parents_identity_docs[]'>
                                                <label class="form-check-label" for="parents_identity_docs2">
                                                    Adhar Card
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="driving licence"
                                                    @if (in_array('driving licence', $student->parents_identity_docs)) checked @endif
                                                    id="parents_identity_docs3" name='parents_identity_docs[]'>
                                                <label class="form-check-label" for="parents_identity_docs3">
                                                    Driving Licence
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="ration card"
                                                    @if (in_array('ration card', $student->parents_identity_docs)) checked @endif
                                                    id="parents_identity_docs4" name='parents_identity_docs[]'>
                                                <label class="form-check-label" for="parents_identity_docs4">
                                                    Ration Card
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="electricity bill"
                                                    @if (in_array('electricity bill', $student->parents_identity_docs)) checked @endif
                                                    id="parents_identity_docs5" name='parents_identity_docs[]'>
                                                <label class="form-check-label" for="parents_identity_docs5">
                                                    Electricity Bill
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="gas card"
                                                    @if (in_array('gas card', $student->parents_identity_docs)) checked @endif
                                                    id="parents_identity_docs6" name='parents_identity_docs[]'>
                                                <label class="form-check-label" for="parents_identity_docs6">
                                                    Gas Card
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="bank passbook"
                                                    @if (in_array('bank passbook', $student->parents_identity_docs)) checked @endif
                                                    id="parents_identity_docs7" name='parents_identity_docs[]'>
                                                <label class="form-check-label" for="parents_identity_docs7">
                                                    Bank Passbook
                                                </label>
                                            </div>
                                            <span class="text-danger">
                                                @error('parents_identity_docs')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="rollno">
                                                    <h5>Roll no</h5>
                                                </label>
                                                <input type="text" value="{{ $student->rollno }}"
                                                    class="form-control @error('rollno') is-invalid @enderror"
                                                    id="rollno" name="rollno" placeholder="Roll no">
                                                <span class="text-danger">
                                                    @error('rollno')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='row'>
                                        <h4 class='col-auto'>ADMISSION FORM
                                        </h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="admission_class">
                                                    <h5>Application for admission in Class</h5>
                                                </label>
                                                <select
                                                    class="form-control @error('admission_class') is-invalid @enderror"
                                                    name="admission_class" id="admission_class">
                                                    {{-- <option value="" disabled selected>Select an option</option> --}}
                                                    @foreach ($classes as $class)
                                                        <option value="{{ $class->id }}"
                                                            @if ($student->admission_class == $class->id) selected @endif>
                                                            {{ $class->class_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">
                                                    @error('admission_class')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="section">
                                                    <h5>Section</h5>
                                                </label>
                                                <select class="form-control @error('section') is-invalid @enderror"
                                                    name="section" id="section">
                                                    <option value="" disabled selected>Select an option</option>
                                                </select>
                                                <span class="text-danger">
                                                    @error('section')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="dob">
                                                    <h5>Date of Birth</h5>
                                                </label>
                                                <input type="date" value="{{ $student->dob }}"
                                                    class="form-control @error('dob') is-invalid @enderror"
                                                    id="dob" name="dob" placeholder="Date of Birth">
                                                <span class="text-danger">
                                                    @error('dob')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    <h5>Sex</h5>
                                                </label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="gender1" value='male'
                                                        @if ($student->gender == 'male') checked @endif>
                                                    <label class="form-check-label" for="gender1">
                                                        Male
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        @if ($student->gender == 'female') checked @endif id="gender2"
                                                        value='female'>
                                                    <label class="form-check-label" for="gender2">
                                                        Female
                                                    </label>
                                                </div>

                                                <span class="text-danger">
                                                    @error('gender')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="dob">
                                                    <h5>Weight</h5>
                                                </label>
                                                <input type="text" value="{{ $student->weight }}"
                                                    class="form-control @error('weight') is-invalid @enderror"
                                                    id="weight" name="weight" placeholder="Weight">
                                                <span class="text-danger">
                                                    @error('weight')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="dob">
                                                    <h5>Height</h5>
                                                </label>
                                                <input type="text" value="{{ $student->height }}"
                                                    class="form-control @error('height') is-invalid @enderror"
                                                    id="height" name="height" placeholder="Height">
                                                <span class="text-danger">
                                                    @error('height')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="religion">
                                                    <h5>Religion</h5>
                                                </label>
                                                <select class="form-control @error('religion') is-invalid @enderror"
                                                    name="religion" id="religion">
                                                    <option value="" disabled selected>Select an option</option>
                                                    <option value="hindu"
                                                        @if ($student->religion == 'hindu') selected @endif>Hindu</option>
                                                    <option value="muslim"
                                                        @if ($student->religion == 'muslim') selected @endif>Muslim</option>
                                                    <option value="christians"
                                                        @if ($student->religion == 'christians') selected @endif>Christians
                                                    </option>
                                                    <option value="buddhists"
                                                        @if ($student->religion == 'buddhists') selected @endif>Buddhists
                                                    </option>
                                                    <option value="jains"
                                                        @if ($student->religion == 'jains') selected @endif>Jains</option>
                                                    <option value="others"
                                                        @if ($student->religion == 'others') selected @endif>others</option>
                                                </select>
                                                <span class="text-danger">
                                                    @error('religion')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category">
                                                    <h5>Category</h5>
                                                </label>
                                                <select class="form-control @error('category') is-invalid @enderror"
                                                    name="category" id="category">
                                                    <option value="" disabled selected>Select an option</option>
                                                    <option value="general"
                                                        @if ($student->category == 'general') selected @endif>General</option>
                                                    <option value="obc"
                                                        @if ($student->category == 'obc') selected @endif>OBC</option>
                                                    <option value="sc"
                                                        @if ($student->category == 'sc') selected @endif>SC</option>
                                                    <option value="st"
                                                        @if ($student->category == 'st') selected @endif>ST</option>
                                                </select>
                                                <span class="text-danger">
                                                    @error('category')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="postal_address">
                                                    <h5>Full Postal Address</h5>
                                                </label>
                                                <input type="text" value="{{ $student->postal_address }}"
                                                    class="form-control @error('postal_address') is-invalid @enderror"
                                                    id="postal_address" name="postal_address"
                                                    placeholder="Full Postal Address">
                                                <span class="text-danger">
                                                    @error('postal_address')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone_no">
                                                    <h5>Phone</h5>
                                                </label>
                                                <input type="text" value="{{ $student->phone_no }}"
                                                    class="form-control @error('phone_no') is-invalid @enderror"
                                                    id="phone_no" name="phone_no" placeholder="Phone">
                                                <span class="text-danger">
                                                    @error('phone_no')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="permanent_address">
                                                    <h5>Full Permanent Address</h5>
                                                </label>
                                                <input type="text" value="{{ $student->permanent_address }}"
                                                    class="form-control @error('permanent_address') is-invalid @enderror"
                                                    id="permanent_address" name="permanent_address"
                                                    placeholder="Full Permanent Address">
                                                <span class="text-danger">
                                                    @error('permanent_address')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="alternate_phone_no">
                                                    <h5>Another Phone</h5>
                                                </label>
                                                <input type="text" value="{{ $student->alternate_phone_no }}"
                                                    class="form-control @error('alternate_phone_no') is-invalid @enderror"
                                                    id="alternate_phone_no" name="alternate_phone_no"
                                                    placeholder="Another Phone">
                                                <span class="text-danger">
                                                    @error('alternate_phone_no')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="area">
                                                    <h5>Area</h5>
                                                </label>
                                                <input type="text" value="{{ $student->area }}"
                                                    class="form-control @error('area') is-invalid @enderror"
                                                    id="area" name="area" placeholder="Area">
                                                <span class="text-danger">
                                                    @error('area')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fathers_occupation">
                                                    <h5>Father's Occupation</h5>
                                                </label>
                                                <input type="text" value="{{ $student->fathers_occupation }}"
                                                    class="form-control @error('fathers_occupation') is-invalid @enderror"
                                                    id="fathers_occupation" name="fathers_occupation"
                                                    placeholder="Father's Occupation">
                                                <span class="text-danger">
                                                    @error('fathers_occupation')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mothers_occupation">
                                                    <h5>Mother's Occupation</h5>
                                                </label>
                                                <input type="text" value="{{ $student->mothers_occupation }}"
                                                    class="form-control @error('mothers_occupation') is-invalid @enderror"
                                                    id="mothers_occupation" name="mothers_occupation"
                                                    placeholder="Mother's Occupation">
                                                <span class="text-danger">
                                                    @error('mothers_occupation')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bpl_no">
                                                    <h5>BPL No. ( 0 if N/A )</h5>
                                                </label>
                                                <input type="text" value="{{ $student->bpl_no }}"
                                                    class="form-control @error('bpl_no') is-invalid @enderror"
                                                    id="bpl_no" name="bpl_no" placeholder="BPL No.">
                                                <span class="text-danger">
                                                    @error('bpl_no')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="aadhar_card_student">
                                                    <h5>Adhar Card No. of Student</h5>
                                                </label>
                                                <input type="text" value="{{ $student->aadhar_card_student }}"
                                                    class="form-control @error('aadhar_card_student') is-invalid @enderror"
                                                    id="aadhar_card_student" name="aadhar_card_student"
                                                    placeholder="0000 0000 0000">
                                                <span class="text-danger">
                                                    @error('aadhar_card_student')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="aadhar_card_parent">
                                                    <h5>Adhar Card No. of Parents</h5>
                                                </label>
                                                <input type="text" value="{{ $student->aadhar_card_parent }}"
                                                    class="form-control @error('aadhar_card_parent') is-invalid @enderror"
                                                    id="aadhar_card_parent" name="aadhar_card_parent"
                                                    placeholder="Adhar Card No. of Parents">
                                                <span class="text-danger">
                                                    @error('aadhar_card_parent')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bank_account_no">
                                                    <h5>Bank Account No. of student</h5>
                                                </label>
                                                <input type="text" value="{{ $student->bank_account_no }}"
                                                    class="form-control @error('bank_account_no') is-invalid @enderror"
                                                    id="bank_account_no" name="bank_account_no"
                                                    placeholder="Bank Account No. of student">
                                                <span class="text-danger">
                                                    @error('bank_account_no')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ifsc_code">
                                                    <h5>IFSC Code</h5>
                                                </label>
                                                <input type="text" value="{{ $student->ifsc_code }}"
                                                    class="form-control @error('ifsc_code') is-invalid @enderror"
                                                    id="ifsc_code" name="ifsc_code" placeholder="IFSC Code">
                                                <span class="text-danger">
                                                    @error('ifsc_code')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">
                                                    <h5>Email Id</h5>
                                                </label>
                                                <input type="email" value="{{ $student->email }}"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="email" name="email" placeholder="xyz@gmail.com">
                                                <span class="text-danger">
                                                    @error('email')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="native_language">
                                                    <h5>Language spoken at home</h5>
                                                </label>
                                                <input type="text" value="{{ $student->native_language }}"
                                                    class="form-control @error('native_language') is-invalid @enderror"
                                                    id="native_language" name="native_language"
                                                    placeholder="Language spoken at home">
                                                <span class="text-danger">
                                                    @error('native_language')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="previous_school">
                                                    <h5>Previous School</h5>
                                                </label>
                                                <input type="text" value="{{ $student->previous_school }}"
                                                    class="form-control @error('previous_school') is-invalid @enderror"
                                                    id="previous_school" name="previous_school"
                                                    placeholder="Previous School">
                                                <span class="text-danger">
                                                    @error('previous_school')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gurdian_name">
                                                    <h5>Gaurdian's Full Name</h5>
                                                </label>
                                                <input type="text" value="{{ $student->gurdian_name }}"
                                                    class="form-control @error('gurdian_name') is-invalid @enderror"
                                                    id="gurdian_name" name="gurdian_name"
                                                    placeholder="Gaurdian's Full Name">
                                                <span class="text-danger">
                                                    @error('gurdian_name')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="admission_no">
                                                    <h5>Admission No.</h5>
                                                </label>
                                                <input type="text" value="{{ $student->admission_no }}"
                                                    class="form-control @error('admission_no') is-invalid @enderror"
                                                    id="admission_no" name="admission_no" placeholder="Admission no">
                                                <span class="text-danger">
                                                    @error('admission_no')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="admission_date">
                                                    <h5>Admission Date</h5>
                                                </label>
                                                <input type="date" value="{{ $student->admission_date }}"
                                                    class="form-control @error('admission_date') is-invalid @enderror"
                                                    id="admission_date" name="admission_date"
                                                    placeholder="Admission Date">
                                                <span class="text-danger">
                                                    @error('admission_date')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Image -->
                                    <div class='row'>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="photo_path">
                                                    <h5>Photo
                                                    </h5>
                                                </label>
                                                @if ($student->photo_path)
                                                    <div>
                                                        <img src="{{ asset($student->photo_path) }}" alt="Student Image"
                                                            class='mb-2' style="max-width: 100px; max-height: 100px;">
                                                    </div>
                                                @endif
                                                <input type="file"
                                                    class="form-control @error('photo_path') is-invalid @enderror"
                                                    id="photo_path" name="photo_path">
                                                <span class="text-danger">
                                                    @error('photo_path')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}

                                    <div class="row mt-3">
                                        <div class="col-auto d-flex justify-content-start">
                                            <button type="submit" class="btn btn-primary btn-fill pull-right">Edit
                                                Student</button>
                                            <a class="btn btn-secondary btn-fill pull-right mx-3"
                                                href="{{ route('view.student') }}">Cancel</a>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            function fetchSections(classId) {
                var url = "{{ route('get.student.section', 'classId') }}";
                url = url.replace('classId', classId);
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        class_id: classId
                    },
                    success: function(data) {
                        var selectedSection = {{ $student->section }};
                        $('#section').empty();
                        $('#section').append(
                            '<option value="" disabled>Select an option</option>'
                        );
                        $.each(data, function(key, value) {
                            var isSelected = value.id == selectedSection ? 'selected' : '';
                            $('#section').append('<option value="' + value.id + '" ' +
                                isSelected + '>' + value.section_name + '</option>');
                        });
                    }
                });
            }

            var defaultClassId = $('#admission_class').val();
            if (defaultClassId) {
                fetchSections(defaultClassId);
            }

            $('#admission_class').change(function() {
                var classId = $(this).val();
                if (classId) {
                    var url = "{{ route('get.student.section', 'classId') }}";
                    url = url.replace('classId', classId);
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#section').empty();
                            $('#section').append(
                                '<option value="" disabled selected>Select an option</option>'
                            );
                            $.each(data, function(key, value) {
                                $('#section').append('<option value="' + value.id +
                                    '">' + value.section_name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#section').empty();
                    $('#section').append('<option value="" disabled selected>Select an option</option>');
                }
            });
        });
    </script>
@endpush
