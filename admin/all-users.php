<?php
session_start();
?>

<?php
if(isset($_SESSION['admin'])){
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
     <title>All Users | Complaints Management System - Yaba College of Technology </title>
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
                        <h4 class="page-title">All Users</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>admin">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All users</li>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                 $sql = "SELECT COUNT(studentID) FROM user";
                                 $conn->query($sql);
                                 $total_users = $conn->fetchColumn();
                                ?>
                                <h5 class="card-title">Total Users Found: <span style="color:  #28b779; font-weight: bold;"><?php echo $total_users;  ?></span></h5>

                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead style="font-weight: bold; font-size: 16px;">
                                            <tr>
                                                <th>S/N</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Matric No</th>
                                                <th>Phone No</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                         $sql = "SELECT * FROM user";
                                         $conn->query($sql);
                                         $row_count = $conn->rowCount();
                                         $result = $conn->fetchMultiple();


                                        ?>

                                        <?php
                                        if($row_count > 0){
                                            $counter = 1;
                                            foreach ($result as $user){
                                                $photo = $user->photo;
                                                $name = $user->name;
                                                $username = $user->username;
                                                $matric_no = $user->matric_no;
                                                $phone_no = $user->phone_no;
                                                $email = $user->email;


                                                $redirect = $conn->base_url()."admin/view-user/$username";

                                                ?>
                                                <tr>
                                                        <td><?= $counter++; ?></td>

                                                        <td>
                                                            <?php
                                                            if(!empty($photo)){
                                                                ?>   <div class="p-2"><img src="<?= $conn->base_url();?>assets/images/<?= $photo;?>" alt="profile image" style="width: 40px; height: 40px; border-radius: 50%;"></div> <?php

                                                            }else{
                                                                ?>   <div class="p-2"><img src="<?= $conn->base_url();?>assets/images/default-photo.png" alt="profile image" style="width: 40px; height: 40px; border-radius: 50%;"></div> <?php

                                                            }
                                                            ?>
                                                        </td>

                                                        <td><?= $name; ?></td>
                                                        <td><?= $email; ?></td>
                                                        <td><?= $username; ?></td>
                                                        <td><?= $matric_no; ?></td>
                                                        <td><?= $phone_no; ?></td>

                                                        <td>

                                                            <a href="javascript:void();" style="cursor:pointer;" data-toggle="modal" data-target="#delete_user<?php echo $username;?>">
                                                                <i class="fa fa-trash" data-toggle="tooltip" title="Delete User"></i>
                                                            </a>


                                                        </td>

                                                </tr>

                                                <?php
                                            }
                                        }else{
                                            ?>
                                            <tr>
                                                <td colspan="8" class="text-center">No registered users found.</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                        </tbody>
                                        <tfoot>

                                            <tr>
                                                <th>S/N</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Matric No</th>
                                                <th>Phone No</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
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
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>
   <?php
   foreach ($result as $user){
       $name = $user->name;
       $username = $user->username;
       $matric_no = $user->matric_no;
       $phone_no = $user->phone_no;
       $email = $user->email;

    //mark as resolved modal
   ?>

            <div class="modal fade" id="delete_user<?= $username; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete user <?= $username; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true ">×</span>
                            </button>
                        </div>
                        <form action="" method="post">
                        <div class="modal-body">
                           Are you sure you want to delete user: <span class="text-warning"><?= $name; ?></span>?
                            <input type="hidden" name="username" value="<?= $username; ?>">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="delete_user" value="Delete User" class="btn btn-danger">
                        </div>
                        </form>
                    </div>
                </div>
            </div>

       <?php

   }

   if(isset($_POST['delete_user'])){
       $username = $_POST['username'];
       $redirect = $conn->base_url().'admin/all-users';

       $sql = "DELETE FROM user WHERE username =:username";
       $conn->query($sql);
       $conn->bind(":username", $username);
       try {
           $conn->execute();
           echo "<script>
              toastr['success']('User $username was successfully deleted.');
           </script><meta http-equiv='refresh' content='3; $redirect'>";

       }catch (PDOException $err){
           $error =  $err->getMessage();
           echo "<script>
              toastr['error']('An error occurred while deleting user. $error');
           </script><meta http-equiv='refresh' content='3; $redirect'>";
       }
   }

   ?>

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
                        <meta http-equiv='refresh' content='4; <?php echo $login_redirect; ?>'>
                    </div>
                    <p>You need to login to view this page.</p>
                </div>
            </div>
        </div>
    </div>

    <?php
}?>
