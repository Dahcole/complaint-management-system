<?php
session_start();
?>

<?php
if(isset($_SESSION['username'])){
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title> Messages | Complaints Management System - Yaba College of Technology </title>
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
                        <h4 class="page-title">Messages</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Messages</li>
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

                    <div class="col-md-8 offset-md-2">
                        <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">All Messages</h4>
                </div>
                <div class="comment-widgets scrollable">
            <?php
                $sql = "SELECT * FROM messages JOIN user u on messages.user = u.username
                                 WHERE messages.user = :username ORDER BY id DESC";
                $conn->query($sql);
                $conn->bind(":username", $_SESSION['username']);
                 $result_set = $conn->fetchMultiple();
                 if($conn->rowCount() > 0){
                foreach ($result_set as $messages) {
                    $message_sender = $messages->message_sender;
                    $message_content = $messages->message_content;
                    $date_received = $messages->date_received;
                    $complaint_no = $messages->complaint_no;
                    $is_read = $messages->is_read;
                    $image = $messages->photo;
                    $redirect = $conn->base_url()."messages";
                    $msg_id = $messages->id;
                    ?>
                    <!-- Comment Row -->
                    <div class="d-flex flex-row comment-row m-t-0">
                        <?php
                         if(!empty($image)){
                             ?>   <div class="p-2"><img src="<?= $conn->base_url();?>assets/images/<?= $image;?>" alt="profile image" style="width: 50px; height: 50px; border-radius: 50%;"></div> <?php
                         }else{
                             ?>   <div class="p-2"><i class="fa fa-user" style="font-size: 2.2em; padding: 2px 15px;"></i></div> <?php
                         }

                        ?>


                        <div class="comment-text w-100">
                            <h6 class="font-medium">Sent by: <?php echo $message_sender; ?> (#<?php echo $complaint_no; ?>)</h6>
                            <span class="m-b-15 d-block"><?php echo $message_content; ?> </span>
                            <div class="comment-footer">
                                <span class="text-muted float-right"><?php echo $date_received; ?></span>
                                <?php
                                 if($is_read == 'yes') {
                                    ?>
                                     <span class="text-success"><i class="fa fa-check"></i> Read</span>
                                     <?php
                                 }else {
                                     ?>
                                         <span  data-toggle="modal" data-target="#mark_read<?php echo $msg_id; ?>" style="cursor:pointer;"><i class="fa fa-eye" data-toggle="tooltip" title="Mark as read"></i></span>

                                     <?php
                                 }

                                ?>
                                <span  data-toggle="modal" data-target="#delete_msg<?php echo $msg_id; ?>" style="cursor:pointer;"><i class="fa fa-trash" data-toggle="tooltip" title="Delete Message"></i></span>

                            </div>
                        </div>
                    </div>
                    <!-- Comment Row -->


                    <?php
                }


            }else{
                echo "<p class='text-center'>You have not received any new notifications yet. </p>";
            }

            ?>



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
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>




<?php
foreach ($result_set as $details){
    $redirect = $conn->base_url()."messages";
    $msg_id = $details->id;

    ?>
<!--        delete message modal start-->
    <div class="modal fade" id="delete_msg<?= $msg_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true ">×</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        Are you sure you want to delete this message?
                        <input type="hidden" name="msg_id" value="<?= $msg_id; ?>">
                        <input type="hidden" name="user" value="<?= $_SESSION['username']; ?>">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" name="delete_message" value="Delete Message" class="btn btn-danger">
                    </div>
                </form>
            </div>
        </div>
    </div>
<!--    delete message modal end -->

<!--        Mark message as read modal start-->
    <div class="modal fade" id="mark_read<?= $msg_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mark Message as read </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true ">×</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        Are you sure you want to mark this message as read?
                        <input type="hidden" name="msg_id" value="<?= $msg_id; ?>">
                        <input type="hidden" name="user" value="<?= $_SESSION['username']; ?>">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" name="mark_read" value="Mark as read" class="btn btn-info">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--        Mark message as read modal end -->



    <?php

}

if(isset($_POST['delete_message'])){
    $msg_id = $_POST['msg_id'];
    $user = $_POST['user'];

    $sql = "DELETE FROM messages WHERE id =:id AND user =:user";
    $conn->query($sql);
    $conn->bind(":id", $msg_id);
    $conn->bind(":user", $user);

    try {
        $conn->execute();
        echo "<script>
              toastr['success']('Message was deleted successfully.');
           </script><meta http-equiv='refresh' content='3; $redirect'>";

    }catch (PDOException $err){
        $error = $err->getMessage();
        echo "<script>
              toastr['error']('An error occurred: $error');
           </script><meta http-equiv='refresh' content='3; $redirect'>";
    }

}

if(isset($_POST['mark_read'])){
    $msg_id = $_POST['msg_id'];
    $user = $_POST['user'];

    $sql = "UPDATE messages SET is_read =:yes WHERE id =:id AND user =:user";
    $conn->query($sql);
    $conn->bind(":id", $msg_id);
    $conn->bind(":user", $user);
    $conn->bind(":yes", "yes");

    try {
        $conn->execute();
        echo "<script>
              toastr['success']('Message status changed to read successfully.');
           </script><meta http-equiv='refresh' content='3; $redirect'>";

    }catch (PDOException $err){
        $error = $err->getMessage();
        echo "<script>
              toastr['error']('An error occurred: $error');
           </script><meta http-equiv='refresh' content='3; $redirect'>";
    }

}

?>



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