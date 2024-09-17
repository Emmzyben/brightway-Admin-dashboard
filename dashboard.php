<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Title -->
  <title>Brightway day-care admin</title>

  <!-- Favicon -->
  <link rel="icon" href="img/core-img/logo.png" />

  <!-- Plugins File -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/animate.css" />
  <link rel="stylesheet" href="css/introjs.min.css" />

  <!-- Master Stylesheet [If you remove this CSS file, your file will be broken undoubtedly.] -->
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <!-- Preloader -->
  <div id="preloader">
    <div class="item">
      <i class="loader --8"></i>
    </div>
  </div>
  <!-- /Preloader -->

  <!-- ======================================
    ******* Page Wrapper Area Start **********
    ======================================= -->
  <div class="flapt-page-wrapper">
    <!-- Sidemenu Area -->
    <div class="flapt-sidemenu-wrapper">
      <!-- Desktop Logo -->
      <div style='margin-bottom:-40%;display:flex;justify-content:center;margin-top:20px'> 
        <a href="dashboard.php">
          <img class="desktop-logo" src="img/core-img/logo.png" alt="Desktop Logo" style='width:70px;height:70px'/>
        </a>
      </div> 

      <!-- Side Nav -->
      <div class="flapt-sidenav" id="flaptSideNav">
        <!-- Side Menu Area -->
        <div class="side-menu-area">
          <!-- Sidebar Menu -->
          <nav>
            <ul class="sidebar-menu" data-widget="tree">
              <li class="active">
                <a href="dashboard.php"><i class="bx bx-home-heart"></i><span>Dashboard</span></a>
              </li>
              <li class="treeview">
                <a href="javascript:void(0)"><i class="bx bx-file"></i><span>Users</span>
                  <i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                  <li><a href="user.php">Overview</a></li>
                  <li><a href="approve.php">Approve users</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="javascript:void(0)"><i class="bx bx-file"></i><span>Provider</span>
                  <i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                  <li><a href="provider.php">Overview</a></li>
                  <li><a href="providerApprove.php">Approve providers</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="javascript:void(0)"><i class="bx bx-file"></i><span>Staff</span>
                  <i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                  <li><a href="staff.php">Overview</a></li>
                  <li><a href="staffapprove.php">Approve Staff</a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="javascript:void(0)"><i class="bx bx-file"></i><span>Driver</span>
                  <i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                  <li><a href="driver.php">Overview</a></li>
                  <li><a href="driverapprove.php">Approve Driver</a></li>
                </ul>
              </li>
              <li class="treeview">
                            <a href="javascript:void(0)"><i class="bx bx-file"></i><span>Services</span>
                              <i class="fa fa-angle-right"></i></a>
                            <ul class="treeview-menu">
                              <li><a href="services.php">Overview</a></li>
                            </ul>
                          </li>
                          <li class="treeview">
                            <a href="javascript:void(0)"><i class="bx bx-file"></i><span>Department</span>
                              <i class="fa fa-angle-right"></i></a>
                            <ul class="treeview-menu">
                              <li><a href="department.php">Overview</a></li>
                            </ul>
                          </li>
              <li>
                <a href="chat-box.php"><i class="bx bx-message-rounded-dots"></i><span>Chat</span></a>
              </li>
              <li class="treeview">
                <a href="javascript:void(0)"><i class="bx bx-envelope"></i> <span>Email</span>
                  <i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                  <li><a href="mail-inbox.php">Inbox</a></li>
                  <li><a href="mail-view.php">Mail View</a></li>
                </ul>
              </li>
              <li>
                 <a href="logout.php"><i class="bx bx-list-ul"></i><span>Log Out</span></a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>

    <!-- Page Content -->
    <div class="flapt-page-content">
      <!-- Top Header Area -->
      <header class="top-header-area d-flex align-items-center justify-content-between">
        <div class="left-side-content-area d-flex align-items-center">
          <!-- Mobile Logo -->
          <div class="mobile-logo">
             <a href="dashboard.php"><img src="img/core-img/logo.png" alt="Mobile Logo" /></a>
          </div>

          <!-- Triggers -->
          <div class="flapt-triggers">
            <div class="menu-collasped" id="menuCollasped">
              <i class="zmdi zmdi-dns"></i>
            </div>
            <div class="mobile-menu-open" id="mobileMenuOpen">
              <i class="zmdi zmdi-dns"></i>
            </div>
          </div>

          <!-- Left Side Nav -->
          <ul class="left-side-navbar d-flex align-items-center">
            <li class="hide-phone app-search">
              <input type="text" class="form-control" placeholder="Search..." />
              <span class="bx bx-search-alt"></span>
            </li>
          </ul>
        </div>

        <div class="right-side-navbar d-flex align-items-center justify-content-end">
          <!-- Mobile Trigger -->
          <div class="right-side-trigger" id="rightSideTrigger">
            <i class="bx bx-menu-alt-right"></i>
          </div>

          <!-- Top Bar Nav -->
          <ul class="right-side-content d-flex align-items-center">
            <li class="nav-item dropdown">
              <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <span><i class="bx bx-world"></i></span>
              </button>
              <div class="dropdown-menu language-dropdown dropdown-menu-right">
                <div class="user-profile-area">
                  <a href="#" class="dropdown-item mb-15"><img src="img/core-img/l5.jpg" alt="Image" />
                    <span>USA</span></a>
                  <a href="#" class="dropdown-item mb-15"><img src="img/core-img/l2.jpg" alt="Image" />
                    <span>German</span></a>
                </div>
              </div>
            </li>

            <li class="nav-item dropdown">
              <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="bx bx-envelope"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <!-- Message Area -->
                <div class="top-message-area">
                  <!-- Heading -->
                  <div class="message-heading">
                    <div class="heading-title">
                      <h6 class="mb-0">All Messages</h6>
                    </div>
                    <span>10</span>
                  </div>

                  <div class="message-box" id="messageBox">
                    <a href="#" class="dropdown-item">
                      <i class="bx bx-dollar-circle"></i>
                      <div>
                        <span>Did you know?</span>
                        <p class="mb-0 font-12">
                          Adipisicing elit. Ipsa, porro!
                        </p>
                      </div>
                    </a>

                    <a href="#" class="dropdown-item">
                      <i class="bx bx-shopping-bag"></i>
                      <div>
                        <span>Congratulations! </span>
                        <p class="mb-0 font-12">
                          Consectetur adipisicing elit.
                        </p>
                      </div>
                    </a>

                    <a href="#" class="dropdown-item">
                      <i class="bx bx-wallet-alt"></i>
                      <div>
                        <span>Hello Obeta</span>
                        <p class="mb-0 font-12">
                          Consectetur adipisicing elit.
                        </p>
                      </div>
                    </a>

                    <a href="#" class="dropdown-item">
                      <i class="bx bx-border-all"></i>
                      <div>
                        <span>Your order is placed</span>
                        <p class="mb-0 font-12">
                          Consectetur adipisicing elit.
                        </p>
                      </div>
                    </a>
                    <a href="#" class="dropdown-item">
                      <i class="bx bx-wallet-alt"></i>
                      <div>
                        <span>Haslina Obeta</span>
                        <p class="mb-0 font-12">
                          Consectetur adipisicing elit.
                        </p>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </li>

            <li class="nav-item dropdown">
              <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="bx bx-bell bx-tada"></i>
                <span class="active-status"></span>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <!-- Top Notifications Area -->
                <div class="top-notifications-area">
                  <!-- Heading -->
                  <div class="notifications-heading">
                    <div class="heading-title">
                      <h6>Notifications</h6>
                    </div>
                    <span>11</span>
                  </div>

                  <div class="notifications-box" id="notificationsBox">
                    <a href="#" class="dropdown-item">
                      <i class="bx bx-shopping-bag"></i>
                      <div>
                        <span>Your order is placed</span>
                        <p class="mb-0 font-12">
                          Consectetur adipisicing elit. Ipsa, porro!
                        </p>
                      </div>
                    </a>

                    <a href="#" class="dropdown-item">
                      <i class="bx bx-wallet-alt"></i>
                      <div>
                        <span>Haslina Obeta</span>
                        <p class="mb-0 font-12">
                          Consectetur adipisicing elit. Ipsa, porro!
                        </p>
                      </div>
                    </a>

                    <a href="#" class="dropdown-item">
                      <i class="bx bx-dollar-circle"></i>
                      <div>
                        <span>Your order is Dollar</span>
                        <p class="mb-0 font-12">
                          Consectetur adipisicing elit. Ipsa, porro!
                        </p>
                      </div>
                    </a>

                    <a href="#" class="dropdown-item">
                      <i class="bx bx-wallet-alt"></i>
                      <div>
                        <span>Haslina Obeta</span>
                        <p class="mb-0 font-12">
                          Consectetur adipisicing elit. Ipsa, porro!
                        </p>
                      </div>
                    </a>

                    <a href="#" class="dropdown-item">
                      <i class="bx bx-border-all"></i>
                      <div>
                        <span>Your order is placed</span>
                        <p class="mb-0 font-12">
                          Consectetur adipisicing elit. Ipsa, porro!
                        </p>
                      </div>
                    </a>
                    <a href="#" class="dropdown-item">
                      <i class="bx bx-wallet-alt"></i>
                      <div>
                        <span>Haslina Obeta</span>
                        <p class="mb-0 font-12">
                          Consectetur adipisicing elit. Ipsa, porro!
                        </p>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </li>

            <li class="nav-item dropdown">
              <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <img src="img/bg-img/person_1.jpg" alt="" />
              </button>
              <div class="dropdown-menu profile dropdown-menu-right">
                <!-- User Profile Area -->
                <div class="user-profile-area">
                  <a href="#" class="dropdown-item"><i class="bx bx-user font-15" aria-hidden="true"></i> My
                    profile</a>
                  <a href="#" class="dropdown-item"><i class="bx bx-wallet font-15" aria-hidden="true"></i>
                    My wallet</a>
                  <a href="#" class="dropdown-item"><i class="bx bx-wrench font-15" aria-hidden="true"></i>
                    settings</a>
                  <a href="#" class="dropdown-item"><i class="bx bx-power-off font-15" aria-hidden="true"></i>
                    Sign-out</a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </header>

      <!-- Main Content Area -->
      <div class="main-content introduction-farm">
        <div class="content-wraper-area">
          <div class="dashboard-area">
            <div class="container-fluid">
              <div class="row g-0">
                <!-- Single Card -->
                <div class="col-sm-6 col-xxl-3">
                  <div class="card mb-20">
                    <div class="card-body">
                      <div class="single-widget-home">
                        <h6>Weekly Activity</h6>
                        <h2>25%.00</h2>
                        <div class="chart-bottom-card d-flex align-items-center justify-content-between">
                          <p>
                            24:00:00
                            <span><i class="zmdi zmdi-triangle-down text-danger"></i>
                            </span>
                          </p>

                          <div class="chart-bottom">
                            <div id="widgest-chart-1"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Single Card -->
                <div class="col-sm-6 col-xxl-3">
                  <div class="card mb-20">
                    <div class="card-body">
                      <div class="single-widget-home">
                        <h6>Worked this week</h6>
                        <h2>11:40:23</h2>
                        <div class="chart-bottom-card d-flex align-items-center justify-content-between">
                          <p>
                            24:00:00
                            <span><i class="zmdi zmdi-triangle-down text-danger"></i>
                            </span>
                          </p>

                          <div class="chart-bottom">
                            <div id="widgest-chart-2"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Single Card -->
                <div class="col-sm-6 col-xxl-3">
                  <div class="card mb-20">
                    <div class="card-body">
                      <div class="single-widget-home">
                        <h6>Earned this week</h6>
                        <h2>$30.00</h2>
                        <div class="chart-bottom-card d-flex align-items-center justify-content-between">
                          <p>
                            50:00:00
                            <span><i class="zmdi zmdi-triangle-down text-danger"></i>
                            </span>
                          </p>

                          <div class="chart-bottom">
                            <div id="widgest-chart-3"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Single Card -->
                <div class="col-sm-6 col-xxl-3">
                  <div class="card mb-20">
                    <div class="card-body">
                      <div class="single-widget-home">
                        <h6>Project Worked</h6>
                        <h2>2</h2>
                        <div class="chart-bottom-card d-flex align-items-center justify-content-between">
                          <p>
                            24:00:00
                            <span><i class="zmdi zmdi-triangle-down text-danger"></i>
                            </span>
                          </p>

                          <div class="chart-bottom">
                            <div id="widgest-chart-4"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row g-4">
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-body">
                      <h2 class="card-title">Total hours worked per day</h2>
                      <div class="chart-area">
                        <div id="most-visited"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-body">
                      <div class="timesheet-area">
                        <h2 class="card-title">Timesheet</h2>
                        <div class="table-responsive text-nowrap">
                          <table class="table table-centered table-nowrap table-hover mb-0">
                            <thead>
                              <tr>
                                <th>Project</th>
                                <th>Date</th>
                                <th>Start time</th>
                                <th>Stop time</th>
                                <th>Duration</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="d-flex align-items-center">
                                  <p class="pro-img">A</p>
                                  <span>Active Work</span>
                                </td>
                                <td>Sat, Jan 19, 24</td>
                                <td>4:30 pm</td>
                                <td>10:40 pm</td>
                                <td>6:10:00</td>
                              </tr>
                              <tr>
                                <td class="d-flex align-items-center">
                                  <p class="pro-img">B</p>
                                  <span>Active Work</span>
                                </td>
                                <td>Fri, Jan 19, 24</td>
                                <td>4:30 pm</td>
                                <td>10:40 pm</td>
                                <td>6:10:00</td>
                              </tr>
                              <tr>
                                <td class="d-flex align-items-center">
                                  <p class="pro-img">C</p>
                                  <span>Active Work</span>
                                </td>
                                <td>Sun, Jan 19, 24</td>
                                <td>4:30 pm</td>
                                <td>10:40 pm</td>
                                <td>6:10:00</td>
                              </tr>
                              <tr>
                                <td class="d-flex align-items-center">
                                  <p class="pro-img">D</p>
                                  <span>Active Work</span>
                                </td>
                                <td>Fri, Jan 19, 24</td>
                                <td>4:30 pm</td>
                                <td>10:40 pm</td>
                                <td>6:10:00</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="card-title mb-30 d-flex align-items-center justify-content-between">
                        <h6 class="mb-0">Todo List</h6>
                        <div class="dashboard-dropdown">
                          <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dashboardDropdown56"
                              data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="ti-more"></i></button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dashboardDropdown56">
                              <a class="dropdown-item" href="#"><i class="ti-pencil-alt"></i>
                                Edit</a>
                              <a class="dropdown-item" href="#"><i class="ti-settings"></i>
                                Settings</a>
                              <a class="dropdown-item" href="#"><i class="ti-eraser"></i>
                                Remove</a>
                              <a class="dropdown-item" href="#"><i class="ti-trash"></i>
                                Delete</a>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-9 col-sm-10">
                          <div class="alert alert-info px-2" role="alert">
                            <h6 class="mb-1 text-dark">Setup Sass Repository</h6>
                            <p class="mb-0 text-danger">10:00 - 11:00</p>
                          </div>
                        </div>

                        <div class="col-3 col-sm-2">
                          <h6 class="text-success">11:00</h6>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-9 col-sm-10">
                          <div class="alert alert-primary px-2" role="alert">
                            <h6 class="mb-1 text-dark">Setup Web Progress</h6>
                            <p class="mb-0 text-danger">10:00 - 11:00</p>
                          </div>
                        </div>

                        <div class="col-3 col-sm-2">
                          <h6 class="text-success">12:00</h6>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-9 col-sm-10">
                          <div class="alert alert-success px-2" role="alert">
                            <h6 class="mb-1 text-dark">Setup Sass Repository</h6>
                            <p class="mb-0 text-danger">10:00 - 11:00</p>
                          </div>
                        </div>

                        <div class="col-3 col-sm-2">
                          <h6 class="text-success">09:00</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="card-title mb-30 d-flex align-items-center justify-content-between">
                        <h6 class="mb-0">Top 4 Lead Sources </h6>
                        <div class="dashboard-dropdown">
                          <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dashboardDropdown57"
                              data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="ti-more"></i></button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dashboardDropdown57">
                              <a class="dropdown-item" href="#"><i class="ti-pencil-alt"></i>
                                Edit</a>
                              <a class="dropdown-item" href="#"><i class="ti-settings"></i>
                                Settings</a>
                              <a class="dropdown-item" href="#"><i class="ti-eraser"></i>
                                Remove</a>
                              <a class="dropdown-item" href="#"><i class="ti-trash"></i>
                                Delete</a>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="shiping-cart-meta-area" id="shiping">
                        <!-- Single Progress -->
                        <div class="shipping-cart-area d-flex align-items-center justify-content-between">
                          <div class="shipping-progress">
                            <label class="lable-text">Initiated</label>
                            <div class="progress h-6" role="progressbar" aria-label="Example with label"
                              aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                              <div class="progress-bar" style="width: 75%"></div>
                            </div>
                          </div>
                          <div class="shipping-progress-details">
                            <p><i class='bx bx-up-arrow'></i> 46.25%</p>
                            <span>Session:5487</span>
                          </div>
                        </div>
                        <!-- Single Progress -->
                        <div class="shipping-cart-area d-flex align-items-center justify-content-between">
                          <div class="shipping-progress">
                            <label class="lable-text">Revenue
                              Rate</label>
                            <div class="progress h-6" role="progressbar" aria-label="Example with label"
                              aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                              <div class="progress-bar bg-info" style="width: 75%"></div>
                            </div>
                          </div>
                          <div class="shipping-progress-details">
                            <p><i class='bx bx-up-arrow'></i> 46.25%</p>
                            <span>Session:5487</span>
                          </div>
                        </div>
                        <!-- Single Progress -->
                        <div class="shipping-cart-area d-flex align-items-center justify-content-between">
                          <div class="shipping-progress">
                            <label class="lable-text">Total
                              Product</label>
                            <div class="progress h-6" role="progressbar" aria-label="Example with label"
                              aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                              <div class="progress-bar bg-warning" style="width: 75%"></div>
                            </div>
                          </div>
                          <div class="shipping-progress-details">
                            <p><i class='bx bx-up-arrow'></i> 46.25%</p>
                            <span>Session:5487</span>
                          </div>
                        </div>
                        <!-- Single Progress -->
                        <div class="shipping-cart-area d-flex align-items-center justify-content-between">
                          <div class="shipping-progress">
                            <label class="lable-text">Revenue
                              Rate</label>
                            <div class="progress h-6" role="progressbar" aria-label="Example with label"
                              aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                              <div class="progress-bar bg-info" style="width: 75%"></div>
                            </div>
                          </div>
                          <div class="shipping-progress-details">
                            <p><i class='bx bx-up-arrow'></i> 46.25%</p>
                            <span>Session:5487</span>
                          </div>
                        </div>
                        <!-- Single Progress -->
                        <div class="shipping-cart-area d-flex align-items-center justify-content-between">
                          <div class="shipping-progress">
                            <label class="lable-text">Initiated</label>
                            <div class="progress h-6" role="progressbar" aria-label="Example with label"
                              aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                              <div class="progress-bar bg-danger" style="width: 75%"></div>
                            </div>
                          </div>
                          <div class="shipping-progress-details">
                            <p><i class='bx bx-up-arrow'></i> 46.25%</p>
                            <span>Session:5487</span>
                          </div>
                        </div>
                        <!-- Single Progress -->
                        <div class="shipping-cart-area d-flex align-items-center justify-content-between">
                          <div class="shipping-progress">
                            <label class="lable-text">Revenue
                              Rate</label>
                            <div class="progress h-6" role="progressbar" aria-label="Example with label"
                              aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                              <div class="progress-bar bg-info" style="width: 75%"></div>
                            </div>
                          </div>
                          <div class="shipping-progress-details">
                            <p><i class='bx bx-up-arrow'></i> 46.25%</p>
                            <span>Session:5487</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="card">
                    <div class="card-body chat-application">
                      <div class="card-title  d-flex align-items-center justify-content-between">
                        <h6 class="mb-0">Chat</h6>
                        <div class="dashboard-dropdown">
                          <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dashboardDropdown58"
                              data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="ti-more"></i></button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dashboardDropdown58">
                              <a class="dropdown-item" href="#"><i class="ti-pencil-alt"></i>
                                Edit</a>
                              <a class="dropdown-item" href="#"><i class="ti-settings"></i>
                                Settings</a>
                              <a class="dropdown-item" href="#"><i class="ti-eraser"></i>
                                Remove</a>
                              <a class="dropdown-item" href="#"><i class="ti-trash"></i>
                                Delete</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="chats" id="chatBox">
                        <div class="chats">
                          <div class="chat">
                            <div class="chat-avatar">
                              <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title=""
                                data-original-title="">
                                <img src="img/bg-img/person_1.jpg" alt="avatar">
                              </a>
                            </div>
                            <div class="chat-body">
                              <div class="chat-content">
                                <p>How can we help? We're here for you!
                                </p>
                              </div>
                            </div>
                          </div>
                          <div class="chat chat-left">
                            <div class="chat-avatar">
                              <a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title=""
                                data-original-title="">
                                <img src="img/bg-img/person_1.jpg" alt="avatar">
                              </a>
                            </div>
                            <div class="chat-body">
                              <div class="chat-content">
                                <p>Hey Jacob, Could you please help me to find it out?</p>
                              </div>
                            </div>
                          </div>
                          <div class="chat">
                            <div class="chat-avatar">
                              <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title=""
                                data-original-title="">
                                <img src="img/bg-img/person_1.jpg" alt="avatar">
                              </a>
                            </div>
                            <div class="chat-body">
                              <div class="chat-content">
                                <p>Absolutely!</p>
                              </div>
                            </div>
                          </div>
                          <div class="chat chat-left">
                            <div class="chat-avatar">
                              <a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title=""
                                data-original-title="">
                                <img src="img/bg-img/person_1.jpg" alt="avatar">
                              </a>
                            </div>
                            <div class="chat-body">
                              <div class="chat-content">
                                <p>I am looking for the best admin template.</p>
                              </div>
                            </div>
                          </div>
                          <div class="chat">
                            <div class="chat-avatar">
                              <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title=""
                                data-original-title="">
                                <img src="img/bg-img/person_1.jpg" alt="avatar">
                              </a>
                            </div>
                            <div class="chat-body">
                              <div class="chat-content">
                                <p>Creat responsive admin template.</p>
                              </div>
                            </div>
                          </div>
                          <div class="chat chat-left">
                            <div class="chat-avatar">
                              <a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title=""
                                data-original-title="">
                                <img src="img/bg-img/person_1.jpg" alt="avatar">
                              </a>
                            </div>
                            <div class="chat-body">
                              <div class="chat-content">
                                <p>Looks clean and fresh UI.</p>
                              </div>
                              <div class="chat-content">
                                <p>It's perfect for my next project.</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <form class="chat-app-input mt-1 row">
                        <div class="col-12">
                          <fieldset>
                            <div class="input-group position-relative has-icon-left">
                              <input type="text" class="form-control border-white chat-form" placeholder="Send message">
                              <div class="input-group-append">
                                <button class="btn btn-primary chat-btn" type="button">Send</button>
                              </div>
                            </div>
                          </fieldset>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-body">
                      <div class="timesheet-area">
                        <h2 class="card-title">Projects</h2>
                        <div class="table-responsive text-nowrap">
                          <table class="table table-centered table-nowrap table-hover mb-0">
                            <thead>
                              <tr>
                                <th>Project</th>
                                <th>Time</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="d-flex align-items-center">
                                  <p class="pro-img">A</p>
                                  <span>Active Work <span class="badge text-bg-warning">30%</span>
                                  </span>
                                </td>
                                <td>6:10:00 <span class="badge text-bg-warning">50%</span></td>
                              </tr>

                              <tr>
                                <td class="d-flex align-items-center">
                                  <p class="pro-img">D</p>
                                  <span>Active Work <span class="badge text-bg-warning">30%</span>
                                  </span>
                                </td>
                                <td>8:10:00 <span class="badge text-bg-warning">60%</span></td>
                              </tr>

                              <tr>
                                <td class="d-flex align-items-center">
                                  <p class="pro-img">C</p>
                                  <span>Active Work <span class="badge text-bg-warning">30%</span>
                                  </span>
                                </td>
                                <td>12:10:00 <span class="badge text-bg-warning">70%</span></td>
                              </tr>

                              <tr>
                                <td class="d-flex align-items-center">
                                  <p class="pro-img">D</p>
                                  <span>Active Work <span class="badge text-bg-warning">30%</span>
                                  </span>
                                </td>
                                <td>6:10:00 <span class="badge text-bg-warning">50%</span></td>
                              </tr>
                              <tr>
                                <td class="d-flex align-items-center">
                                  <p class="pro-img">D</p>
                                  <span>Active Work <span class="badge text-bg-warning">30%</span>
                                  </span>
                                </td>
                                <td>6:10:00 <span class="badge text-bg-warning">50%</span></td>
                              </tr>

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-body">
                      <div class="timesheet-area">
                        <h2 class="card-title">Apps & URLS</h2>
                        <div class="table-responsive text-nowrap">
                          <table class="table table-centered table-nowrap table-hover mb-0">
                            <thead>
                              <tr>
                                <th>App or site</th>
                                <th>Time</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="app-urls-list align-items-center">
                                  <p class="mb-0">translate.google.com <span class="text-danger">0:03:46</span></p>
                                </td>
                                <td>
                                  <div class="progress h-7" role="progressbar" aria-label="Example with label"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar" style="width: 25%">25%</div>
                                  </div>
                                </td>
                              </tr>

                              <tr>
                                <td class="app-urls-list align-items-center">
                                  <p class="mb-0">youtube.com <span class="text-danger">0:01:46</span></p>
                                </td>
                                <td>
                                  <div class="progress h-7" role="progressbar" aria-label="Example with label"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar" style="width: 70%">70%</div>
                                  </div>
                                </td>
                              </tr>

                              <tr>
                                <td class="app-urls-list align-items-center">
                                  <p class="mb-0">facebook.com <span class="text-danger">0:16:46</span></p>
                                </td>
                                <td>
                                  <div class="progress h-7" role="progressbar" aria-label="Example with label"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar" style="width: 65%">65%</div>
                                  </div>
                                </td>
                              </tr>

                              <tr>
                                <td class="app-urls-list align-items-center">
                                  <p class="mb-0">translate.google.com <span class="text-danger">0:03:46</span></p>
                                </td>
                                <td>
                                  <div class="progress h-7" role="progressbar" aria-label="Example with label"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar" style="width: 25%">25%</div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="app-urls-list align-items-center">
                                  <p class="mb-0">translate.google.com <span class="text-danger">0:03:46</span></p>
                                </td>
                                <td>
                                  <div class="progress h-7" role="progressbar" aria-label="Example with label"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar" style="width: 25%">25%</div>
                                  </div>
                                </td>
                              </tr>


                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer Area -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <!-- Footer Area -->
              <footer class="footer-area d-sm-flex justify-content-center align-items-center justify-content-between">
                <!-- Copywrite Text -->
                <div class="copywrite-text">
                  <p class="font-13">Developed by &copy; <a href="#" style='color:#8dc741'>Gita-allied tech</a></p>
                </div>
                <div class="fotter-icon text-center">
                  <p class="mb-0 font-13">2024 &copy; Brightway Admin</p>
                </div>
              </footer>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ======================================
    ********* Page Wrapper Area End ***********
    ======================================= -->

  <!-- Must needed plugins to the run this Template -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/default-assets/setting.js"></script>
  <script src="js/default-assets/scrool-bar.js"></script>
  <script src="js/todo-list.js"></script>

  <!-- These plugins only need for the run this page -->
  <script src="js/apexcharts.min.js"></script>
  <script src="js/apexcharts-init.js"></script>
  <script src="js/widget-chart-custom.js"></script>

  <!-- Active JS -->
  <script src="js/default-assets/active.js"></script>
</body>

</html>