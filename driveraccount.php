<?php
session_start();
if (!isset($_SESSION['uniqueId'])) {
    header("Location: index.php");
    exit;
}


if (isset($_POST['addDriver'])) {
    // Database connection
    include 'database/db_config.php';

    // Form data validation
    $errors = [];

    if (empty($_POST['firstname'])) {
        $errors[] = "First name is required.";
    }
    if (empty($_POST['lastname'])) {
        $errors[] = "Last name is required.";
    }
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email address is required.";
    }
    if (empty($_POST['phone'])) {
        $errors[] = "A phone number is required.";
    }
    if (empty($_POST['date_of_birth']) || !DateTime::createFromFormat('Y-m-d', $_POST['date_of_birth'])) {
        $errors[] = "A valid date of birth is required (YYYY-MM-DD).";
    }
    if (empty($_POST['address'])) {
        $errors[] = "Address is required.";
    }
    if (empty($_POST['state'])) {
        $errors[] = "State is required.";
    }
    if (empty($_POST['city'])) {
        $errors[] = "City is required.";
    }
    if (empty($_POST['zip'])) {
        $errors[] = "Zip code is required.";
    }
    if (empty($_POST['username'])) {
        $errors[] = "Username is required.";
    }
    if (empty($_POST['password']) || strlen($_POST['password']) < 6) {
        $errors[] = "Password is required and must be at least 6 characters.";
    }

    if (!empty($errors)) {
        $_SESSION['message'] = implode(' ', $errors);
        $_SESSION['messageType'] = 'error';
        header("Location: driveraccount.php");
        exit;
    }

    $profilePicturePath = null;
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
        $fileName = $_FILES['profile_picture']['name'];
        $fileSize = $_FILES['profile_picture']['size'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = ['jpg', 'png'];
        if (in_array($fileExtension, $allowedfileExtensions)) {
            if ($fileSize <= 15 * 1024 * 1024) { // 15 MB
                $uploadFileDir = 'profileImages/';
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $profilePicturePath = $uploadFileDir . $newFileName;
                $dest_path = $profilePicturePath;

                if (!move_uploaded_file($fileTmpPath, $dest_path)) {
                    $_SESSION['message'] = "There was an error moving the uploaded file.";
                    $_SESSION['messageType'] = 'error';
                   header("Location: driveraccount.php");
                    exit;
                }
            } else {
                $_SESSION['message'] = "Upload failed. File size exceeds 15 MB.";
                $_SESSION['messageType'] = 'error';
               header("Location: driveraccount.php");
                exit;
            }
        } else {
            $_SESSION['message'] = "Upload failed. Allowed file types: " . implode(', ', $allowedfileExtensions);
            $_SESSION['messageType'] = 'error';
           header("Location: driveraccount.php");
            exit;
        }
    }

    // Get form data
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dateOfBirth = $_POST['date_of_birth'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $bio = $_POST['bio'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $accountType = $_POST['accountType'];


   
    $ref_table = 'users_table';
    $fetchdata = $database->getReference($ref_table)->getValue();
    
    $email_exists = false;
    $username_exists = false;

    if ($fetchdata) {
        foreach ($fetchdata as $key => $value) {
            if (isset($value['email']) && $value['email'] === $email) {
                $email_exists = true;
            }
            if (isset($value['username']) && $value['username'] === $username) {
                $username_exists = true;
            }
        }
    }

    if ($email_exists) {
        $_SESSION['message'] = "Email already exists.";
        $_SESSION['messageType'] = 'error';
       header("Location: driveraccount.php");
        exit;
    }

    if ($username_exists) {
        $_SESSION['message'] = "Username already exists.";
        $_SESSION['messageType'] = 'error';
       header("Location: driveraccount.php");
        exit;
    }
    $default_status ='unapproved';
    $postData = [
        'firstname' => $firstName,
        'lastname' => $lastName,
        'email' => $email,
        'phone' => $phone,
        'date_of_birth' => $dateOfBirth,
        'address' => $address,
        'state' => $state,
        'city' => $city,
        'zip' => $zip,
        'bio' => $bio,
        'username' => $username,
        'password' => $password,
        'accountType' => $accountType,
        'profile_picture' => $profilePicturePath,
        'approved'=> $default_status,
    ];
    $postRef_result = $database->getReference($ref_table)->push($postData);

    if ($postRef_result) {
        $_SESSION['message'] = "driver registered successfully.";
        $_SESSION['messageType'] = 'success';
        header("Location: driver.php");
        exit;
    } else {
        $_SESSION['message'] = "Error registering driver.";
        $_SESSION['messageType'] = 'error';
       header("Location: driveraccount.php");
        exit;
    }

   header("Location: driveraccount.php");
    exit;
}

// Handle message display
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $messageType = $_SESSION['messageType'];
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
    <title>Create driver</title>
    <!-- Favicon -->
    <link rel="icon" href="img/core-img/logo.png">
    <!-- Plugins File -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">

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
                            <a href="javascript:void(0)"  class="active"><i class="bx bx-file"></i><span>Users</span>
                              <i class="fa fa-angle-right"></i></a>
                            <ul class="treeview-menu">
                              <li ><a href="user.php" >Overview</a></li>
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
                          <li class="treeview active">
                            <a href="javascript:void(0)"><i class="bx bx-file"></i><span>Driver</span>
                              <i class="fa fa-angle-right"></i></a>
                            <ul class="treeview-menu">
                              <li class="active"><a href="driver.php">Overview</a></li>
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
                      </nav></div>
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


                        <div class="row g-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body card-breadcrumb">
                                        <div class="page-title-box d-flex align-items-center justify-content-between">
                                            <h4 class="mb-0">Add driver</h4>
               
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
                                            <form id="profileForm" method="POST" enctype="multipart/form-data">
                                            <div class="d-flex align-items-center border-bottom pb-4 mb-4">
        <div class="account-img">
            <img id="profileImagePreview" src="img/bg-img/per-3.jpg" alt="Profile Image">
        </div>
        <div>
            <h6>Driver Image</h6>
            <span class="fs-sm text-muted">( Upload a PNG or JPG, size limit is 15 MB. )</span>
            <div class="mt-3">
                <input type="file" id="profileImageInput" name="profile_picture" class="d-none" accept="image/png, image/jpeg">
                <button type="button" class="btn btn-sm btn-primary" onclick="document.getElementById('profileImageInput').click();">Set Profile Image</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">First name</label>
                <input type="text" class="form-control" name="firstname" id="formrow-firstname-input" placeholder="First name" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Last name</label>
                <input type="text" class="form-control" name="lastname" id="formrow-last-input" placeholder="Last name" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="formrow-email-input" placeholder="exple@98.com" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Phone number</label>
                <input type="text" class="form-control" name="phone" id="formrow-phone-input" placeholder="+888 222 544" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Date of birth</label>
                <input type="date" class="form-control" name="date_of_birth" id="formrow-date-input" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" name="address" id="formrow-address-input" placeholder="enter address" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">State</label>
                <input type="text" class="form-control" name="state" id="formrow-address-input" placeholder="enter state" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">City</label>
                <input type="text" class="form-control" name="city" id="formrow-address-input" placeholder="enter city" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Zip code</label>
                <input type="text" class="form-control" name="zip" id="formrow-address-input" placeholder="enter zip code" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Bio</label>
                <textarea rows="4" cols="4" class="form-control" name="bio" id="formrow-address-input" placeholder="enter Short bio (OPTIONAL)" ></textarea> 
            </div>
        </div>
        <input type="hidden" name='accountType' value="driver">
    </div>



<script>
    document.getElementById('profileImageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileImagePreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
                                            </div>
                                        </div>
    <div class="card">
        <div class="card-header-cu">
            <h6 class="mb-0">Set driver login</h6>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">User name</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name='password' class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name='password' class="form-control" required>
            </div>
            <div class="col-12 mt-2">
                <button type="submit" class="btn btn-primary" name='addDriver'>Create driver</button>
            </div>
        </div>
    </div>
</form>
                                       
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
                                    <p class="mb-0 font-13">2024 &copy; Funel Admin</p>
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
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/todo-list.js"></script>

    <!-- Active JS -->
    <script src="js/default-assets/active.js"></script>

</body>

</html>