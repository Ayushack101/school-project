<nav class="navbar navbar-expand-lg" color-on-scroll="500">
    <div class="container-fluid px-4">

        <a href="#" class="nav-link" data-toggle="dropdown">
            <span class="mdi mdi-menu-open" style="font-size: 30px"></span>
        </a>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="nav navbar-nav mr-auto">

                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="mdi mdi-bell-outline" style="font-size: 21px"></span>
                        <span class="notification">5</span>
                        <span class="d-lg-none">Notification</span>
                    </a>
                    {{--
                    <!-- <ul class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Notification 1</a>
                                    <a class="dropdown-item" href="#">Notification 2</a>
                                    <a class="dropdown-item" href="#">Notification 3</a>
                                    <a class="dropdown-item" href="#">Notification 4</a>
                                    <a class="dropdown-item" href="#">Another notification</a>
                                </ul> --> --}}
                </li>
                {{--
                <!-- <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nc-icon nc-zoom-split"></i>
                                    <span class="d-lg-block">&nbsp;Search</span>
                                </a>
                            </li> --> --}}
            </ul>
            <ul class="navbar-nav ml-auto">
                {{--
                <!-- <li class="nav-item">
                                <a class="nav-link" href="#pablo">
                                    <span class="no-icon">Account</span>
                                </a>
                            </li> --> --}}
                <div class="btn-group">
                    <button type="button"
                        class="nav-link dropdown-toggle d-flex justify-content-center align-items-center"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar me-2">A</div>
                        <div class="d-flex flex-column align-items-start">
                            <span style="font-size: 15px; color: #404040;">
                                Administrator
                            </span>

                        </div>
                        {{--
                        <!-- <i class="nc-icon nc-stre-down"></i> --> --}}
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item d-flex justify-content-start align-items-center" href="./users"><i
                                class="mdi mdi-account pe-2 text-info" style="font-size: 1.2rem"></i> User Profile</a>
                        <div class="divider"></div>
                        <a class="dropdown-item d-flex justify-content-start align-items-center" href="./logout"><i
                                class="mdi mdi-logout pe-2 text-info" style="font-size: 1.2rem"></i>Signout</a>
                    </div>
                </div>
            </ul>

        </div>
    </div>
</nav>