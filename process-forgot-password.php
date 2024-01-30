<?php
//error_reporting(0);
session_start();
require dirname(__DIR__) . "/project/vendor/autoload.php";
include "mailer-config.php";
$conn= new Functions();

date_default_timezone_set("Africa/Lagos");
$redirect = $conn->base_url() .'forgot-password';

if(!empty($_POST['email'])){
    $email = $_POST['email'];
//check if email is valid

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<script>
              toastr['error']('Please enter a valid email address.');
      </script>";
    }else{
        //check if user email exists in records
        $sql = "SELECT * FROM user WHERE email=:email";
        $conn->query($sql);
        $conn->bind(":email", $email);
        $rowcount = $conn->rowCount();

        if ($rowcount > 0){
            $user_details = $conn->fetchSingle();
            $name = $user_details->name;
            $user_id = $user_details->studentID;
            //reset user password
            $verification_id = bin2hex(openssl_random_pseudo_bytes(40));
            $date =strtotime("+10mins");
            $code_expire  = date("F d, Y h:ia", $date);
            $current_date = date('F d, Y h:ia');
            $year = date('Y');

            $sql = "INSERT INTO reset_password (user_id, email, verify_id, code_expire)
                    VALUES (:user_id, :email, :verify_id, :code_expire)";
            $conn->query($sql);
            $conn->bind(":user_id", $user_id);
            $conn->bind(":email", $email);
            $conn->bind(":verify_id", $verification_id);
            $conn->bind(":code_expire", $code_expire);
            $execute = $conn->execute();
            $reset_link = $conn->base_url()."password_verify?code=$verification_id&email=$email";

            //send password reset email to user
            $mail->Subject = "Password Reset for $name";
            //set sender email
            $mail->setFrom('admin@matryxnetwork.com', "Matryx Network");
            //enable HTML
            $mail->isHTML(true);
            //email body
            $mail->Body = "<div style='width: 60%; margin: 40px auto;'>
                    <div style='margin: 0 auto;'>
                    <div style='padding: 15px; background-color: #033e8a; color: #ffffff; font-weight: bold;'>
                        Password Reset Request
                   </div>
                      <p>Hello!!! $name, a password request was initiated on your account on $current_date. </p>
                      <p> Please ignore this email and try to use a stronger password on your account if this was not you.</p>
                      <p> If you requested to reset your password please click the link below to proceed.</p>
                      <p style='color: #f00;'> This link is only valid for 10mins.</p>
                    <p style='text-align: left; font-size: 18px; color: #000;'>Password Reset Link:
                       <a style=' color: #428bca; font-size: 16px; font-weight: normal;' href='$reset_link'>Reset Password</a>
                    </p>

                   <div style='border: 2px solid #d9edf7;'>
                   <div style='padding: 10px;  background-color: #033e8a;;'>
                    <h2 style='font-size: 14px; text-align: center;'>&copy; $year, Matryx Networks | All Rights Reserved </h2>
                     <p style='font-size: 14px; text-align: center;'>
                      <a href='#'  style='color: white; margin: 5px; background-color: #e08206; border-color: #e08206; padding: 10px;
                       -webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px;'>Matryx Network Home </a>
                     </p>

                   </div>
              </div>

        </div>
     </div>";

            $mail->addAddress($email);
            $send_email = $mail->send();

            if($execute AND $send_email){

                echo "<script>
               toastr['success']('We have sent you an email with password reset instructions.');
           </script><meta http-equiv='refresh' content='4; $redirect'>";

            }else{
                echo "<script>
               toastr['error']('An error occurred pls try again later. $mail->ErrorInfo');
           </script>";
            }

        }else{
            echo "<script>
               toastr['error']('Sorry this email address does not exist in our database.');
           </script>";

        }


    }

}else{

    echo "<script>
              toastr['error']('Please enter your email.');
      </script>";
}
