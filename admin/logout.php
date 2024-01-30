<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html dir="ltr">

<head>
     <title> Admin Logout | Complaints Management System - Yaba College of Technology </title>
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
                        <span class="db"><img src="<?php echo $conn->base_url(); ?>assets/images/site-logo.png" alt="logo" width="90" height="90" /></span>
                    </div>
                    <?php
                    if(isset($_SESSION['admin'])){
                        //destroy the session and logout user
                        session_destroy();
                        ?>
                        <p style='color: #28b779; font-size: 18px; text-align: center;'>Logout Successful</p>
                        <div class='spinner-border text-success text-center' role='status'>
                            <span class='sr-only'></span>
                        </div>

                        <div id="success-msg" style='color: #28b779; font-size: 18px; text-align: center;'>Redirecting to login  <meta http-equiv="refresh" content="4; <?php echo $login_redirect;?>"></div>

                        <?php
                    }else{
                        $index = $conn->base_url().'admin';
                        //redirect the user back to the homepage
                        header("Location: $index");
                    }
                    ?>


                </div>

            </div>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <?php include 'inc/scripts.php'; ?>
</body>

</html>