<?php
session_start();
?>

<?php
if(isset($_SESSION['admin'])){
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <style>
        .parsley-errors-list, .filled {
            position: static !important;
            left: 0 !important;
            top: 0 !important;
            display: inline-block;
            list-style: none !important;
        }
        .parsley-pattern {
            color: #6a2121 !important;
             position: static !important;
            left: 0;
            bottom: 0;
            list-style: none;
            font-weight: 500 !important;
        }
    </style>
     <title> Admin Change Password | Complaints Management System - Yaba College of Technology </title>
    <?php include "inc/header.php"; ?>

   


</head>

<body>

<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<?php include 'inc/preloader.php'; ?>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include 'inc/top-bar.php'?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php include 'inc/side-bar.php'?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Change Password </h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>admin">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Change Password </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->

                <div class="row">

                    <div class="col-md-10 offset-md-1">
                        <div class="card">
                          <form class="form-horizontal" method="post" id="change_password">
                                <div class="card-body">
                                    <h4 class="card-title">Change Password</h4>
                                    <div class="form-group row">
                                        <label for="old_password" class="col-sm-3 control-label col-form-label">Old Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="old_password" name="old_password" required data-parsley-trigger="keyup">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="new_password" class="col-sm-3 control-label col-form-label">New Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="new_password"  name="new_password" required data-parsley-trigger='keyup' data-parsley-pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" data-parsley-pattern-message="Password must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirm_new_password" class="col-sm-3 control-label col-form-label">Confirm New Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control password" id="confirm_new_password"  name="confirm_new_password" required data-parsley-trigger='keyup' data-parsley-pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" data-parsley-pattern-message="Password must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">
                                        </div>
                                    </div>
                                </div>
                              <div class="checkbox" style="position: relative; bottom: 20px; left: 27%;">
                                  <input type="checkbox" id="chekcbox4" onclick="myFunction()">
                                  <label for="chekcbox4" class="ml-4">
                                      <span class="checkbox-icon mt-1 -ml-4"></span> <span class="font-semibold text-base" style="position: relative;left: -23px; top: -2px; color: #ffb848;">Show or Hide Password</span>
                                  </label>
                              </div>
                              <input type="hidden" name="username" value="<?php echo $_SESSION['admin']; ?>">
                                <div class="border-top">
                                    <div class="card-body">
                                        <input type="submit" name="submit" class="btn btn-success" value="Update Password">
                                    </div>
                                </div>
                            </form>
                            <div id="display_msg"></div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include 'inc/scripts.php'; ?>

            <script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>

            <script>

                $(document).ready(function(){
                    $('#change_password').parsley();
                    $('#change_password').on('submit', function (event) {
                        event.preventDefault();
                        let formData = $(this).serialize();
                        if($('#change_password').parsley().isValid()) {
                            $.ajax({
                                url: 'update-password.php',
                                data: formData,
                                dataType: 'JSON',
                                method: 'POST',
                                success: function (data) {
                                    if (data.error != '') {
                                        $('#display_msg').html(data.error);
                                    }
                                }
                            });
                        }
                    })
                })
            </script>

            <script>
                function myFunction() {
                    var x = document.getElementById("new_password");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }

                    var y = document.getElementById("confirm_new_password");
                    if (y.type === "password") {
                        y.type = "text";
                    } else {
                        y.type = "password";
                    }
                    var z = document.getElementById("old_password");
                    if (z.type === "password") {
                        z.type = "text";
                    } else {
                        z.type = "password";
                    }

                }
            </script>


</body>

</html>
<?php

}else{

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <title> Login to continue |  Complaints Management System - Yaba College of Technology </title>

        <?php include "inc/header.php"; ?>

        <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    </head>
    <body style='background: #e0e0e0; '>
    <div class="container" style="margin-top: 20%;">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="section-title text-center">
                    <h6>Access denied</h6>
                    <div class="spinner-border text-info" role="status">
                        <span class="sr-only"></span>
                        <meta http-equiv='refresh' content='4; <?php echo $login_redirect; ?>'>
                    </div>
                    <p>You need to login to view this page.</p>
                </div>
            </div>
        </div>
    </div>

    <?php
}?>