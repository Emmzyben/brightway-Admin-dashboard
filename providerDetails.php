<?php
session_start();

if (!isset($_SESSION['uniqueId'])) {
    header("Location: index.php");
    exit;
}

include 'database/db_config.php';

$user_id = $_GET['id'] ?? null;

if ($user_id) {
    $sql = "SELECT * FROM users_patients WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
} else {
    $_SESSION['message'] = "provider not found.";
    $_SESSION['messageType'] = 'error';
    header("Location: user.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['operation']) && $_POST['operation'] === 'status_update') {
        // Status update logic
        $id = $_POST['id'];
        $action = $_POST['action'];

        $status = in_array($action, ['approved', 'declined', 'unapproved']) ? $action : 'unapproved';

        $sql = "UPDATE users_patients SET approved = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Provider status updated to " . ucfirst($status) . ".";
            $_SESSION['messageType'] = 'success';
            
        } else {
            $_SESSION['message'] = "Error updating provider status: " . $stmt->error;
            $_SESSION['messageType'] = 'error';
        }

        $stmt->close();
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $user_id);
        exit;
    } elseif (isset($_POST['operation']) && $_POST['operation'] === 'password_update') {
        // Password update logic
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password === $confirm_password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users_patients SET password = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $hashed_password, $user_id);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Password updated successfully.";
                $_SESSION['messageType'] = 'success';
            } else {
                $_SESSION['message'] = "Error updating password: " . $stmt->error;
                $_SESSION['messageType'] = 'error';
            }

            $stmt->close();
            header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $user_id);
            exit;
        } else {
            $_SESSION['message'] = "Passwords do not match.";
            $_SESSION['messageType'] = 'error';
        }
    }
}

