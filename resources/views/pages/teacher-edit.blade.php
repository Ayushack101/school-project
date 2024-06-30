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
                                <li class="breadcrumb-item"><a href="{{ route('view.teacher') }}"
                                        class="d-flex justify-content-center align-items-center"><span
                                            class="mdi mdi-human-male-board me-2"></span><span>Teacher</span></a>
                                </li>
                                <li class="breadcrumb-item">Teacher Edit</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Teacher</h4>
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
                            <form action="{{ route('edit.teacherstore') }}" method="POST" enctype="multipart/form-data">

                                @csrf
                                <input type='hidden' name='id' value="{{ $teachers->id }}" />
                                <div class="row">
                                    <!-- First Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name">
                                                <h5>First Name</h5>
                                            </label>
                                            <input type="text" value="{{ $teachers->first_name }}"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                id="first_name" name="first_name" placeholder="First Name">
                                            <span class="text-danger">
                                                @error('first_name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Last Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">
                                                <h5>Last Name</h5>
                                            </label>
                                            <input type="text" value="{{ $teachers->last_name }}"
                                                class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                                                name="last_name" placeholder="Last Name">
                                            <span class="text-danger">
                                                @error('last_name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- DOB -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dob">
                                                <h5>DOB</h5>
                                            </label>
                                            <input type="date" value="{{ $teachers->dob }}"
                                                class="form-control @error('dob') is-invalid @enderror" id="dob"
                                                name="dob" placeholder="Date of Birth">
                                            <span class="text-danger">
                                                @error('dob')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Age -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="age">
                                                <h5>Age</h5>
                                            </label>
                                            <input type="number" value="{{ $teachers->age }}"
                                                class="form-control @error('age') is-invalid @enderror" id="age"
                                                placeholder="Age" name="age">
                                            <span class="text-danger">
                                                @error('age')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Contact -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contact">
                                                <h5>Contact</h5>
                                            </label>
                                            <input type="text" value="{{ $teachers->contact }}"
                                                class="form-control @error('contact') is-invalid @enderror" id="contact"
                                                name="contact" placeholder="Contact">
                                            <span class="text-danger">
                                                @error('contact')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">
                                                <h5>Email</h5>
                                            </label>
                                            <input type="email" value="{{ $teachers->email }}"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                placeholder="Email" name="email">
                                            <span class="text-danger">
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Address -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">
                                                <h5>Address</h5>
                                            </label>
                                            <input type="text" value="{{ $teachers->address }}"
                                                class="form-control @error('address') is-invalid @enderror" id="address"
                                                name="address" placeholder="Address">
                                            <span class="text-danger">
                                                @error('address')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <!-- City -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city">
                                                <h5>City</h5>
                                            </label>
                                            <input type="text" value="{{ $teachers->city }}"
                                                class="form-control @error('city') is-invalid @enderror" id="city"
                                                placeholder="City" name="city">
                                            <span class="text-danger">
                                                @error('city')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Country -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country">
                                                <h5>Country</h5>
                                            </label>
                                            <input type="text" value="{{ $teachers->country }}"
                                                class="form-control @error('country') is-invalid @enderror" id="country"
                                                name="country" placeholder="Country">
                                            <span class="text-danger">
                                                @error('country')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Register Date -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="registration_date">
                                                <h5>Register Date</h5>
                                            </label>
                                            <input type="date" value="{{ $teachers->registration_date }}"
                                                class="form-control @error('registration_date') is-invalid @enderror"
                                                id="registration_date" name="registration_date">
                                            <span class="text-danger">
                                                @error('registration_date')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Job Type -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="job_type">
                                                <h5>Job Type</h5>
                                            </label>
                                            <select class="form-control @error('job_type') is-invalid @enderror"
                                                name="job_type" id="job_type">
                                                <option value="" disabled selected>Select an option</option>
                                                <option value="full-time"
                                                    @if ($teachers->job_type == 'full-time') selected @endif>Full
                                                    Time</option>
                                                <option value="part-time"
                                                    @if ($teachers->job_type == 'part-time') selected @endif>Part Time</option>
                                            </select>
                                            <span class="text-danger">
                                                @error('job_type')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Image -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="photo_path">
                                                <h5>Image</h5>
                                            </label>
                                            @if ($teachers->photo_path)
                                                <div>
                                                    <img src="{{ asset($teachers->photo_path) }}" alt="Teacher Image"
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

                                <div class="row mt-3">
                                    <div class="col-auto d-flex justify-content-start">
                                        <button type="submit" name="product-submit"
                                            class="btn btn-primary btn-fill pull-right">Edit Teacher</button>
                                        <a class="btn btn-secondary btn-fill pull-right mx-3"
                                            href="{{ route('view.teacher') }}">Cancel</a>
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
