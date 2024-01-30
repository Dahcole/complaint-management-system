<?php session_start(); ?>
<!DOCTYPE html>
<html dir="ltr">

<head>
     <title> Login | Complaints Management System - Yaba College of Technology </title>
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
                    <form class="form-horizontal m-t-20" id="login_form" method="post">

                        <div class="row p-b-30">
                            <div class="col-12">
                                <?php

                                if (isset($_SESSION['username'])) {
                                    $username = $_SESSION['username'];
                                    echo "<h2>You are already logged in $username </h2> <p style='color: #ffc107;'>Access denied.</p>";
                                                echo "<script>
                                  alert('You are already logged in $username');
                               </script><meta http-equiv='refresh' content='3; index'>";
                                                return false;
                                }

                                if(isset($_SESSION['just_registered'])){
                                    $full_name = $_SESSION['just_registered'];
                                    echo "<p style='color: #28b779; font-size: 18px; text-align: center;'>Thanks for registering  $full_name </p> <p style='color: #ffc107; font-size: 16px; text-align: center;'>Login below</p>";
                                }else{
                                    echo "<p style='color: #28b779; font-size: 18px; text-align: center;'>Welcome Back</p>";
                                }

                                ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Matric No" aria-label="matric_no" aria-describedby="basic-addon1" required="" name="matric_no">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required="" name="password" id="password">
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" id="chekcbox4" onclick="myFunction()">
                                    <label for="chekcbox4" class="ml-4">
                                        <span class="checkbox-icon mt-1 -ml-4"></span> <span class="font-semibold text-base" style="position: relative;left: -2px; top: -2px; color: #ffb848;">Show or Hide Password</span>
                                    </label>
                                </div>
                                <input type="submit" value="Login" class="btn btn-success" id="submit">

                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <button class="btn btn-info" id="to-recover" type="button" onclick="window.location.href='<?php echo $conn->base_url();?>forgot-password'"><i class="fa fa-lock m-r-5"></i> Lost password?</button>
                                        <button class="btn btn-danger" id="to-recover" type="button" onclick="window.location.href='<?php echo $conn->base_url();?>register'"><i class="fa fa-lock m-r-5"></i> Create an Account</button>

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
        $('#login_form').parsley();
        $('#login_form').on('submit', function (event) {
            event.preventDefault();
            if($('#login_form').parsley().isValid()){
                $.ajax({
                    url: 'process-login-user.php',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('#submit').attr('disabled', 'disabled');
                        $('#submit').val('Processing Login, pls wait.....');
                    },
                    success: function (data) {
                        $('#login_form').parsley().reset();
                        $('#submit').attr('disabled', false);
                        $('#submit').val('Submit');
                        $('#success-msg').html(data);
                    }
                });
            }

        });
    </script>

    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>