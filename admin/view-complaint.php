<?php
session_start();
date_default_timezone_set("Africa/Lagos");
?>

<?php
if(isset($_SESSION['admin'])){
    if(isset($_GET['complaint_no'])){
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
     <title> Admin View Complaints | Complaints Management System - Yaba College of Technology </title>
    <?php include "inc/header.php"; ?>
    <?php include "mailer-config.php"; ?>



</head>

<body>
<?php

//fetch complaints data from the database
$complaint_no = $_GET['complaint_no'];
$sql = "SELECT * FROM complaints WHERE complaint_number =:complaint_no";
$conn->query($sql);
$conn->bind(":complaint_no", $complaint_no);
$row_count = $conn->rowCount();
$result = $conn->fetchSingle();
$db_complaint_no = $result->complaint_number;
if($complaint_no == $db_complaint_no){
    $subject = $result->title;
    $status = $result->status;
    $urgency = $result->urgency;
    $date_submitted = $result->reg_date;
    $date_modified = $result->last_modified;
    $complaint_image = $result->complaint_file;


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
                        <h4 class="page-title">Complaints History for #<?php echo $db_complaint_no; ?></h4>
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
                                  if($status == 'Closed'){
                                      ?>
                                      <div class="col-lg-12 create-space">
                                          <div class="alert alert-success text-center">
                                              This complaint is closed. You may reply to this complaint to reopen it.
                                          </div>
                                      </div>
                                      <?php
                                  }
                                ?>
                                <h5 class="card-title" style="font-size: 18px;">#<?php echo $db_complaint_no ?> - <span style="color:  #28b779; font-weight: bold;"><?php echo $subject;  ?></span>
                                    <?php
                                      if(!empty($complaint_image)){
                                          //display image here
                                          ?>
                                          <span data-toggle="modal" data-target="#view-image" style="cursor:pointer;"><i class="fa fa-image"></i></span>
                                           <!-- Start view complaint image modal -->
                                          <div class="modal fade" id="view-image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static" data-keyboard="false">
                                              <div class="modal-dialog" role="document ">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">View main complaint image file</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true ">×</span>
                                                          </button>
                                                      </div>
                                                          <div class="modal-body">
                                                              <img src="<?php echo $conn->base_url(); ?>assets/images/<?php echo $complaint_image; ?>" alt="main complaint image" width="400" height="400">

                                                          </div>

                                                          <div class="modal-footer">
                                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                          </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- End view complaint image modal -->
                                          <?php
                                      }
                                    ?>

                                </h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Complaint number</th>
                                            <th>Title</th>
                                            <th>Date submitted</th>
                                            <th>Urgency</th>
                                            <th>Compalint status</th>
                                            <th>Complainer</th>
                                            <th>Last Updated</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                        $sql = "SELECT * FROM complaints JOIN user on complaints.studentID = user.studentID WHERE complaint_number =:complaints_no";
                                        $conn->query($sql);
                                        $conn->bind(":complaints_no", $db_complaint_no);


                                        ?>

                                        <?php
                                              $details = $conn->fetchSingle();
                                                $name = $details->name;
                                                $matric_no = $details->matric_no;
                                                $student_id = $details->studentID;
                                                $complaint_no = $details->complaint_number;
                                                $subject = $details->title;
                                                $message = $details->complaint_message;
                                                $status = $details->status;
                                                $urgency = $details->urgency;
                                                $date_submitted = $details->reg_date;
                                                $date_modified = $details->last_modified;
                                                $urgency_class = '';
                                                $status_class = '';
                                                $image = $details->photo;
                                                $user_email = $details->email;
                                                $student_username = $details->username;

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
                                                    <td><?= $name; ?></td>
                                                    <td><?= $date_modified; ?></td>
                                                </tr>

                                        </tbody>
                                    </table>
                                </div><!-- End table-->

                                <div id="accordian-4">
                                    <div class="card m-t-30">

                                        <a class="card-header link collapsed border-top" data-toggle="collapse" data-parent="#accordian-4" href="#Toggle-3" aria-expanded="false" aria-controls="Toggle-3">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                            <span>Reply this complaint</span>
                                        </a>
                                        <div id="Toggle-3" class="collapse multi-collapse">
                                            <div class="card-body widget-content">
                                                <form action="" method="post" enctype="multipart/form-data">
                                                <div class="row mb-6">
                                                    <div class="col-lg-8 create-space">
                                                        <label for="new_message">Complaints Message <span style="color: orangered;">*</span></label>
                                                        <textarea name="new_message"  cols="30" rows="10" class="form-control"  id="new_message"></textarea>
                                                    </div>
                                                    <div class="col-lg-4 create-space">
                                                        <label for="file">Upload a file</label>
                                                        <input type="file" name="file" class="form-control is-valid">
                                                        <span class="text-info">File size can't exceed 1mb, supported types: jpg, jpeg and png</span>
                                                    </div>
                                                    <input type="hidden" name="user" value="<?= $_SESSION['admin']; ?>">
                                                    <input type="hidden" name="complaint_no" value="<?= $db_complaint_no; ?>">
                                                    <input type="hidden" name="matric_no" value="<?= $matric_no; ?>">
                                                    <input type="hidden" name="student_id" value="<?= $student_id; ?>">
                                                    <input type="hidden" name="old_message" value="<?= $message; ?>">
                                                    <input type="hidden" name="replied_by" value="<?= $admin_name; ?>">
                                                    <input type="hidden" name="user_email" value="<?= $user_email; ?>">

                                                    <input type="submit" class="btn btn-success" value="Submit" id="submit" name="submit" style="position: relative; left: 10px;">
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End edit complaint accordion -->

                                <div class="chat-box scrollable" style="height:475px; background: #fbfdff;">
                                    <!--chat Row -->
                                    <ul class="chat-list">

                                        <!--start chat Row -->
                                        <li class="chat-item">
                                            <div class="chat-img">
                                                <?php
                                                if(!empty($image)){
                                                    ?>   <div class="p-2"><img src="<?= $conn->base_url();?>assets/images/<?= $image;?>" alt="profile image" style="width: 30px; height: 30px; border-radius: 50%;"></div> <?php
                                                }else{
                                                    ?>   <div class="p-2"><i class="fa fa-user" style="font-size: 2.2em; padding: 2px 15px;"></i></div> <?php
                                                }
                                                ?>

                                            </div>
                                            <div class="chat-content">
                                                <h6 class="font-medium"><?php echo $name; ?></h6>
                                                <span style="display: block;position: relative;top: -8px; font-size: 11px;font-weight: bold;color: #ffb848;">Student</span>
                                                <div class="box bg-light-info"><?= $message; ?></div>
                                            </div>
                                            <div class="chat-time" style="color: #25b371; font-size: 13px;"><?= $date_submitted; ?></div>
                                        </li>

                                        <!--end chat Row -->

                                        <?php
                                         //fetch messages replies
                                        $sql = "SELECT * FROM complaint_replies JOIN complaints on complaint_replies.student_id = complaints.studentID
                                                AND complaint_replies.complaint_no = complaints.complaint_number WHERE complaint_number =:complaint_no";

                                        $conn->query($sql);
                                        $conn->bind(":complaint_no", $db_complaint_no);
                                        $result_details = $conn->fetchMultiple();

                                        $row_count = $conn->rowCount();
                                        if($row_count > 0){
                                          foreach ($result_details as $replies){
                                              $complaint_no = $replies->complaint_number;
                                              $student_id = $replies->student_id;
                                              $matric_no = $replies->matric_no;
                                              $complaint_message = $replies->complaint_message;
                                              $complaint_reply_message = $replies->complaint_reply_message;
                                              $replied_by = $replies->replied_by;
                                              $last_updated = $replies->last_updated;
                                              $new_complaint_file = $replies->new_complaint_file;
                                              $student_email = $replies->email;




                                              //echo $replied_by .'<br>';


                                              if($replied_by === $name){
                                                  ?>
                                                  <li class="chat-item">

                                                      <div class="chat-img">
                                                          <?php
                                                          if(!empty($image)){
                                                              ?>   <div class="p-2"><img src="<?= $conn->base_url();?>assets/images/<?= $image;?>" alt="profile image" style="width: 30px; height: 30px; border-radius: 50%;"></div> <?php
                                                          }else{
                                                              ?>   <div class="p-2"><i class="fa fa-user" style="font-size: 2.2em; padding: 2px 15px;"></i></div> <?php
                                                          }
                                                          ?>

                                                      </div>
                                                      <div class="chat-content">
                                                          <h6 class="font-medium"><?php echo $replied_by; ?></h6>
                                                          <span style="display: block;position: relative;top: -8px; font-size: 11px;font-weight: bold;color: #ffb848;">Student</span>
                                                          <div class="box bg-light-info"><?= $complaint_reply_message; ?></div>
                                                      </div>
                                                      <div class="chat-time" style="color: #25b371; font-size: 13px;"><?= $last_updated ; ?></div>
                                                  </li>

                                                  <?php

                                              }else{
                                                  ?>
                                                  <li class="chat-item" style="margin-left: 30px;">
                                                      <?php
                                                      //fetch admin profile image if it exists
                                                      $sql = "SELECT photo FROM admin WHERE username =:username";
                                                      $conn->query($sql);
                                                      $conn->bind(":username", $_SESSION['admin']);
                                                      $admin_image = $conn->fetchColumn();


                                                      ?>

                                                      <div class="chat-img">
                                                          <?php
                                                          if(!empty($admin_image)){
                                                              ?>   <div class="p-2"><img src="<?= $conn->base_url();?>assets/images/<?= $admin_image;?>" alt="profile image" style="width: 30px; height: 30px; border-radius: 50%;"></div> <?php
                                                          }else{
                                                              ?>   <div class="p-2"><i class="fa fa-user" style="font-size: 2.2em; padding: 2px 15px; color:#27a9e3;"></i></div> <?php
                                                          }
                                                          ?>

                                                      </div>


                                                      <div class="chat-content">
                                                          <h6 class="font-medium"><?php echo $replied_by; ?></h6>
                                                          <span style="display: block;position: relative;top: -8px; font-size: 11px;font-weight: bold;color: #ffb848;">Admin</span>
                                                          <div class="box bg-light-info"><?= $complaint_reply_message; ?></div>
                                                      </div>
                                                      <div class="chat-time" style="color: #25b371; font-size: 13px;"><?= $last_updated ; ?></div>
                                                  </li>

                                                  <?php
                                              }


                                          }

                                        }
                                        ?>



                                    </ul>
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
                CKEDITOR.replace( 'new_message', {
                    uiColor: '#28b779'
                });
                CKEDITOR.on('dialogDefinition', function (e) {
                    dialogName = e.data.name;
                    dialogDefinition = e.data.definition;
                    //console.log(dialogName);
                    if(dialogName == 'image'){
                        dialogDefinition.removeContents('Link');
                        dialogDefinition.removeContents('advanced');
                        var tabContent = dialogDefinition.getContents('info');
                        tabContent.remove('txtHSpace');
                        tabContent.remove('txtVSpace');
                    }
                })

            </script>

            <?php
            if(isset($_POST['submit'])){
                if(!empty($_POST['new_message'])){
                    $old_message = $_POST['old_message'];
                    $user = $_POST['user'];
                    $complaint_no = $_POST['complaint_no'];
                    $matric_no = $_POST['matric_no'];
                    $replied_by = $_POST['replied_by'];
                    $date = date('M d, Y').' at ' .date('h:ia');
                    $file_tmpname = $_FILES['file']['tmp_name'];
                    $file_name = $_FILES['file']['name'];
                    $file_size = $_FILES['file']['size'];
                    $new_filename = '';
                    $redirect = $conn->base_url().'admin/complaints';
                    $student_id = $_POST['student_id'];
                    $new_message = $_POST['new_message'];
                    $user_email = $_POST['user_email'];
                    $year = date('Y');


                    if(!empty($file_name)){
                        $ext = explode('.', $file_name);
                        $extension = end($ext);
                        if($extension == 'jpg' || 'png' || 'jpeg' AND $file_size <= 1000000){
                            $new_filename = time().rand(10000,99999).'.'.$extension;
                            $location = "assets/images/".$new_filename;
                            move_uploaded_file($file_tmpname, $location);
                        }else{
                            echo "<script>
                              toastr['error']('Either you uploaded an unsupported file extension or your file size is too large.');
                           </script>";
                            return false;
                        }
                    }


                    //process  inserting of data into database
                    $sql = "INSERT INTO complaint_replies(student_id, complaint_no, matric_no, complaint_message, complaint_reply_message, replied_by, last_updated, new_complaint_file, username)
                            VALUES (:student_id, :complaint_no, :matric_no, :complaint_message, :complaint_reply_message, :replied_by, :last_updated, :complaint_file, :username)";
                    $conn->query($sql);
                    $conn->bind(":student_id", $student_id);
                    $conn->bind(":complaint_no", $complaint_no);
                    $conn->bind(":matric_no", $matric_no);
                    $conn->bind(":complaint_message", $old_message);
                    $conn->bind(":complaint_reply_message", $new_message);
                    $conn->bind(":replied_by", $replied_by);
                    $conn->bind(":complaint_file", $new_filename);
                    $conn->bind(":last_updated", $date);
                    $conn->bind(":username", $_SESSION['admin']);
                    $insert = $conn->execute();

                    //second query to reopen the complaint in the complaints table.
                    $sql_update_status = "UPDATE complaints SET status = :open WHERE complaint_number =:complaint_no";
                    $conn->query($sql_update_status);
                    $conn->bind(":open", 'Open');
                    $conn->bind(":complaint_no", $complaint_no);
                    $update = $conn->execute();

                    //send email to admin about the new update
                    $mail->Subject = "Hello $student_username you have received a reply to your complaint.";
                    //set sender email
                    $mail->setFrom("admin@yabatechcomplaintsys.com", "Yabatech complaint system");
                    //enable HTML
                    $mail->isHTML(true);

                    //email body

                    $mail->Body = "<div style='width: 60%; margin: 40px auto; padding: 30px;'>
                    <div style='margin: 0 auto;'>
                    <div style='padding: 15px; background-color: #d9edf7; '>
                    <h2 style='text-align: center;'> New reply to Complaint #$complaint_no by $admin_name</h2>
                   </div>

                   <div style='border: 2px solid #d9edf7;'>
                   <p style='text-align: center; font-size: 16px;'>Hello $student_username, you have received a new reply to your complaint #$complaint_no  <br>
                   Please find below the details of the new reply message on the complaint #$complaint_no sent by $admin_name.

                   <br>

                     <div class='card-header'>
                       <h3 style='text-decoration: underline; text-align: center; font-size: 30px;'>Complaint Details </h3>
                 </div>

                 <div>
                    <p style='text-align: center; font-size: 18px; color: #000;'>Your Full Name: <span style=' color: #428bca; font-size: 15px; font-weight: 400;'> $name</span></p>
                    <p style='text-align: center; font-size: 18px; color: #000;'>Matric No: <span style=' color: #428bca; font-size: 15px; font-weight: 400;'> $matric_no</span></p>
                    <p  style='text-align: center; font-size: 18px; color: #000;'>Complaint Title: <span style=' color: #428bca; font-size: 15px; font-weight: 400;'> $subject</span></p>
                    <p  style='text-align: center; font-size: 18px; color: #000; padding: 30px;'>Complaint Reply Message: <span style=' color: #428bca; font-size: 15px; font-weight: 400;'> $new_message</span></p>
                    <p  style='text-align: center; font-size: 18px; color: #000;'>Date Sent: <span style=' color: #428bca; font-size: 15px; font-weight: 400;'> $date</span></p>
                  </div>

                   <div style='padding: 10px;  background-color: #d9edf7;'>
                   <p style='text-align: center;'>Please login to your account area to reply to this complaint message. Thanks.</p>
                    <h2 style='font-size: 14px; text-align: center;'>&copy; $year | yabatechcomplaintsys.com | All Rights Reserved </h2>

                   </div>


              </div>

        </div>
     </div>";

    // add recipient's of email
    $mail->addAddress($user_email);
    $mail->addReplyTo("$admin_email", "Acknowledging Receipt of complaint reply: $admin_name");
    //send the email
    $send_email = $mail->send();

            if ($send_email AND $insert AND $update) {
                echo "<script>
      toastr['success']('Your have successfully replied to this complaint.');
    </script><meta http-equiv='refresh' content='3; $redirect'>";

            } else {
                echo "<script>
      toastr['error']('An error occurred. $mail->ErrorInfo');
    </script><meta http-equiv='refresh' content='3; $redirect'>";
            }
        }else{
            echo "<script>
      toastr['error']('Message is a required field.');
    </script>";
        }
    }


            ?>



</body>

</html>
    <?php }else{
    $redirect = $conn->base_url().'admin/complaints';
        header("location: $redirect");

    }?>
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
                            <?php $redirect = $conn->base_url() . 'complaints';?>
                            <meta http-equiv='refresh' content='4; <?= $redirect; ?>'>
                        </div>
                        <p>Redirecting to Complaints page.</p>
                    </div>
                </div>
            </div>
        </div>
        </body>
        </html>

        <?php
    }
}

    else{

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
    </body>
    </html>

    <?php
}?>
