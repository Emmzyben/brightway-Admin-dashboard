<?php
session_start();
if (!isset($_SESSION['uniqueId'])) {
    header("Location: index.php");
    exit;
}

include 'database/db_config.php'; 

// Handle deletion
if (isset($_GET['confirmDeleteService']) && isset($_GET['id'])) {
    $id = $_GET['id'];

  
    $ref_table = 'services/' . $id; 
    $deleteResult = $database->getReference($ref_table)->remove();
    // Delete service record from Firebase

    if ($deleteResult) {
        $_SESSION['message'] = "service record deleted successfully.";
        $_SESSION['messageType'] = 'success';
    } else {
        $_SESSION['message'] = "Error deleting service record.";
        $_SESSION['messageType'] = 'error';
    }
    header("Location: services.php");
    exit;
}

$ref_table = 'services';
$services = $database->getReference($ref_table)->getValue();

$users = [];
if ($services) {
    foreach ($services as $id => $service) {
        $service['id'] = $id;
        $users[] = $service;
    }
}

// Display message if set
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $messageType = $_SESSION['messageType'];
    echo "<div class='message {$messageType}'>{$message}</div>";
    unset($_SESSION['message']);
    unset($_SESSION['messageType']);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title -->
    <title>Services</title>
    <!-- Favicon -->
    <link rel="icon" href="img/core-img/logo.png">
    <!-- Plugins File -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <!-- Page Plugins Css Files -->
    <link rel="stylesheet" href="css/fullcalendar.min.css">

    <!-- Master Stylesheet [If you remove this CSS file, your file will be broken undoubtedly.] -->
    <link rel="stylesheet" href="style.css">
    <style>
        /* Style for confirmation popup */
        .confirmation-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* semi-transparent background */
            z-index: 1000; /* ensure it's on top of everything */
            justify-content: center;
            align-items: center;
        }

        .confirmation-popup-inner {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        
        .btn:hover {
            background-color: red;
        }
       
    </style>
         <style>
        .notification-bar {
            padding: 10px;
            text-align: center;
            z-index: 1050;
            display: none;
        }
        .notification-success {
            background-color: #d4edda;
            color: #155724;
        }
        .notification-error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .close-btn {
            margin-left: 15px;
            color: #000;
            font-weight: bold;
            float: right;
            font-size: 20px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }
        .close-btn:hover {
            color: #999;
        }
    </style>
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
                          <li class="treeview active">
                            <a href="javascript:void(0)"><i class="bx bx-file"></i><span>Services</span>
                              <i class="fa fa-angle-right"></i></a>
                            <ul class="treeview-menu">
                              <li class="active"><a href="services.php">Overview</a></li>
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
                        <div id="notificationBar" class="notification-bar <?php echo !empty($messageType) ? 'notification-'.$messageType : ''; ?>" <?php echo !empty($message) ? 'style="display: block;"' : ''; ?>>
        <span class="close-btn" onclick="closeNotification()">&times;</span>
        <span id="notificationMessage"><?php echo !empty($message) ? $message : ''; ?></span>
    </div>  <script>
    function closeNotification() {
        var notificationBar = document.getElementById("notificationBar");
        notificationBar.style.display = "none";
    }

    // Automatically close the notification after 3 seconds
    function autoCloseNotification() {
        var notificationBar = document.getElementById("notificationBar");
        setTimeout(function() {
            notificationBar.style.display = "none";
        }, 3000); // 3000 milliseconds = 3 seconds
    }

    // Call autoCloseNotification if there's a notification
    window.onload = function() {
        var notificationBar = document.getElementById("notificationBar");
        if (notificationBar && notificationBar.style.display !== "none") {
            autoCloseNotification();
        }
    }
</script>

                            <div class="col-12">
                                <div class="card ">
                                    <div class="card-body card-breadcrumb">
                                        <div class="page-title-box d-flex align-items-center justify-content-between">
                                            <h4 class="mb-0">Service Management</h4>
                                            <a href="serviceaccount.php"><button class="btn btn-green" style="background-color:#8dc741;color:white">Add Services</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                           
                            <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                              
                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap data-table-area">
        <thead>
            <tr>
                <th>Profession</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['service']); ?></td>
              <td><a href="editServices.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-orange btn-sm">Edit</a></td>
                <td><button onclick="showConfirmation('delete', '<?php echo htmlspecialchars($user['id']); ?>')" class="btn btn-danger btn-sm delete-btn">Delete</button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Confirmation Popup -->
<div id="confirmationPopup" class="confirmation-popup" style="display:none;">
    <div class="confirmation-popup-inner">
        <p id="confirmationMessage"></p>
        <button class="btn btn-danger" onclick="deleteRecord()">Yes</button>
        <button class="btn btn-secondary" onclick="closeConfirmation()">No</button>
    </div>
</div>

<script>
    function showConfirmation(type, id) {
        var message = 'Are you sure you want to delete this service?';
        document.getElementById('confirmationMessage').textContent = message;
        document.getElementById('confirmationPopup').style.display = 'flex';
        document.getElementById('confirmationPopup').setAttribute('data-type', type);
        document.getElementById('confirmationPopup').setAttribute('data-id', id);
    }

    function closeConfirmation() {
        document.getElementById('confirmationPopup').style.display = 'none';
    }

    function deleteRecord() {
        var id = document.getElementById('confirmationPopup').getAttribute('data-id');
        window.location.href = 'services.php?confirmDeleteService=true&id=' + encodeURIComponent(id);
    }
</script>
                    </div>
                </div>
                </div>
                </div>  </div></div>
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

    <!-- These plugins only need for the run this page -->
    <script src="js/fullcalendar.min.js"></script>
    <script src="js/fullcalendar-custom.js"></script>




</body>

</html>