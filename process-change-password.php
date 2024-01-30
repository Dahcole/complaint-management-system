<?php
//error_reporting(0);
session_start();
require dirname(__DIR__) . "/project/vendor/autoload.php";
include "mailer-config.php";
$conn= new Functions();

date_default_timezone_set("Africa/Lagos");
$redirect = $conn->base_url() .'login';


if(!empty($_POST['password']) AND !empty($_POST['confirm_password']) AND !empty($_POST['email'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
//check if email is valid

    if($password != $confirm_password){
        echo "<script>
              toastr['error']('Passwords do not match.');
      </script>";
        return false;
    }
    if(!$conn->Checkpassword($password)){
        echo "<script>
              toastr['error']('Password must include one uppercase letter, one lowercase letter, one number and one special character such as $ or % and length should be between 6 and 16');
      </script>";
        return false;
    }

    //save new user password to database
    $hashed_password = $conn->Password_Encryption($password);
    $sql = "UPDATE user SET password =:password WHERE email =:email";
    $conn->query($sql);
    $conn->bind(":password", $hashed_password);
    $conn->bind(":email", $email);
    $execute = $conn->execute();

    //select details of user from database
    $sql = "SELECT name FROM user WHERE email =:email";
    $conn->query($sql);
    $conn->bind(":email", $email);
    $name = $conn->fetchColumn();
    $year = date('Y');

    if($execute){
        //send password reset email to user
        $mail->Subject = "Password Reset success $name";
        //set sender email
        $mail->setFrom('admi@matryxnetwork.com', "Matryx Network");
        //enable HTML
        $mail->isHTML(true);
        //email body
        $mail->Body = "<div style='width: 60%; margin: 40px auto;'>
                    <div style='margin: 0 auto;'>
                    <div style='padding: 15px; background-color: #033e8a; color: #ffffff; font-weight: bold;'>
                        Password Reset Successful
                   </div>
                      <p>Hello!!! $name, your password reset was successful </p>
                      <p> To ensure account security, we recommend you change your account password once every 90 days.</p>
                    <p style='text-align: left; font-size: 18px; color: #000;'>Login to Account:
                       <a style=' color: #428bca; font-size: 16px; font-weight: normal;' href='$redirect'>Login here</a>
                    </p>

                   <div style='border: 2px solid #d9edf7;'>
                   <div style='padding: 10px;  background-color: #033e8a;;'>
                    <h2 style='font-size: 14px; text-align: center;'>&copy; $year, Matryx Network | All Rights Reserved </h2>
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

        if($send_email){
            echo "<script>
              toastr['success']('Your password have been changed successfully.');
          </script><meta http-equiv='refresh' content='4; $redirect'>";
        }else{
            echo "<script>
              toastr['error']('We encountered a slight error. Pls check to verify if your password was changed. $mail->ErrorInfo');
          </script>";
        }
    }

}else{
    echo "<script>
              toastr['error']('Both password and confirm password fields are required.');
      </script>";
}
