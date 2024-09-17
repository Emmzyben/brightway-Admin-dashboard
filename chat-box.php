<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title -->
    <title>Chat box</title>
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
                          <li class="active">
                            <a href="chat-box.php" ><i class="bx bx-message-rounded-dots"></i><span>Chat</span></a>
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
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body card-breadcrumb">
                                        <div class="page-title-box d-flex align-items-center justify-content-between">
                                            <h4 class="mb-0">Chat Box</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7 col-xxl-8">
                                <div class="chat-box-right">
                                    <div class="chat-header">
                                        <a href="" class="chat-user-heade d-flex align-items-center">
                                            <div class="chat-media-left">
                                                <img src="img/bg-img/person_1.jpg" alt="user"
                                                    class="rounded-circle thumb-sm">
                                                <span class="round-50 bg-danger"></span>
                                            </div><!-- media-left -->
                                            <div class="chat-main-user">
                                                <h6 class="m-0">Mary Schneider</h6>
                                                <p class="mb-0">Last seen: 2 hours ago</p>
                                            </div>
                                        </a>
                                        <div class="chat-features">
                                            <a class="alert alert-primary px-2 py-1" href="#"><i
                                                    class='bx bx-phone'></i></a>
                                            <a class="alert alert-warning px-2 py-1" href="#"><i
                                                    class='bx bx-play-circle'></i></a>
                                            <a class="alert alert-danger px-2 py-1" href="#"><i
                                                    class='bx bx-trash'></i></a>
                                            <a class="alert alert-light px-2 py-1" href="#"><i
                                                    class='bx bx-dots-vertical-rounded'></i></a>
                                        </div>
                                    </div>

                                    <div class="chat-body">
                                        <div class="chat-detail" id="chatBody">
                                            <div class="single-chat-details-list d-flex align-items-center">
                                                <div class="single-chat-user">
                                                    <img src="img/bg-img/per-2.jpg" alt="user"
                                                        class="rounded-circle thumb-sm">
                                                </div>
                                                <div class="single-chat-media-body">
                                                    <div class="chat-msg">
                                                        <div class="chat-body-time">9:02am</div>
                                                        <p>Hello,</p>
                                                        <p class="mb-0">There are many variations of passages of
                                                            Lorem Ipsum available.</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="single-chat-details-list reverse d-flex align-items-center">
                                                <div class="single-chat-user">
                                                    <img src="img/bg-img/person_1.jpg" alt="user"
                                                        class="rounded-circle thumb-sm">
                                                </div>
                                                <div class="single-chat-media-body">
                                                    <div class="chat-msg">
                                                        <div class="chat-body-time">9:02am</div>
                                                        <p>Good Morning !</p>
                                                        <p class="mb-0">There are many variations of passages of
                                                            Lorem Ipsum available.</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="single-chat-details-list d-flex align-items-center">
                                                <div class="single-chat-user">
                                                    <img src="img/bg-img/per-2.jpg" alt="user"
                                                        class="rounded-circle thumb-sm">
                                                </div>
                                                <div class="single-chat-media-body">
                                                    <div class="chat-body-time">9:02am</div>
                                                    <div class="chat-msg">
                                                        <p>Good Morning !</p>
                                                        <p class="mb-0">There are many variations of passages of
                                                            Lorem Ipsum available.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="chat-footer">
                                        <div class="row align-items-center">
                                            <div class="col-md-2">
                                                <div class="d-flex chat-features bottom">
                                                    <a class="btn btn-circle text-white ms-1 btn-primary btn-sm"
                                                        href="#"><i class='bx bx-camera'></i></a>
                                                    <a class="btn btn-circle text-white ms-1 btn-info btn-sm"
                                                        href="#"><i class='bx bx-paperclip'></i></a>
                                                    <a class="btn btn-circle text-white ms-1 btn-danger btn-sm"
                                                        href="#"><i class='bx bx-microphone'></i></a>
                                                </div>
                                            </div>

                                            <div class="col-md-10">
                                                <textarea class="form-control chat-field" name="" id="chatbox"
                                                    placeholder="Type something here..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 col-xxl-4">
                                <div class="chat-box-left">
                                    <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-home" type="button" role="tab"
                                                aria-controls="pills-home" aria-selected="true">General</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-profile" type="button" role="tab"
                                                aria-controls="pills-profile" aria-selected="false">Groups</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-contact" type="button" role="tab"
                                                aria-controls="pills-contact" aria-selected="false">Personal</button>
                                        </li>
                                    </ul>

                                    <div class="chat-search mb-2">
                                        <div class="form-group">
                                            <input type="text" name="chat-search" class="form-control"
                                                placeholder="Search">
                                            <button type="button" class="btn search-btn"><i
                                                    class='bx bx-search-alt-2'></i></button>
                                        </div>
                                    </div>
                                    <!--end chat-search-->

                                    <div class="chat-body-left">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                                aria-labelledby="pills-home-tab" tabindex="0">
                                                <div class="single-chat-list" id="HotChat-list">
                                                    <!-- Single Chat -->
                                                    <a href="#"
                                                        class="chat-media d-flex align-items-center new-message">
                                                        <div class="chat-user-img">
                                                            <img src="img/bg-img/per-2.jpg" alt="user"
                                                                class="rounded-circle thumb-md">
                                                            <span class="round-50 bg-success"></span>
                                                        </div>
                                                        <div class="chat-media-body d-flex justify-content-between">
                                                            <div class="chat-user-info">
                                                                <h6>Daniel Madsen</h6>
                                                                <p>Good morning! Congratulations Friend...
                                                                </p>
                                                            </div>
                                                            <div class="chat-time">
                                                                <span>02 min</span>
                                                            </div>
                                                        </div>
                                                    </a>

                                                    <!-- Single Chat -->
                                                    <a href="#"
                                                        class="chat-media d-flex align-items-center new-message">
                                                        <div class="chat-user-img">
                                                            <img src="img/bg-img/per-3.jpg" alt="user"
                                                                class="rounded-circle thumb-md">
                                                            <span class="round-50 bg-danger"></span>

                                                        </div>
                                                        <div class="chat-media-body d-flex justify-content-between">
                                                            <div class="chat-user-info">
                                                                <h6>Jhon Madsen</h6>
                                                                <p>Good morning! Congratulations Friend...
                                                                </p>
                                                            </div>
                                                            <div class="chat-time">
                                                                <span>07 min</span>
                                                            </div>
                                                        </div>
                                                    </a>

                                                    <!-- Single Chat -->
                                                    <a href="#"
                                                        class="chat-media d-flex align-items-center new-message">
                                                        <div class="chat-user-img">
                                                            <img src="img/bg-img/per-2.jpg" alt="user"
                                                                class="rounded-circle thumb-md">
                                                            <span class="round-50 bg-success"></span>

                                                        </div>
                                                        <div class="chat-media-body d-flex justify-content-between">
                                                            <div class="chat-user-info">
                                                                <h6>Ajoy Madsen</h6>
                                                                <p>Good morning! Congratulations Friend...
                                                                </p>
                                                            </div>
                                                            <div class="chat-time">
                                                                <span>10 min</span>
                                                            </div>
                                                        </div>
                                                    </a>

                                                    <!-- Single Chat -->
                                                    <a href="#"
                                                        class="chat-media d-flex align-items-center new-message">
                                                        <div class="chat-user-img">
                                                            <img src="img/bg-img/per-3.jpg" alt="user"
                                                                class="rounded-circle thumb-md">
                                                            <span class="round-50 bg-danger"></span>

                                                        </div>
                                                        <div class="chat-media-body d-flex justify-content-between">
                                                            <div class="chat-user-info">
                                                                <h6>Daniel Madsen</h6>
                                                                <p>Good morning! Congratulations Friend...
                                                                </p>
                                                            </div>
                                                            <div class="chat-time">
                                                                <span>22 min</span>
                                                            </div>
                                                        </div>
                                                    </a>

                                                    <!-- Single Chat -->
                                                    <a href="#"
                                                        class="chat-media d-flex align-items-center new-message">
                                                        <div class="chat-user-img">
                                                            <img src="img/bg-img/per-2.jpg" alt="user"
                                                                class="rounded-circle thumb-md">
                                                            <span class="round-50 bg-danger"></span>

                                                        </div>
                                                        <div class="chat-media-body d-flex justify-content-between">
                                                            <div class="chat-user-info">
                                                                <h6>Daniel Madsen</h6>
                                                                <p>Good morning! Congratulations Friend...
                                                                </p>
                                                            </div>
                                                            <div class="chat-time">
                                                                <span>02 min</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <!-- Single Chat -->
                                                    <a href="#"
                                                        class="chat-media d-flex align-items-center new-message">
                                                        <div class="chat-user-img">
                                                            <img src="img/bg-img/per-3.jpg" alt="user"
                                                                class="rounded-circle thumb-md">

                                                        </div>
                                                        <div class="chat-media-body d-flex justify-content-between">
                                                            <div class="chat-user-info">
                                                                <h6>Daniel Madsen</h6>
                                                                <p>Good morning! Congratulations Friend...
                                                                </p>
                                                            </div>
                                                            <div class="chat-time">
                                                                <span>28 min</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                                aria-labelledby="pills-profile-tab" tabindex="0">
                                                <div class="single-chat-list" id="HotChat-list2">
                                                    <!-- Single Chat -->
                                                    <a href="#"
                                                        class="chat-media d-flex align-items-center new-message">
                                                        <div class="chat-user-img">
                                                            <img src="img/shop-img/2.png" alt="user"
                                                                class="rounded-circle thumb-md">
                                                            <span class="round-50 bg-success"></span>
                                                        </div>
                                                        <div class="chat-media-body d-flex justify-content-between">
                                                            <div class="chat-user-info">
                                                                <h6>Developer Group</h6>
                                                                <p>Good morning! Congratulations Friend...
                                                                </p>
                                                            </div>
                                                            <div class="chat-time">
                                                                <span>20 min</span>
                                                            </div>
                                                        </div>
                                                    </a>

                                                    <!-- Single Chat -->
                                                    <a href="#"
                                                        class="chat-media d-flex align-items-center new-message">
                                                        <div class="chat-user-img">
                                                            <img src="img/shop-img/3.png" alt="user"
                                                                class="rounded-circle thumb-md">
                                                            <span class="round-50 bg-danger"></span>
                                                        </div>
                                                        <div class="chat-media-body d-flex justify-content-between">
                                                            <div class="chat-user-info">
                                                                <h6>Daniel Madsen</h6>
                                                                <p>Good morning! Congratulations Friend...
                                                                </p>
                                                            </div>
                                                            <div class="chat-time">
                                                                <span>07 min</span>
                                                            </div>
                                                        </div>
                                                    </a>

                                                    <!-- Single Chat -->
                                                    <a href="#"
                                                        class="chat-media d-flex align-items-center new-message">
                                                        <div class="chat-user-img">
                                                            <img src="img/shop-img/4.png" alt="user"
                                                                class="rounded-circle thumb-md">

                                                        </div>
                                                        <div class="chat-media-body d-flex justify-content-between">
                                                            <div class="chat-user-info">
                                                                <h6>Daniel Madsen</h6>
                                                                <p>Good morning! Congratulations Friend...
                                                                </p>
                                                            </div>
                                                            <div class="chat-time">
                                                                <span>10 min</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                                aria-labelledby="pills-contact-tab" tabindex="0">
                                                <div class="single-chat-list" id="HotChat-list3">
                                                    <!-- Single Chat -->
                                                    <a href="#"
                                                        class="chat-media d-flex align-items-center new-message">
                                                        <div class="chat-user-img">
                                                            <img src="img/bg-img/per-2.jpg" alt="user"
                                                                class="rounded-circle thumb-md">
                                                            <span class="round-50 bg-success"></span>
                                                        </div>
                                                        <div class="chat-media-body d-flex justify-content-between">
                                                            <div class="chat-user-info">
                                                                <h6>Daniel Madsen</h6>
                                                                <p>Good morning! Congratulations Friend...
                                                                </p>
                                                            </div>
                                                            <div class="chat-time">
                                                                <span>02 min</span>
                                                            </div>
                                                        </div>
                                                    </a>

                                                    <!-- Single Chat -->
                                                    <a href="#"
                                                        class="chat-media d-flex align-items-center new-message">
                                                        <div class="chat-user-img">
                                                            <img src="img/bg-img/per-3.jpg" alt="user"
                                                                class="rounded-circle thumb-md">
                                                            <span class="round-50 bg-success"></span>
                                                        </div>
                                                        <div class="chat-media-body d-flex justify-content-between">
                                                            <div class="chat-user-info">
                                                                <h6>Daniel Madsen</h6>
                                                                <p>Good morning! Congratulations Friend...
                                                                </p>
                                                            </div>
                                                            <div class="chat-time">
                                                                <span>07 min</span>
                                                            </div>
                                                        </div>
                                                    </a>

                                                    <!-- Single Chat -->
                                                    <a href="#"
                                                        class="chat-media d-flex align-items-center new-message">
                                                        <div class="chat-user-img">
                                                            <img src="img/bg-img/per-2.jpg" alt="user"
                                                                class="rounded-circle thumb-md">
                                                            <span class="round-50 bg-danger"></span>
                                                        </div>
                                                        <div class="chat-media-body d-flex justify-content-between">
                                                            <div class="chat-user-info">
                                                                <h6>Daniel Madsen</h6>
                                                                <p>Good morning! Congratulations Friend...
                                                                </p>
                                                            </div>
                                                            <div class="chat-time">
                                                                <span>10 min</span>
                                                            </div>
                                                        </div>
                                                    </a>

                                                    <!-- Single Chat -->
                                                    <a href="#"
                                                        class="chat-media d-flex align-items-center new-message">
                                                        <div class="chat-user-img">
                                                            <img src="img/bg-img/per-3.jpg" alt="user"
                                                                class="rounded-circle thumb-md">
                                                            <span class="round-50 bg-success"></span>
                                                        </div>
                                                        <div class="chat-media-body d-flex justify-content-between">
                                                            <div class="chat-user-info">
                                                                <h6>Daniel Madsen</h6>
                                                                <p>Good morning! Congratulations Friend...
                                                                </p>
                                                            </div>
                                                            <div class="chat-time">
                                                                <span>22 min</span>
                                                            </div>
                                                        </div>
                                                    </a>

                                                    <!-- Single Chat -->
                                                    <a href="#"
                                                        class="chat-media d-flex align-items-center new-message">
                                                        <div class="chat-user-img">
                                                            <img src="img/bg-img/per-2.jpg" alt="user"
                                                                class="rounded-circle thumb-md">

                                                        </div>
                                                        <div class="chat-media-body d-flex justify-content-between">
                                                            <div class="chat-user-info">
                                                                <h6>Daniel Madsen</h6>
                                                                <p>Good morning! Congratulations Friend...
                                                                </p>
                                                            </div>
                                                            <div class="chat-time">
                                                                <span>02 min</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <!-- Single Chat -->
                                                    <a href="#"
                                                        class="chat-media d-flex align-items-center new-message">
                                                        <div class="chat-user-img">
                                                            <img src="img/bg-img/per-3.jpg" alt="user"
                                                                class="rounded-circle thumb-md">

                                                        </div>
                                                        <div class="chat-media-body d-flex justify-content-between">
                                                            <div class="chat-user-info">
                                                                <h6>Daniel Madsen</h6>
                                                                <p>Good morning! Congratulations Friend...
                                                                </p>
                                                            </div>
                                                            <div class="chat-time">
                                                                <span>28 min</span>
                                                            </div>
                                                        </div>
                                                    </a>
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

</body>

</html>