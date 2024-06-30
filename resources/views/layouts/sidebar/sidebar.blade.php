  <?php
  $url = $_SERVER['REQUEST_URI'];
  $parts = explode('/', parse_url($url, PHP_URL_PATH));
  $curr_page = end($parts);
  ?>
  <div class="siderbar-main">
      <div class="sec">
          <div class="sidebar" data-image="../assets/img/sidebar-5.jpg">
              <div class="sidebar-wrapper">
                  <div class="logo">
                      <a href="#" class="simple-text">
                          School PCA
                      </a>
                  </div>
                  <ul class="nav">
                      {{-- Home --}}
                      <li class="nav-item <?php
                      if ($curr_page == ''):
                          echo 'active';
                      endif; ?>">
                          <a class="nav-link" href="{{ route('view.dashboard') }}">
                              <i class="nc-icon nc-chart-pie-35"></i>
                              <p>Dashboard</p>
                          </a>
                      </li>
                      {{-- Class Management --}}
                      <li class="nav-item">
                          <a class="nav-link" data-bs-toggle="collapse" href="#collapse-1" aria-expanded="false"
                              aria-controls="collapseExample">
                              <i class="nc-icon nc-bag"></i>
                              <p>
                                  Class
                              </p>
                              <i class="fa-solid fa-chevron-down"
                                  style='position: absolute; top: 33%; right: 15px;'></i>
                          </a>
                      </li>
                      <div class="collapse small <?php
                      if ($curr_page == 'class' || $curr_page == 'section' || $curr_page == 'subjects'):
                          echo 'show';
                      endif; ?>" id="collapse-1">
                          <ul class="nav">
                              <li class="nav-item <?php
                              if ($curr_page == 'class'):
                                  echo 'active';
                              endif; ?>">
                                  <a class="nav-link" href="{{ route('view.class') }}">
                                      <span style='font-size: 20px' class="mdi mdi-google-classroom me-2"></span>
                                      <p>Manage Class</p>
                                  </a>
                              </li>
                          </ul>
                          <ul class="nav">
                              <li class="nav-item <?php
                              if ($curr_page == 'section'):
                                  echo 'active';
                              endif; ?>">
                                  <a class="nav-link" href="{{ route('view.section') }}">
                                      <span style='font-size: 20px' class="mdi mdi-invoice-list-outline me-2"></span>
                                      <p>Manage Section</p>
                                  </a>
                              </li>
                          </ul>
                          <ul class="nav">
                              <li class="nav-item <?php
                              if ($curr_page == 'subjects'):
                                  echo 'active';
                              endif; ?>">
                                  <a class="nav-link" href="{{ route('view.subject') }}">
                                      <span style='font-size: 20px' class="mdi mdi-text-long me-2"></span>
                                      <p>Manage Subject</p>
                                  </a>
                              </li>
                          </ul>
                      </div>

                      {{-- Student Management --}}
                      <li class="nav-item">
                          <a class="nav-link" data-bs-toggle="collapse" href="#collapse-3" aria-expanded="false"
                              aria-controls="collapseExample">
                              {{-- <i class="nc-icon nc-bag"></i> --}}
                              <span style='font-size: 1.6rem; margin-right: 15px;'
                                  class="mdi mdi-format-list-checkbox"></span>
                              <p>
                                  Student
                              </p>
                              <i class="fa-solid fa-chevron-down"
                                  style='position: absolute; top: 33%; right: 15px;'></i>
                          </a>
                      </li>
                      <div class="collapse small <?php
                      if ($curr_page == 'student'):
                          echo 'show';
                      endif; ?>" id="collapse-3">
                          <ul class="nav">
                              <li class="nav-item <?php
                              if ($curr_page == 'student'):
                                  echo 'active';
                              endif; ?>">
                                  <a class="nav-link" href="{{ route('view.student') }}">
                                      <span style='font-size: 20px' class="mdi mdi-account-school-outline me-2"></span>
                                      <p>Manage Student</p>
                                  </a>
                              </li>
                          </ul>
                      </div>

                      {{-- Teacher --}}
                      <li class="nav-item <?php
                      if ($curr_page == 'teacher' || $curr_page == 'teacher-edit' || $curr_page == 'teacher-add'):
                          echo 'active';
                      endif; ?>">
                          <a class="nav-link" href="{{ route('view.teacher') }}">
                              <i class="mdi mdi-human-male-board"></i>
                              <p>Teacher</p>
                          </a>
                      </li>

                      {{-- Marksheet Management --}}
                      <li class="nav-item">
                          <a class="nav-link" data-bs-toggle="collapse" href="#collapse-2" aria-expanded="false"
                              aria-controls="collapseExample">
                              {{-- <i class="nc-icon nc-bag"></i> --}}
                              <span style='font-size: 1.6rem; margin-right: 15px;'
                                  class="mdi mdi-note-text-outline"></span>
                              <p>
                                  Marksheet
                              </p>
                              <i class="fa-solid fa-chevron-down"
                                  style='position: absolute; top: 33%; right: 15px;'></i>
                          </a>
                      </li>
                      <div class="collapse small <?php
                      if ($curr_page == 'marksheet'):
                          echo 'show';
                      endif; ?>" id="collapse-2">
                          <ul class="nav">
                              <li class="nav-item <?php
                              if ($curr_page == 'marksheet'):
                                  echo 'active';
                              endif; ?>">
                                  <a class="nav-link" href="{{ route('view.marksheet') }}">
                                      <span style='font-size: 20px' class="mdi mdi-google-classroom me-2"></span>
                                      <p>Manage Marksheet</p>
                                  </a>
                              </li>
                          </ul>
                      </div>

                      {{-- Student Management --}}
                      <li class="nav-item">
                          <a class="nav-link" data-bs-toggle="collapse" href="#collapse-4" aria-expanded="false"
                              aria-controls="collapseExample">
                              {{-- <i class="nc-icon nc-bag"></i> --}}
                              <span style='font-size: 1.6rem; margin-right: 9px;'
                                  class="mdi mdi-format-list-checkbox"></span>
                              <p>
                                  Admission
                              </p>
                              <i class="fa-solid fa-chevron-down"
                                  style='position: absolute; top: 33%; right: 15px;'></i>
                          </a>
                      </li>
                      <div class="collapse small <?php
                      if ($curr_page == 'student-add'):
                          echo 'show';
                      endif; ?>" id="collapse-4">
                          <ul class="nav">
                              <li class="nav-item <?php
                              if ($curr_page == 'student-add'):
                                  echo 'active';
                              endif; ?>">
                                  <a class="nav-link" href="{{ route('add.student') }}">
                                      <span style='font-size: 20px' class="mdi mdi-account-school-outline me-2"></span>
                                      <p>Add Student</p>
                                  </a>
                              </li>
                          </ul>
                      </div>

                      {{-- <!-- Order Management Superadmin -->
                            <?php
                            if ($_SESSION['user_type'] == 'superadmin') {
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="collapse" href="#collapse-1" aria-expanded="false"
                                        aria-controls="collapseExample">
                                        <i class="nc-icon nc-bag"></i>
                                        <p>
                                            Order Management
                                        </p>
                                        <i class="fa-solid fa-chevron-down"
                                            style='position: absolute; top: 33%; right: 15px;'></i>
                                    </a>

                                </li>
                                <div class="collapse small <?php
                                if ($curr_page == 'superadmin-branch-dashboard-in' || $curr_page == 'superadmin-branch-dashboard-in.php' || $curr_page == 'superadmin-branch-dashboard-out' || $curr_page == 'superadmin-branch-dashboard-out.php' || $curr_page == 'superadmin-dashboard-in' || $curr_page == 'superadmin-dashboard-in.php' || $curr_page == 'superadmin-dashboard-out' || $curr_page == 'superadmin-dashboard-out.php' || $curr_page == 'superadmin-orders' || $curr_page == 'superadmin-orders.php' || $curr_page == 'order-items' || $curr_page == 'order-items.php' || $curr_page == 'superadmin-transfer.php' || $curr_page == 'transfer-items.php' || $curr_page == 'superadmin-transfer' || $curr_page == 'transfer-items'):
                                    echo 'show';
                                endif; ?>" id="collapse-1">
                                    <ul class="nav">
                                        <li class="nav-item <?php
                                        if ($curr_page == 'superadmin-branch-dashboard-in' || $curr_page == 'superadmin-branch-dashboard-in.php' || $curr_page == 'superadmin-dashboard-in' || $curr_page == 'superadmin-dashboard-in.php'):
                                            echo 'active';
                                        endif;
                                        if ($curr_page == 'superadmin-orders' || $curr_page == 'superadmin-orders.php' || $curr_page == 'order-items.php' || $curr_page == 'order-items' || $curr_page == 'superadmin-transfer.php' || $curr_page == 'transfer-items.php' || $curr_page == 'superadmin-transfer' || $curr_page == 'transfer-items') {
                                            if ($_GET['order_in_out'] == 'in') {
                                                echo 'active';
                                            }
                                        }
                                        ?>">
                                            <a class="nav-link" href="./superadmin-branch-dashboard-in">
                                                <i class="nc-icon nc-notes"></i>
                                                <p>In</p>
                                            </a>
                                        </li>
                                        <li class="nav-item <?php
                                        if ($curr_page == 'superadmin-branch-dashboard-out' || $curr_page == 'superadmin-branch-dashboard-out.php' || $curr_page == 'superadmin-dashboard-out' || $curr_page == 'superadmin-dashboard-out.php'):
                                            echo 'active';
                                        endif;
                                        if ($curr_page == 'superadmin-orders' || $curr_page == 'superadmin-orders.php' || $curr_page == 'order-items.php' || $curr_page == 'order-items' || $curr_page == 'superadmin-transfer.php' || $curr_page == 'transfer-items.php' || $curr_page == 'superadmin-transfer' || $curr_page == 'transfer-items') {
                                            if ($_GET['order_in_out'] == 'out') {
                                                echo 'active';
                                            }
                                        }
                                        ?>">
                                            <a class="nav-link" href="./superadmin-branch-dashboard-out">
                                                <i class="nc-icon nc-notes"></i>
                                                <p>Out</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <?php
                            }

                            ?>

                            <!-- Order Management Admin -->
                            <?php
                            if ($_SESSION['user_type'] == 'admin') {

                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="collapse" href="#collapse-1" aria-expanded="false"
                                        aria-controls="collapseExample">
                                        <i class="nc-icon nc-bag"></i>
                                        <p>
                                            Order Management
                                        </p>
                                        <i class="fa-solid fa-chevron-down"
                                            style='position: absolute; top: 33%; right: 15px;'></i>
                                    </a>

                                </li>
                                <div class="collapse small <?php
                                if ($curr_page == 'branch-dashboard-in' || $curr_page == 'branch-dashboard-in.php' || $curr_page == 'branch-dashboard-out' || $curr_page == 'branch-dashboard-out.php' || $curr_page == 'orders' || $curr_page == 'orders.php' || $curr_page == 'order-items' || $curr_page == 'order-items.php' || $curr_page == 'order-add' || $curr_page == 'order-add.php' || $curr_page == 'transfer-add.php' || $curr_page == 'transfer.php' || $curr_page == 'transfer-items.php' || $curr_page == 'transfer-add' || $curr_page == 'transfer' || $curr_page == 'transfer-items'):
                                    echo 'show';
                                endif; ?>" id="collapse-1">
                                    <ul class="nav">
                                        <li class="nav-item <?php
                                        if ($curr_page == 'branch-dashboard-in' || $curr_page == 'branch-dashboard-in.php'):
                                            echo 'active';
                                        endif;
                                        if ($curr_page == 'orders' || $curr_page == 'orders.php' || $curr_page == 'order-items.php' || $curr_page == 'order-items' || $curr_page == 'order-add' || $curr_page == 'order-add.php' || $curr_page == 'transfer-add.php' || $curr_page == 'transfer.php' || $curr_page == 'transfer-items.php' || $curr_page == 'transfer-add' || $curr_page == 'transfer' || $curr_page == 'transfer-items') {
                                            if ($_GET['order_in_out'] == 'in') {
                                                echo 'active';
                                            }
                                        }
                                        ?>">
                                            <a class="nav-link" href="./branch-dashboard-in">
                                                <i class="nc-icon nc-notes"></i>
                                                <p>In</p>
                                            </a>
                                        </li>
                                        <li class="nav-item <?php
                                        if ($curr_page == 'branch-dashboard-out' || $curr_page == 'branch-dashboard-out.php'):
                                            echo 'active';
                                        endif;
                                        if ($curr_page == 'orders' || $curr_page == 'orders.php' || $curr_page == 'order-items.php' || $curr_page == 'order-items' || $curr_page == 'order-add' || $curr_page == 'order-add.php' || $curr_page == 'transfer-add.php' || $curr_page == 'transfer.php' || $curr_page == 'transfer-items.php' || $curr_page == 'transfer-add' || $curr_page == 'transfer' || $curr_page == 'transfer-items') {
                                            if ($_GET['order_in_out'] == 'out') {
                                                echo 'active';
                                            }
                                        }
                                        ?>">
                                            <a class="nav-link" href="./branch-dashboard-out">
                                                <i class="nc-icon nc-notes"></i>
                                                <p>Out</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <?php
                            }
                            ?>

                            <?php
                            if ($_SESSION['user_type'] == 'admin') {
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="collapse" href="#collapse-2" aria-expanded="false"
                                        aria-controls="collapseExample">
                                        <i class="nc-icon nc-bag"></i>
                                        <p>
                                            Product Inventory
                                        </p>
                                        <i class="fa-solid fa-chevron-down"
                                            style='position: absolute; top: 33%; right: 15px;'></i>
                                    </a>

                                </li>
                                <div class="collapse small <?php
                                if ($curr_page == 'product' || $curr_page == 'product.php' || $curr_page == 'category' || $curr_page == 'category.php' || $curr_page == 'product-add.php' || $curr_page == 'product-add' || $curr_page === 'category-add' || $curr_page == 'category-add.php'):
                                    echo 'show';
                                endif; ?>" id="collapse-2">
                                    <ul class="nav">
                                        <li class="nav-item <?php
                                        if ($curr_page == 'product' || $curr_page == 'product.php' || $curr_page == 'product-add.php' || $curr_page == 'product-add'):
                                            echo 'active';
                                        endif; ?>">
                                            <a class="nav-link" href="./product">
                                                <span class="mdi mdi-circle-outline pe-2"
                                                    style="font-size: 12px; padding-bottom: 1px;"></span>
                                                <span class="sidebar-normal">Product List</span>
                                            </a>
                                        </li>
                                        <li class="nav-item  <?php
                                        if ($curr_page === 'category' || $curr_page == 'category.php' || $curr_page === 'category-add' || $curr_page == 'category-add.php'):
                                            echo 'active';
                                        endif; ?>">
                                            <a class="nav-link" href="./category">
                                                <span class="mdi mdi-circle-outline pe-2"
                                                    style="font-size: 12px; padding-bottom: 1px;"></span>
                                                <span class="sidebar-normal">Product Department</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            <?php }
                            ?> --}}
                      {{-- <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="collapse" href="#collapse-3" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    <i class="nc-icon nc-notes"></i>
                                    <p>
                                        P. O. Management
                                    </p>
                                    <i class="fa-solid fa-chevron-down"
                                        style='position: absolute; top: 33%; right: 15px;'></i>
                                </a>

                            </li> --}}
                      {{-- <div class="collapse small <?php
                      if ($curr_page === 'create-purchasing-order' || $curr_page === 'create-purchasing-order.php' || $curr_page === 'accepted-purchasing-order-list' || $curr_page === 'accepted-purchasing-order-list.php'):
                          echo 'show';
                      endif; ?>" id="collapse-3">
                                <ul class="nav">
                                    <?php
                                    if ($_SESSION['user_type'] == 'admin') {
                                        ?>
                                        <li class="nav-item  <?php
                                        if ($curr_page === 'create-purchasing-order' || $curr_page === 'create-purchasing-order.php'):
                                            echo 'active';
                                        endif; ?>">
                                            <a class="nav-link" href="./create-purchasing-order">
                                                <span class="mdi mdi-circle-outline pe-2"
                                                    style="font-size: 12px; padding-bottom: 1px;"></span>
                                                <span class="sidebar-normal">Purchasing Order</span>
                                            </a>
                                        </li>
                                        <li class="nav-item  <?php
                                        if ($curr_page === 'accepted-purchasing-order-list' || $curr_page === 'accepted-purchasing-order-list.php'):
                                            echo 'active';
                                        endif; ?>">
                                            <a class="nav-link" href="./accepted-purchasing-order-list">
                                                <span class="mdi mdi-circle-outline pe-2"
                                                    style="font-size: 12px; padding-bottom: 1px;"></span>
                                                <span class="sidebar-normal">Accepted Order List</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php
                                    if ($_SESSION['user_type'] == 'superadmin'):
                                        ?>
                                        <li class="nav-item  <?php
                                        if ($curr_page === 'top-category'):
                                            echo 'active';
                                        endif; ?>">
                                            <a class="nav-link" href="./purchasing-order-list">
                                                <span class="mdi mdi-circle-outline pe-2"
                                                    style="font-size: 12px; padding-bottom: 1px;"></span>
                                                <span class="sidebar-normal">Purchasing Order List</span>
                                            </a>
                                        </li>
                                        <?php
                                    endif
                                    ?>
                                    <?php
                                    if ($_SESSION['user_type'] == 'superadmin'):
                                        ?>
                                        <li class="nav-item  <?php
                                        if ($curr_page === 'top-category'):
                                            echo 'active';
                                        endif; ?>">
                                            <a class="nav-link" href="./accepted-order-branch">
                                                <span class="mdi mdi-circle-outline pe-2"
                                                    style="font-size: 12px; padding-bottom: 1px;"></span>
                                                <span class="sidebar-normal">Accepted Order List</span>
                                            </a>
                                        </li>
                                        <?php
                                    endif
                                    ?>
                                </ul>
                            </div>


                            <?php
                            if ($_SESSION['user_type'] == 'superadmin'):
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="./users">
                                        <i class="nc-icon nc-circle-09"></i>
                                        <p>All Users</p>
                                    </a>
                                </li>
                                <?php
                            endif
                            ?>

                            <?php
                            if ($_SESSION['user_type'] == 'superadmin'):
                                ?>
                                <li class="nav-item <?php
                                if ($curr_page == 'branch' || $curr_page == 'branch.php' || $curr_page == 'branch-add.php' || $curr_page == 'branch-add'):
                                    echo 'active';
                                endif; ?>">
                                    <a class=" nav-link" href="./branch">
                                        <i class="nc-icon nc-notes"></i>
                                        <p>Branch</p>
                                    </a>
                                </li>
                                <?php
                            endif
                            ?> --}}
                  </ul>
              </div>
          </div>
      </div>
  </div>
