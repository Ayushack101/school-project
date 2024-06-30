@extends('layouts/app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="card-stats card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7 d-flex justify-content-start align-items-start">
                                    <div>
                                        <h2>
                                            {{ $class }}
                                        </h2>
                                        <h5 class="mt-2">Class</h5>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="icon-big text-center icon-warning">
                                        <span class="mdi mdi-warehouse text-primary"></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="card-footer mt-2">
                            <a href="{{ route('view.class') }}">
                                <div class="stats"></i>
                                    <p>More info</p><span class="mdi  mdi-arrow-right-thin-circle-outline ms-2"
                                        style="font-size: 23px;"></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="card-stats card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7 d-flex justify-content-start align-items-start">
                                    <div>
                                        <h2>
                                            {{ $section }}
                                        </h2>
                                        <h5 class="mt-2">Section</h5>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-notes text-primary"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="card-footer mt-2">
                            <a href="{{ route('view.section') }}">
                                <div class="stats"></i>
                                    <p>More info</p><span class="mdi  mdi-arrow-right-thin-circle-outline ms-2"
                                        style="font-size: 23px;"></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="card-stats card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7 d-flex justify-content-start align-items-start">
                                    <div>
                                        <h2> {{ $subject }}
                                        </h2>
                                        <h5 class="mt-2">Subjects</h5>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-notes text-info"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="card-footer mt-2">
                            <a href="{{ route('view.subject') }}">
                                <div class="stats"></i>
                                    <p>More info</p><span class="mdi  mdi-arrow-right-thin-circle-outline ms-2"
                                        style="font-size: 23px;"></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="card-stats card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7 d-flex justify-content-start align-items-start">
                                    <div>
                                        <h2>{{ $teacher }}
                                        </h2>
                                        <h5 class="mt-2">Teachers
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-notes text-secondary"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="card-footer mt-2">
                            <a href="{{ route('view.teacher') }}">
                                <div class="stats"></i>
                                    <p>More info</p><span class="mdi  mdi-arrow-right-thin-circle-outline ms-2"
                                        style="font-size: 23px;"></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="card-stats card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7 d-flex justify-content-start align-items-start">
                                    <div>
                                        <h2>{{ $student }}
                                        </h2>
                                        <h5 class="mt-2">Students
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-notes text-success"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="card-footer mt-2">
                            <a href="{{ route('view.student') }}">
                                <div class="stats"></i>
                                    <p>More info</p><span class="mdi  mdi-arrow-right-thin-circle-outline ms-2"
                                        style="font-size: 23px;"></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h4 class="card-title">Email Statistics</h4>
                                                                    <p class="card-category">Last Campaign Performance</p>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>
                                                                    <div class="legend">
                                                                        <i class="fa fa-circle text-info"></i> Open
                                                                        <i class="fa fa-circle text-danger"></i> Bounce
                                                                        <i class="fa fa-circle text-warning"></i> Unsubscribe
                                                                    </div>
                                                                    <hr />
                                                                    <div class="stats">
                                                                        <i class="fa-regular fa-clock"></i> Campaign sent 2 days ago
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h4 class="card-title">Users Behavior</h4>
                                                                    <p class="card-category">24 Hours performance</p>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div id="chartHours" class="ct-chart"></div>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <div class="legend">
                                                                        <i class="fa fa-circle text-info"></i> Open
                                                                        <i class="fa fa-circle text-danger"></i> Click
                                                                        <i class="fa fa-circle text-warning"></i> Click Second
                                                                        Time
                                                                    </div>
                                                                    <hr />
                                                                    <div class="stats">
                                                                        <i class="fa fa-history"></i> Updated 3 minutes ago
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
            <!-- <div class="row d-flex justify-content-center align-items-center">
                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h4 class="card-title">2017 Sales</h4>
                                                                    <p class="card-category">All products including Taxes</p>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div id="chartActivity" class="ct-chart"></div>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <div class="legend">
                                                                        <i class="fa fa-circle text-info"></i> Tesla Model S
                                                                        <i class="fa fa-circle text-danger"></i> BMW 5 Series
                                                                    </div>
                                                                    <hr />
                                                                    <div class="stats">
                                                                        <i class="fa fa-check"></i> Data information certified
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card card-tasks">
                                                                <div class="card-header">
                                                                    <h4 class="card-title">Tasks</h4>
                                                                    <p class="card-category">Backend development</p>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="table-full-width">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="form-check">
                                                                                            <label class="form-check-label">
                                                                                                <input class="form-check-input" type="checkbox" value="" />
                                                                                                <span class="form-check-sign"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        Sign contract for "What are conference organizers
                                                                                        afraid of?"
                                                                                    </td>
                                                                                    <td class="td-actions text-right">
                                                                                        <button type="button" rel="tooltip" title="Edit Task"
                                                                                            class="btn btn-info btn-simple btn-link">
                                                                                            <i class="fa fa-edit"></i>
                                                                                        </button>
                                                                                        <button type="button" rel="tooltip" title="Remove"
                                                                                            class="btn btn-danger btn-simple btn-link">
                                                                                            <i class="fa fa-times"></i>
                                                                                        </button>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="form-check">
                                                                                            <label class="form-check-label">
                                                                                                <input class="form-check-input" type="checkbox" value="" checked />
                                                                                                <span class="form-check-sign"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        Lines From Great Russian Literature? Or E-mails
                                                                                        From My Boss?
                                                                                    </td>
                                                                                    <td class="td-actions text-right">
                                                                                        <button type="button" rel="tooltip" title="Edit Task"
                                                                                            class="btn btn-info btn-simple btn-link">
                                                                                            <i class="fa fa-edit"></i>
                                                                                        </button>
                                                                                        <button type="button" rel="tooltip" title="Remove"
                                                                                            class="btn btn-danger btn-simple btn-link">
                                                                                            <i class="fa fa-times"></i>
                                                                                        </button>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="form-check">
                                                                                            <label class="form-check-label">
                                                                                                <input class="form-check-input" type="checkbox" value="" checked />
                                                                                                <span class="form-check-sign"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        Flooded: One year later, assessing what was lost
                                                                                        and what was found when a ravaging rain swept
                                                                                        through metro Detroit
                                                                                    </td>
                                                                                    <td class="td-actions text-right">
                                                                                        <button type="button" rel="tooltip" title="Edit Task"
                                                                                            class="btn btn-info btn-simple btn-link">
                                                                                            <i class="fa fa-edit"></i>
                                                                                        </button>
                                                                                        <button type="button" rel="tooltip" title="Remove"
                                                                                            class="btn btn-danger btn-simple btn-link">
                                                                                            <i class="fa fa-times"></i>
                                                                                        </button>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="form-check">
                                                                                            <label class="form-check-label">
                                                                                                <input class="form-check-input" type="checkbox" checked />
                                                                                                <span class="form-check-sign"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        Create 4 Invisible User Experiences you Never Knew
                                                                                        About
                                                                                    </td>
                                                                                    <td class="td-actions text-right">
                                                                                        <button type="button" rel="tooltip" title="Edit Task"
                                                                                            class="btn btn-info btn-simple btn-link">
                                                                                            <i class="fa fa-edit"></i>
                                                                                        </button>
                                                                                        <button type="button" rel="tooltip" title="Remove"
                                                                                            class="btn btn-danger btn-simple btn-link">
                                                                                            <i class="fa fa-times"></i>
                                                                                        </button>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="form-check">
                                                                                            <label class="form-check-label">
                                                                                                <input class="form-check-input" type="checkbox" value="" />
                                                                                                <span class="form-check-sign"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>Read "Following makes Medium better"</td>
                                                                                    <td class="td-actions text-right">
                                                                                        <button type="button" rel="tooltip" title="Edit Task"
                                                                                            class="btn btn-info btn-simple btn-link">
                                                                                            <i class="fa fa-edit"></i>
                                                                                        </button>
                                                                                        <button type="button" rel="tooltip" title="Remove"
                                                                                            class="btn btn-danger btn-simple btn-link">
                                                                                            <i class="fa fa-times"></i>
                                                                                        </button>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="form-check">
                                                                                            <label class="form-check-label">
                                                                                                <input class="form-check-input" type="checkbox" value="" disabled />
                                                                                                <span class="form-check-sign"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>Unfollow 5 enemies from twitter</td>
                                                                                    <td class="td-actions text-right">
                                                                                        <button type="button" rel="tooltip" title="Edit Task"
                                                                                            class="btn btn-info btn-simple btn-link">
                                                                                            <i class="fa fa-edit"></i>
                                                                                        </button>
                                                                                        <button type="button" rel="tooltip" title="Remove"
                                                                                            class="btn btn-danger btn-simple btn-link">
                                                                                            <i class="fa fa-times"></i>
                                                                                        </button>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <hr />
                                                                    <div class="stats">
                                                                        <i class="now-ui-icons loader_refresh spin"></i> Updated 3
                                                                        minutes ago
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
        </div>
    </div>
@endsection
