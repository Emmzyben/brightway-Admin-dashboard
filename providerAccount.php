<?php
session_start();
if (!isset($_SESSION['uniqueId'])) {
    header("Location: index.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    if (empty($_POST['service'])) {
        $errors[] = "service is required.";
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
        header("Location: providerAccount.php"); 
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
                    header("Location: providerAccount.php"); 
                    exit;
                }
            } else {
                $_SESSION['message'] = "Upload failed. File size exceeds 15 MB.";
                $_SESSION['messageType'] = 'error';
                header("Location: providerAccount.php"); 
                exit;
            }
        } else {
            $_SESSION['message'] = "Upload failed. Allowed file types: " . implode(', ', $allowedfileExtensions);
            $_SESSION['messageType'] = 'error';
            header("Location: providerAccount.php"); 
            exit;
        }
    }

    $licensePath = null;
    if (isset($_FILES['license_document']) && $_FILES['license_document']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['license_document']['tmp_name'];
        $fileName = $_FILES['license_document']['name'];
        $fileSize = $_FILES['license_document']['size'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = ['jpg', 'png'];
        if (in_array($fileExtension, $allowedfileExtensions)) {
            if ($fileSize <= 15 * 1024 * 1024) { // 15 MB
                $uploadFileDir = 'licenseDocuments/';
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $licensePath = $uploadFileDir . $newFileName;
                $dest_path = $licensePath;

                if (!move_uploaded_file($fileTmpPath, $dest_path)) {
                    $_SESSION['message'] = "There was an error moving the uploaded license document.";
                    $_SESSION['messageType'] = 'error';
                    header("Location: providerAccount.php"); 
                    exit;
                }
            } else {
                $_SESSION['message'] = "Upload failed. File size exceeds 15 MB.";
                $_SESSION['messageType'] = 'error';
                header("Location: providerAccount.php"); 
                exit;
            }
        } else {
            $_SESSION['message'] = "Upload failed. Allowed file types: " . implode(', ', $allowedfileExtensions);
            $_SESSION['messageType'] = 'error';
            header("Location: providerAccount.php"); 
            exit;
        }
    }

    // Get form data
    $firstName = $conn->real_escape_string($_POST['firstname']);
    $lastName = $conn->real_escape_string($_POST['lastname']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $dateOfBirth = $conn->real_escape_string($_POST['date_of_birth']);
    $address = $conn->real_escape_string($_POST['address']);
    $state = $conn->real_escape_string($_POST['state']);
    $city = $conn->real_escape_string($_POST['city']);
    $zip = $conn->real_escape_string($_POST['zip']);
    $service = $conn->real_escape_string($_POST['service']);
    $bio = $conn->real_escape_string($_POST['bio']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT);
    $accountType = $conn->real_escape_string($_POST['accountType']);

    // Check if the email already exists
    $emailCheckSql = "SELECT id FROM users_patients WHERE email = ?";
    $emailStmt = $conn->prepare($emailCheckSql);
    $emailStmt->bind_param("s", $email);
    $emailStmt->execute();
    $emailStmt->store_result();

    if ($emailStmt->num_rows > 0) {
        $_SESSION['message'] = "A user with this email already exists.";
        $_SESSION['messageType'] = 'error';
        $emailStmt->close();
        $conn->close();
        header("Location: providerAccount.php"); 
        exit;
    }
    $emailStmt->close();

    // Insert user data into database
    $insertUserSql = "INSERT INTO users_patients (firstname, lastname, email, phone, date, address, state, city, zip, service, bio, username, password, profile_picture, license, accountType) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertUserSql);
    $insertStmt->bind_param("ssssssssssssssss", $firstName, $lastName, $email, $phone, $dateOfBirth, $address, $state, $city, $zip, $service, $bio, $username, $password, $profilePicturePath, $licensePath, $accountType);

    if ($insertStmt->execute()) {
        $_SESSION['message'] = "Provider account created successfully.";
        $_SESSION['messageType'] = 'success';
    } else {
        $_SESSION['message'] = "Error: " . $insertStmt->error;
        $_SESSION['messageType'] = 'error';
    }

    $insertStmt->close();
    $conn->close();

    header("Location: providerAccount.php");
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
    <title>Create provider</title>
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
 <style>
        #profileImagePreview, {
            max-width: 100px;
            display: block;
            margin-top: 10px;
            margin-bottom:10px;
        }
        #identity-proof-preview, #license-previews {
            max-width: 300px;
            display: block;
            margin-top: 10px;
            margin-bottom:10px;
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
                              <li class="active"><a href="provider.php">Overview</a></li>
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
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body card-breadcrumb">
                                        <div class="page-title-box d-flex align-items-center justify-content-between">
                                            <h4 class="mb-0">Add Provider</h4>
                                           
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
                                                            
                                                            <span class="fs-sm text-muted">
                                                                <p>( Upload a PNG or JPG, size limit is 15 MB. )</p>
                                                                <input type="file" id="profileImageInput" name="profile_picture" class="d-none" accept="image/png, image/jpeg">
                <button type="button" class="btn btn-sm btn-primary" onclick="document.getElementById('profileImageInput').click();">Set Profile Image</button>
           
                                                            </span>
                                                       
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
        <div class="mb-3 account">
                            <label for="email-name" class="col-form-label">Service:</label>
                <select class="form-select account w-100" name="service"  required>
                    <option value="">Select option</option>
                    <option value="cleaner">doctor</option>
                    <option value="admin">nurse</option>
                </select> 
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Bio</label>
                <textarea rows="4" cols="4" class="form-control" name="bio" id="formrow-address-input" placeholder="enter Short bio (OPTIONAL)" ></textarea> 
            </div>
        </div>
        <input type="hidden" name='accountType' value="provider">
    </div>
                                 
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header-cu">
                                                <h6 class="mb-0">Set Provider Login</h6>
                                            </div>

                                            <div class="card-body">
                        
                                                    <div class="mb-3">
                                                        <label class="form-label">Username</label>
                                                        <input type="text" name="username" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">password</label>
                                                        <input type="password" name='password' class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Confirm Password</label>
                                                        <input type="password" name='password' class="form-control" required>
                                                    </div>
                                            </div>
                                        </div>
                                     <br>
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

<!-- Existing code... -->
<div class="card">
    <div class="card-header-cu">
        <h6 class="mb-0">Upload Documents</h6>
    </div>
    <div class="card-body">
        <!-- Identity Proof Upload Section -->
        <div class="d-flex align-items-center border-bottom pb-4 mb-4">
            <div>
                <h6>Licence Upload</h6>
                <span class="fs-sm text-muted">
                    <p>(Upload a PNG or JPG, size limit is 15 MB.)</p>
                    <input type="file" name="license_document" id="license-document" accept="image/*" onchange="previewImage(event, 'license-document-preview')">
                </span>
                <div class="mt-3">
                    <img id="license-document-preview" class="document-preview" style="display: none;">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Create Provider</button>
    </div>
</div>
<!-- Existing code... -->

<script>
function previewImage(event, previewId) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
            document.getElementById(previewId).style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}