$conn->close();

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
    <title>Provider Details</title>
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
                          <li class="treeview active">
                            <a href="javascript:void(0)"><i class="bx bx-file"></i><span>Provider</span>
                              <i class="fa fa-angle-right"></i></a>
                            <ul class="treeview-menu">
                              <li class='active'><a href="provider.php">Overview</a></li>
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
        <div id="notificationBar" class="notification-bar <?php echo !empty($messageType) ? 'notification-'.$messageType : ''; ?>" <?php echo !empty($message) ? 'style="display: block;"' : ''; ?>>
        <span class="close-btn" onclick="closeNotification()">&times;</span>
        <span id="notificationMessage"><?php echo !empty($message) ? $message : ''; ?></span>
    </div>
    <script>
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
            <div class="row justify-content-center g-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body card-breadcrumb">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Provider Details</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (isset($user)): ?>
                            <div class="col-lg-3">
                            <div class="card">
                                    <div class="card-body">
                                        <div style='display:flex; align-items:center'>
                                        <div>
                                        <?php if ($user['profile_picture']): ?>
                    <img src="<?= htmlspecialchars($user['profile_picture']) ?>" alt="Profile Picture" style='height:200px'> <br> <br>
                <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div> <br>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="nav flex-column nav-pills me-3 account-tab" id="v-pills-tab"
                                            role="tablist" aria-orientation="vertical">
                                            <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                                data-bs-target="#v-pills-home" type="button" role="tab"
                                                aria-controls="v-pills-home" aria-selected="true">General</button>
                                          
                                            <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                                data-bs-target="#v-pills-messages" type="button" role="tab"
                                                aria-controls="v-pills-messages" aria-selected="false">Login Activity</button>
                                            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                                data-bs-target="#v-pills-settings" type="button" role="tab"
                                                aria-controls="v-pills-settings" aria-selected="false">Bookings</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-9">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                        aria-labelledby="v-pills-home-tab" tabindex="0">
                                        <div class="card mb-4">
                                            <div class="card-header-cu">
                                                <h6 class="mb-0">Basic information</h6>
                                            </div>
                                            <div class="card-body">
                                                <form>
                                                    <div class="d-flex align-items-center border-bottom pb-4 mb-4">
                                                        <div>
                                                            <h6>
                                                            <?= htmlspecialchars($user['firstname']) ?> <?= htmlspecialchars($user['lastname']) ?>
                                                            </h6>
                                                          <p><span style="color:#8dc741">Approval Status:</span> <?= htmlspecialchars($user['approved']) ?></p>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"><b>First name:</b>  <?= htmlspecialchars($user['firstname']) ?></label>
                                                             
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"><b>Last name:</b>  <?= htmlspecialchars($user['lastname']) ?></label>
                                                             
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"><b>email: </b> <?= htmlspecialchars($user['email']) ?></label>
                                                          
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"><b>Phone:</b>  <?= htmlspecialchars($user['phone']) ?></label>
                                                               
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"><b>Date of birth:</b>  <?= htmlspecialchars($user['date']) ?></label>
                                                               
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"><b>Address:</b> <?= htmlspecialchars($user['address']) ?></label>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"><b>State:</b> <?= htmlspecialchars($user['state']) ?></label>
                                                                
                                                            </div>
                                                        </div>
                                                         <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"><b>City:</b> <?= htmlspecialchars($user['city']) ?></label>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"><b>Zip code:</b> <?= htmlspecialchars($user['zip']) ?></label>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"><b>Service:</b> <?= htmlspecialchars($user['service']) ?></label>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"><b>Bio:</b> <?= htmlspecialchars($user['bio']) ?></label>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
    <?php endif; ?>
                                    <!-- Password Update Form -->
            <div class="card mt-4">
                <div class="card-header-cu">
                    <h6 class="mb-0">Change User Password</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <input type="hidden" name="operation" value="password_update">
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
                          </div>
                                        
                          <div class="card mt-4">
                <div class="card-header-cu">
                    <h6 class="card-header-title">Update Status</h6>
                </div>
                <div class="card-body">
                    <?php if (isset($user)): ?>
                        <form method="POST" action="">
                            <input type="hidden" name="operation" value="status_update">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
                            <p>Update account status</p>
                            <select name="action" class="form-control">
                                <option value="unapproved">Unapproved</option>
                                <option value="approved">Approved</option>
                                <option value="declined">Declined</option>
                            </select>
                            <br>
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
       
  

  
                               

                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                        aria-labelledby="v-pills-messages-tab" tabindex="0">

                                       
                                        <div class="card">
                                            <div class="card-header-cu">
                                                <h6 class="card-header-title text-darkblue">
                                                   Login Activity
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                            <table id="datatable" style='width:100%'
                                                class="table table-bordered dt-responsive nowrap data-table-area">
                                               
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td>12/10/2024</td>
                                                        <td>12:00pm</td>
                                                        <td>Login</td>
                                                    </tr>
                                                    <tr>
                                                        <td>12/10/2024</td>
                                                        <td>05:00pm</td>
                                                        <td>Log out</td>
                                                    </tr>
                                                    
                                                  
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                        aria-labelledby="v-pills-settings-tab" tabindex="0">
                                        <div class="card">
                                            <div
                                                class="card-header-cu d-flex align-items-center justify-content-between">
                                                <h6 class="mb-0">Booking Activity</h6>
                                                

                                            </div>

                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li
                                                        class="list-group-item account-members-list d-md-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            <div class="account-member-img">
                                                                <img src="img/bg-img/person_1.jpg" alt="">
                                                            </div>
                                                            <div class="flex-1 mt-3 mt-md-0">
                                                                <div class="fw-bold">
                                                                    Joan Didion
                                                                </div>
                                                                 
                                                            </div>
                                                        </div>
                                                        <div class="dashboard-dropdown">
                                                          <p>12/5/2025</p> 
                                                        </div>
                                                         <div class="dashboard-dropdown">
                                                          <p>12:00pm</p> 
                                                        </div>
                                                         

                                                        <div class="dashboard-dropdown">
                                                          <p style="color:orange">Pending</p> 
                                                        </div>
                                                    </li>

                                                    <li
                                                        class="list-group-item account-members-list d-md-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            <div class="account-member-img">
                                                                <img src="img/bg-img/per-3.jpg" alt="">
                                                            </div>
                                                            <div class="flex-1 mt-3 mt-md-0">
                                                                <div class="fw-bold">
                                                                    Joan Didion
                                                                </div>
                                                                 
                                                            </div>
                                                        </div>
                                                        <div class="dashboard-dropdown">
                                                          <p>12/5/2025</p> 
                                                        </div>
                                                         <div class="dashboard-dropdown">
                                                          <p>12:00pm</p> 
                                                        </div>
                                                         

                                                        <div class="dashboard-dropdown">
                                                          <p style="color:red">Cancelled</p> 
                                                        </div>
                                                    </li>

                                                    <li
                                                        class="list-group-item account-members-list d-md-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            <div class="account-member-img">
                                                                <img src="img/bg-img/per-2.jpg" alt="">
                                                            </div>
                                                            <div class="flex-1 mt-3 mt-md-0">
                                                                <div class="fw-bold">
                                                                    Joan Didion
                                                                </div>
                                                                 
                                                            </div>
                                                        </div>
                                                        <div class="dashboard-dropdown">
                                                          <p>12/5/2025</p> 
                                                        </div>
                                                         <div class="dashboard-dropdown">
                                                          <p>12:00pm</p> 
                                                        </div>
                                                         

                                                        <div class="dashboard-dropdown">
                                                          <p style="color:green">confirmed</p> 
                                                        </div>
                                                    </li>

                                                    <li
                                                        class="list-group-item account-members-list d-md-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            <div class="account-member-img">
                                                                <img src="img/bg-img/person_1.jpg" alt="">
                                                            </div>
                                                            <div class="flex-1 mt-3 mt-md-0">
                                                                <div class="fw-bold">
                                                                    Joan Didion
                                                                </div>
                                                                 
                                                            </div>
                                                        </div>
                                                        <div class="dashboard-dropdown">
                                                          <p>12/5/2025</p> 
                                                        </div>
                                                         <div class="dashboard-dropdown">
                                                          <p>12:00pm</p> 
                                                        </div>
                                                         

                                                        <div class="dashboard-dropdown">
                                                          <p style="color:orange">Pending</p> 
                                                        </div>
                                                    </li>

                                                    <li
                                                        class="list-group-item account-members-list d-md-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            <div class="account-member-img">
                                                                <img src="img/bg-img/per-3.jpg" alt="">
                                                            </div>
                                                            <div class="flex-1 mt-3 mt-md-0">
                                                                <div class="fw-bold">
                                                                    Joan Didion
                                                                </div>
                                                                 
                                                            </div>
                                                        </div>
                                                        <div class="dashboard-dropdown">
                                                          <p>12/5/2025</p> 
                                                        </div>
                                                         <div class="dashboard-dropdown">
                                                          <p>12:00pm</p> 
                                                        </div>
                                                         

                                                        <div class="dashboard-dropdown">
                                                          <p style="color:green">Confirmed</p> 
                                                        </div>
                                                    </li>

                                                  

                                                </ul>
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

    <!-- These plugins only need for the run this page -->
    <script src="js/fullcalendar.min.js"></script>
    <script src="js/fullcalendar-custom.js"></script>




