<?php
session_start();
?>

<?php
if(isset($_SESSION['admin'])){
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
     <title> Admin Profile | Complaints Management System - Yaba College of Technology </title>
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
                    <div class="col-md-6">
                        <div class="card">
                          <form class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Personal Info</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 control-label col-form-label">Full Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="fname" placeholder="<?php echo $name; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 control-label col-form-label">Phone No</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="cono1" placeholder="<?php echo $phone; ?>">
                                        </div>
                                    </div>

                                         <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 control-label col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="cono1" placeholder="<?php echo $email; ?>">
                                        </div>
                                    </div>


                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                    <p style="font-weight: bold; font-size: 14px;">To edit your profile pls click the link below.</p>
                                        <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo $base_url;?>admin/edit-profile'"><i class="fa fa-edit"></i> Edit my profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                          <form class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Profile Photo</h4>
                                    <div class="form-group row">

                                        <div class="col-sm-9">
                                          <?php
                                           if(empty($photo)){
                                              ?>
                                               <p style="text-align: left;"><img src="<?php echo $base_url; ?>assets/images/default-photo.png" alt="profile photo" style="width: 200px; height: 200px; border-radius: 50%;"></p>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#upload-picture">Upload Profile Picture</button>
                                              <?php
                                           }else{
                                                ?>
                                               <p style="text-align: left;"><img src="<?php echo $base_url; ?>assets/images/<?php echo $photo; ?>" alt="profile photo" style="width: 200px; height: 200px; border-radius: 50%;"></p>

                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#change-picture">Change Profile Picture</button>
                                              <?php
                                           }

                                          ?>
                                           <img src="" alt="">
                                        </div>
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

              <div class="modal fade" id="upload-picture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload a new profile picture</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true ">×</span>
                            </button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                         <p> Select a new  <span class="text-warning"> profile picture</span></p>
                            <input type="file" name="profile_image" required>
                            <p class="text-info">Jpeg, jpg and png formats are supported. Recommended size is 200px by 200px;</p>
                            <input type="hidden" name="user" value="<?= $_SESSION['admin']; ?>">

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="upload_photo" value="Upload Photo" class="btn btn-primary">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
                <div class="modal fade" id="change-picture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change existing profile picture</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true ">×</span>
                            </button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                         <p> Select a new  <span class="text-warning"> profile picture</span></p>
                         <p style="text-align: left;"><img src="<?php echo $base_url; ?>assets/images/<?php echo $photo; ?>" alt="profile photo" style="width: 50px; height: 50px; border-radius: 50%; float: right;position: absolute;top: 10px; right: 90px;"></p>

                            <input type="file" name="image" required>
                            <p class="text-info">Jpeg, jpg and png formats are supported. Recommended size is 200px by 200px;</p>
                            <input type="hidden" name="user" value="<?= $_SESSION['admin']; ?>">
                            <input type="hidden" name="exisiting_photo" value="<?= $photo; ?>">

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="change_photo" value="Upload Photo" class="btn btn-primary">
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
              if(isset($_POST['upload_photo'])){
                   $file_tmpname = $_FILES['profile_image']['tmp_name'];
                    $file_name = $_FILES['profile_image']['name'];
                    $file_size = $_FILES['profile_image']['size'];
                    $new_filename = '';
                    $redirect = $conn->base_url().'admin/profile';

                      if(!empty($file_name)){
                        $ext = explode('.', $file_name);
                        $extension = end($ext);
                        list($width, $height, $type, $attr) = getimagesize($file_tmpname );

                        if($extension == 'jpg' || 'png' || 'jpeg' and $file_size <= 1000000){
                        if($width == 200 and $height == 200){
                            $new_filename = time().rand(10000,99999).'.'.$extension;
                            $location = "../assets/images/".$new_filename;
                            //insert image into the database

                            $sql = "UPDATE admin SET photo =:photo WHERE username =:username";
                            $conn->query($sql);
                            $conn->bind(":photo", $new_filename);
                            $conn->bind(":username", $_SESSION['admin']);
                            try {
                                $conn->execute();
                                 move_uploaded_file($file_tmpname, $location);
                                    echo "<script>
                              toastr['success']('Profile photo uploaded successfully.');
                           </script><meta http-equiv='refresh' content='3; $redirect'>";

                              }catch (PDOException $err){
                                $error = $err->getMessage();
                                   echo "<script>
                              toastr['error']('An error occurred: $error');
                           </script>";
                              }

                        }else{
                            echo "<script>
                              toastr['error']('Image dimension must be 200px by 200px (width and height).');
                           </script>";
                            return false;
                        }

                        }else{
                              echo "<script>
                              toastr['error']('Either you uploaded an unsupported file extension or your file size is too large.');
                           </script>";
                            return false;
                        }

                    }else{
                          echo "<script>
                              toastr['error']('Please select an image file to upload.');
                           </script>";
                    }

              }

                if(isset($_POST['change_photo'])){
                   $file_tmpname = $_FILES['image']['tmp_name'];
                    $file_name = $_FILES['image']['name'];
                    $file_size = $_FILES['image']['size'];
                    $new_filename = '';
                    $redirect = $conn->base_url().'admin/profile';
                    $exisiting_photo = $_POST['exisiting_photo'];

                      if(!empty($file_name)){
                        $ext = explode('.', $file_name);
                        $extension = end($ext);
                        list($width, $height, $type, $attr) = getimagesize($file_tmpname );

                        if($extension == 'jpg' || 'png' || 'jpeg' and $file_size <= 1000000){
                        if($width == 200 and $height == 200){
                            $new_filename = time().rand(10000,99999).'.'.$extension;
                            $location = "../assets/images/".$new_filename;
                            $existing_file= "../assets/images/".$exisiting_photo;
                            //insert image into the database

                            $sql = "UPDATE admin SET photo =:photo WHERE username =:username";
                            $conn->query($sql);
                            $conn->bind(":photo", $new_filename);
                            $conn->bind(":username", $_SESSION['admin']);
                            try {
                                //delete the existing photo
                                unlink($existing_file);
                                $conn->execute();
                                 move_uploaded_file($file_tmpname, $location);
                                    echo "<script>
                              toastr['success']('Profile photo updated successfully.');
                           </script><meta http-equiv='refresh' content='3; $redirect'>";

                              }catch (PDOException $err){
                                $error = $err->getMessage();
                                   echo "<script>
                              toastr['error']('An error occurred: $error');
                           </script>";
                              }

                        }else{
                            echo "<script>
                              toastr['error']('Image dimension must be 200px by 200px (width and height).');
                           </script>";
                            return false;
                        }

                        }else{
                              echo "<script>
                              toastr['error']('Either you uploaded an unsupported file extension or your file size is too large.');
                           </script>";
                            return false;
                        }

                    }else{
                          echo "<script>
                              toastr['error']('Please select an image file to upload.');
                           </script>";
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