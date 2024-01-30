<?php
date_default_timezone_set("Africa/Lagos");
$current_date = date('F d, Y h:ia');

    if(!empty($_GET['code'])){
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title> Password Verify | Complaints Management System - Yaba College of Technology </title>
    
    <?php
    
    include "inc/header.php";
    $redirect = $conn->base_url() .'login';

    ?>

    

</head>

<body>
<?php

//fetch complaints data from the database
$email_code = $_GET['code'];
$email_address = $_GET['email'];
//check if code matches with database code
$sql = "SELECT verify_id FROM reset_password WHERE verify_id =:verify_id";
$conn->query($sql);
$conn->bind(":verify_id", $email_code);
$db_code = $conn->fetchColumn();

?>

<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<?php include 'inc/preloader.php'; ?>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->

        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
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
                    <div class="col-10 offset-1">
                        <div class="card">
                            <div class="card-body" style="background: #303030 !important;">

                                <h5 class="card-title" style="font-size: 18px;">Password Reset <span style="color:  #28b779; font-weight: bold;">Page</span>
                                </h5>

                                <?php
                                if($email_code == $db_code){
                                    //ID check passed, check for expiration of code
                                    $sql = "SELECT code_expire FROM reset_password WHERE verify_id =:verify_id";
                                    $conn->query($sql);
                                    $conn->bind(":verify_id", $email_code);
                                    $db_code_expire = $conn->fetchColumn();

                                    if($db_code_expire > $current_date){

                                    //go ahead and allow user to reset password
                                    ?>
                                            <div id="loginform">
                                                <div class="text-center p-t-20 p-b-20">
                                                    <span class="db"><img src="<?php $conn->base_url();?>assets/images/matryxlogo.png" alt="logo" /></span>
                                                </div>
                                                <!-- Form -->
                                                <form class="form-horizontal m-t-20" id="reset_password" method="post">

                                                    <div class="row p-b-30">
                                                        <div class="col-10 offset-1">
                                                            <p style="font-size: 12px; color: coral;">* Password must include one uppercase letter, one lowercase letter, one number,
                                                                * and one special character such as $ or %
                                                                * and length should be between 6 and 16</p>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                                                </div>
                                                                <input type="password" class="form-control form-control-lg" placeholder="Enter new password" aria-label="password" aria-describedby="basic-addon1" required="" name="password" id="password">
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                                                </div>
                                                                <input type="password" class="form-control form-control-lg" placeholder="Confirm new password" aria-label="password" aria-describedby="basic-addon1" required="" name="confirm_password" id="confirm_password">
                                                            </div>

                                                            <input type="hidden" name="email" value="<?php echo $email_address;?>">

                                                            <div class="checkbox">
                                                                <input type="checkbox" id="chekcbox4" onclick="myFunction()">
                                                                <label for="chekcbox4" class="ml-4">
                                                                    <span class="checkbox-icon mt-1 -ml-4"></span> <span class="font-semibold text-base" style="position: relative;left: -23px; top: -2px; color: #ffb848;">Show or Hide Password</span>
                                                                </label>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="row border-top border-secondary">
                                                        <div class="col-5 offset-2">
                                                            <div class="form-group">
                                                                <div class="p-t-20">
                                                                    <input type="submit" value="Change Password" class="btn btn-success float-right" id="submit">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div id="success-msg"></div>
                                            </div>

                                    <?php


                                }else{

                                    ?>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-2"></div>
                                            <div class="col-lg-8" style="margin: 100px;">
                                                <p class="text-center" style="color: #fff; font-size: 18px;"> Your verification link has expired. Link is only valid for 10mins from the time of sending...</p>
                                                <meta http-equiv='refresh' content ='4; <?= $redirect; ?>'>
                                            </div>
                                            <div class="col-lg-2"></div>
                                        </div>
                                    </div>
                                    <?php
                                }

                                }else{

                                    ?>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-2"></div>
                                            <div class="col-lg-8" style="margin: 100px;">
                                                <p class="text-center" style="color: #fff; font-size: 18px;"> Your verification code is invalid. Please make sure you clicked on the link sent to your email.</p>
                                            </div>
                                            <meta http-equiv='refresh' content ='4; <?= $redirect; ?>'>
                                            <div class="col-lg-2"></div>
                                        </div>
                                    </div>
                                    <?php

                                }




                                ?>




                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include 'inc/scripts.php'; ?>

            <script>
                function myFunction() {
                    var x = document.getElementById("password");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }

                    var y = document.getElementById("confirm_password");
                    if (y.type === "password") {
                        y.type = "text";
                    } else {
                        y.type = "password";
                    }
                }
            </script>

            <script>
                //Process add new team modal
                $(document).ready(function () {
                    $('#reset_password').on('submit', function (event) {
                        event.preventDefault();
                        $.ajax({
                            url: 'process-change-password.php',
                            method: 'post',
                            data: new FormData(this),
                            contentType: false,
                            cache: false,
                            processData: false,
                            beforeSend: function () {
                                $('#submit').attr('disabled', 'disabled');
                                $('#submit').val('Submitting, pls wait.....');
                            },
                            success: function (data) {
                                $('#submit').attr('disabled', false);
                                $('#submit').val('Change Password');
                                $('#success-msg').html(data);
                            }
                        })
                    })
                })

            </script>

</body>


</html>

<?php }else{
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
            <title> Acess denied |  Complaints Management System - Yaba College of Technology </title>

            <?php include "inc/header.php"; ?>

            <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

        </head>
        <body style='background: #e0e0e0; '>
        <div class="container" style="margin-top: 20%;">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="section-title text-center">
                        <h6>You don't have access to view this page</h6>
                        <div class="spinner-border text-info" role="status">
                            <span class="sr-only"></span>
                            <?php $redirect = $conn->base_url() . 'login';?>
                            <meta http-equiv='refresh' content='4; <?= $redirect; ?>'>
                        </div>
                        <p>Redirecting to Login page.</p>
                    </div>
                </div>
            </div>
        </div>
        </body>
        </html>

        <?php
    }


