<?php
session_start();
date_default_timezone_set("Africa/Lagos");
?>

<?php
if(isset($_SESSION['username'])){
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>

    <title>Add Complaint | Complaints Management System - Yaba College of Technology </title>

    <?php include "inc/header.php"; ?>
    <?php include "mailer-config.php"; ?>

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
                        <h4 class="page-title">Lodge Complaint</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Lodge Complaint</li>
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
                                //fetch existing user details
                                $sql = "SELECT * FROM user WHERE username =:username";
                                $conn->query($sql);
                                $conn->bind('username', $_SESSION['username']);
                                $row_count = $conn->rowCount();
                                if($row_count > 0){
                                    //fetch user details
                                    $result = $conn->fetchSingle();
                                    $name = $result->name;
                                    $matric_no = $result->matric_no;
                                    $email = $result->email;
                                    $student_id = $result->studentID;



                                ?>
                                <form method="post" id="complaints_form" enctype="multipart/form-data">
                                <div class="row mb-6">

                                    <div class="col-lg-4 create-space">
                                        <label for="name">Name <span style="color: orangered;">*</span></label>
                                        <input type="text" class="form-control is-valid" placeholder="Full Name" id="name" value="<?php echo $name; ?>" name="name" readonly style="cursor: not-allowed">
                                    </div>
                                    <div class="col-lg-4 create-space">
                                        <label for="email">Email <span style="color: orangered;">*</span></label>
                                        <input type="text" class="form-control is-valid" placeholder="Email" id="email" value="<?php echo $email;?>" name="email" readonly style="cursor: not-allowed">
                                    </div>

                                    <div class="col-lg-4 create-space">
                                        <label for="subject">Title <span style="color: orangered;">*</span></label>
                                        <input type="text" class="form-control is-valid" placeholder="Title" id="subject" name="subject">
                                    </div>

                                    <div class="col-lg-4 create-space">
                                        <label for="category">Complaint Category <span style="color: orangered;">*</span></label>

                                        <?php
                                        //fetch all classes
                                        $sql = "SELECT * FROM complaints_category";
                                        $conn->query($sql);
                                        $details = $conn->fetchMultiple();

                                        ?>
                                        <select name="category" id="categoryID" class="category form-control is-valid" style="width: 100%; height:36px;">
                                            <option value="">Select category</option>
                                            <?php
                                            if ($conn->rowCount() > 0) {
                                                foreach ($details as $category) {
                                                    ?>
                                                <option value="<?php echo $category->id ?>">
                                                    <?php echo $category->name ?> </option><?php
                                                }
                                            } else {
                                                ?>
                                                <option value="">No categories found</option><?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-lg-4 create-space">
                                        <label for="subcategory">Complaint Subcategory <span style="color: orangered;">*</span></label>
                                        <select class="category form-control is-valid" id="subcategory" style="width: 100%; height:36px;" name="subcategory">
                                            <option>Select subcategory</option>

                                        </select>
                                    </div>

                                    <div class="col-lg-4 create-space">
                                        <label for="urgency">Urgency <span style="color: orangered;">*</span></label>
                                        <select class="select2 form-control is-valid" id="urgency" style="width: 100%; height:36px;" name="urgency">
                                            <option value="">Select</option>
                                            <option value="high">High</option>
                                            <option value="low">Low</option>
                                            <option value="medium">Medium</option>
                                            <option value="critical">Critical</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-8 create-space">
                                        <label for="c_message">Complaints Message <span style="color: orangered;">*</span></label>
                                        <textarea name="message"  cols="30" rows="10" class="form-control"  id="c_message"></textarea>
                                        <span>Message should not be more than 200 words.</span>
                                    </div>

                                    <div class="col-lg-4 create-space">
                                        <label for="file">Upload a file</label>
                                        <input type="file" name="file" class="form-control is-valid">
                                        <span class="text-info">File size can't exceed 1mb, supported types: jpg, jpeg and png</span>
                                    </div>

                                    <input type="hidden" name="matric_no" value="<?php echo $matric_no; ?>">
                                    <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">

                                    <input type="submit" class="btn btn-success" value="Submit Complaint" id="submit" name="submit">
                                    &nbsp;&nbsp;
                                    <input type="reset" class="btn btn-danger">

                                </div>
                                </form>
                                    <div id="success_msg"></div>
                                <?php } else{
                                    echo "<p style='text-align: center; '> Your details were not found, you can't submit a complaint. </p>";
                                }?>
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
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>

            <script>
                CKEDITOR.replace( 'message', {
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


            <script>
                $(".select2").select2();
                $(".category").select2();
            </script>

            <script>
                $(document).ready(function () {
                    $('#categoryID').on('change', function () {
                        var categoryID = $(this).val();
                        if (categoryID) {
                            $.ajax({
                                type: 'POST',
                                url: 'fetch_subcategory.php',
                                data: 'categoryID=' + categoryID,//append the categoryID
                                success: function (html) {
                                    $('#subcategory').html(html);
                                }
                            });
                        } else {
                            $('#subcategory').html('<option value="">select category  first</option>');
                        }
                    })
                })

            </script>

            <?php
             if(isset($_POST['submit'])){
                 if(!empty($_POST['email']) && !empty($_POST['name'])
                     && !empty($_POST['subject']) && !empty($_POST['category'])
                     && !empty($_POST['subcategory']) && !empty($_POST['message'])){
                     $full_name = $_POST['name'];
                     $email = $_POST['email'];
                     $subject = ($_POST['subject']);
                     $category = ($_POST['category']);
                     $subcategory = ($_POST['subcategory']);
                     $message = $_POST['message'];
                     //generate random complaints ID
                     $complaint_id = rand(1000000,9999999);
                     $date = date('M d, Y').' at ' .date('h:ia');
                     $file_tmpname = $_FILES['file']['tmp_name'];
                     $file_name = $_FILES['file']['name'];
                     $file_size = $_FILES['file']['size'];
                     $new_filename = '';
                     $redirect = $conn->base_url().'complaints';
                     $student_id = $_POST['student_id'];
                     $urgency = $_POST['urgency'];


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

                     if(str_word_count($message) > 200){
                       echo "<script>
                        toastr['error']('Message cannot be more than 200 words.');
                     </script>";
                       return false;
                     }



                     //process  inserting of data into database
                     $sql = "INSERT INTO complaints (title, complaint_number, matric_no, category, complaint_message, complaint_file, reg_date, last_modified, urgency, studentID, subcategory, email)
          VALUES(:title, :complaint_number, :matric_no, :category, :complaint_message, :complaint_file, :reg_date, :last_modified, :urgency, :studentID, :subcategory, :email)";
                     $conn->query($sql);
                     $conn->bind(":title", $subject);
                     $conn->bind(":complaint_number", $complaint_id);
                     $conn->bind(":matric_no", $matric_no);
                     $conn->bind(":category", $category);
                     $conn->bind(":complaint_message", $message);
                     $conn->bind(":complaint_file", $new_filename);
                     $conn->bind(":reg_date", $date);
                     $conn->bind(":last_modified", $date);
                     $conn->bind(":urgency", $urgency);
                     $conn->bind(":studentID", $student_id);
                     $conn->bind(":subcategory", $subcategory);
                     $conn->bind(":email", $email);

                     $send = $conn->execute();

                     //send admin notification

                     $sql = "INSERT INTO admin_messages (user, message_content, date_received, complaint_no)
                            VALUES (:username, :message_content, :date_received, :complaint_no)";
                     $conn->query($sql);
                     $conn->bind(":username", $_SESSION['username']);
                     $message_content = "<p>Hello, $admin_name, a new complaint has been made by $full_name  with complaint no: #$complaint_id. Please visit the complaint page for more details. The Matryx Net Team.</p>";
                     $conn->bind(":message_content", $message_content);
                     $conn->bind(":date_received", $date);
                     $conn->bind(":complaint_no", $complaint_id);
                     $send_notification = $conn->execute();
                     $year = date('Y');


                     //send email to admin about the new update
                     $mail->Subject = "New Complaint submitted by $full_name";
                     //set sender email
                     $mail->setFrom("admin@matryxnetwork.com", "Matryx Networks Limited");
                     //enable HTML
                     $mail->isHTML(true);

                     //email body

                     $mail->Body = "<div style='width: 55%; margin: 40px auto;'>
                    <div style='margin: 0 auto;'>
                    <div style='padding: 15px; background-color: #d9edf7; '>
                    <h2 style='text-align: center;'> New complaint submitted with Complaint #$complaint_id by $full_name</h2>
                   </div>

                   <div style='border: 2px solid #d9edf7;'>
                   <p style='text-align: center; font-size: 16px;'>Hello $admin_name , <br>
                   Please find below the details of the new complaint message submitted by $full_name with complaint ID #$complaint_no on $date.

                   <br>

                     <div class='card-header'>
                       <h3 style='text-decoration: underline; text-align: center; font-size: 30px;'>Complaint Details </h3>
                 </div>

                 <div>
                    <p style='text-align: center; font-size: 18px; color: #000;'>Student's Name: <span style=' color: #428bca; font-size: 15px; font-weight: 400;'> $full_name</span></p>
                    <p style='text-align: center; font-size: 18px; color: #000;'>Matric No: <span style=' color: #428bca; font-size: 15px; font-weight: 400;'> $matric_no</span></p>
                    <p  style='text-align: center; font-size: 18px; color: #000;'>Complaint Title: <span style=' color: #428bca; font-size: 15px; font-weight: 400;'> $subject</span></p>
                    <p  style='text-align: center; font-size: 18px; color: #000; padding: 30px;'>Complaint Message: <span style=' color: #428bca; font-size: 15px; font-weight: 400;'> $message</span></p>
                    <p  style='text-align: center; font-size: 18px; color: #000;'>Date Sent: <span style=' color: #428bca; font-size: 15px; font-weight: 400;'> $date</span></p>
                  </div>

                   <div style='padding: 10px;  background-color: #d9edf7;'>
                   <p style='text-align: center;'>Please login to your account area to reply to this complaint message. Thanks.</p>
                    <h2 style='font-size: 14px; text-align: center;'>&copy; $year | Matryx Networks Limited  | All Rights Reserved </h2>
                     <p style='font-size: 14px; text-align: center;'>
                      <a href='#'  style='color: white; margin: 5px; background-color: #5cb85c; border-color: #4cae4c; padding: 10px; -webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px;'>Matryx Network Home </a>
                     </p>
                   </div>


              </div>

        </div>
     </div>";

                     // add recipient's of email
                     $mail->addAddress($admin_email);
                     $mail->addReplyTo("$email", "Acknowledging Receipt of complaint reply: $full_name");
                     //send the email
                     $send_email = $mail->send();

                     if ($send AND $send_notification AND $send_email){
                         echo "<script>
              toastr['success']('Your Complaint was registered successfully. You will get a reply via email as soon as possible.');
           </script><meta http-equiv='refresh' content='3; $redirect'>";

                     } else {
                         echo "<script>
              toastr['error']('An error occurred. $mail->ErrorInfo');
           </script><meta http-equiv='refresh' content='3; $redirect'>";
                     }
                 }else{
                     echo "<script>
              toastr['error']('All fields apart from complaint file are required.');
           </script>";
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
