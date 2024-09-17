<?php
session_start();
if (!isset($_SESSION['uniqueId'])) {
    header("Location: index.php");
    exit;
}

include 'database/db_config.php'; 

$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date_of_birth = $_POST['date_of_birth'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];

    $userReference = $database->getReference('users_table/' . $id);
    $user = $userReference->getValue();

    // Hash the password before updating
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $hashed_password = $user['password']; 
    }

    $profile_picture = $_FILES['profile_picture'] ?? null;
    $profile_picture_path = '';

    if ($profile_picture && $profile_picture['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/png', 'image/jpeg'];
        if (in_array($profile_picture['type'], $allowed_types)) {
            if ($profile_picture['size'] <= 15 * 1024 * 1024) { // 15 MB
                $target_dir = "profileImages/";
                $profile_picture_path = $target_dir . basename($profile_picture['name']);
                move_uploaded_file($profile_picture['tmp_name'], $profile_picture_path);
            } else {
                $_SESSION['message'] = "Profile picture size exceeds the limit of 15 MB.";
                $_SESSION['messageType'] = 'error';
                header("Location: editDriver.php?id=$id");
                exit;
            }
        } else {
            $_SESSION['message'] = "Invalid file type. Only PNG and JPG are allowed.";
            $_SESSION['messageType'] = 'error';
            header("Location: editDriver.php?id=$id");
            exit;
        }
    } else {
        // If no new profile picture is uploaded, retain the existing one
        $profile_picture_path = $user['profile_picture'] ?? '';
    }

    // Prepare the data to be updated
    $updatedUserData = [
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'phone' => $phone,
        'date_of_birth' => $date_of_birth,
        'address' => $address,
        'profile_picture' => $profile_picture_path,
        'username' => $username,
        'password' => $hashed_password,
        'state' => $state,
        'city' => $city,
        'zip' => $zip
    ];

    // Update the user record in Firebase
    $userReference->update($updatedUserData);

    $_SESSION['message'] = "driver record updated successfully.";
    $_SESSION['messageType'] = 'success';

    header("Location: driver.php");
    exit;
}

if ($id) {
    // Fetch user data from Firebase
    $userReference = $database->getReference('users_table/' . $id);
    $user = $userReference->getValue();

    if (!$user) {
        $_SESSION['message'] = "driver not found.";
        $_SESSION['messageType'] = 'error';
        header("Location: driver.php");
        exit;
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title -->
    <title>Edit Driver</title>
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
                          <li class="treeview active">
                            <a href="javascript:void(0)"><i class="bx bx-file"></i><span>Driver</span>
                              <i class="fa fa-angle-right"></i></a>
                            <ul class="treeview-menu">
                              <li  class='active'><a href="driver.php">Overview</a></li>
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
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body card-breadcrumb">
                                        <div class="page-title-box d-flex align-items-center justify-content-between">
                                            <h4 class="mb-0">Edit Driver information</h4>
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
                                            </div>
                                            <div class="card-body">
                                            <form id="profileForm" method="POST" enctype="multipart/form-data">
                                            <div class="d-flex align-items-center border-bottom pb-4 mb-4">
        <div class="account-img">
        <img id="profileImagePreview" src="<?php echo htmlspecialchars(isset($user['profile_picture']) ? $user['profile_picture'] : 'img/bg-img/per-3.jpg'); ?>" alt="Profile Image">

        </div>
  
        <div>
            <h6>Driver Image</h6>
            <span class="fs-sm text-muted">( Upload a PNG or JPG, size limit is 15 MB. )</span>
            <div class="mt-3">
            <input type="file" id="profileImageInput" name="profile_picture" class="d-none" accept="image/png, image/jpeg">
                        <button type="button" class="btn btn-sm btn-primary" onclick="document.getElementById('profileImageInput').click();">Edit Profile Image</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">First name</label>
                <input type="text" class="form-control" name="firstname" id="formrow-firstname-input" placeholder="First name" value="<?php echo htmlspecialchars($user['firstname']); ?>"  >
            </div>
        </div>
        <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Last name</label>
                        <input type="text" class="form-control" name="lastname" id="formrow-last-input" placeholder="Last name" value="<?php echo htmlspecialchars($user['lastname']); ?>"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="formrow-email-input" placeholder="exple@98.com" value="<?php echo htmlspecialchars($user['email']); ?>"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Phone number</label>
                        <input type="text" class="form-control" name="phone" id="formrow-phone-input" placeholder="+888 222 544" value="<?php echo htmlspecialchars($user['phone']); ?>"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Date of birth</label>
                        <input type="date" class="form-control" name="date_of_birth" id="formrow-date-input" value="<?php echo htmlspecialchars($user['date_of_birth']); ?>"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="formrow-address-input" placeholder="" value="<?php echo htmlspecialchars($user['address']); ?>"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">state</label>
                        <input type="text" class="form-control" name="state" id="formrow-address-input" placeholder="" value="<?php echo htmlspecialchars($user['state']); ?>"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">city</label>
                        <input type="text" class="form-control" name="city" id="formrow-address-input" placeholder="" value="<?php echo htmlspecialchars($user['city']); ?>"  >
                    </div>
                </div>  <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Zip code</label>
                        <input type="text" class="form-control" name="zip" id="formrow-address-input" placeholder="" value="<?php echo htmlspecialchars($user['zip']); ?>"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="formrow-date-input" value="<?php echo htmlspecialchars($user['username']); ?>"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="text" class="form-control" name="password" id="formrow-address-input" placeholder="" value="<?php echo htmlspecialchars($user['password']); ?>"  >
                    </div>
                </div>
              
                <div class="form-group">
                <button type="submit" name="update" class="btn btn-primary">Update</button>
                <a href="driver.php" class="btn btn-secondary">Cancel</a>
            </div>
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
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/todo-list.js"></script>

    <!-- Active JS -->
    <script src="js/default-assets/active.js"></script>

</body>

</html>