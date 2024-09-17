<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title -->
    <title>Forgot password</title>
    <!-- Favicon -->
    <link rel="icon" href="img/core-img/logo.png">
    <!-- Plugins File -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <!-- Master Stylesheet [If you remove this CSS file, your file will be broken undoubtedly.] -->
    <link rel="stylesheet" href="style.css">

</head>

<body class="login-area">

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
    <div class="main-content- h-100vh bg-img" style="background-image: url(img/bg-img/bg-3.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-sm-10 col-md-7 col-lg-5">
                    <!-- Middle Box -->
                    <div class="middle-box">
                        <div class="card-">
                            <div class="card-body p-4 py-5">
                                <div class="log-header-area mb-5 text-center">
                                    <h5 class="mb-0">Forgot Password?
                                    </h5>
                                </div>
                                <form action="index.php">
                                    <div class="form-group mb-3">
                                        <label class="text-muted" for="emailaddress">Email or Phone</label>
                                        <input class="form-control" type="email" id="emailaddress"
                                            placeholder="Enter email or Number">
                                    </div>

                                    <div class="form-group mb-3">
                                        <button class="btn btn-primary btn-lg w-100" type="submit">Send
                                            Password</button>
                                    </div>

                                    <div class="text-center">
                                        <span class="me-1">I remembered my password.</span>
                                        <a class="fw-bold" href="login.php">Sign in</a>
                                    </div>
                                </form>
                            </div>
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