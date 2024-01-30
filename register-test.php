<?php session_start(); ?>
<!DOCTYPE html>
<html dir="ltr">

<head>
    <?php include "inc/header.php"; ?>

    <title> Registration | Complaints Management System - Yaba College of Technology </title>
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

                <div id="loginform">
                    <div class="text-center p-t-20 p-b-20">
                        <span class="db"><img src="assets/images/site-logo.png" alt="logo" width="90" height="90"/></span>
                    </div>
                    <!-- Form -->
                    <form class="form-horizontal m-t-20" id="registration_form" method="post">

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

                                ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Matric No" aria-label="matric_no" aria-describedby="basic-addon1"  name="matric_no">
                                </div>

                                    <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="username" aria-describedby="basic-addon1"  name="username">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1"  name="password" id="password" autocomplete="off" name="password" data-parsley-trigger="keyup" id="password">


                                </div>

                                <div class="checkbox">
                                    <input type="checkbox" id="chekcbox4" onclick="myFunction()">
                                    <label for="chekcbox4" class="ml-4">
                                        <span class="checkbox-icon mt-1 -ml-4"></span> <span class="font-semibold text-base" style="position: relative;left: -23px; top: -2px; color: #ffb848;">Show or Hide Password</span>
                                    </label>
                                </div>
                                <input type="submit" value="Register" class="btn btn-success" id="submit">

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
        $('#registration_form').parsley();
        $('#registration_form').on('submit', function (event) {
            event.preventDefault();
            if($('#registration_form').parsley().isValid()){
                $.ajax({
                    url: 'process-registertest-user.php',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('#submit').attr('disabled', 'disabled');
                        $('#submit').val('Processing registration, pls wait.....');
                    },
                    success: function (data) {
                        $('#registration_form').parsley().reset();
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
