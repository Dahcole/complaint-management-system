<?php
session_start();
?>

<?php
  if(isset($_SESSION['username'])){
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
     <title> Dashboard | Complaints Management System - Yaba College of Technology </title>

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
                        <h4 class="page-title">Welcome, you are logged in as <span style="color: #28b779; "><?= ucfirst($_SESSION['username']); ?></span></h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
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
                <!-- Sales Cards  -->
                <!-- ============================================================== -->
                <?php include 'inc/dashboard-items.php'; ?>
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <?php include "inc/complaints_reply.php";?>
                </div>
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
            </div>

            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include 'inc/scripts.php'; ?>
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
          <title>Login to continue |  Complaints Management System - Yaba College of Technology </title>

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
                          <meta http-equiv='refresh' content='4; login'>
                      </div>
                      <p>You need to login to view this page.</p>
                  </div>
              </div>
          </div>
      </div>

      <?php
  }?>
