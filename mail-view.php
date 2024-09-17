<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title -->
    <title>Mail</title>
    <!-- Favicon -->
    <link rel="icon" href="img/core-img/logo.png">
    <!-- Plugins File -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <!-- Master Stylesheet [If you remove this CSS file, your file will be broken undoubtedly.] -->
    <link rel="stylesheet" href="style.css">

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
                          <li >
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
                          <li class="treeview active">
                            <a href="javascript:void(0)"><i class="bx bx-envelope"></i> <span>Email</span>
                              <i class="fa fa-angle-right"></i></a>
                            <ul class="treeview-menu">
                              <li><a href="mail-inbox.php">Inbox</a></li>
                              <li class="active"><a href="mail-view.php">Mail View</a></li>
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
                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span><i class="bx bx-world"></i></span>
                            </button>
                            <div class="dropdown-menu language-dropdown dropdown-menu-right">
                                <div class="user-profile-area">
                                    <a href="#" class="dropdown-item mb-15"><img src="img/core-img/l5.jpg"
                                            alt="Image" />
                                        <span>USA</span></a>
                                    <a href="#" class="dropdown-item mb-15"><img src="img/core-img/l2.jpg"
                                            alt="Image" />
                                        <span>German</span></a>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
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
                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
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
                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="img/bg-img/person_1.jpg" alt="" />
                            </button>
                            <div class="dropdown-menu profile dropdown-menu-right">
                                <!-- User Profile Area -->
                                <div class="user-profile-area">
                                    <a href="#" class="dropdown-item"><i class="bx bx-user font-15"
                                            aria-hidden="true"></i> My
                                        profile</a>
                                    <a href="#" class="dropdown-item"><i class="bx bx-wallet font-15"
                                            aria-hidden="true"></i>
                                        My wallet</a>
                                    <a href="#" class="dropdown-item"><i class="bx bx-wrench font-15"
                                            aria-hidden="true"></i>
                                        settings</a>
                                    <a href="#" class="dropdown-item"><i class="bx bx-power-off font-15"
                                            aria-hidden="true"></i>
                                        Sign-out</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </header>

            <!-- Main Content Area -->
            <div class="main-content">
                <div class="content-wraper-area">
                    <div class="container-fluid">
                        <div class="row justify-content-center g-4">
                            <div class="col-12">
                                <div class="card ">
                                    <div class="card-body card-breadcrumb">
                                        <div class="page-title-box d-flex align-items-center justify-content-between">
                                            <h4 class="mb-0">Main View</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7 col-lg-3 col-xxl-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="inbox-area">
                                            <div class="mail-side-menu mb-30">
                                                <div class="ibox-content mailbox-content">
                                                    <div class="file-manager clearfix">
                                                        <button type="button" class="btn btn-primary w-100 d-block"
                                                            data-bs-toggle="modal" data-bs-target="#composemodal">
                                                            Compose
                                                        </button>

                                                        <ul class="folder-list">
                                                            <li class="active"><a href="#"> <i
                                                                        class='bx bx-envelope'></i>
                                                                    Inbox
                                                                    <span
                                                                        class="badge badge-pill badge-primary inbox ms-2">25</span>
                                                                </a>
                                                            </li>
                                                            <li><a href="#"> <i class='bx bx-mail-send'></i> Send
                                                                    Mail</a></li>
                                                            <li><a href="#"> <i class='bx bx-pin'></i> Important</a>
                                                            </li>
                                                            <li><a href="#"><i class='bx bx-file'></i> Drafts <span
                                                                        class="badge badge-pill badge-warning inbox ms-2">3</span></a>
                                                            </li>
                                                            <li><a href="#"> <i class='bx bx-trash'></i> Trash <span
                                                                        class="badge badge-pill badge-danger inbox ms-2">4</span></a>
                                                            </li>
                                                        </ul>
                                                        <!-- Title -->
                                                        <div class="categori-title">
                                                            <h6 class="mb-3 primary-color-text">Important</h6>
                                                        </div>
                                                        <!-- List -->
                                                        <ul class="driver-list mb-25">
                                                            <li><a href="#"> <i class='bx bx-user'></i> Clients</a></li>
                                                            <li><a href="#"> <i class='bx bx-edit-alt'></i>
                                                                    Important</a></li>
                                                            <li><a href="#"> <i class='bx bx-headphone'></i> Social</a>
                                                            </li>
                                                            <li><a href="#"> <i class='bx bx-stopwatch'></i> Other</a>
                                                            </li>
                                                        </ul>
                                                        <div class="clearfix"></div>
                                                        <!-- Title -->
                                                        <div class="categori-title">
                                                            <h6 class="mb-3 primary-color-text">Labels</h6>
                                                        </div>
                                                        <!-- List -->
                                                        <ul class="driver-list">
                                                            <li><a href="#"> <i class='bx bxs-circle text-success'></i>
                                                                    Promotional</a></li>
                                                            <li><a href="#"> <i class="bx bxs-circle text-danger"></i>
                                                                    Social</a></li>
                                                            <li><a href="#"> <i
                                                                        class="bx bxs-circle text-primary"></i>Health</a>
                                                            </li>
                                                            <li><a href="#"> <i class="bx bxs-circle text-info"></i>
                                                                    Other</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-9 col-xxl-10">
                                <!-- Email View Header -->
                                <div class="mail-body--area">
                                    <div class="mail-windoe-body-area">
                                        <div class="mail-box-header">
                                            <div
                                                class="mail-title-search-area mb-4 d-md-flex align-items-center justify-content-between">
                                                <div class="search-wrapper mb-15">
                                                    <form action="#" method="get">
                                                        <input type="search" name="search"
                                                            class="form-control inbox-mail" placeholder="Search...">
                                                        <button type="submit" class="mail-btn"> <i
                                                                class="ti-search"></i></button>
                                                    </form>
                                                </div>

                                                <!-- Tools -->
                                                <div
                                                    class="mail-tools tooltip-demo d-flex align-items-center mb-15 justify-content-between">
                                                    <div class="mail-btn-group d-flex align-items-center mb-15">
                                                        <a href="#" class="btn btn-sm btn-danger"><i
                                                                class='bx bx-trash'></i></a>
                                                        <a href="#" class="btn btn-sm btn-success"><i
                                                                class='bx bx-envelope'></i></a>
                                                        <a href="#" class="btn btn-sm btn-info"><i
                                                                class='bx bx-folder-open'></i></a>
                                                        <a href="#" class="btn btn-sm btn-secondary"><i
                                                                class='bx bx-purchase-tag-alt'></i></a>
                                                        <a href="#" class="btn btn-sm btn-primary"><i
                                                                class="ti-settings"></i></a>
                                                    </div>

                                                    <div class="mail-pager d-flex align-items-center text-right mb-15">
                                                        <span>( 1-50 of 90 )</span>
                                                        <a class="btn btn-sm btn-info me-2" href="#"><i
                                                                class='bx bx-left-arrow-alt'></i></a>
                                                        <a class="btn btn-sm btn-info" href="#"><i
                                                                class='bx bx-right-arrow-alt'></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mail-window-text-content card">
                                            <div class="card-body p-4 p-lg-5">
                                                <h6 class="mb-0 font-18">Please send the new designs by wednesday</h6>
                                                <p>4.12 pm Feb 26,2019</p>
                                                <div class="mail-avatra d-flex align-items-center mb-30">
                                                    <div class="mail-avatar-thumb">
                                                        <img src="img/bg-img/person_1.jpg" alt="">
                                                    </div>
                                                    <div class="mail-avatra-text">
                                                        <h6 class="mb-0 font-15">Hamridan Patel</h6>
                                                        <p class="mb-0 font-12">adm@nytimes.com</p>
                                                    </div>
                                                </div>

                                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad
                                                    delectus doloremque eos eum eveniet ex illo in, iure minus
                                                    necessitatibus nesciunt omnis pariatur perferendis praesentium
                                                    quaerat reprehenderit rerum unde vero? Lorem ipsum dolor sit amet,
                                                    consectetur adipisicing elit. Inventore molestias fugit rerum.
                                                    Dolorem, eveniet, commodi.</p>

                                                <p> Ad delectus doloremque eos eum eveniet ex illo in, iure minus
                                                    necessitatibus nesciunt omnis pariatur perferendis praesentium
                                                    quaerat reprehenderit rerum unde vero? Lorem ipsum dolor sit amet,
                                                    consectetur adipisicing elit. Inventore molestias fugit rerum.
                                                    Dolorem, eveniet, commodi.</p>

                                                <h6 class="mb-1">Regards,</h6>
                                                <p class="font-14 text-dark">Jhon Lara</p>

                                                <p><i class="ti-help-alt"></i> Click on below buttons to see composer
                                                </p>

                                                <!-- Button -->
                                                <div class="box-footer">
                                                    <div class="pull-">
                                                        <a href="#" class="btn btn-secondary me-2">Replay</a>
                                                        <a href="#" class="btn btn-dark">Replay All</a>
                                                    </div>
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
                            <footer
                                class="footer-area d-sm-flex justify-content-center align-items-center justify-content-between">
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

    <!-- Compose Email Modal -->
    <div class="modal fade" id="composemodal" tabindex="-1" role="dialog" aria-labelledby="composemodalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header email">
                    <h5 class="modal-title" id="composemodalTitle">Compose Mail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="To">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Cc">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Bcc">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Subject">
                        </div>
                        <div class="mb-3">
                            <div id="email-editor"></div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send <i class="fa fa-telegram ms-1"></i></button>
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

    <!-- Active JS -->
    <script src="js/default-assets/active.js"></script>

    <!-- These plugins only need for the run this page -->
    <script src="js/checkeditor.js"></script>
    <script src="js/email-editor.js"></script>

</body>

</html>