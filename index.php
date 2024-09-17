<?php
session_start();
include 'database/db_config.php';
$_SESSION['showLogo'] = true;
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $ref_table = 'admin_login';
    $fetchdata = $database->getReference($ref_table)->getValue();
    
    $user_found = false;
    $user_id = null;
    $stored_password = null;

    if ($fetchdata) {
        foreach ($fetchdata as $key => $value) {
            if (isset($value['username']) && $value['username'] === $username) {
                $user_found = true;
                $user_id = $value['id'];
                $stored_password = $value['password'];
                break;
            }
        }
    }

    if ($user_found) {
        if (password_verify($password, $stored_password)) {
            $_SESSION['uniqueId'] = $user_id;
            $_SESSION['message'] = "Login successful.";
            $_SESSION['messageType'] = 'success';
            header("Location: dashboard.php");
            exit;
        } else {
            $_SESSION['message'] = "Incorrect password.";
            $_SESSION['messageType'] = 'error';
            $_SESSION['showLogo'] = false; 
        }
    } else {
        $_SESSION['message'] = "Username not found.";
        $_SESSION['messageType'] = 'error';
        $_SESSION['showLogo'] = false; 
    }

    header("Location: index.php"); 
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title -->
    <title>Brightway Admin Login</title>
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
        #displayLogo {
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 1050;
        }
    </style>
</head>

<body class="login-area">

    <div id="displayLogo">
        <img src="img/core-img/logo.png" alt="">
    </div>

    <!-- Page Wrapper Area Start -->
    <div class="main-content- h-100vh bg-img" style="background-image: url(img/bg-img/bg-3.jpg); display: none;">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-sm-10 col-md-7 col-lg-5">
                    <!-- Middle Box -->
                    <div style="display:flex;align-items:center;justify-content:center;margin-top:-10%;padding:20px">
                        <img src="img/core-img/logo.png" alt="" style="width: 150px;">
                     </div>
                    <div class="middle-box">
                        <div class="card-">
                            <div class="card-body p-4 py-5">
                                <div class="log-header-area mb-5 text-center">
                                    <h5>Welcome Back !</h5>
                                    <p class="mb-0">Sign in to continue.</p>
                                    <div id="notificationBar" class="notification-bar <?php echo !empty($_SESSION['messageType']) ? 'notification-' . $_SESSION['messageType'] : ''; ?>" <?php echo !empty($_SESSION['message']) ? 'style="display: block;"' : ''; ?>>
                                        <span class="close-btn" onclick="closeNotification()">&times;</span>
                                        <span id="notificationMessage"><?php echo !empty($_SESSION['message']) ? $_SESSION['message'] : ''; ?></span>
                                    </div>
                                    <?php
                                        unset($_SESSION['message']);
                                        unset($_SESSION['messageType']);
                                    ?>
                                </div>
                                <form action="" method="POST">
                                    <div class="form-group mb-3">
                                        <label class="text-muted" for="username">Username</label>
                                        <input class="form-control" type="text" id="username" name="username" required placeholder="Enter your username">
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="text-muted" for="password">Password</label>
                                        <input class="form-control" type="password" id="password" name="password" required placeholder="Enter your password">
                                    </div>

                                    <div class="form-group mb-3">
                                        <button class="btn btn-primary btn-lg w-100" type="submit" name="login">Sign In</button>
                                    </div>

                                    <div class="text-center">
                                        <span class="me-1">Don't have an account?</span>
                                        <a class="fw-bold" href="register.php">Sign up</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Wrapper Area End -->

    <!-- Must needed plugins to the run this Template -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/default-assets/setting.js"></script>
    <script src="js/default-assets/scrool-bar.js"></script>
    <script src="js/todo-list.js"></script>

    <!-- Active JS -->
    <script src="js/default-assets/active.js"></script>
    <script>
        function closeNotification() {
            var notificationBar = document.getElementById("notificationBar");
            notificationBar.style.display = "none";
        }

        function showLoginForm() {
            document.getElementById("displayLogo").style.display = "none";
            document.querySelector(".main-content-").style.display = "block";
        }

        document.addEventListener('DOMContentLoaded', function() {
            var displayLogo = document.getElementById("displayLogo");
            var mainContent = document.querySelector(".main-content-");

            // Check session variable to decide whether to show the logo or not
            var showLogo = <?php echo !empty($_SESSION['showLogo']) ? 'true' : 'false'; ?>;
            if (showLogo) {
                setTimeout(function() {
                    showLoginForm();
                }, 3000); // 3 seconds delay
            } else {
                showLoginForm();
            }

            <?php unset($_SESSION['showLogo']); ?>
        });
    </script>

</body>

</html>