document.getElementById('profileImageInput').addEventListener('change', function(event) {
    previewImage(event, 'profileImagePreview');
});

document.getElementById('license-document').addEventListener('change', function(event) {
    previewImage(event, 'license-document-preview');
});
</script>
 
                                   

                                       
                                    </div>

                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                        aria-labelledby="v-pills-profile-tab" tabindex="0">
                                        <div class="card mb-25">
                                            <div
                                                class="card-header-cu d-flex align-items-center justify-content-between">
                                                <h6>Account notifications</h6>
                                                <a href="#!" class="btn btn-primary">Disable all</a>
                                            </div>
                                            <div class="card-body">
                                                <div class="row no-gutters border-bottom pb-4">
                                                    <div class="col">
                                                        jhon mentions me with a <span class="text-primary">@work</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="form-check form-switch">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="switch1">
                                                            <label class="form-check-label" for="switch1"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row no-gutters border-bottom py-4">
                                                    <div class="col">
                                                        jhon mentions me with.
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="form-check form-switch">
                                                            <input type="checkbox" class="form-check-input" id="switch2"
                                                                checked="">
                                                            <label class="form-check-label" for="switch2"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row no-gutters border-bottom py-4">
                                                    <div class="col">
                                                        jhon mentions me with.
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="form-check form-switch">
                                                            <input type="checkbox" class="form-check-input" id="switch3"
                                                                checked="">
                                                            <label class="form-check-label" for="switch3"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row no-gutters pt-4">
                                                    <div class="col">
                                                        jhon mentions me with.
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="form-check form-switch">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="switch4">
                                                            <label class="form-check-label" for="switch4"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div
                                                class="card-header-cu d-flex align-items-center justify-content-between">
                                                <h6> Marketing notifications</h6>
                                                <a href="#!" class="btn btn-primary">Disable all</a>
                                            </div>
                                            <div class="card-body">
                                                <div class="row no-gutters border-bottom pb-4">
                                                    <div class="col">
                                                        Suscribe to offers and discounts
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="form-check form-switch">
                                                            <input type="checkbox" class="form-check-input" id="switch5"
                                                                checked="">
                                                            <label class="form-check-label" for="switch5"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row no-gutters align-items-center border-bottom py-4">
                                                    <div class="col-8 col-md-9">
                                                        Receive the newsletter
                                                    </div>
                                                    <div class="col-4 col-md-3">
                                                        <select class="w-100">
                                                            <option>Daily</option>
                                                            <option>Weekly</option>
                                                            <option>Monthly</option>
                                                            <option>Unsubscribe</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row no-gutters pt-4">
                                                    <div class="col">
                                                        Product updates
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="form-check form-switch">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="switch6">
                                                            <label class="form-check-label" for="switch6"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                        aria-labelledby="v-pills-messages-tab" tabindex="0">

                                        <div class="card mb-25">
                                            <div 
                                                class="card-header-cu d-flex align-items-center justify-content-between">
                                                <h6>Present plan</h6>
                                                <a href="#!" class="btn btn-primary">Change Plan</a>
                                            </div>
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <div class="sub-plan-text">
                                                    <h6>Premium suscription</h6>
                                                    <h4 class="font-weigth-bold mb-0"><span
                                                            class="text-primary">$49.00</span> per month</h4>
                                                </div>
                                                <p class="text-uppercase-xs mt-4 mb-0">
                                                    <i class="fa fa-check-circle fa-lg text-success me-1"></i>
                                                    Your plan renews on Nov 16, 2023
                                                </p>
                                            </div>
                                        </div>

                                        <div class="card mb-25">
                                            <div
                                                class="card-header-cu d-flex align-items-center justify-content-between">
                                                <h6>Payment methods</h6>
                                                <a href="#!" class="btn btn-primary">Add new</a>
                                            </div>

                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-md-6 d-flex align-items-center">
                                                        <div class="svg-icon svg-icon-xl me-2 relative-top--2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="2500"
                                                                height="2500" viewBox="0 0 141.732 141.732">
                                                                <g fill="#2566af">
                                                                    <path
                                                                        d="M62.935 89.571h-9.733l6.083-37.384h9.734zM45.014 52.187L35.735 77.9l-1.098-5.537.001.002-3.275-16.812s-.396-3.366-4.617-3.366h-15.34l-.18.633s4.691.976 10.181 4.273l8.456 32.479h10.141l15.485-37.385H45.014zM121.569 89.571h8.937l-7.792-37.385h-7.824c-3.613 0-4.493 2.786-4.493 2.786L95.881 89.571h10.146l2.029-5.553h12.373l1.14 5.553zm-10.71-13.224l5.114-13.99 2.877 13.99h-7.991zM96.642 61.177l1.389-8.028s-4.286-1.63-8.754-1.63c-4.83 0-16.3 2.111-16.3 12.376 0 9.658 13.462 9.778 13.462 14.851s-12.075 4.164-16.06.965l-1.447 8.394s4.346 2.111 10.986 2.111c6.642 0 16.662-3.439 16.662-12.799 0-9.72-13.583-10.625-13.583-14.851.001-4.227 9.48-3.684 13.645-1.389z">
                                                                    </path>
                                                                </g>
                                                                <path
                                                                    d="M34.638 72.364l-3.275-16.812s-.396-3.366-4.617-3.366h-15.34l-.18.633s7.373 1.528 14.445 7.253c6.762 5.472 8.967 12.292 8.967 12.292z"
                                                                    fill="#e6a540"></path>
                                                                <path fill="none" d="M0 0h141.732v141.732H0z"></path>
                                                            </svg>
                                                        </div>
                                                        <span class="badge text-bg-primary ms-3">DEFAULT</span>
                                                    </div>
                                                    <div
                                                        class="col-md-6 d-flex justify-content-between align-items-center mt-3 mt-md-0">
                                                        <span class="text-uppercase-xs">
                                                            Expires 08/2028
                                                        </span>

                                                        <div class="dashboard-dropdown">
                                                            <div class="dropdown">
                                                                <button class="btn dropdown-toggle" type="button"
                                                                    id="dashboardDropdown53" data-bs-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false"><i
                                                                        class="ti-more"></i></button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dashboardDropdown53">
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-pencil-alt"></i>
                                                                        Edit</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-settings"></i>
                                                                        Settings</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-eraser"></i>
                                                                        Remove</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-trash"></i>
                                                                        Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header-cu">
                                                <h6 class="card-header-title text-darkblue">
                                                    Invoice history
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group">
                                                    <li class="list-group-item d-flex invoice-list-account">
                                                        <a href="#!">
                                                            Oct 26, 2023
                                                        </a>
                                                        <span class="ms-4">Premium Suscription</span>
                                                        <span class="ms-auto text-primary">$36.00</span>
                                                    </li>
                                                    <li class="list-group-item d-flex invoice-list-account">
                                                        <a href="#!">
                                                            Aug 26, 2023
                                                        </a>
                                                        <span class="ms-4">Premium Suscription</span>
                                                        <span class="ms-auto text-primary">$39.00</span>
                                                    </li>
                                                    <li class="list-group-item d-flex invoice-list-account">
                                                        <a href="#!">
                                                            Jul 26, 2023
                                                        </a>
                                                        <span class="ms-4">Premium Suscription</span>
                                                        <span class="ms-auto text-primary">$29.00</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                        aria-labelledby="v-pills-settings-tab" tabindex="0">
                                        <div class="card">
                                            <div
                                                class="card-header-cu d-flex align-items-center justify-content-between">
                                                <h6 class="mb-0">9 Members</h6>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal" data-bs-whatever="@mdo">New
                                                    User</button>

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
                                                                <span class="text-muted">
                                                                    joan@foresight.com
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <select class="form-select account">
                                                            <option>Admin</option>
                                                            <option>Staff</option>
                                                            <option>Designer</option>
                                                            <option>Developer</option>
                                                        </select>

                                                        <div class="dashboard-dropdown">
                                                            <div class="dropdown">
                                                                <button class="btn dropdown-toggle" type="button"
                                                                    id="dashboardDropdown1" data-bs-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false"><i
                                                                        class="ti-more"></i></button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dashboardDropdown1">
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-pencil-alt"></i>
                                                                        Edit</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-settings"></i>
                                                                        Settings</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-eraser"></i>
                                                                        Remove</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-trash"></i>
                                                                        Delete</a>
                                                                </div>
                                                            </div>
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
                                                                <span class="text-muted">
                                                                    joan@foresight.com
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <select class="form-select account">
                                                            <option>Admin</option>
                                                            <option>Staff</option>
                                                            <option>Designer</option>
                                                            <option>Developer</option>
                                                        </select>

                                                        <div class="dashboard-dropdown">
                                                            <div class="dropdown">
                                                                <button class="btn dropdown-toggle" type="button"
                                                                    id="dashboardDropdown2" data-bs-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false"><i
                                                                        class="ti-more"></i></button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dashboardDropdown2">
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-pencil-alt"></i>
                                                                        Edit</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-settings"></i>
                                                                        Settings</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-eraser"></i>
                                                                        Remove</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-trash"></i>
                                                                        Delete</a>
                                                                </div>
                                                            </div>
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
                                                                <span class="text-muted">
                                                                    joan@foresight.com
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <select class="form-select account">
                                                            <option>Admin</option>
                                                            <option>Staff</option>
                                                            <option>Designer</option>
                                                            <option>Developer</option>
                                                        </select>

                                                        <div class="dashboard-dropdown">
                                                            <div class="dropdown">
                                                                <button class="btn dropdown-toggle" type="button"
                                                                    id="dashboardDropdown4" data-bs-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false"><i
                                                                        class="ti-more"></i></button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dashboardDropdown4">
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-pencil-alt"></i>
                                                                        Edit</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-settings"></i>
                                                                        Settings</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-eraser"></i>
                                                                        Remove</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-trash"></i>
                                                                        Delete</a>
                                                                </div>
                                                            </div>
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
                                                                <span class="text-muted">
                                                                    joan@foresight.com
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <select class="form-select account">
                                                            <option>Admin</option>
                                                            <option>Staff</option>
                                                            <option>Designer</option>
                                                            <option>Developer</option>
                                                        </select>

                                                        <div class="dashboard-dropdown">
                                                            <div class="dropdown">
                                                                <button class="btn dropdown-toggle" type="button"
                                                                    id="dashboardDropdown8" data-bs-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false"><i
                                                                        class="ti-more"></i></button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dashboardDropdown8">
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-pencil-alt"></i>
                                                                        Edit</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-settings"></i>
                                                                        Settings</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-eraser"></i>
                                                                        Remove</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-trash"></i>
                                                                        Delete</a>
                                                                </div>
                                                            </div>
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
                                                                <span class="text-muted">
                                                                    joan@foresight.com
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <select class="form-select account">
                                                            <option>Admin</option>
                                                            <option>Staff</option>
                                                            <option>Designer</option>
                                                            <option>Developer</option>
                                                        </select>

                                                        <div class="dashboard-dropdown">
                                                            <div class="dropdown">
                                                                <button class="btn dropdown-toggle" type="button"
                                                                    id="dashboardDropdown5" data-bs-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false"><i
                                                                        class="ti-more"></i></button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dashboardDropdown5">
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-pencil-alt"></i>
                                                                        Edit</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-settings"></i>
                                                                        Settings</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-eraser"></i>
                                                                        Remove</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-trash"></i>
                                                                        Delete</a>
                                                                </div>
                                                            </div>
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
                                                                <span class="text-muted">
                                                                    joan@foresight.com
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <select class="form-select account" data-display="Select">
                                                            <option selected>Admin</option>
                                                            <option value="1">Staff</option>
                                                            <option value="4">Designer</option>
                                                            <option value="5">Developer</option>
                                                        </select>
                                                        <div class="dashboard-dropdown">
                                                            <div class="dropdown">
                                                                <button class="btn dropdown-toggle" type="button"
                                                                    id="dashboardDropdown10" data-bs-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false"><i
                                                                        class="ti-more"></i></button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dashboardDropdown10">
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-pencil-alt"></i>
                                                                        Edit</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-settings"></i>
                                                                        Settings</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-eraser"></i>
                                                                        Remove</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-trash"></i>
                                                                        Delete</a>
                                                                </div>
                                                            </div>
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
                                                                <span class="text-muted">
                                                                    joan@foresight.com
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <select class="form-select account">
                                                            <option>Admin</option>
                                                            <option>Staff</option>
                                                            <option>Designer</option>
                                                            <option>Developer</option>
                                                        </select>

                                                        <div class="dashboard-dropdown">
                                                            <div class="dropdown">
                                                                <button class="btn dropdown-toggle" type="button"
                                                                    id="dashboardDropdown6" data-bs-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false"><i
                                                                        class="ti-more"></i></button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dashboardDropdown6">
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-pencil-alt"></i>
                                                                        Edit</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-settings"></i>
                                                                        Settings</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-eraser"></i>
                                                                        Remove</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ti-trash"></i>
                                                                        Delete</a>
                                                                </div>
                                                            </div>
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

    <!-- New User Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="email-name" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" id="email-name">
                        </div>
                        <div class="mb-3 account">
                            <label for="email-name" class="col-form-label">Catagory:</label>
                            <select class="form-select account w-100">
                                <option>Admin</option>
                                <option>Staff</option>
                                <option>Designer</option>
                                <option>Developer</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send Request</button>
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