<?php error_reporting(0); ?>
<!DOCTYPE html>
<html dir="ltr">

<head>
    <title> Register | Complaints Management System - Yaba College of Technology </title>
    <?php include "inc/header.php"; ?>


</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <?php include 'inc/preloader.php'; ?>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div id="loginform">
                    <div class="text-center p-t-20 p-b-20">
                      <span class="db"><img src="assets/images/site-logo.png" alt="logo" width="90" height="90"/></span>
                    </div>
                    <!-- Form -->

                    <form class="form-horizontal m-t-20" method="post" id="register_form">
                        <p class="text-center" style="font-size: 20px; color: #fff;">Register below </p>
                        <div class="row p-b-30">
                            <div class="col-12">
                                <?php
                                session_start();
                                if (isset($_SESSION['username'])) {
                                    $username = $_SESSION['username'];
                                    echo "<h2>You are already logged in $username </h2> <p style='color: #ffc107;'>Access denied.</p>";
                                    echo "<script>
                                  alert('You are already logged in $username');
                               </script><meta http-equiv='refresh' content='3; index'>";
                                    return false;
                                }

                                ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Full Name" aria-label="full_name" aria-describedby="basic-addon1" required autocomplete="off" name="full_name" data-parsley-trigger="keyup">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required autocomplete="off" name="username" data-parsley-trigger="keyup">
                                </div>

                                <!-- email -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="email" class="form-control form-control-lg" placeholder="Email Address" aria-label="email" aria-describedby="basic-addon1" required autocomplete="off" name="email" data-parsley-trigger="keyup" data-parsley-type="email">
                                </div>
                                <div class="input-group mb-3">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required autocomplete="off" name="password" data-parsley-trigger="keyup" data-parsley-pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" data-parsley-pattern-message="Password must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder=" Matric No" aria-label="matric_no" aria-describedby="basic-addon1" required autocomplete="off" name="matric_no" data-parsley-trigger="keyup">
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <input type="submit" value="Register" class="btn btn-block btn-lg btn-info" id="submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div id="success-msg"></div>

                </div>
            </div>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <?php include 'inc/scripts.php'; ?>

    <script>
            $('#register_form').parsley();
            $('#register_form').on('submit', function(event){
                event.preventDefault();
                if($('#register_form').parsley().isValid()){
                    $.ajax({
                        url: 'process-register-user.php',
                        method: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function () {
                            $('#submit').attr('disabled', 'disabled');
                            $('#submit').val('We are registering you, pls wait.....');
                        },
                        success: function (data) {
                            $('#register_form').parsley().reset();
                            $('#submit').attr('disabled', false);
                            $('#submit').val('Submit');
                            $('#success-msg').html(data);
                        }
                    });
                }
            })
    </script>
</body>

</html>
