<?php session_start(); ?>
<!DOCTYPE html>
<html dir="ltr">

<head>
     <title> Forgot Password | Complaints Management System - Yaba College of Technology </title>
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
                    <form class="form-horizontal m-t-20" id="reset_password" method="post">

                        <div class="row p-b-30">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="email" class="form-control form-control-lg" placeholder="Enter Email Address" aria-label="email" aria-describedby="basic-addon1" required="" name="email">
                                </div>

                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-4 offset-4">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <input type="submit" value="Reset Password" class="btn btn-success float-right" id="submit">
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
        $('#reset_password').on('submit', function (event) {
            event.preventDefault();
                $.ajax({
                    url: 'process-forgot-password.php',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('#submit').attr('disabled', 'disabled');
                        $('#submit').val('Processing, pls wait.....');
                    },
                    success: function (data) {
                        $('#submit').attr('disabled', false);
                        $('#submit').val('Submit');
                        $('#success-msg').html(data);
                    }
                });


        });
    </script>

</body>

</html>
