<?php
session_start();
include 'database/db_config.php';

if (isset($_POST['signup'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Generate a unique ID
    $uniqueId = uniqid('admin_', true);

    // Store the unique ID in the session
    $_SESSION['uniqueId'] = $uniqueId;

    $ref_table = 'admin_login';
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
        header("Location: register.php");
        exit;
    }

    if ($username_exists) {
        $_SESSION['message'] = "Username already exists.";
        $_SESSION['messageType'] = 'error';
        header("Location: register.php");
        exit;
    }

    // Push data to Firebase
    $postData = [
        'id' => $uniqueId,
        'fullname' => $fullname,
        'username' => $username,
        'email' => $email,
        'password' => $password,
    ];

    $postRef_result = $database->getReference($ref_table)->push($postData);

    if ($postRef_result) {
        $_SESSION['message'] = "Admin registered successfully.";
        $_SESSION['messageType'] = 'success';
        $_SESSION['showNotification'] = true;
        header("Location: register.php");
        exit;
    } else {
        $_SESSION['message'] = "Error registering admin.";
        $_SESSION['messageType'] = 'error';
    }

    header("Location: register.php");
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title -->
    <title>Brightway Admin register</title>
    <!-- Favicon -->
    <link rel="icon" href="img/core-img/logo.png">
    <!-- Plugins File -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <!-- Master Stylesheet -->
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

<body class="login-area">

    <!-- Preloader -->
    <div id="preloader">
        <div class="item">
            <i class="loader --8"></i>
        </div>
    </div>
    <!-- /Preloader -->

    <div class="main-content h-100vh bg-img" style="background-image: url(img/bg-img/bg-3.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-sm-10 col-md-7 col-lg-5">
                    <!-- Middle Box -->
                    <div class="middle-box">
                        <div class="card">
                            <div class="card-body p-4 py-5">
                                <div class="log-header-area mb-5 text-center">
                                <div id="notificationBar" class="notification-bar <?php echo !empty($_SESSION['messageType']) ? 'notification-' . $_SESSION['messageType'] : ''; ?>" <?php echo !empty($_SESSION['message']) ? 'style="display: block;"' : ''; ?>>
                                    <span class="close-btn" onclick="closeNotification()">&times;</span>
                                    <span id="notificationMessage"><?php echo !empty($_SESSION['message']) ? $_SESSION['message'] : ''; ?></span>
                                </div>
                                <?php
                                    unset($_SESSION['message']);
                                    unset($_SESSION['messageType']);
                                ?>
                                    <h5>Register Admin</h5>
                                    <p class="mb-0">Register new admin.</p>
                                </div>
                                <form action="" method='post'>
                                    <div class="form-group mb-3">
                                        <label class="text-muted" for="fullname">Full Name</label>
                                        <input class="form-control" type="text" id="fullname" name="fullname" required placeholder="Enter your name">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-muted" for="username">Username</label>
                                        <input class="form-control" type="text" id="username" name="username" required placeholder="Enter your username">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-muted" for="emailaddress">Email Address</label>
                                        <input class="form-control" type="email" id="emailaddress" name="email" required placeholder="Enter your email">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="text-muted" for="password">Password</label>
                                        <input class="form-control" type="password" id="password" name="password" required placeholder="Enter your password">
                                    </div>
                                    <div class="form-group mb-3">
                                        <button class="btn btn-primary btn-lg w-100" type="submit" name="signup">Sign Up</button>
                                    </div>
                                    <div class="text-center">
                                        <span class="me-1">Already have an account?</span>
                                        <a class="fw-bold" href="index.php">Sign in</a>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/default-assets/setting.js"></script>
    <script src="js/default-assets/scrool-bar.js"></script>
    <script src="js/todo-list.js"></script>
    <script src="js/default-assets/active.js"></script>
    <script>
        function closeNotification() {
            var notificationBar = document.getElementById("notificationBar");
            notificationBar.style.display = "none";
        }

        <?php if (!empty($_SESSION['showNotification'])): ?>
            document.addEventListener('DOMContentLoaded', function() {
                var notificationBar = document.getElementById("notificationBar");
                notificationBar.style.display = "block";
                setTimeout(function() {
                    notificationBar.style.display = "none";
                    window.location.href = "dashboard.php";
                }, 3000);
            });
            <?php unset($_SESSION['showNotification']); ?>
        <?php endif; ?>
    </script>
</body>

</html>
