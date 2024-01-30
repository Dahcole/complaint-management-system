<?php
session_start();
?>

<?php
if(isset($_SESSION['admin'])){
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
     <title> Admin view Complaints | Complaints Management System - Yaba College of Technology </title>
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
                        <h4 class="page-title">Complaints History</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>admin">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Complaints</li>
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
                                 $sql = "SELECT COUNT(id) FROM complaints";
                                 $conn->query($sql);
                                 $total_complaints = $conn->fetchColumn();
                                ?>
                                <h5 class="card-title">Total Complaints Found: <span style="color:  #28b779; font-weight: bold;"><?php echo $total_complaints;  ?></span></h5>

                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead style="font-weight: bold; font-size: 16px;">
                                            <tr>
                                                <th>Complaint number</th>
                                                <th>Title</th>
                                                <th>Date submitted</th>
                                                <th>Urgency</th>
                                                <th>Complaint status</th>
                                                <th>Complainer</th>
                                                <th>Last Updated</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                         $sql = "SELECT * FROM complaints JOIN user u on complaints.studentID = u.studentID ORDER BY complaints.id DESC";
                                         $conn->query($sql);
                                         $row_count = $conn->rowCount();
                                         $result = $conn->fetchMultiple();


                                        ?>

                                        <?php
                                        if($row_count > 0){
                                            foreach ($result as $complaint_details){
                                                $complaint_no = $complaint_details->complaint_number;
                                                $subject = $complaint_details->title;
                                                $status = $complaint_details->status;
                                                $urgency = $complaint_details->urgency;
                                                $date_submitted = $complaint_details->reg_date;
                                                $date_modified = $complaint_details->last_modified;
                                                $redirect = $conn->base_url()."admin/view-complaint/$complaint_no";
                                                $urgency_class = '';
                                                $status_class = '';
                                                $student_username = $complaint_details->username;
                                                if($status == 'Open'){
                                                    $status_class = 'text-success';

                                                }else{
                                                    $status_class = 'text-danger';
                                                }

                                                if($urgency == 'low'){
                                                    $urgency_class = 'text-info';
                                                }elseif($urgency == 'medium'){
                                                    $urgency_class = 'text-success';
                                                }elseif($urgency == 'high'){
                                                    $urgency_class = 'text-warning';
                                                }elseif($urgency == 'critical'){
                                                    $urgency_class = 'text-danger';
                                                }
                                                ?>
                                                <tr>
                                                        <td>#<?= $complaint_no; ?></td>
                                                        <td><?= $subject; ?></td>
                                                        <td><?= $date_submitted; ?></td>
                                                        <td><span class="<?= $urgency_class ?>"><?= $urgency; ?></span></td>
                                                        <td><span class="<?= $status_class ?>"><?= $status; ?></span></td>
                                                        <td><?= $student_username; ?></td>
                                                        <td><?= $date_modified; ?></td>
                                                        <td>
                                                            <a onclick="window.location.href='<?php echo $redirect; ?>'" style="cursor:pointer;">
                                                                <i class="fa fa-eye" data-toggle="tooltip" title="view complaint"></i>
                                                            </a>

                                                            <?php
                                                             if($status =='Open'){
                                                                 ?>
                                                                 <a href="javascript:void()" style="cursor:pointer;" data-toggle="modal" data-target="#mark_resolved<?php echo $complaint_no; ?>">
                                                                     <i class="fas fa-check-circle" data-toggle="tooltip" title="Mark as resolved"></i>
                                                                 </a>
                                                                 <?php
                                                             }

                                                            ?>



                                                        </td>

                                                </tr>

                                                <?php
                                            }
                                        }else{
                                            ?>
                                            <tr>
                                                <td colspan="8" class="text-center">No new complaints yet.</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                        </tbody>
                                        <tfoot>

                                            <tr>
                                                <th>Complaint number</th>
                                                <th>Title</th>
                                                <th>Date submitted</th>
                                                <th>Urgency</th>
                                                <th>Complaint status</th>
                                                <th>Complainer</th>
                                                <th>Last Updated</th>
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
   foreach ($result as $complaint_details){
    $complaint_no = $complaint_details->complaint_number;
    $subject = $complaint_details->title;
    $status = $complaint_details->status;

    //mark as resolved modal
   ?>

            <div class="modal fade" id="mark_resolved<?= $complaint_no; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Mark Complaint as resolved</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true ">×</span>
                            </button>
                        </div>
                        <form action="" method="post">
                        <div class="modal-body">
                           Are you sure you want to mark complaint: <span class="text-warning"><?= $subject; ?></span> as resolved?
                            <input type="hidden" name="complaint_no" value="<?= $complaint_no; ?>">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="mark_resolved" value="Mark as Resolved" class="btn btn-primary">
                        </div>
                        </form>
                    </div>
                </div>
            </div>

       <?php

   }

   if(isset($_POST['mark_resolved'])){
       $complaint_no = $_POST['complaint_no'];
       $redirect = $conn->base_url().'admin/complaints';

       $sql = "UPDATE complaints SET status =:closed WHERE complaint_number =:complaint_no";
       $conn->query($sql);
       $conn->bind(":closed", 'Closed');
       $conn->bind(":complaint_no", $complaint_no);
       try {
           $conn->execute();
           echo "<script>
              toastr['success']('Complaint #$complaint_no was successfully marked as resolved.');
           </script><meta http-equiv='refresh' content='3; $redirect'>";

       }catch (PDOException $err){
           $error =  $err->getMessage();
           echo "<script>
              toastr['error']('An error occurred while updating complaint #$complaint_no as resolved.');
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
