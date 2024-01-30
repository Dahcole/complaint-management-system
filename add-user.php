<?php
session_start();
?>

<?php
if(isset($_SESSION['admin'])){
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
     <title> Admin Edit Profile | Complaints Management System - Yaba College of Technology </title>
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
                        <h4 class="page-title">My Profile</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>admin">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
                            <?php
                                //fetch existing user details
                                $sql = "SELECT * FROM admin WHERE username =:username";
                                $conn->query($sql);
                                $conn->bind('username', $_SESSION['admin']);
                                $row_count = $conn->rowCount();
                                if($row_count > 0){
                                    //fetch user details
                                    $result = $conn->fetchSingle();
                                    $name = $result->name;
                                    $admin_id = $result->adminID;
                                    $phone = $result->phone_no;
                                    $photo = $result->photo;
                                    $email = $result->email;

                                ?>
                    <div class="col-md-8 offset-md-2">
                        <div class="card">
                          <form class="form-horizontal" method="post">
                                <div class="card-body">
                                    <h4 class="card-title">Personal Info</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 control-label col-form-label">Full Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="fname" value="<?php echo $name; ?>" name="full_name" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-3 control-label col-form-label">Phone No</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="phone" value="<?php echo $phone; ?>" name="phone" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 control-label col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="email" value="<?php echo $email; ?>" name="email" required>
                                        </div>
                                     </div>

                                       <div class="form-group row">
                                        <label for="username" class="col-sm-3 control-label col-form-label">Username</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="username" id="username" value="<?php echo $_SESSION['admin']; ?>" readonly style="cursor: not-allowed;">
                                        </div>
                                    </div>


                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" name="update_profile" class="btn btn-success"><i class="fa fa-upload"></i> Update Profile</button>
                                    </div>
                                </div>
                            </form>
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


            <?php
              if(isset($_POST['update_profile'])){
                   $full_name =$_POST['full_name'];
                   $phone =$_POST['phone'];
                   $email =$_POST['email'];

                    $redirect = $conn->base_url().'admin/profile';
                    //perform validations for email
    //check for email availability
    $sql = "SELECT * FROM admin WHERE email =:email AND username !=:username";
    $conn->query($sql);
    $conn->bind(":email", $email);
    $conn->bind(":username", $_SESSION['admin']);
    if($conn->rowCount() > 0){
        echo "<script>
              toastr['error']('Email already exists for another admin.');
           </script>";
        return false;
    }
    $sql = "SELECT * FROM admin WHERE name =:name AND username != :username";
    $conn->query($sql);
    $conn->bind(":name", $full_name);
    $conn->bind(":username", $_SESSION['admin']);
    if($conn->rowCount() > 0){
        echo "<script>
              toastr['error']('Please enter a different name.');
           </script>";
    }else {

        //process  updating of data into database

        if($conn-> validate_phone($phone)){
              $sql = "UPDATE admin SET name =:name, phone_no=:phone, email=:email WHERE username =:username ";
        $conn->query($sql);
        $conn->bind(":name", $full_name);
        $conn->bind(":email", $email);
        $conn->bind(":phone", $phone);
        $conn->bind(":username", $_SESSION['admin']);

        try {
            $send = $conn->execute();
             echo "<script>
              toastr['success']('Your profile was updated successfully.');
           </script><meta http-equiv='refresh' content='3; $redirect'>";
           }catch (PDOException $err){
            $error = $err->getMessage();
             echo "<script>
              toastr['error']('An error occurred: $error');
           </script>";
           }

    } else{
         echo "<script>
              toastr['error']('Pls enter a valid phone number. Eg:07015667653.');
           </script>";
    }
        }

              }

            ?>



</body>

</html>
<?php
  }

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