</body>

</html>
 <!-- <div class="container mt-5">
                    <?php if (isset($user)): ?>
                        <div class="card">
                            <div class="card-body">
                                <?php if ($user['profile_picture']): ?>
                                    <img src="<?= htmlspecialchars($user['profile_picture']) ?>" alt="Profile Picture" class="img-fluid" width='150px'> <br> <br>
                                <?php endif; ?>
                                <p class="card-text"><strong>Full Name:</strong> <?= htmlspecialchars($user['firstname']) ?> <?= htmlspecialchars($user['lastname']) ?></p>
                                <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                                <p class="card-text"><strong>Phone:</strong> <?= htmlspecialchars($user['phone']) ?></p>
                                <p class="card-text"><strong>Address:</strong> <?= htmlspecialchars($user['address']) ?></p>
                                <p class="card-text"><strong>Approval Status:</strong> <?= htmlspecialchars($user['approved']) ?></p>

                                <hr>

                                <h5>Documents</h5>
                                <?php if (!empty($documents)): ?>
                                    <div class="document-list">
                                        <?php foreach ($documents as $doc): ?>
                                            <div class="document-item">
                                                <p><strong>Type:</strong> <?= htmlspecialchars($doc['documentType']) ?></p>
                                                <p><strong>Uploaded On:</strong> <?= htmlspecialchars($doc['upload_date']) ?></p>
                                                <?php if ($doc['documentPath']): ?>
                                                    <a href="<?= htmlspecialchars($doc['documentPath']) ?>" target="_blank" class="btn btn-primary mt-3">View Document</a>
                                                <?php endif; ?>
                                                <hr>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <p>No documents available.</p>
                                <?php endif; ?>

                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-danger">Provider not found.</div>
                    <?php endif; ?>
                    <a href="provider.php" class="btn btn-primary mt-3">Back to providers</a>
                </div>
            </div>
        </div>
    </div>
</div> -->
